<?php
/**
 * Jingga
 *
 * PHP Version 8.1
 *
 * @package   Modules\Accounting
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\Accounting\Controller;

use Modules\Accounting\Models\AccountAbstract;
use Modules\Accounting\Models\AccountAbstractMapper;
use Modules\Accounting\Models\AccountL11nMapper;
use Modules\Accounting\Models\AccountType;
use Modules\Accounting\Models\CostCenter;
use Modules\Accounting\Models\CostCenterL11nMapper;
use Modules\Accounting\Models\CostCenterMapper;
use Modules\Accounting\Models\CostObject;
use Modules\Accounting\Models\CostObjectL11nMapper;
use Modules\Accounting\Models\CostObjectMapper;
use Modules\Accounting\Models\Posting;
use Modules\Accounting\Models\PostingElement;
use Modules\Accounting\Models\PostingMapper;
use Modules\Accounting\Models\PostingSide;
use Modules\Admin\Models\AccountMapper;
use Modules\Admin\Models\NullAccount;
use Modules\Billing\Models\BillStatus;
use Modules\ItemManagement\Models\Attribute\ItemAttributeTypeMapper;
use Modules\ItemManagement\Models\Attribute\ItemAttributeValueMapper;
use phpOMS\Localization\BaseStringL11n;
use phpOMS\Localization\ISO639x1Enum;
use phpOMS\Message\Http\HttpRequest;
use phpOMS\Message\Http\HttpResponse;
use phpOMS\Message\Http\RequestStatusCode;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Model\Message\FormValidation;

/**
 * Accounting controller class.
 *
 * This class is responsible for the basic accounting activities.
 *
 * @package Modules\Accounting
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 */
final class ApiController extends Controller
{
    use \Modules\Attribute\Controller\ApiAttributeTraitController;

    /**
     * Event after creating a stock
     *
     * @param int         $account Account
     * @param mixed       $old     Old stock model
     * @param mixed       $new     New / created stock model
     * @param null|int    $type    Event type (usually mapper hash)
     * @param string      $trigger Trigger name
     * @param null|string $module  Module name who triggers the event
     * @param null|string $ref     Reference (e.g. reference to a different model)
     * @param null|string $content Content for the event (e.g. comment, values, ...)
     * @param null|string $ip      Ip of the account
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function eventBillArchive(
        int $account,
        mixed $old,
        mixed $new,
        ?int $type = null,
        string $trigger = '',
        ?string $module = null,
        ?string $ref = null,
        ?string $content = null,
        ?string $ip = null
    ) : void
    {
        if (!$new->type->isAccounting
            || $new->status !== BillStatus::ARCHIVED
        ) {
            return;
        }

        $posting = PostingMapper::get()
            ->where('bill', $new->id)
            ->limit(1)
            ->execute();

        // Posting already created
        if ($posting->id !== 0) {
            \phpOMS\Log\FileLogger::getInstance()->warning(
                \phpOMS\Log\FileLogger::MSG_FULL, [
                    'message' => 'Posting for bill "' . $new->id . '" already created',
                    'line'    => __LINE__,
                    'file'    => self::class,
                ]
            );

            return;
        }

        $type   = '';
        $person = null;

        /** @var \Modules\Billing\Models\Bill $new */
        if (($new->client?->id ?? 0) !== 0) {
            $new->client = \Modules\ClientManagement\Models\ClientMapper::get()
                ->where('id', $new->client->id)
                ->execute();

            $person = $new->client;
            $type   = 'client';
        } else {
            $new->supplier = \Modules\SupplierManagement\Models\SupplierMapper::get()
                ->where('id', $new->supplier->id)
                ->execute();

            $person = $new->supplier;
            $type   = 'supplier';
        }

        $finAcc = AccountAbstractMapper::get()
            ->where('code', $person->number)
            ->execute();

        $posting            = new Posting();
        $posting->bill      = $new->id;
        $posting->createdBy = new NullAccount($account);
        $posting->unit      = $new->unit;
        $posting->account   = AccountAbstractMapper::get()
            ->where('code', $person->number)
            ->execute();

        // First side
        $firstElement            = new PostingElement();
        $firstElement->createdBy = new NullAccount($account);
        $firstElement->unit      = $posting->unit;
        $firstElement->account   = $finAcc;
        $firstElement->value     = $new->grossSales->getInt();

        if ($type === 'client') {
            $firstElement->type = $new->grossSales->getInt() > 0
                ? PostingSide::DEBIT
                : PostingSide::CREDIT;
        } else {
            $firstElement->type = $new->grossSales->getInt() > 0
                ? PostingSide::CREDIT
                : PostingSide::DEBIT;
        }

        $posting->elements[] = $firstElement;

        // Second side
        // @todo Implement automatic posting of archived bill
        //      https://github.com/Karaka-Management/oms-Accounting/issues/10
        foreach ($new->elements as $element) {
            // handle pl account from bill
            // handle taxes
            $postingElement            = new PostingElement();
            $postingElement->createdBy = new NullAccount($account);
            $postingElement->unit      = $posting->unit;
            $postingElement->account   = $finAcc;
            $postingElement->value     = $element->totalSalesPriceGross->getInt();
            $postingElement->type      = $firstElement->type === PostingSide::DEBIT
                ? PostingSide::CREDIT
                : PostingSide::DEBIT;

            $posting->elements[] = $postingElement;
        }

        // check debit === credit
        // check bill tax = sum(element.tax)
        // check bill net = sum(element.net)
        // check bill gross = sum(element.gross)

        $this->createModel($account, $posting, PostingMapper::class, 'posting-bill', $ip);
    }

    public function hookPersonalAccountCreate(
        int $account,
        mixed $old,
        mixed $new,
        ?int $type = null,
        string $trigger = '',
        ?string $module = null,
        ?string $ref = null,
        ?string $content = null,
        ?string $ip = null
    ) : void
    {
        $accountType = $new instanceof \Modules\ClientManagement\Models\Client
            ? AccountType::DEBITOR
            : AccountType::CREDITOR;

        $new->account = AccountMapper::get()
            ->where('id', $new->account->id)
            ->execute();

        $response = new HttpResponse();
        $request  = new HttpRequest();

        // @feature Create a way to let admins create a default account format for clients/suppliers
        //      https://github.com/Karaka-Management/oms-Accounting/issues/8

        $request->header->account = $account;
        $request->setData('code', $new->number);
        $request->setData('content', \rtrim($new->account->name1 . ' ' . $new->account->name2));
        $request->setData('language', ISO639x1Enum::_EN);
        $request->setData('type', $accountType);
        $request->setData('account', $new->account->id);
        $this->apiAccountCreate($request, $response);
    }

    /**
     * Api method to create an account
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiAccountCreate(RequestAbstract $request, ResponseAbstract $response, array $data = []) : void
    {
        if (!empty($val = $this->validateAccountCreate($request))) {
            $response->header->status = RequestStatusCode::R_400;
            $this->createInvalidCreateResponse($request, $response, $val);

            return;
        }

        $account = $this->createAccountFromRequest($request);
        $this->createModel($request->header->account, $account, AccountAbstractMapper::class, 'account', $request->getOrigin());
        $this->createStandardCreateResponse($request, $response, $account);
    }

    /**
     * Validate account create request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool>
     *
     * @since 1.0.0
     */
    private function validateAccountCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['code'] = !$request->hasData('code'))
        ) {
            return $val;
        }

        return [];
    }

    /**
     * Method to create account from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return AccountAbstract
     *
     * @since 1.0.0
     */
    private function createAccountFromRequest(RequestAbstract $request) : AccountAbstract
    {
        $account          = new AccountAbstract();
        $account->code    = $request->getDataString('code') ?? '';
        $account->account = $request->getDataInt('account');

        if ($request->hasData('content')) {
            $account->setL11n(
                $request->getDataString('content') ?? '',
                ISO639x1Enum::tryFromValue($request->getDataString('language')) ?? ISO639x1Enum::_EN
            );
        }

        $account->type = AccountType::tryFromValue($request->getDataInt('type')) ?? AccountType::IMPERSONAL;

        return $account;
    }

    /**
     * Api method to create item attribute l11n
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiAccountL11nCreate(RequestAbstract $request, ResponseAbstract $response, array $data = []) : void
    {
        if (!empty($val = $this->validateAccountL11nCreate($request))) {
            $response->header->status = RequestStatusCode::R_400;
            $this->createInvalidCreateResponse($request, $response, $val);

            return;
        }

        $accountL11n = $this->createAccountL11nFromRequest($request);
        $this->createModel($request->header->account, $accountL11n, AccountL11nMapper::class, 'account_l11n', $request->getOrigin());
        $this->createStandardCreateResponse($request, $response, $accountL11n);
    }

    /**
     * Method to create item attribute l11n from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return BaseStringL11n
     *
     * @since 1.0.0
     */
    private function createAccountL11nFromRequest(RequestAbstract $request) : BaseStringL11n
    {
        $accountL11n           = new BaseStringL11n();
        $accountL11n->ref      = $request->getDataInt('ref') ?? 0;
        $accountL11n->language = ISO639x1Enum::tryFromValue($request->getDataString('language')) ?? $request->header->l11n->language;
        $accountL11n->content  = $request->getDataString('content') ?? '';

        return $accountL11n;
    }

    /**
     * Validate item attribute l11n create request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool>
     *
     * @since 1.0.0
     */
    private function validateAccountL11nCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['content'] = !$request->hasData('content'))
            || ($val['ref'] = !$request->hasData('ref'))
        ) {
            return $val;
        }

        return [];
    }

    /**
     * Api method to update an account
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiAccountUpdate(RequestAbstract $request, ResponseAbstract $response, array $data = []) : void
    {
        if (!empty($val = $this->validateAccountUpdate($request))) {
            $response->data['account_update'] = new FormValidation($val);
            $response->header->status         = RequestStatusCode::R_400;

            return;
        }
    }

    /**
     * Validate account update request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool>
     *
     * @since 1.0.0
     */
    private function validateAccountUpdate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['id'] = !$request->hasData('id'))
        ) {
            return $val;
        }

        return [];
    }

    /**
     * Api method to create an cost center
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiCostCenterCreate(RequestAbstract $request, ResponseAbstract $response, array $data = []) : void
    {
        if (!empty($val = $this->validateCostCenterCreate($request))) {
            $response->header->status = RequestStatusCode::R_400;
            $this->createInvalidCreateResponse($request, $response, $val);

            return;
        }

        $costcenter = $this->createCostCenterFromRequest($request);
        $this->createModel($request->header->account, $costcenter, CostCenterMapper::class, 'costcenter', $request->getOrigin());

        // Create item attribute value
        $type = ItemAttributeTypeMapper::get()
            ->with('defaults')
            ->where('name', 'costcenter')
            ->execute();

        $internalRequest                  = new HttpRequest($request->uri);
        $internalRequest->header->account = $request->header->account;
        $internalRequest->setData('default', true);
        $internalRequest->setData('value', $costcenter->code);
        $internalRequest->setData('title', $costcenter->getL11n());
        $internalRequest->setData('language', $costcenter->l11n->language);
        $internalRequest->setData('unit', $request->getDataInt('unit') ?? $this->app->unitId);

        $attrValue = $this->createAttributeValueFromRequest($internalRequest, $type);
        $this->createModel($request->header->account, $attrValue, ItemAttributeValueMapper::class, 'attr_value', $request->getOrigin());

        $this->createModelRelation(
            $request->header->account,
            $type->id,
            $attrValue->id,
            ItemAttributeTypeMapper::class, 'defaults', '', $request->getOrigin()
        );

        $this->createStandardCreateResponse($request, $response, $costcenter);
    }

    /**
     * Validate cost center create request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool>
     *
     * @since 1.0.0
     */
    private function validateCostCenterCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['code'] = !$request->hasData('code'))
        ) {
            return $val;
        }

        return [];
    }

    /**
     * Method to create cost center from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return CostCenter
     *
     * @since 1.0.0
     */
    private function createCostCenterFromRequest(RequestAbstract $request) : CostCenter
    {
        $costcenter       = new CostCenter();
        $costcenter->code = $request->getDataString('code') ?? '';
        $costcenter->setL11n(
            $request->getDataString('content') ?? '',
            ISO639x1Enum::tryFromValue($request->getDataString('language')) ?? ISO639x1Enum::_EN
        );
        $costcenter->unit = $request->getDataInt('unit');

        return $costcenter;
    }

    /**
     * Api method to update an cost center
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiCostCenterUpdate(RequestAbstract $request, ResponseAbstract $response, array $data = []) : void
    {
        if (!empty($val = $this->validateCostCenterUpdate($request))) {
            $response->data['account_update'] = new FormValidation($val);
            $response->header->status         = RequestStatusCode::R_400;

            return;
        }
    }

    /**
     * Validate cost center update request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool>
     *
     * @since 1.0.0
     */
    private function validateCostCenterUpdate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['id'] = !$request->hasData('id'))
        ) {
            return $val;
        }

        return [];
    }

    /**
     * Api method to create an cost object
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiCostObjectCreate(RequestAbstract $request, ResponseAbstract $response, array $data = []) : void
    {
        if (!empty($val = $this->validateCostObjectCreate($request))) {
            $response->header->status = RequestStatusCode::R_400;
            $this->createInvalidCreateResponse($request, $response, $val);

            return;
        }

        $costobject = $this->createCostObjectFromRequest($request);
        $this->createModel($request->header->account, $costobject, CostObjectMapper::class, 'costobject', $request->getOrigin());

        // Create item attribute value
        $type = ItemAttributeTypeMapper::get()
            ->with('defaults')
            ->where('name', 'costobject')
            ->execute();

            $internalRequest                  = new HttpRequest($request->uri);
            $internalRequest->header->account = $request->header->account;
            $internalRequest->setData('default', true);
            $internalRequest->setData('value', $costobject->code);
            $internalRequest->setData('title', $costobject->getL11n());
            $internalRequest->setData('language', $costobject->l11n->language);
            $internalRequest->setData('unit', $request->getDataInt('unit') ?? $this->app->unitId);

        $attrValue = $this->createAttributeValueFromRequest($internalRequest, $type);
        $this->createModel($request->header->account, $attrValue, ItemAttributeValueMapper::class, 'attr_value', $request->getOrigin());

        $this->createModelRelation(
            $request->header->account,
            $type->id,
            $attrValue->id,
            ItemAttributeTypeMapper::class, 'defaults', '', $request->getOrigin()
        );

        $this->createStandardCreateResponse($request, $response, $costobject);
    }

    /**
     * Method to create cost object from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return CostObject
     *
     * @since 1.0.0
     */
    private function createCostObjectFromRequest(RequestAbstract $request) : CostObject
    {
        $costobject       = new CostObject();
        $costobject->code = $request->getDataString('code') ?? '';
        $costobject->setL11n(
            $request->getDataString('content') ?? '',
            ISO639x1Enum::tryFromValue($request->getDataString('language')) ?? ISO639x1Enum::_EN
        );
        $costobject->unit = $request->getDataInt('unit');

        return $costobject;
    }

    /**
     * Validate cost object create request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool>
     *
     * @since 1.0.0
     */
    private function validateCostObjectCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['code'] = !$request->hasData('code'))
        ) {
            return $val;
        }

        return [];
    }

    /**
     * Api method to update an cost object
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiCostObjectUpdate(RequestAbstract $request, ResponseAbstract $response, array $data = []) : void
    {
        if (!empty($val = $this->validateCostObjectUpdate($request))) {
            $response->data['account_update'] = new FormValidation($val);
            $response->header->status         = RequestStatusCode::R_400;

            return;
        }
    }

    /**
     * Validate cost object update request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool>
     *
     * @since 1.0.0
     */
    private function validateCostObjectUpdate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['id'] = !$request->hasData('id'))
        ) {
            return $val;
        }

        return [];
    }

    /**
     * Api method to create an entry
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiEntryCreate(RequestAbstract $request, ResponseAbstract $response, array $data = []) : void
    {
        if (!empty($val = $this->validateEntryCreate($request))) {
            $response->header->status = RequestStatusCode::R_400;
            $this->createInvalidCreateResponse($request, $response, $val);

            return;
        }
    }

    /**
     * Validate entry create request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool>
     *
     * @since 1.0.0
     */
    private function validateEntryCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['name'] = !$request->hasData('name'))
        ) {
            return $val;
        }

        return [];
    }

    /**
     * Api method to update an entry
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiEntryUpdate(RequestAbstract $request, ResponseAbstract $response, array $data = []) : void
    {
        if (!empty($val = $this->validateEntryUpdate($request))) {
            $response->data['account_update'] = new FormValidation($val);
            $response->header->status         = RequestStatusCode::R_400;

            return;
        }
    }

    /**
     * Validate entry update request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool>
     *
     * @since 1.0.0
     */
    private function validateEntryUpdate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['id'] = !$request->hasData('id'))
        ) {
            return $val;
        }

        return [];
    }

    /**
     * Api method to create an recurring entry
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiRecurringEntryCreate(RequestAbstract $request, ResponseAbstract $response, array $data = []) : void
    {
        if (!empty($val = $this->validateRecurringEntryCreate($request))) {
            $response->header->status = RequestStatusCode::R_400;
            $this->createInvalidCreateResponse($request, $response, $val);

            return;
        }
    }

    /**
     * Validate recurring entry create request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool>
     *
     * @since 1.0.0
     */
    private function validateRecurringEntryCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['name'] = !$request->hasData('name'))
        ) {
            return $val;
        }

        return [];
    }

    /**
     * Api method to update an recurring entry
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiRecurringEntryUpdate(RequestAbstract $request, ResponseAbstract $response, array $data = []) : void
    {
        if (!empty($val = $this->validateRecurringEntryUpdate($request))) {
            $response->data['account_update'] = new FormValidation($val);
            $response->header->status         = RequestStatusCode::R_400;

            return;
        }
    }

    /**
     * Validate recurring entry update request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool>
     *
     * @since 1.0.0
     */
    private function validateRecurringEntryUpdate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['id'] = !$request->hasData('id'))
        ) {
            return $val;
        }

        return [];
    }

    /**
     * Api method to create an tax key
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiTaxKeyCreate(RequestAbstract $request, ResponseAbstract $response, array $data = []) : void
    {
        if (!empty($val = $this->validateTaxKeyCreate($request))) {
            $response->header->status = RequestStatusCode::R_400;
            $this->createInvalidCreateResponse($request, $response, $val);

            return;
        }
    }

    /**
     * Validate tax key create request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool>
     *
     * @since 1.0.0
     */
    private function validateTaxKeyCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['name'] = !$request->hasData('name'))
        ) {
            return $val;
        }

        return [];
    }

    /**
     * Api method to update an tax key
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiTaxKeyUpdate(RequestAbstract $request, ResponseAbstract $response, array $data = []) : void
    {
        if (!empty($val = $this->validateTaxKeyUpdate($request))) {
            $response->data['account_update'] = new FormValidation($val);
            $response->header->status         = RequestStatusCode::R_400;

            return;
        }
    }

    /**
     * Validate tax key update request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool>
     *
     * @since 1.0.0
     */
    private function validateTaxKeyUpdate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['id'] = !$request->hasData('id'))
        ) {
            return $val;
        }

        return [];
    }

    /**
     * Api method to create an batch entry
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiBatchEntryCreate(RequestAbstract $request, ResponseAbstract $response, array $data = []) : void
    {
        if (!empty($val = $this->validateBatchEntryCreate($request))) {
            $response->header->status = RequestStatusCode::R_400;
            $this->createInvalidCreateResponse($request, $response, $val);

            return;
        }
    }

    /**
     * Validate batch entry create request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool>
     *
     * @since 1.0.0
     */
    private function validateBatchEntryCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['name'] = !$request->hasData('name'))
        ) {
            return $val;
        }

        return [];
    }

    /**
     * Api method to update an batch entry
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiBatchEntryUpdate(RequestAbstract $request, ResponseAbstract $response, array $data = []) : void
    {
        if (!empty($val = $this->validateBatchEntryUpdate($request))) {
            $response->data['account_update'] = new FormValidation($val);
            $response->header->status         = RequestStatusCode::R_400;

            return;
        }
    }

    /**
     * Validate batch entry update request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool>
     *
     * @since 1.0.0
     */
    private function validateBatchEntryUpdate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['id'] = !$request->hasData('id'))
        ) {
            return $val;
        }

        return [];
    }

    /**
     * Api method to create item attribute l11n
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiCostCenterL11nCreate(RequestAbstract $request, ResponseAbstract $response, array $data = []) : void
    {
        if (!empty($val = $this->validateCostCenterL11nCreate($request))) {
            $response->header->status = RequestStatusCode::R_400;
            $this->createInvalidCreateResponse($request, $response, $val);

            return;
        }

        $l11n = $this->createCostCenterL11nFromRequest($request);
        $this->createModel($request->header->account, $l11n, CostCenterL11nMapper::class, 'account_l11n', $request->getOrigin());
        $this->createStandardCreateResponse($request, $response, $l11n);
    }

    /**
     * Method to create item attribute l11n from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return BaseStringL11n
     *
     * @since 1.0.0
     */
    private function createCostCenterL11nFromRequest(RequestAbstract $request) : BaseStringL11n
    {
        $l11n           = new BaseStringL11n();
        $l11n->ref      = $request->getDataInt('ref') ?? 0;
        $l11n->language = ISO639x1Enum::tryFromValue($request->getDataString('language')) ?? $request->header->l11n->language;
        $l11n->content  = $request->getDataString('content') ?? '';

        return $l11n;
    }

    /**
     * Validate item attribute l11n create request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool>
     *
     * @since 1.0.0
     */
    private function validateCostCenterL11nCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['content'] = !$request->hasData('content'))
            || ($val['ref'] = !$request->hasData('ref'))
        ) {
            return $val;
        }

        return [];
    }

    /**
     * Api method to create item attribute l11n
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiCostObjectL11nCreate(RequestAbstract $request, ResponseAbstract $response, array $data = []) : void
    {
        if (!empty($val = $this->validateCostObjectL11nCreate($request))) {
            $response->header->status = RequestStatusCode::R_400;
            $this->createInvalidCreateResponse($request, $response, $val);

            return;
        }

        $l11n = $this->createCostObjectL11nFromRequest($request);
        $this->createModel($request->header->account, $l11n, CostObjectL11nMapper::class, 'account_l11n', $request->getOrigin());
        $this->createStandardCreateResponse($request, $response, $l11n);
    }

    /**
     * Method to create item attribute l11n from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return BaseStringL11n
     *
     * @since 1.0.0
     */
    private function createCostObjectL11nFromRequest(RequestAbstract $request) : BaseStringL11n
    {
        $l11n           = new BaseStringL11n();
        $l11n->ref      = $request->getDataInt('ref') ?? 0;
        $l11n->language = ISO639x1Enum::tryFromValue($request->getDataString('language')) ?? $request->header->l11n->language;
        $l11n->content  = $request->getDataString('content') ?? '';

        return $l11n;
    }

    /**
     * Validate item attribute l11n create request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool>
     *
     * @since 1.0.0
     */
    private function validateCostObjectL11nCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['content'] = !$request->hasData('content'))
            || ($val['ref'] = !$request->hasData('ref'))
        ) {
            return $val;
        }

        return [];
    }
}

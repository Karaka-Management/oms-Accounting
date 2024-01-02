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
use Modules\Accounting\Models\CostCenter;
use Modules\Accounting\Models\CostCenterMapper;
use Modules\Accounting\Models\CostObject;
use Modules\Accounting\Models\CostObjectMapper;
use phpOMS\Localization\BaseStringL11n;
use phpOMS\Localization\ISO639x1Enum;
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
    public function hookPersonalAccountCreate(...$data)
    {
        \var_dump($data);
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
        if (($val['account'] = !$request->hasData('account'))
            || ($val['content'] = !$request->hasData('content'))
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
        $account->account = $request->getDataString('account') ?? '';
        $account->setL11n($request->getDataString('content') ?? '', $request->getDataString('language') ?? ISO639x1Enum::_EN);

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
        $accountL11n      = new BaseStringL11n();
        $accountL11n->ref = $request->getDataInt('ref') ?? 0;
        $accountL11n->setLanguage(
            $request->getDataString('language') ?? $request->header->l11n->language
        );
        $accountL11n->content = $request->getDataString('content') ?? '';

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
     * Method to create costcenter from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return CostCenter
     *
     * @since 1.0.0
     */
    private function createCostCenterFromRequest(RequestAbstract $request) : CostCenter
    {
        $costcenter          = new CostCenter();
        $costcenter->code = $request->getDataString('code') ?? '';
        $costcenter->setL11n($request->getDataString('content') ?? '', $request->getDataString('language') ?? ISO639x1Enum::_EN);
        $costcenter->unit = $request->getDataInt('unit') ?? 1;

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
        $this->createStandardCreateResponse($request, $response, $costobject);
    }

    /**
     * Method to create costobject from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return CostObject
     *
     * @since 1.0.0
     */
    private function createCostObjectFromRequest(RequestAbstract $request) : CostObject
    {
        $costobject          = new CostObject();
        $costobject->code = $request->getDataString('code') ?? '';
        $costobject->setL11n($request->getDataString('content') ?? '', $request->getDataString('language') ?? ISO639x1Enum::_EN);
        $costobject->unit = $request->getDataInt('unit') ?? 1;

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
}

<?php
/**
 * Karaka
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
    /**
     * Api method to create an account
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiAccountCreate(RequestAbstract $request, ResponseAbstract $response, mixed $data = null) : void
    {
        if (!empty($val = $this->validateAccountCreate($request))) {
            $response->data['account_create'] = new FormValidation($val);
            $response->header->status = RequestStatusCode::R_400;

            return;
        }
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
        if (($val['name'] = !$request->hasData('name'))
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
     * @return mixed
     *
     * @since 1.0.0
     */
    private function createAccountFromRequest(RequestAbstract $request) : mixed
    {
        return null;
    }

    /**
     * Api method to update an account
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiAccountUpdate(RequestAbstract $request, ResponseAbstract $response, mixed $data = null) : void
    {
        if (!empty($val = $this->validateAccountUpdate($request))) {
            $response->data['account_update'] = new FormValidation($val);
            $response->header->status = RequestStatusCode::R_400;

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
     * Method to update account from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return mixed
     *
     * @since 1.0.0
     */
    private function updateAccountFromRequest(RequestAbstract $request) : mixed
    {
        return null;
    }

    /**
     * Api method to create an cost center
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiCostCenterCreate(RequestAbstract $request, ResponseAbstract $response, mixed $data = null) : void
    {
        if (!empty($val = $this->validateCostCenterCreate($request))) {
            $response->data['account_create'] = new FormValidation($val);
            $response->header->status = RequestStatusCode::R_400;

            return;
        }
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
        if (($val['name'] = !$request->hasData('name'))
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
     * @return mixed
     *
     * @since 1.0.0
     */
    private function createCostCenterFromRequest(RequestAbstract $request) : mixed
    {
        return null;
    }

    /**
     * Api method to update an cost center
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiCostCenterUpdate(RequestAbstract $request, ResponseAbstract $response, mixed $data = null) : void
    {
        if (!empty($val = $this->validateCostCenterUpdate($request))) {
            $response->data['account_update'] = new FormValidation($val);
            $response->header->status = RequestStatusCode::R_400;

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
     * Method to update cost center from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return mixed
     *
     * @since 1.0.0
     */
    private function updateCostCenterFromRequest(RequestAbstract $request) : mixed
    {
        return null;
    }

    /**
     * Api method to create an cost object
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiCostObjectCreate(RequestAbstract $request, ResponseAbstract $response, mixed $data = null) : void
    {
        if (!empty($val = $this->validateCostObjectCreate($request))) {
            $response->data['account_create'] = new FormValidation($val);
            $response->header->status = RequestStatusCode::R_400;

            return;
        }
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
        if (($val['name'] = !$request->hasData('name'))
        ) {
            return $val;
        }

        return [];
    }

    /**
     * Method to create cost object from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return mixed
     *
     * @since 1.0.0
     */
    private function createCostObjectFromRequest(RequestAbstract $request) : mixed
    {
        return null;
    }

    /**
     * Api method to update an cost object
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiCostObjectUpdate(RequestAbstract $request, ResponseAbstract $response, mixed $data = null) : void
    {
        if (!empty($val = $this->validateCostObjectUpdate($request))) {
            $response->data['account_update'] = new FormValidation($val);
            $response->header->status = RequestStatusCode::R_400;

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
     * Method to update cost object from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return mixed
     *
     * @since 1.0.0
     */
    private function updateCostObjectFromRequest(RequestAbstract $request) : mixed
    {
        return null;
    }

    /**
     * Api method to create an entry
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiEntryCreate(RequestAbstract $request, ResponseAbstract $response, mixed $data = null) : void
    {
        if (!empty($val = $this->validateEntryCreate($request))) {
            $response->data['account_create'] = new FormValidation($val);
            $response->header->status = RequestStatusCode::R_400;

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
     * Method to create entry from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return mixed
     *
     * @since 1.0.0
     */
    private function createEntryFromRequest(RequestAbstract $request) : mixed
    {
        return null;
    }

    /**
     * Api method to update an entry
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiEntryUpdate(RequestAbstract $request, ResponseAbstract $response, mixed $data = null) : void
    {
        if (!empty($val = $this->validateEntryUpdate($request))) {
            $response->data['account_update'] = new FormValidation($val);
            $response->header->status = RequestStatusCode::R_400;

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
     * Method to update entry from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return mixed
     *
     * @since 1.0.0
     */
    private function updateEntryFromRequest(RequestAbstract $request) : mixed
    {
        return null;
    }

    /**
     * Api method to create an recurring entry
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiRecurringEntryCreate(RequestAbstract $request, ResponseAbstract $response, mixed $data = null) : void
    {
        if (!empty($val = $this->validateRecurringEntryCreate($request))) {
            $response->data['account_create'] = new FormValidation($val);
            $response->header->status = RequestStatusCode::R_400;

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
     * Method to create recurring entry from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return mixed
     *
     * @since 1.0.0
     */
    private function createRecurringEntryFromRequest(RequestAbstract $request) : mixed
    {
        return null;
    }

    /**
     * Api method to update an recurring entry
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiRecurringEntryUpdate(RequestAbstract $request, ResponseAbstract $response, mixed $data = null) : void
    {
        if (!empty($val = $this->validateRecurringEntryUpdate($request))) {
            $response->data['account_update'] = new FormValidation($val);
            $response->header->status = RequestStatusCode::R_400;

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
     * Method to update recurring entry from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return mixed
     *
     * @since 1.0.0
     */
    private function updateRecurringEntryFromRequest(RequestAbstract $request) : mixed
    {
        return null;
    }

    /**
     * Api method to create an tax key
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiTaxKeyCreate(RequestAbstract $request, ResponseAbstract $response, mixed $data = null) : void
    {
        if (!empty($val = $this->validateTaxKeyCreate($request))) {
            $response->data['account_create'] = new FormValidation($val);
            $response->header->status = RequestStatusCode::R_400;

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
     * Method to create tax key from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return mixed
     *
     * @since 1.0.0
     */
    private function createTaxKeyFromRequest(RequestAbstract $request) : mixed
    {
        return null;
    }

    /**
     * Api method to update an tax key
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiTaxKeyUpdate(RequestAbstract $request, ResponseAbstract $response, mixed $data = null) : void
    {
        if (!empty($val = $this->validateTaxKeyUpdate($request))) {
            $response->data['account_update'] = new FormValidation($val);
            $response->header->status = RequestStatusCode::R_400;

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
     * Method to update tax key from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return mixed
     *
     * @since 1.0.0
     */
    private function updateTaxKeyFromRequest(RequestAbstract $request) : mixed
    {
        return null;
    }

    /**
     * Api method to create an batch entry
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiBatchEntryCreate(RequestAbstract $request, ResponseAbstract $response, mixed $data = null) : void
    {
        if (!empty($val = $this->validateBatchEntryCreate($request))) {
            $response->data['account_create'] = new FormValidation($val);
            $response->header->status = RequestStatusCode::R_400;

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
     * Method to create batch entry from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return mixed
     *
     * @since 1.0.0
     */
    private function createBatchEntryFromRequest(RequestAbstract $request) : mixed
    {
        return null;
    }

    /**
     * Api method to update an batch entry
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiBatchEntryUpdate(RequestAbstract $request, ResponseAbstract $response, mixed $data = null) : void
    {
        if (!empty($val = $this->validateBatchEntryUpdate($request))) {
            $response->data['account_update'] = new FormValidation($val);
            $response->header->status = RequestStatusCode::R_400;

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
     * Method to update batch entry from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return mixed
     *
     * @since 1.0.0
     */
    private function updateBatchEntryFromRequest(RequestAbstract $request) : mixed
    {
        return null;
    }
}

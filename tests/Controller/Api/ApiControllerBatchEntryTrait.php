<?php
/**
 * Jingga
 *
 * PHP Version 8.1
 *
 * @package   tests
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\Accounting\tests\Controller\Api;

use phpOMS\Message\Http\HttpRequest;
use phpOMS\Message\Http\HttpResponse;
use phpOMS\Message\Http\RequestStatusCode;
use phpOMS\Uri\HttpUri;

trait ApiControllerBatchEntryTrait
{
    /**
     * @covers Modules\Accounting\Controller\ApiController
     * @group module
     */
    public function testApiBatchEntryCreate() : void
    {
       $response  = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->header->account = 1;
        $request->setData('name', '1');

        $this->module->apiBatchEntryCreate($request, $response);

        self::assertTrue(true);
        //self::assertGreaterThan(0, $response->getDataArray('')['response']->id);
    }

    /**
     * @covers Modules\Accounting\Controller\ApiController
     * @group module
     */
    public function testApiBatchEntryCreateInvalid() : void
    {
       $response  = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->header->account = 1;
        $request->setData('invalid', '1');

        $this->module->apiBatchEntryCreate($request, $response);
        self::assertEquals(RequestStatusCode::R_400, $response->header->status);
    }

    /**
     * @covers Modules\Accounting\Controller\ApiController
     * @group module
     */
    public function testApiBatchEntryUpdate() : void
    {
       $response  = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->header->account = 1;
        $request->setData('id', '1');

        $this->module->apiBatchEntryUpdate($request, $response);

        self::assertTrue(true);
        //self::assertGreaterThan(0, $response->getDataArray('')['response']->id);
    }

    /**
     * @covers Modules\Accounting\Controller\ApiController
     * @group module
     */
    public function testApiBatchEntryUpdateInvalid() : void
    {
       $response  = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->header->account = 1;
        $request->setData('invalid', '1');

        $this->module->apiBatchEntryUpdate($request, $response);
        self::assertEquals(RequestStatusCode::R_400, $response->header->status);
    }

    /**
     * @covers Modules\Accounting\Controller\ApiController
     * @group module
     */
    public function testApiRecurringEntryCreate() : void
    {
       $response  = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->header->account = 1;
        $request->setData('name', '1');

        $this->module->apiRecurringEntryCreate($request, $response);

        self::assertTrue(true);
        //self::assertGreaterThan(0, $response->getDataArray('')['response']->id);
    }

    /**
     * @covers Modules\Accounting\Controller\ApiController
     * @group module
     */
    public function testApiRecurringEntryCreateInvalid() : void
    {
       $response  = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->header->account = 1;
        $request->setData('invalid', '1');

        $this->module->apiRecurringEntryCreate($request, $response);
        self::assertEquals(RequestStatusCode::R_400, $response->header->status);
    }

    /**
     * @covers Modules\Accounting\Controller\ApiController
     * @group module
     */
    public function testApiRecurringEntryUpdate() : void
    {
       $response  = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->header->account = 1;
        $request->setData('id', '1');

        $this->module->apiRecurringEntryUpdate($request, $response);

        self::assertTrue(true);
        //self::assertGreaterThan(0, $response->getDataArray('')['response']->id);
    }

    /**
     * @covers Modules\Accounting\Controller\ApiController
     * @group module
     */
    public function testApiRecurringEntryUpdateInvalid() : void
    {
       $response  = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->header->account = 1;
        $request->setData('invalid', '1');

        $this->module->apiRecurringEntryUpdate($request, $response);
        self::assertEquals(RequestStatusCode::R_400, $response->header->status);
    }
}

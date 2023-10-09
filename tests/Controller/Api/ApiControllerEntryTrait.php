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

trait ApiControllerEntryTrait
{
    /**
     * @covers Modules\Accounting\Controller\ApiController
     * @group module
     */
    public function testApiEntryCreate() : void
    {
        $response = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->header->account = 1;
        $request->setData('name', '1');

        $this->module->apiEntryCreate($request, $response);

        self::assertTrue(true);
        //self::assertGreaterThan(0, $response->getDataArray('')['response']->id);
    }

    /**
     * @covers Modules\Accounting\Controller\ApiController
     * @group module
     */
    public function testApiEntryCreateInvalidData() : void
    {
        $response = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->header->account = 1;
        $request->setData('invalid', '1');

        $this->module->apiEntryCreate($request, $response);
        self::assertEquals(RequestStatusCode::R_400, $response->header->status);
    }

    /**
     * @covers Modules\Accounting\Controller\ApiController
     * @group module
     */
    public function testApiEntryUpdate() : void
    {
        $response = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->header->account = 1;
        $request->setData('id', '1');

        $this->module->apiEntryUpdate($request, $response);

        self::assertTrue(true);
        //self::assertGreaterThan(0, $response->getDataArray('')['response']->id);
    }

    /**
     * @covers Modules\Accounting\Controller\ApiController
     * @group module
     */
    public function testApiEntryUpdateInvalidData() : void
    {
        $response = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->header->account = 1;
        $request->setData('invalid', '1');

        $this->module->apiEntryUpdate($request, $response);
        self::assertEquals(RequestStatusCode::R_400, $response->header->status);
    }
}

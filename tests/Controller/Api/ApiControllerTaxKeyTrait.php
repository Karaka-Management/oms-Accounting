<?php
/**
 * Orange Management
 *
 * PHP Version 8.0
 *
 * @package   tests
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Accounting\tests\Controller\Api;

use phpOMS\Message\Http\HttpRequest;
use phpOMS\Message\Http\HttpResponse;
use phpOMS\Message\Http\RequestStatusCode;
use phpOMS\Uri\HttpUri;

trait ApiControllerTaxKeyTrait
{
    /**
     * @covers Modules\Accounting\Controller\ApiController
     * @group module
     */
    public function testApiTaxKeyCreate() : void
    {
       $response  = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->header->account = 1;
        $request->setData('name', '1');

        $this->module->apiTaxKeyCreate($request, $response);

        self::assertTrue(true);
        //self::assertGreaterThan(0, $response->get('')['response']->getId());
    }

    /**
     * @covers Modules\Accounting\Controller\ApiController
     * @group module
     */
    public function testApiTaxKeyCreateInvalid() : void
    {
       $response  = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->header->account = 1;
        $request->setData('invalid', '1');

        $this->module->apiTaxKeyCreate($request, $response);
        self::assertEquals(RequestStatusCode::R_400, $response->header->status);
    }

    /**
     * @covers Modules\Accounting\Controller\ApiController
     * @group module
     */
    public function testApiTaxKeyUpdate() : void
    {
       $response  = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->header->account = 1;
        $request->setData('id', '1');

        $this->module->apiTaxKeyUpdate($request, $response);

        self::assertTrue(true);
        //self::assertGreaterThan(0, $response->get('')['response']->getId());
    }

    /**
     * @covers Modules\Accounting\Controller\ApiController
     * @group module
     */
    public function testApiTaxKeyUpdateInvalid() : void
    {
       $response  = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->header->account = 1;
        $request->setData('invalid', '1');

        $this->module->apiTaxKeyUpdate($request, $response);
        self::assertEquals(RequestStatusCode::R_400, $response->header->status);
    }
}

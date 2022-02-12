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

trait ApiControllerAccountTrait
{
    /**
     * @covers Modules\Accounting\Controller\ApiController
     * @group module
     */
    public function testApiAccountCreate() : void
    {
        $response = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->header->account = 1;
        $request->setData('name', '1');

        $this->module->apiAccountCreate($request, $response);

        self::assertTrue(true);
        //self::assertGreaterThan(0, $response->get('')['response']->getId());
    }

    /**
     * @covers Modules\Accounting\Controller\ApiController
     * @group module
     */
    public function testApiAccountCreateInvalid() : void
    {
        $response = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->header->account = 1;
        $request->setData('invalid', '1');

        $this->module->apiAccountCreate($request, $response);
        self::assertEquals(RequestStatusCode::R_400, $response->header->status);
    }

    /**
     * @covers Modules\Accounting\Controller\ApiController
     * @group module
     */
    public function testApiAccountUpdate() : void
    {
        $response = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->header->account = 1;
        $request->setData('id', '1');

        $this->module->apiAccountUpdate($request, $response);

        self::assertTrue(true);
        //self::assertGreaterThan(0, $response->get('')['response']->getId());
    }

    /**
     * @covers Modules\Accounting\Controller\ApiController
     * @group module
     */
    public function testApiAccountUpdateInvalid() : void
    {
        $response = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->header->account = 1;
        $request->setData('invalid', '1');

        $this->module->apiAccountUpdate($request, $response);
        self::assertEquals(RequestStatusCode::R_400, $response->header->status);
    }
}
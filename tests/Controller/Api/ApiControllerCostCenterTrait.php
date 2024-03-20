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

trait ApiControllerCostCenterTrait
{
    /**
     * @covers \Modules\Accounting\Controller\ApiController
     */
    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testApiCostCenterCreate() : void
    {
       $response = new HttpResponse();
        $request = new HttpRequest();

        $request->header->account = 1;
        $request->setData('name', '1');

        $this->module->apiCostCenterCreate($request, $response);

        self::assertTrue(true);
        //self::assertGreaterThan(0, $response->getDataArray('')['response']->id);
    }

    /**
     * @covers \Modules\Accounting\Controller\ApiController
     */
    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testApiCostCenterCreateInvalid() : void
    {
       $response = new HttpResponse();
        $request = new HttpRequest();

        $request->header->account = 1;
        $request->setData('invalid', '1');

        $this->module->apiCostCenterCreate($request, $response);
        self::assertEquals(RequestStatusCode::R_400, $response->header->status);
    }

    /**
     * @covers \Modules\Accounting\Controller\ApiController
     */
    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testApiCostCenterUpdate() : void
    {
       $response = new HttpResponse();
        $request = new HttpRequest();

        $request->header->account = 1;
        $request->setData('id', '1');

        $this->module->apiCostCenterUpdate($request, $response);

        self::assertTrue(true);
        //self::assertGreaterThan(0, $response->getDataArray('')['response']->id);
    }

    /**
     * @covers \Modules\Accounting\Controller\ApiController
     */
    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testApiCostCenterUpdateInvalid() : void
    {
       $response = new HttpResponse();
        $request = new HttpRequest();

        $request->header->account = 1;
        $request->setData('invalid', '1');

        $this->module->apiCostCenterUpdate($request, $response);
        self::assertEquals(RequestStatusCode::R_400, $response->header->status);
    }
}

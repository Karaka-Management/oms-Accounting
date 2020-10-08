<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   tests
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Accounting\tests\Models;

use Modules\Accounting\Models\CostCenter;

/**
 * @internal
 */
class CostCenterTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers Modules\Accounting\Models\CostCenter
     * @group module
     */
    public function testDefault() : void
    {
        $cc = new CostCenter();

        self::assertEquals(0, $cc->getId());
        self::assertEquals('', $cc->getName());
        self::assertEquals('', $cc->getCode());
        self::assertEquals('', $cc->getDescription());
        self::assertNull($cc->getParent());
    }

    /**
     * @covers Modules\Accounting\Models\CostCenter
     * @group module
     */
    public function testNameInputOutput() : void
    {
        $cc = new CostCenter();

        $cc->setName('TestName');
        self::assertEquals('TestName', $cc->getName());
    }

    /**
     * @covers Modules\Accounting\Models\CostCenter
     * @group module
     */
    public function testCodeInputOutput() : void
    {
        $cc = new CostCenter();

        $cc->setCode('TestCode');
        self::assertEquals('TestCode', $cc->getCode());
    }

    /**
     * @covers Modules\Accounting\Models\CostCenter
     * @group module
     */
    public function testDescriptionInputOutput() : void
    {
        $cc = new CostCenter();

        $cc->setDescription('TestDescription');
        self::assertEquals('TestDescription', $cc->getDescription());
    }

    /**
     * @covers Modules\Accounting\Models\CostCenter
     * @group module
     */
    public function testParentInputOutput() : void
    {
        $cc = new CostCenter();

        $cc->setParent(1);
        self::assertEquals(1, $cc->getParent());
    }
}

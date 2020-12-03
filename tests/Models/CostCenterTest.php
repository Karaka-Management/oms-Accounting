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
        self::assertEquals('', $cc->l11n->name);
        self::assertEquals('', $cc->code);
        self::assertEquals('', $cc->l11n->description);
        self::assertNull($cc->parent);
    }

    /**
     * @covers Modules\Accounting\Models\CostCenter
     * @group module
     */
    public function testNameInputOutput() : void
    {
        $cc = new CostCenter();

        $cc->l11n->name = 'TestName';
        self::assertEquals('TestName', $cc->l11n->name);
    }

    /**
     * @covers Modules\Accounting\Models\CostCenter
     * @group module
     */
    public function testCodeInputOutput() : void
    {
        $cc = new CostCenter();

        $cc->code = 'TestCode';
        self::assertEquals('TestCode', $cc->code);
    }

    /**
     * @covers Modules\Accounting\Models\CostCenter
     * @group module
     */
    public function testDescriptionInputOutput() : void
    {
        $cc = new CostCenter();

        $cc->l11n->description = 'TestDescription';
        self::assertEquals('TestDescription', $cc->l11n->description);
    }

    /**
     * @covers Modules\Accounting\Models\CostCenter
     * @group module
     */
    public function testParentInputOutput() : void
    {
        $cc = new CostCenter();

        $cc->parent = 1;
        self::assertEquals(1, $cc->parent);
    }
}

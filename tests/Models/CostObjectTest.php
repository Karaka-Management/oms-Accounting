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

use Modules\Accounting\Models\CostObject;

/**
 * @internal
 */
class CostObjectTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers Modules\Accounting\Models\CostObject
     * @group module
     */
    public function testDefault() : void
    {
        $co = new CostObject();

        self::assertEquals(0, $co->getId());
        self::assertEquals('', $co->l11n->name);
        self::assertEquals('', $co->code);
        self::assertEquals('', $co->l11n->description);
        self::assertNull($co->parent);
    }

    /**
     * @covers Modules\Accounting\Models\CostObject
     * @group module
     */
    public function testNameInputOutput() : void
    {
        $co = new CostObject();

        $co->l11n->name = 'TestName';
        self::assertEquals('TestName', $co->l11n->name);
    }

    /**
     * @covers Modules\Accounting\Models\CostObject
     * @group module
     */
    public function testCodeInputOutput() : void
    {
        $co = new CostObject();

        $co->code = 'TestCode';
        self::assertEquals('TestCode', $co->code);
    }

    /**
     * @covers Modules\Accounting\Models\CostObject
     * @group module
     */
    public function testDescriptionInputOutput() : void
    {
        $co = new CostObject();

        $co->l11n->description = 'TestDescription';
        self::assertEquals('TestDescription', $co->l11n->description);
    }

    /**
     * @covers Modules\Accounting\Models\CostObject
     * @group module
     */
    public function testParentInputOutput() : void
    {
        $co = new CostObject();

        $co->parent = 1;
        self::assertEquals(1, $co->parent);
    }
}

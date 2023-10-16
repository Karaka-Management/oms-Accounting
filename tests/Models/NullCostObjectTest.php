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

namespace Modules\Accounting\tests\Models;

use Modules\Accounting\Models\NullCostObject;

/**
 * @internal
 */
final class NullCostObjectTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers Modules\Accounting\Models\NullCostObject
     * @group module
     */
    public function testNull() : void
    {
        self::assertInstanceOf('\Modules\Accounting\Models\CostObject', new NullCostObject());
    }

    /**
     * @covers Modules\Accounting\Models\NullCostObject
     * @group module
     */
    public function testId() : void
    {
        $null = new NullCostObject(2);
        self::assertEquals(2, $null->id);
    }

    /**
     * @covers Modules\Accounting\Models\NullCostObject
     * @group module
     */
    public function testJsonSerialize() : void
    {
        $null = new NullCostObject(2);
        self::assertEquals(['id' => 2], $null);
    }
}

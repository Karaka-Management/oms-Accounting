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

use Modules\Accounting\Models\NullCostObject;

/**
 * @internal
 */
final class Null extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers Modules\Accounting\Models\NullCostObject
     * @group framework
     */
    public function testNull() : void
    {
        self::assertInstanceOf('\Modules\Accounting\Models\CostObject', new NullCostObject());
    }

    /**
     * @covers Modules\Accounting\Models\NullCostObject
     * @group framework
     */
    public function testId() : void
    {
        $null = new NullCostObject(2);
        self::assertEquals(2, $null->getId());
    }
}

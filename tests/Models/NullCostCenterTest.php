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

use Modules\Accounting\Models\NullCostCenter;

/**
 * @internal
 */
final class NullCostCenterTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers \Modules\Accounting\Models\NullCostCenter
     * @group module
     */
    public function testNull() : void
    {
        self::assertInstanceOf('\Modules\Accounting\Models\CostCenter', new NullCostCenter());
    }

    /**
     * @covers \Modules\Accounting\Models\NullCostCenter
     * @group module
     */
    public function testId() : void
    {
        $null = new NullCostCenter(2);
        self::assertEquals(2, $null->id);
    }

    /**
     * @covers \Modules\Accounting\Models\NullCostCenter
     * @group module
     */
    public function testJsonSerialize() : void
    {
        $null = new NullCostCenter(2);
        self::assertEquals(['id' => 2], $null->jsonSerialize());
    }
}

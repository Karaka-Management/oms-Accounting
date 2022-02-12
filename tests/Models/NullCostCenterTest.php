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

use Modules\Accounting\Models\NullCostCenter;

/**
 * @internal
 */
final class NullCostCenterTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers Modules\Accounting\Models\NullCostCenter
     * @group framework
     */
    public function testNull() : void
    {
        self::assertInstanceOf('\Modules\Accounting\Models\CostCenter', new NullCostCenter());
    }

    /**
     * @covers Modules\Accounting\Models\NullCostCenter
     * @group framework
     */
    public function testId() : void
    {
        $null = new NullCostCenter(2);
        self::assertEquals(2, $null->getId());
    }
}
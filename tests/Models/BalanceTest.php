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

use Modules\Accounting\Models\Balance;

/**
 * @internal
 */
final class BalanceTest extends \PHPUnit\Framework\TestCase
{
    private Balance $balance;

    /**
     * {@inheritdoc}
     */
    protected function setUp() : void
    {
        $this->balance = new Balance();
    }

    /**
     * @covers Modules\Accounting\Models\Balance
     * @group module
     */
    public function testDefault() : void
    {
        self::assertEquals(0, $this->balance->getId());
    }

    /**
     * @covers Modules\Accounting\Models\Balance
     * @group module
     */
    public function testSerialize() : void
    {
        self::assertEquals(
            [
                'id'       => 0,
            ],
            $this->balance->jsonSerialize()
        );
    }
}
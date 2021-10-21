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

use Modules\Accounting\Models\Debitor;

/**
 * @internal
 */
final class DebitorTest extends \PHPUnit\Framework\TestCase
{
    private Debitor $creditor;

    /**
     * {@inheritdoc}
     */
    protected function setUp() : void
    {
        $this->creditor = new Debitor();
    }

    /**
     * @covers Modules\Accounting\Models\Debitor
     * @group module
     */
    public function testDefault() : void
    {
        self::assertEquals(0, $this->creditor->getId());
    }
}

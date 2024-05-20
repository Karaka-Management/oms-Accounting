<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   tests
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.2
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\Accounting\tests\Models;

use Modules\Accounting\Models\AccountAbstract;

/**
 * @internal
 */
#[\PHPUnit\Framework\Attributes\TestDox('Modules\Accounting\tests\Models\AccountAbstractTest: Account abstraction')]
final class AccountAbstractTest extends \PHPUnit\Framework\TestCase
{
    private $class = null;

    /**
     * {@inheritdoc}
     */
    protected function setUp() : void
    {
        $this->class = new class() extends AccountAbstract {
        };
    }

    public function testDefault() : void
    {
        self::assertEquals(0, $this->class->id);
        self::assertNull($this->class->summaryAccount);
        self::assertNull($this->class->getEntryById(0));
        self::assertEquals([], $this->class->getEntriesByDate(new \DateTime()));
    }
}

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

use Modules\Accounting\Models\AccountAbstract;

/**
 * @testdox Modules\Accounting\tests\Models\AccountAbstractTest: Account abstraction
 *
 * @internal
 */
class AccountAbstractTest extends \PHPUnit\Framework\TestCase
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
        self::assertEquals(0, $this->class->getId());
        self::assertEquals(null, $this->class->summaryAccount);
        self::assertEquals(null, $this->class->getEntryById(0));
        self::assertEquals([], $this->class->getEntriesByDate(new \DateTime()));
    }
}

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

use Modules\Accounting\Models\BatchPosting;

/**
 * @internal
 */
final class BatchPostingTest extends \PHPUnit\Framework\TestCase
{
    private BatchPosting $batch;

    /**
     * {@inheritdoc}
     */
    protected function setUp() : void
    {
        $this->batch = new BatchPosting();
    }

    /**
     * @covers Modules\Accounting\Models\BatchPosting
     * @group module
     */
    public function testDefault() : void
    {
        self::assertEquals(0, $this->batch->getId());
        self::assertEquals(0, $this->batch->creator);
        self::assertEquals('', $this->batch->description);
        self::assertEquals(0, $this->batch->count());
        self::assertEquals(null, $this->batch->getPosting(1));
        self::assertInstanceOf('\DateTimeImmutable', $this->batch->created);
    }
}

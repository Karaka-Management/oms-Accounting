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

use Modules\Accounting\Models\CostCenter;

/**
 * @internal
 */
class CostCenterTest extends \PHPUnit\Framework\TestCase
{
    private CostCenter $cc;

    /**
     * {@inheritdoc}
     */
    protected function setUp() : void
    {
        $this->cc = new CostCenter();
    }

    /**
     * @covers Modules\Accounting\Models\CostCenter
     * @group module
     */
    public function testDefault() : void
    {
        self::assertEquals(0, $this->cc->getId());
        self::assertEquals('', $this->cc->code);
        self::assertNull($this->cc->parent);
    }

    /**
     * @covers Modules\Accounting\Models\CostCenter
     * @group module
     */
    public function testCodeInputOutput() : void
    {
        $this->cc->code = 'TestCode';
        self::assertEquals('TestCode', $this->cc->code);
    }

    /**
     * @covers Modules\Accounting\Models\CostCenter
     * @group module
     */
    public function testParentInputOutput() : void
    {
        $this->cc->parent = 1;
        self::assertEquals(1, $this->cc->parent);
    }
}

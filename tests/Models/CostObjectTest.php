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

use Modules\Accounting\Models\CostObject;

/**
 * @internal
 */
final class CostObjectTest extends \PHPUnit\Framework\TestCase
{
    private CostObject $cc;

    /**
     * {@inheritdoc}
     */
    protected function setUp() : void
    {
        $this->cc = new CostObject();
    }

    /**
     * @covers Modules\Accounting\Models\CostObject
     * @group module
     */
    public function testDefault() : void
    {
        self::assertEquals(0, $this->cc->getId());
        self::assertEquals('', $this->cc->code);
        self::assertNull($this->cc->parent);
    }

    /**
     * @covers Modules\Accounting\Models\CostObject
     * @group module
     */
    public function testCodeInputOutput() : void
    {
        $this->cc->code = 'TestCode';
        self::assertEquals('TestCode', $this->cc->code);
    }

    /**
     * @covers Modules\Accounting\Models\CostObject
     * @group module
     */
    public function testParentInputOutput() : void
    {
        $this->cc->parent = 1;
        self::assertEquals(1, $this->cc->parent);
    }
}

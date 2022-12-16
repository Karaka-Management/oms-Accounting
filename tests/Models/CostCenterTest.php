<?php
/**
 * Karaka
 *
 * PHP Version 8.1
 *
 * @package   tests
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\Accounting\tests\Models;

use Modules\Accounting\Models\CostCenter;

/**
 * @internal
 */
final class CostCenterTest extends \PHPUnit\Framework\TestCase
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

    /**
     * @covers Modules\Accounting\Models\CostCenter
     * @group module
     */
    public function testSerialize() : void
    {
        $this->cc->code = '123';

        self::assertEquals(
            [
                'id'           => 0,
                'code'         => '123',
                'parent'       => null,
            ],
            $this->cc->jsonSerialize()
        );
    }
}

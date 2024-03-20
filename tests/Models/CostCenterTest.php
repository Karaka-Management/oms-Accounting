<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   tests
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\Accounting\tests\Models;

use Modules\Accounting\Models\CostCenter;

/**
 * @internal
 */
#[\PHPUnit\Framework\Attributes\CoversClass(\Modules\Accounting\Models\CostCenter::class)]
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

    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testDefault() : void
    {
        self::assertEquals(0, $this->cc->id);
        self::assertEquals('', $this->cc->code);
        self::assertNull($this->cc->parent);
    }

    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testCodeInputOutput() : void
    {
        $this->cc->code = 'TestCode';
        self::assertEquals('TestCode', $this->cc->code);
    }

    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testParentInputOutput() : void
    {
        $this->cc->parent = 1;
        self::assertEquals(1, $this->cc->parent);
    }

    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testSerialize() : void
    {
        $this->cc->code = '123';

        self::assertEquals(
            [
                'id'     => 0,
                'code'   => '123',
                'parent' => null,
            ],
            $this->cc->jsonSerialize()
        );
    }
}

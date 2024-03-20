<?php
/**
 * Jingga
 *
 * PHP Version 8.1
 *
 * @package   tests
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\Accounting\tests\Models;

use Modules\Accounting\Models\CostObject;

/**
 * @internal
 */
#[\PHPUnit\Framework\Attributes\CoversClass(\Modules\Accounting\Models\CostObject::class)]
final class CostObjectTest extends \PHPUnit\Framework\TestCase
{
    private CostObject $co;

    /**
     * {@inheritdoc}
     */
    protected function setUp() : void
    {
        $this->co = new CostObject();
    }

    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testDefault() : void
    {
        self::assertEquals(0, $this->co->id);
        self::assertEquals('', $this->co->code);
        self::assertNull($this->co->parent);
    }

    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testCodeInputOutput() : void
    {
        $this->co->code = 'TestCode';
        self::assertEquals('TestCode', $this->co->code);
    }

    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testParentInputOutput() : void
    {
        $this->co->parent = 1;
        self::assertEquals(1, $this->co->parent);
    }

    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testSerialize() : void
    {
        $this->co->code = '123';

        self::assertEquals(
            [
                'id'     => 0,
                'code'   => '123',
                'parent' => null,
            ],
            $this->co->jsonSerialize()
        );
    }
}

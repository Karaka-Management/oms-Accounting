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

use Modules\Accounting\Models\Debitor;

/**
 * @internal
 */
#[\PHPUnit\Framework\Attributes\CoversClass(\Modules\Accounting\Models\Debitor::class)]
final class DebitorTest extends \PHPUnit\Framework\TestCase
{
    private Debitor $debitor;

    /**
     * {@inheritdoc}
     */
    protected function setUp() : void
    {
        $this->debitor = new Debitor();
    }

    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testDefault() : void
    {
        self::assertEquals(0, $this->debitor->id);
    }

    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testSerialize() : void
    {
        self::assertEquals(
            [
                'id'      => 0,
                'account' => null,
            ],
            $this->debitor->jsonSerialize()
        );
    }
}

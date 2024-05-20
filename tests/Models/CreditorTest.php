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

use Modules\Accounting\Models\Creditor;

/**
 * @internal
 */
#[\PHPUnit\Framework\Attributes\CoversClass(\Modules\Accounting\Models\Creditor::class)]
final class CreditorTest extends \PHPUnit\Framework\TestCase
{
    private Creditor $creditor;

    /**
     * {@inheritdoc}
     */
    protected function setUp() : void
    {
        $this->creditor = new Creditor();
    }

    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testDefault() : void
    {
        self::assertEquals(0, $this->creditor->id);
    }

    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testSerialize() : void
    {
        self::assertEquals(
            [
                'id'      => 0,
                'account' => null,
            ],
            $this->creditor->jsonSerialize()
        );
    }
}

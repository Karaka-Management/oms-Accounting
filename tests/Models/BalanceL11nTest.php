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

use Modules\Accounting\Models\BalanceL11n;
use phpOMS\Localization\ISO639x1Enum;

/**
 * @internal
 */
final class BalanceL11nTest extends \PHPUnit\Framework\TestCase
{
    private BalanceL11n $l11n;

    /**
     * {@inheritdoc}
     */
    protected function setUp() : void
    {
        $this->l11n = new BalanceL11n();
    }

    /**
     * @covers Modules\Accounting\Models\BalanceL11n
     * @group module
     */
    public function testDefault() : void
    {
        self::assertEquals(0, $this->l11n->id);
        self::assertEquals('', $this->l11n->name);
        self::assertEquals('', $this->l11n->description);
        self::assertEquals(0, $this->l11n->balance);
        self::assertEquals(ISO639x1Enum::_EN, $this->l11n->language);
    }

    /**
     * @covers Modules\Accounting\Models\BalanceL11n
     * @group module
     */
    public function testNameInputOutput() : void
    {
        $this->l11n->name = 'TestName';
        self::assertEquals('TestName', $this->l11n->name);
    }

    /**
     * @covers Modules\Accounting\Models\BalanceL11n
     * @group module
     */
    public function testDescriptionInputOutput() : void
    {
        $this->l11n->description = 'TestDescription';
        self::assertEquals('TestDescription', $this->l11n->description);
    }

    /**
     * @covers Modules\Accounting\Models\BalanceL11n
     * @group module
     */
    public function testLanguageInputOutput() : void
    {
        $this->l11n->setLanguage(ISO639x1Enum::_DE);
        self::assertEquals(ISO639x1Enum::_DE, $this->l11n->language);
    }

    /**
     * @covers Modules\Accounting\Models\BalanceL11n
     * @group module
     */
    public function testSerialize() : void
    {
        $this->l11n->name        = 'Title';
        $this->l11n->description = 'Description';
        $this->l11n->balance     = 2;
        $this->l11n->setLanguage(ISO639x1Enum::_DE);

        self::assertEquals(
            [
                'id'               => 0,
                'name'             => 'Title',
                'description'      => 'Description',
                'balance'          => 2,
                'language'         => ISO639x1Enum::_DE,
            ],
            $this->l11n->jsonSerialize()
        );
    }
}

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
use Modules\Accounting\Models\CostObjectMapper;
use phpOMS\Localization\ISO639x1Enum;

/**
 * @internal
 */
final class CostObjectMapperTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers Modules\Accounting\Models\CostObjectMapper
     * @group module
     */
    public function testCR() : void
    {
        $costobject                    = new CostObject();
        $costobject->code              = '123';
        $costobject->l11n->name        = 'Test CostObject';
        $costobject->l11n->description = 'Test description';

        $id = CostObjectMapper::create()->execute($costobject);
        self::assertGreaterThan(0, $costobject->id);
        self::assertEquals($id, $costobject->id);

        $costobjectR = CostObjectMapper::get()->with('l11n')->where('l11n/language', ISO639x1Enum::_EN)->where('id', $costobject->id)->execute();
        self::assertEquals($costobject->code, $costobjectR->code);
        self::assertEquals($costobject->l11n->name, $costobjectR->l11n->name);
        self::assertEquals($costobject->l11n->description, $costobjectR->l11n->description);
    }
}

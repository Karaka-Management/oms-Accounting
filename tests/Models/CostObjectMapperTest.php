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

use Modules\Accounting\Models\CostObject;
use Modules\Accounting\Models\CostObjectMapper;
use phpOMS\Localization\BaseStringL11n;
use phpOMS\Localization\ISO639x1Enum;

/**
 * @internal
 */
#[\PHPUnit\Framework\Attributes\CoversClass(\Modules\Accounting\Models\CostObjectMapper::class)]
final class CostObjectMapperTest extends \PHPUnit\Framework\TestCase
{
    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testCR() : void
    {
        $costobject                = new CostObject();
        $costobject->code          = '123';
        $costobject->l11n          = new BaseStringL11n();
        $costobject->l11n->name    = 'Test CostObject';
        $costobject->l11n->content = 'Test description';

        $id = CostObjectMapper::create()->execute($costobject);
        self::assertGreaterThan(0, $costobject->id);
        self::assertEquals($id, $costobject->id);

        $costobjectR = CostObjectMapper::get()->with('l11n')->where('l11n/language', ISO639x1Enum::_EN)->where('id', $costobject->id)->execute();
        self::assertEquals($costobject->code, $costobjectR->code);
        self::assertEquals($costobject->l11n->content, $costobjectR->l11n);
    }
}

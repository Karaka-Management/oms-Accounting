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

use Modules\Accounting\Models\CostCenter;
use Modules\Accounting\Models\CostCenterMapper;
use phpOMS\Localization\BaseStringL11n;
use phpOMS\Localization\ISO639x1Enum;

/**
 * @internal
 */
final class CostCenterMapperTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers Modules\Accounting\Models\CostCenterMapper
     * @group module
     */
    public function testCR() : void
    {
        $costcenter                    = new CostCenter();
        $costcenter->code              = '123';
        $costcenter->l11n = new BaseStringL11n();
        $costcenter->l11n->name        = 'Test CostCenter';
        $costcenter->l11n->content = 'Test description';

        $id = CostCenterMapper::create()->execute($costcenter);
        self::assertGreaterThan(0, $costcenter->id);
        self::assertEquals($id, $costcenter->id);

        $costcenterR = CostCenterMapper::get()->with('l11n')->where('l11n/language', ISO639x1Enum::_EN)->where('id', $costcenter->id)->execute();
        self::assertEquals($costcenter->code, $costcenterR->code);
        self::assertEquals($costcenter->l11n->content, $costcenterR->l11n);
    }
}

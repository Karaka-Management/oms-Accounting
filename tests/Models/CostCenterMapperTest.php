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

use Modules\Accounting\Models\CostCenter;
use Modules\Accounting\Models\CostCenterMapper;
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
        $costcenter->l11n->name        = 'Test CostCenter';
        $costcenter->l11n->description = 'Test description';

        $id = CostCenterMapper::create()->execute($costcenter);
        self::assertGreaterThan(0, $costcenter->getId());
        self::assertEquals($id, $costcenter->getId());

        $costcenterR = CostCenterMapper::get()->with('l11n')->where('l11n/language', ISO639x1Enum::_EN)->where('id', $costcenter->getId())->execute();
        self::assertEquals($costcenter->code, $costcenterR->code);
        self::assertEquals($costcenter->l11n->name, $costcenterR->l11n->name);
        self::assertEquals($costcenter->l11n->description, $costcenterR->l11n->description);
    }
}

<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
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
class CostCenterMapperTest extends \PHPUnit\Framework\TestCase
{
    public function testCR() : void
    {
        $costcenter = new CostCenter();
        $costcenter->setCode('123');
        $costcenter->setName('Test CostCenter');
        $costcenter->setDescription('Test description');

        $id = CostCenterMapper::create($costcenter);
        self::assertGreaterThan(0, $costcenter->getId());
        self::assertEquals($id, $costcenter->getId());

        $costcenterR = CostCenterMapper::withConditional('language', ISO639x1Enum::_EN)::get($costcenter->getId());
        self::assertEquals($costcenter->getCode(), $costcenterR->getCode());
        self::assertEquals($costcenter->getName(), $costcenterR->getName());
        self::assertEquals($costcenter->getDescription(), $costcenterR->getDescription());
    }
}

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

use Modules\Accounting\Models\CostObject;
use Modules\Accounting\Models\CostObjectMapper;
use phpOMS\Localization\ISO639x1Enum;

/**
 * @internal
 */
class CostObjectMapperTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers Modules\Accounting\Models\CostObjectMapper
     * @group module
     */
    public function testCR() : void
    {
        $costobject = new CostObject();
        $costobject->code = '123';
        $costobject->l11n->name = 'Test CostObject';
        $costobject->l11n->description = 'Test description';

        $id = CostObjectMapper::create($costobject);
        self::assertGreaterThan(0, $costobject->getId());
        self::assertEquals($id, $costobject->getId());

        $costobjectR = CostObjectMapper::withConditional('language', ISO639x1Enum::_EN)::get($costobject->getId());
        self::assertEquals($costobject->code, $costobjectR->code);
        self::assertEquals($costobject->l11n->name, $costobjectR->l11n->name);
        self::assertEquals($costobject->l11n->description, $costobjectR->l11n->description);
    }
}

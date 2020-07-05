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
    public function testCR() : void
    {
        $costobject = new CostObject();
        $costobject->setCode('123');
        $costobject->setName('Test CostObject');
        $costobject->setDescription('Test description');

        $id = CostObjectMapper::create($costobject);
        self::assertGreaterThan(0, $costobject->getId());
        self::assertEquals($id, $costobject->getId());

        $costobjectR = CostObjectMapper::withConditional('language', ISO639x1Enum::_EN)::get($costobject->getId());
        self::assertEquals($costobject->getCode(), $costobjectR->getCode());
        self::assertEquals($costobject->getName(), $costobjectR->getName());
        self::assertEquals($costobject->getDescription(), $costobjectR->getDescription());
    }
}

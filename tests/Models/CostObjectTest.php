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

/**
 * @internal
 */
class CostObjectTest extends \PHPUnit\Framework\TestCase
{
    public function testDefault() : void
    {
        $co = new CostObject();

        self::assertEquals(0, $co->getId());
        self::assertEquals('', $co->getName());
        self::assertEquals('', $co->getCode());
        self::assertEquals('', $co->getDescription());
        self::assertNull($co->getParent());
    }

    public function testNameInputOutput() : void
    {
        $co = new CostObject();

        $co->setName('TestName');
        self::assertEquals('TestName', $co->getName());
    }

    public function testCodeInputOutput() : void
    {
        $co = new CostObject();

        $co->setCode('TestCode');
        self::assertEquals('TestCode', $co->getCode());
    }

    public function testDescriptionInputOutput() : void
    {
        $co = new CostObject();

        $co->setDescription('TestDescription');
        self::assertEquals('TestDescription', $co->getDescription());
    }

    public function testParentInputOutput() : void
    {
        $co = new CostObject();

        $co->setParent(1);
        self::assertEquals(1, $co->getParent());
    }
}

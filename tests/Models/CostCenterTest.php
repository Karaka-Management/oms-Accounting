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

/**
 * @internal
 */
class CostCenterTest extends \PHPUnit\Framework\TestCase
{
    public function testDefault() : void
    {
        $cc = new CostCenter();

        self::assertEquals(0, $cc->getId());
        self::assertEquals('', $cc->getName());
        self::assertEquals('', $cc->getCode());
        self::assertEquals('', $cc->getDescription());
        self::assertEquals(null, $cc->getParent());
    }

    public function testNameInputOutput() : void
    {
        $cc = new CostCenter();

        $cc->setName('TestName');
        self::assertEquals('TestName', $cc->getName());
    }

    public function testCodeInputOutput() : void
    {
        $cc = new CostCenter();

        $cc->setCode('TestCode');
        self::assertEquals('TestCode', $cc->getCode());
    }

    public function testDescriptionInputOutput() : void
    {
        $cc = new CostCenter();

        $cc->setDescription('TestDescription');
        self::assertEquals('TestDescription', $cc->getDescription());
    }

    public function testParentInputOutput() : void
    {
        $cc = new CostCenter();

        $cc->setParent(1);
        self::assertEquals(1, $cc->getParent());
    }
}

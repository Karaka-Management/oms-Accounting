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

namespace Modules\Accounting\tests\Admin;

/**
 * @internal
 */
class AccountingTest extends \PHPUnit\Framework\TestCase
{
    protected const MODULE_NAME = 'Accounting';

    protected const URI_LOAD = 'http://127.0.0.1/en/backend/accounting';

    use \Modules\tests\ModuleTestTrait;
}

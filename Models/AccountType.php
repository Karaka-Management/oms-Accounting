<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   Modules\Accounting\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.2
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\Accounting\Models;

use phpOMS\Stdlib\Base\Enum;

/**
 * Account type enum.
 *
 * @package Modules\Accounting\Models
 * @license OMS License 2.2
 * @link    https://jingga.app
 * @since   1.0.0
 */
abstract class AccountType extends Enum
{
    public const IMPERSONAL = 1;

    public const PERSONAL = 2;

    public const CREDITOR = 3;

    public const DEBITOR = 4;
}

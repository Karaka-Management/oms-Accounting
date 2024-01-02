<?php
/**
 * Jingga
 *
 * PHP Version 8.1
 *
 * @package   Modules\Accounting\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\Accounting\Models;

use phpOMS\Stdlib\Base\Enum;

/**
 * Permission category enum.
 *
 * @package Modules\Accounting\Models
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 */
abstract class PermissionCategory extends Enum
{
    public const PERSONAL = 1;

    public const IMPERSONAL = 2;

    public const JOURNAL = 3;

    public const STACK = 4;

    public const GL = 5;

    public const COST_CENTER = 6;

    public const COST_OBJECT = 7;

    public const ACCOUNT = 8;

    public const ENTRY = 9;

    public const SUPPLIER = 10;

    public const CLIENT = 11;
}

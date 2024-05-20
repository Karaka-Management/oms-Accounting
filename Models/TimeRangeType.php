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
 * Time range type enum.
 *
 * @package Modules\Accounting\Models
 * @license OMS License 2.2
 * @link    https://jingga.app
 * @since   1.0.0
 */
abstract class TimeRangeType extends Enum
{
    public const ENTRY_DATE = 1; /* Date of when the entry happened */

    public const DUE_DATE = 2; /* Date of when the entry is due (only for invoices) */

    public const RECEIPT_DATE = 3; /* Date of the receipt */

    public const ASSOCIATED_DATE = 4; /* Date of the association (e.g. when did the articles arrive) */

    public const PERIOD_DATE = 5; /* Date of the period this booking is associated with */

    public const SQUARED_DATE = 6; /* Date of when the entry got squared/balanced */
}

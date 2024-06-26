<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   Modules\Accounting\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\Accounting\Models;

/**
 * IncomeStatement class.
 *
 * @package Modules\Accounting\Models
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 */
class IncomeStatement
{
    /**
     * ID.
     *
     * @var int
     * @since 1.0.0
     */
    public int $id = 0;

    /**
     * Date.
     *
     * @var null|\DateTime
     * @since 1.0.0
     */
    public ?\DateTime $date = null;

    /**
     * Income statement structure.
     *
     * @var array
     * @since 1.0.0
     */
    public array $incomeStatement = [];
}

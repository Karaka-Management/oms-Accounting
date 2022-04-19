<?php
/**
 * Karaka
 *
 * PHP Version 8.1
 *
 * @package   Modules\Accounting\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://karaka.app
 */
declare(strict_types=1);

namespace Modules\Accounting\Models;

/**
 * IncomeStatement class.
 *
 * @package Modules\Accounting\Models
 * @license OMS License 1.0
 * @link    https://karaka.app
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
    protected int $id = 0;

    /**
     * Date.
     *
     * @var null|\DateTime
     * @since 1.0.0
     */
    private ?\DateTime $date = null;

    /**
     * Income statement structure.
     *
     * @var array
     * @since 1.0.0
     */
    private array $incomeStatement = [];
}

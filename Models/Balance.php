<?php
/**
 * Orange Management
 *
 * PHP Version 8.0
 *
 * @package   Modules\Accounting\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Accounting\Models;

/**
 * Balance class.
 *
 * @package Modules\Accounting\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class Balance
{
    /**
     * ID.
     *
     * @var int
     * @since 1.0.0
     */
    protected int $id = 0;

    /**
     * Balance data.
     *
     * @var array
     * @since 1.0.0
     */
    private array $balance = [];

    /**
     * Localization.
     *
     * @var BalanceL11n
     * @since 1.0.0
     */
    public BalanceL11n $l11n;

    /**
     * Constructor.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->l11n = new BalanceL11n();
    }

    /**
     * Get balance id
     *
     * @return int
     *
     * @since 1.0.0
     */
    public function getId() : int
    {
        return $this->id;
    }
}

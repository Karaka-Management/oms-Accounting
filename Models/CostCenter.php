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
 * Cost center class.
 *
 * @package Modules\Accounting\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class CostCenter
{
    /**
     * ID.
     *
     * @var int
     * @since 1.0.0
     */
    protected int $id = 0;

    /**
     * Code.
     *
     * @var string
     * @since 1.0.0
     */
    public string $code = '';

    /**
     * Localization.
     *
     * @var L11nCostCenter
     * @since 1.0.0
     */
    public L11nCostCenter $l11n;

    /**
     * Parent.
     *
     * @var null|int|CostCenter
     * @since 1.0.0
     */
    public $parent = null;

    /**
     * Constructor.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->l11n = new L11nCostCenter();
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

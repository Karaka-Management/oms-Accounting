<?php
/**
 * Karaka
 *
 * PHP Version 8.0
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
 * Cost center class.
 *
 * @package Modules\Accounting\Models
 * @license OMS License 1.0
 * @link    https://karaka.app
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
     * @var CostCenterL11n
     * @since 1.0.0
     */
    public CostCenterL11n $l11n;

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
        $this->l11n = new CostCenterL11n();
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

    /**
     * {@inheritdoc}
     */
    public function toArray() : array
    {
        return [
            'id'        => $this->id,
            'code'      => $this->code,
            'parent'    => $this->parent,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }
}

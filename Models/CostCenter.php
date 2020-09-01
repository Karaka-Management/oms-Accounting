<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
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
    private string $code = '';

    /**
     * Localization.
     *
     * @var L11nCostCenter
     * @since 1.0.0
     */
    private L11nCostCenter $l11n;

    /**
     * Parent.
     *
     * @var null|int|CostCenter
     * @since 1.0.0
     */
    private $parent = null;

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

    /**
     * Set code
     *
     * @param string $code Balance code
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setCode(string $code) : void
    {
        $this->code = $code;
    }

    /**
     * Get code
     *
     * @return string
     *
     * @since 1.0.0
     */
    public function getCode() : string
    {
        return $this->code;
    }

    /**
     * Set name
     *
     * @param string $name Balance name
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setName(string $name) : void
    {
        $this->l11n->setName($name);
    }

    /**
     * Get name
     *
     * @return string
     *
     * @since 1.0.0
     */
    public function getName() : string
    {
        return $this->l11n->getName();
    }

    /**
     * Set description
     *
     * @param string $description Balance description
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setDescription(string $description) : void
    {
        $this->l11n->setDescription($description);
    }

    /**
     * Get description
     *
     * @return string
     *
     * @since 1.0.0
     */
    public function getDescription() : string
    {
        return $this->l11n->getDescription();
    }

    /**
     * Set parent
     *
     * @param null|int|CostCenter $parent Parent
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setParent($parent) : void
    {
        $this->parent = $parent;
    }

    /**
     * Get parent
     *
     * @return mixed
     *
     * @since 1.0.0
     */
    public function getParent()
    {
        return $this->parent;
    }
}

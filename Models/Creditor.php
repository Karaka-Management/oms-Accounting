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

use Modules\Admin\Models\Account;

/**
 * Creditor class.
 *
 * @package Modules\Accounting\Models
 * @license OMS License 1.0
 * @link    https://karaka.app
 * @since   1.0.0
 */
class Creditor
{
    /**
     * Creditor ID.
     *
     * @var int
     * @since 1.0.0
     */
    protected int $id = 0;

    /**
     * Account.
     *
     * @var null|int|Account
     * @since 1.0.0
     */
    public $account = null;

    /**
     * Get id.
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
            'id'         => $this->id,
            'account'    => $this->account,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize() : mixed
    {
        return $this->toArray();
    }
}

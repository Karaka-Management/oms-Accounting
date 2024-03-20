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

use Modules\Admin\Models\Account;
use Modules\Admin\Models\NullAccount;

/**
 * Posting class.
 *
 * @package Modules\Accounting\Models
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 */
class PostingElement
{
    public int $id = 0;

    public int $status = 0;

    public string $text = '';

    public int $type = 0;

    public \DateTimeImmutable $createdAt;

    public \DateTimeImmutable $performanceDate;

    public Account $createdBy;

    public AccountAbstract $account;

    public ?CostCenter $costcenter = null;

    public ?CostObject $costobject = null;

    public int $value = 0;

    public int $tax = 0;

    public int $unit = 0;

    public ?self $opposite = null;

    public int $posting = 0;

    // @todo Create some hard values similar to bill and bill element for taxCode, customer/supplier taxId, ...

    /**
     * Constructor.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->createdAt       = new \DateTimeImmutable('now');
        $this->performanceDate = new \DateTimeImmutable('now');

        $this->createdBy = new NullAccount();
        $this->account   = new NullAccountAbstract();
    }
}

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
class Posting
{
    public int $id = 0;

    public int $status = 0;

    public string $number = '';

    public ?AccountAbstract $account = null;

    public ?int $paymentTerms = null;

    public ?int $payment = null;

    public int $dunLevel = 0;

    public bool $dunStop = false;

    public ?int $bill = null;

    public ?int $batch = null;

    public int $value = 0;

    public \DateTimeImmutable $createdAt;

    public \DateTimeImmutable $performanceDate;

    public Account $createdBy;

    public int $unit = 0;

    public array $elements = [];

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
    }
}

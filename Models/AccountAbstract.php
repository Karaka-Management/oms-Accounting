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
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\Accounting\Models;

/**
 * Account abstraction class.
 *
 * @package Modules\Accounting\Models
 * @license OMS License 1.0
 * @link    https://jingga.app
 * @since   1.0.0
 */
abstract class AccountAbstract
{
    /**
     * Account ID.
     *
     * @var int
     * @since 1.0.0
     */
    protected int $id = 0;

    /**
     * Summary account.
     *
     * @var null|int
     * @since 1.0.0
     */
    public ?int $summaryAccount = null;

    /**
     * Type.
     *
     * @var int
     * @since 1.0.0
     */
    protected int $type = AccountType::IMPERSONAL;

    /**
     * Entry list.
     *
     * @var EntryInterface[]
     * @since 1.0.0
     */
    protected array $entries = [];

    /**
     * Get account id.
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
     * Get entry.
     *
     * @param int $id Entry ID
     *
     * @return null|EntryInterface
     *
     * @since 1.0.0
     */
    public function getEntryById(int $id) : ?EntryInterface
    {
        return $this->entries[$id] ?? null;
    }

    /**
     * Get entry.
     *
     * @param \DateTime      $start    Interval start
     * @param null|\DateTime $end      Interval end
     * @param int            $dateType Date type by witch the entries should be filtered
     *
     * @return array
     *
     * @since   1.0.0
     */
    public function getEntriesByDate(\DateTime $start, \DateTime $end = null, int $dateType = TimeRangeType::RECEIPT_DATE) : array
    {
        return [];
    }
}

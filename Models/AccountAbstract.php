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

use phpOMS\Localization\BaseStringL11n;
use phpOMS\Localization\ISO639x1Enum;

/**
 * Account abstraction class.
 *
 * @package Modules\Accounting\Models
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 */
class AccountAbstract
{
    /**
     * Account ID.
     *
     * @var int
     * @since 1.0.0
     */
    public int $id = 0;

    public string $code = '';

    public ?int $account = null;

    /*
     * String l11n
     *
     * @var string | BaseStringL11n
     * @since 1.0.0
     */
    public string | BaseStringL11n $l11n = '';

    /**
     * Summary account.
     *
     * @var null|int
     * @since 1.0.0
     */
    public ?int $summaryAccount = null;

    // Tax accounts can be defined in:
    //      1. Account (gross postings are automatically split)
    //      2. Tax code
    //      3. Tax combination
    public ?int $taxAccount1 = null;

    public ?int $taxAccount2 = null;

    public int $taxCodeRequirement = RequirementType::ALLOWED;

    public ?int $defaultTaxCode = null;

    public ?int $mandatoryTaxCode = null;

    public int $costCenterRequirement = RequirementType::ALLOWED;

    public ?int $defaultCostCenter = null;

    public ?int $mandatoryCostCenter = null;

    public int $costObjectRequirement = RequirementType::ALLOWED;

    public ?int $defaultCostObject = null;

    public ?int $mandatoryCostObject = null;

    // Indicators and report position for different reports (e.g. EÜR, ZM, UVA, OSS)
    public array $reportIndicators = [];

    public bool $manualPosting = true;

    public string $currency = '';

    public bool $isConfidential = false;

    public bool $isMoneyAccount = false;

    public bool $isCashflowAccount = false;

    public bool $hasOpenPositions = false;

    public bool $createOpeningBalancePosting = false;

    public int $status = AccountStatus::ACTIVE;

    public ?\DateTime $start = null;

    public ?\DateTime $end = null;

    /**
     * Type.
     *
     * @var int
     * @since 1.0.0
     */
    public int $type = AccountType::IMPERSONAL;

    public ?int $parent = null;

    /**
     * Entry list.
     *
     * @var EntryInterface[]
     * @since 1.0.0
     */
    public array $entries = [];

    public ?int $unit = null;

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
     * Set l11n
     *
     * @param string|BaseStringL11n $l11n Tag article l11n
     * @param string                $lang Language
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setL11n(string | BaseStringL11n $l11n, string $lang = ISO639x1Enum::_EN) : void
    {
        if ($l11n instanceof BaseStringL11n) {
            $this->l11n = $l11n;
        } elseif (isset($this->l11n) && $this->l11n instanceof BaseStringL11n) {
            $this->l11n->content  = $l11n;
            $this->l11n->language = $lang;
        } else {
            $this->l11n           = new BaseStringL11n();
            $this->l11n->content  = $l11n;
            $this->l11n->language = $lang;
        }
    }

    /**
     * @return string
     *
     * @since 1.0.0
     */
    public function getL11n() : string
    {
        if (!isset($this->l11n)) {
            return '';
        }

        return $this->l11n instanceof BaseStringL11n ? $this->l11n->content : $this->l11n;
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
    public function getEntriesByDate(\DateTime $start, ?\DateTime $end = null, int $dateType = TimeRangeType::RECEIPT_DATE) : array
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function toArray() : array
    {
        return [
            'id' => $this->id,
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

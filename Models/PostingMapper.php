<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   Modules\Accounting\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.2
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\Accounting\Models;

use Modules\Admin\Models\AccountMapper;
use phpOMS\DataStorage\Database\Mapper\DataMapperFactory;

/**
 * Account mapper class.
 *
 * @package Modules\Accounting\Models
 * @license OMS License 2.2
 * @link    https://jingga.app
 * @since   1.0.0
 *
 * @template T of Posting
 * @extends DataMapperFactory<T>
 */
class PostingMapper extends DataMapperFactory
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, readonly?:bool, writeonly?:bool, annotations?:array}>
     * @since 1.0.0
     */
    public const COLUMNS = [
        'accounting_posting_id'           => ['name' => 'accounting_posting_id',           'type' => 'int',      'internal' => 'id'],
        'accounting_posting_status'       => ['name' => 'accounting_posting_status',           'type' => 'int',      'internal' => 'status'],
        'accounting_posting_number'       => ['name' => 'accounting_posting_number',           'type' => 'string',      'internal' => 'number'],
        'accounting_posting_account'      => ['name' => 'accounting_posting_account',           'type' => 'int',      'internal' => 'account'],
        'accounting_posting_paymentterms' => ['name' => 'accounting_posting_paymentterms',           'type' => 'int',      'internal' => 'paymentTerms'],
        'accounting_posting_payment'      => ['name' => 'accounting_posting_payment',           'type' => 'int',      'internal' => 'payment'],
        'accounting_posting_dun_level'    => ['name' => 'accounting_posting_dun_level',           'type' => 'int',      'internal' => 'dunLevel'],
        'accounting_posting_dun_stop'     => ['name' => 'accounting_posting_dun_stop',           'type' => 'bool',      'internal' => 'dunStop'],
        'accounting_posting_bill'         => ['name' => 'accounting_posting_bill',           'type' => 'int',      'internal' => 'bill'],
        'accounting_posting_batch'        => ['name' => 'accounting_posting_batch',           'type' => 'int',      'internal' => 'batch'],
        'accounting_posting_value'        => ['name' => 'accounting_posting_value',           'type' => 'int',      'internal' => 'value'],
        'accounting_posting_createdat'    => ['name' => 'accounting_posting_createdat',           'type' => 'DateTimeImmutable',      'internal' => 'createdAt'],
        'accounting_posting_createdby'    => ['name' => 'accounting_posting_createdby',           'type' => 'int',      'internal' => 'createdBy'],
        'accounting_posting_performance'  => ['name' => 'accounting_posting_performance',           'type' => 'DateTimeImmutable',      'internal' => 'performanceDate'],
        'accounting_posting_unit'         => ['name' => 'accounting_posting_unit',           'type' => 'int',      'internal' => 'unit'],
    ];

    /**
     * Has one relation.
     *
     * @var array<string, array{mapper:class-string, external:string, by?:string, column?:string, conditional?:bool}>
     * @since 1.0.0
     */
    public const OWNS_ONE = [
        'account' => [
            'mapper'   => AccountAbstractMapper::class,
            'external' => 'accounting_posting_account',
        ],
        'createdBy' => [
            'mapper'   => AccountMapper::class,
            'external' => 'accounting_posting_createdby',
        ],
    ];

    /**
     * Has many relation.
     *
     * @var array<string, array{mapper:class-string, table:string, self?:?string, external?:?string, column?:string}>
     * @since 1.0.0
     */
    public const HAS_MANY = [
        'elements' => [
            'mapper'   => PostingElementMapper::class,
            'table'    => 'accounting_posting_ele',
            'self'     => 'accounting_posting_ele_posting',
            'external' => null,
        ],
    ];

    /**
     * Model to use by the mapper.
     *
     * @var class-string<T>
     * @since 1.0.0
     */
    public const MODEL = Posting::class;

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    public const TABLE = 'accounting_posting';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    public const PRIMARYFIELD = 'accounting_posting_id';
}

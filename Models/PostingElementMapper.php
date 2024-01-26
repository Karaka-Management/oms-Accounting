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

use Modules\Admin\Models\AccountMapper;
use phpOMS\DataStorage\Database\Mapper\DataMapperFactory;

/**
 * Account mapper class.
 *
 * @package Modules\Accounting\Models
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 *
 * @template T of PostingElement
 * @extends DataMapperFactory<T>
 */
class PostingElementMapper extends DataMapperFactory
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, readonly?:bool, writeonly?:bool, annotations?:array}>
     * @since 1.0.0
     */
    public const COLUMNS = [
        'accounting_posting_ele_id'          => ['name' => 'accounting_posting_ele_id',           'type' => 'int',      'internal' => 'id'],
        'accounting_posting_ele_status'      => ['name' => 'accounting_posting_ele_status',           'type' => 'int',      'internal' => 'status'],
        'accounting_posting_ele_text'        => ['name' => 'accounting_posting_ele_text',           'type' => 'string',      'internal' => 'text'],
        'accounting_posting_ele_type'        => ['name' => 'accounting_posting_ele_type',           'type' => 'int',      'internal' => 'type'],
        'accounting_posting_ele_account'     => ['name' => 'accounting_posting_ele_account',           'type' => 'int',      'internal' => 'account'],
        'accounting_posting_ele_cc'          => ['name' => 'accounting_posting_ele_cc',           'type' => 'int',      'internal' => 'costcenter'],
        'accounting_posting_ele_co'          => ['name' => 'accounting_posting_ele_co',           'type' => 'int',      'internal' => 'costobject'],
        'accounting_posting_ele_value'       => ['name' => 'accounting_posting_ele_value',           'type' => 'int',      'internal' => 'value'],
        'accounting_posting_ele_tax'         => ['name' => 'accounting_posting_ele_tax',           'type' => 'int',      'internal' => 'tax'],
        'accounting_posting_ele_createdat'   => ['name' => 'accounting_posting_ele_createdat',           'type' => 'DateTimeImmutable',      'internal' => 'createdAt'],
        'accounting_posting_ele_createdby'   => ['name' => 'accounting_posting_ele_createdby',           'type' => 'int',      'internal' => 'createdBy'],
        'accounting_posting_ele_performance' => ['name' => 'accounting_posting_ele_performance',           'type' => 'DateTimeImmutable',      'internal' => 'performanceDate'],
        'accounting_posting_ele_opposite'    => ['name' => 'accounting_posting_ele_opposite',           'type' => 'int',      'internal' => 'opposite'],
        'accounting_posting_ele_posting'     => ['name' => 'accounting_posting_ele_posting',           'type' => 'int',      'internal' => 'posting'],
        'accounting_posting_ele_unit'        => ['name' => 'accounting_posting_ele_unit',           'type' => 'int',      'internal' => 'unit'],
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
            'external' => 'accounting_posting_ele_account',
        ],
        'createdBy' => [
            'mapper'   => AccountMapper::class,
            'external' => 'accounting_posting_ele_createdby',
        ],
        'costcenter' => [
            'mapper'   => CostCenterMapper::class,
            'external' => 'accounting_posting_ele_cc',
        ],
        'costobject' => [
            'mapper'   => CostObjectMapper::class,
            'external' => 'accounting_posting_ele_co',
        ],
        /*
        'opposite' => [
            'mapper'     => PostingElementMapper::class,
            'external'   => 'accounting_posting_ele_opposite',
        ],
        'posting' => [
            'mapper'     => PostingMapper::class,
            'external'   => 'accounting_posting_ele_posting',
        ],
        */
    ];

    /**
     * Model to use by the mapper.
     *
     * @var class-string<T>
     * @since 1.0.0
     */
    public const MODEL = PostingElement::class;

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    public const TABLE = 'accounting_posting_ele';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    public const PRIMARYFIELD = 'accounting_posting_ele_id';
}

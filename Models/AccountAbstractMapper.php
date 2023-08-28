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

use phpOMS\DataStorage\Database\Mapper\DataMapperFactory;

/**
 * Account mapper class.
 *
 * @package Modules\Accounting\Models
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 *
 * @template T of AccountAbstract
 * @extends DataMapperFactory<T>
 */
class AccountAbstractMapper extends DataMapperFactory
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, readonly?:bool, writeonly?:bool, annotations?:array}>
     * @since 1.0.0
     */
    public const COLUMNS = [
        'accounting_account_id'                  => ['name' => 'accounting_account_id',           'type' => 'int',      'internal' => 'id'],
        'accounting_account_account'               => ['name' => 'accounting_account_account',        'type' => 'string',   'internal' => 'account', 'autocomplete' => true],
        'accounting_account_type'               => ['name' => 'accounting_account_type',        'type' => 'int',   'internal' => 'type'],
        'accounting_account_parent'               => ['name' => 'accounting_account_parent',        'type' => 'string',   'internal' => 'parent'],
    ];

    /**
     * Has many relation.
     *
     * @var array<string, array{mapper:class-string, table:string, self?:?string, external?:?string, column?:string}>
     * @since 1.0.0
     */
    public const HAS_MANY = [
        'l11n' => [
            'mapper'   => AccountL11nMapper::class,
            'table'    => 'accounting_account_l11n',
            'self'     => 'accounting_account_l11n_account',
            'column'   => 'content',
            'external' => null,
        ],
    ];

    /**
     * Model to use by the mapper.
     *
     * @var class-string<T>
     * @since 1.0.0
     */
    public const MODEL = AccountAbstract::class;

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    public const TABLE = 'accounting_account';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    public const PRIMARYFIELD = 'accounting_account_id';
}

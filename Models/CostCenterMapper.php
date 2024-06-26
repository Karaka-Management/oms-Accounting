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

use phpOMS\DataStorage\Database\Mapper\DataMapperFactory;

/**
 * Accounting mapper class.
 *
 * @package Modules\Accounting\Models
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 *
 * @template T of CostCenter
 * @extends DataMapperFactory<T>
 */
final class CostCenterMapper extends DataMapperFactory
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, readonly?:bool, writeonly?:bool, annotations?:array}>
     * @since 1.0.0
     */
    public const COLUMNS = [
        'accounting_costcenter_id'   => ['name' => 'accounting_costcenter_id',   'type' => 'int',    'internal' => 'id'],
        'accounting_costcenter_code' => ['name' => 'accounting_costcenter_code', 'type' => 'string', 'internal' => 'code'],
        'accounting_costcenter_unit' => ['name' => 'accounting_costcenter_unit', 'type' => 'int', 'internal' => 'unit'],
    ];

    /**
     * Has many relation.
     *
     * @var array<string, array{mapper:class-string, table:string, self?:?string, external?:?string, column?:string}>
     * @since 1.0.0
     */
    public const HAS_MANY = [
        'l11n' => [
            'mapper'   => CostCenterL11nMapper::class,
            'table'    => 'accounting_costcenter_l11n',
            'self'     => 'accounting_costcenter_l11n_costcenter',
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
    public const MODEL = CostCenter::class;

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    public const TABLE = 'accounting_costcenter';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    public const PRIMARYFIELD = 'accounting_costcenter_id';
}

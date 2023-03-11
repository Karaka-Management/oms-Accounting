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

use phpOMS\DataStorage\Database\Mapper\DataMapperFactory;

/**
 * CostCenter mapper class.
 *
 * @package Modules\Accounting\Models
 * @license OMS License 1.0
 * @link    https://jingga.app
 * @since   1.0.0
 */
final class CostCenterL11nMapper extends DataMapperFactory
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, readonly?:bool, writeonly?:bool, annotations?:array}>
     * @since 1.0.0
     */
    public const COLUMNS = [
        'accounting_costcenter_l11n_id'          => ['name' => 'accounting_costcenter_l11n_id',          'type' => 'int',    'internal' => 'id'],
        'accounting_costcenter_l11n_name'        => ['name' => 'accounting_costcenter_l11n_name',        'type' => 'string', 'internal' => 'name',        'autocomplete' => true],
        'accounting_costcenter_l11n_description' => ['name' => 'accounting_costcenter_l11n_description', 'type' => 'string', 'internal' => 'description', 'autocomplete' => true],
        'accounting_costcenter_l11n_costcenter'  => ['name' => 'accounting_costcenter_l11n_costcenter',  'type' => 'int',    'internal' => 'costcenter'],
        'accounting_costcenter_l11n_language'    => ['name' => 'accounting_costcenter_l11n_language',    'type' => 'string', 'internal' => 'language'],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    public const TABLE = 'accounting_costcenter_l11n';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    public const PRIMARYFIELD = 'accounting_costcenter_l11n_id';
}

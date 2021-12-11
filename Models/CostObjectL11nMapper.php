<?php
/**
 * Orange Management
 *
 * PHP Version 8.0
 *
 * @package   Modules\Accounting\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Accounting\Models;

use phpOMS\DataStorage\Database\Mapper\DataMapperFactory;

/**
 * CostObject mapper class.
 *
 * @package Modules\Accounting\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class CostObjectL11nMapper extends DataMapperFactory
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, readonly?:bool, writeonly?:bool, annotations?:array}>
     * @since 1.0.0
     */
    public const COLUMNS = [
        'accounting_costobject_l11n_id'              => ['name' => 'accounting_costobject_l11n_id',       'type' => 'int',    'internal' => 'id'],
        'accounting_costobject_l11n_name'            => ['name' => 'accounting_costobject_l11n_name',    'type' => 'string', 'internal' => 'name', 'autocomplete' => true],
        'accounting_costobject_l11n_description'     => ['name' => 'accounting_costobject_l11n_description',    'type' => 'string', 'internal' => 'description', 'autocomplete' => true],
        'accounting_costobject_l11n_costobject'      => ['name' => 'accounting_costobject_l11n_costobject',      'type' => 'int',    'internal' => 'costobject'],
        'accounting_costobject_l11n_language'        => ['name' => 'accounting_costobject_l11n_language', 'type' => 'string', 'internal' => 'language'],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    public const TABLE = 'accounting_costobject_l11n';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    public const PRIMARYFIELD ='accounting_costobject_l11n_id';
}

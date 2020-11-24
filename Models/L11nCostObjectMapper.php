<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Accounting\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Accounting\Models;

use phpOMS\DataStorage\Database\DataMapperAbstract;
use phpOMS\Localization\Defaults\LanguageMapper;

/**
 * CostObject mapper class.
 *
 * @package Modules\Accounting\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 *
 * @todo Do I really want to create a relation to the language mapper? It's not really needed right?
 */
final class L11nCostObjectMapper extends DataMapperAbstract
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, readonly?:bool, writeonly?:bool, annotations?:array}>
     * @since 1.0.0
     */
    protected static array $columns = [
        'accounting_costobject_l11n_id'              => ['name' => 'accounting_costobject_l11n_id',       'type' => 'int',    'internal' => 'id'],
        'accounting_costobject_l11n_name'            => ['name' => 'accounting_costobject_l11n_name',    'type' => 'string', 'internal' => 'name', 'autocomplete' => true],
        'accounting_costobject_l11n_description'     => ['name' => 'accounting_costobject_l11n_description',    'type' => 'string', 'internal' => 'description', 'autocomplete' => true],
        'accounting_costobject_l11n_costobject'      => ['name' => 'accounting_costobject_l11n_costobject',      'type' => 'int',    'internal' => 'costobject'],
        'accounting_costobject_l11n_language'        => ['name' => 'accounting_costobject_l11n_language', 'type' => 'string', 'internal' => 'language'],
    ];

    /**
     * Has one relation.
     *
     * @var array<string, array{mapper:string, external:string, by?:string, column?:string, conditional?:bool}>
     * @since 1.0.0
     */
    protected static array $ownsOne = [
        'language' => [
            'mapper'            => LanguageMapper::class,
            'external'          => 'accounting_costobject_l11n_language',
            'by'                => 'code2',
            'column'            => 'code2',
            'conditional'       => true,
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $table = 'accounting_costobject_l11n';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $primaryField = 'accounting_costobject_l11n_id';
}

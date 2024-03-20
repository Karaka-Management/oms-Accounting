<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   Modules
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

use Modules\Accounting\Controller\BackendController;
use Modules\Accounting\Models\PermissionCategory;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/accounting/entries(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Accounting\Controller\BackendController:viewEntries',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::ENTRY,
            ],
        ],
    ],
    '^.*/accounting/stack/list(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Accounting\Controller\BackendController:viewStackList',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::STACK,
            ],
        ],
    ],
    '^.*/accounting/stack/entries(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Accounting\Controller\BackendController:viewStackEntries',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::STACK,
            ],
        ],
    ],
    '^.*/accounting/stack/archive/list(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Accounting\Controller\BackendController:viewStackArchiveList',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::STACK,
            ],
        ],
    ],
    '^.*/accounting/stack/create(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Accounting\Controller\BackendController:viewStackCreate',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::CREATE,
                'state'  => PermissionCategory::STACK,
            ],
        ],
    ],
    '^.*/accounting/stack/predefined/list(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Accounting\Controller\BackendController:viewStackPredefinedList',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::STACK,
            ],
        ],
    ],
    '^.*/accounting/coa/view(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Accounting\Controller\BackendController:viewAccountView',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::ACCOUNT,
            ],
        ],
    ],
    '^.*/accounting/coa/list(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Accounting\Controller\BackendController:viewCOAList',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::GL,
            ],
        ],
    ],
    '^.*/accounting/coa/create(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Accounting\Controller\BackendController:viewCOACreate',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::CREATE,
                'state'  => PermissionCategory::GL,
            ],
        ],
    ],
    '^.*/accounting/dun/print(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Accounting\Controller\BackendController:viewCostCenterView',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::COST_CENTER,
            ],
        ],
    ],
    '^.*/accounting/statement/print(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Accounting\Controller\BackendController:viewCostCenterView',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::ACCOUNT,
            ],
        ],
    ],
    '^.*/accounting/balances/print(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Accounting\Controller\BackendController:viewCostCenterView',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::ACCOUNT,
            ],
        ],
    ],
    '^.*/accounting/accountform/print(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Accounting\Controller\BackendController:viewCostCenterView',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::ACCOUNT,
            ],
        ],
    ],

    '^.*/accounting/costcenter/list(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Accounting\Controller\BackendController:viewCostCenterList',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::COST_CENTER,
            ],
        ],
    ],
    '^.*/accounting/costobject/list(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Accounting\Controller\BackendController:viewCostObjectList',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::COST_OBJECT,
            ],
        ],
    ],
    '^.*/accounting/costcenter/view(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Accounting\Controller\BackendController:viewCostCenterView',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::COST_CENTER,
            ],
        ],
    ],
    '^.*/accounting/costcenter/create(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Accounting\Controller\BackendController:viewCostCenterCreate',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::CREATE,
                'state'  => PermissionCategory::COST_CENTER,
            ],
        ],
    ],
    '^.*/accounting/costobject/view(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Accounting\Controller\BackendController:viewCostObjectView',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::COST_OBJECT,
            ],
        ],
    ],
    '^.*/accounting/costobject/create(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Accounting\Controller\BackendController:viewCostObjectCreate',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::CREATE,
                'state'  => PermissionCategory::COST_OBJECT,
            ],
        ],
    ],

    '^.*/accounting/supplier/list(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Accounting\Controller\BackendController:viewSupplierList',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::SUPPLIER,
            ],
        ],
    ],
    '^.*/accounting/client/list(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Accounting\Controller\BackendController:viewClientList',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::CLIENT,
            ],
        ],
    ],
    '^.*/accounting/supplier/view(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Accounting\Controller\BackendController:viewSupplierView',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::SUPPLIER,
            ],
        ],
    ],
    '^.*/accounting/client/view(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Accounting\Controller\BackendController:viewClientView',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::CLIENT,
            ],
        ],
    ],
    '^.*/accounting/supplier/entries(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Accounting\Controller\BackendController:viewSupplierView',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::SUPPLIER,
            ],
        ],
    ],
    '^.*/accounting/client/entries(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Accounting\Controller\BackendController:viewClientView',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::CLIENT,
            ],
        ],
    ],
];

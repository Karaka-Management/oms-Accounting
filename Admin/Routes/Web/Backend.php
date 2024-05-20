<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   Modules
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.2
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

use Modules\Accounting\Controller\BackendController;
use Modules\Accounting\Models\PermissionCategory;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^/accounting/entry/dashboard(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Accounting\Controller\BackendController:viewEntries',
            'verb'       => RouteVerb::GET,
            'active'     => true,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::ENTRY,
            ],
        ],
    ],
    '^/accounting/entry/list(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Accounting\Controller\BackendController:viewEntryList',
            'verb'       => RouteVerb::GET,
            'active'     => true,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::ENTRY,
            ],
        ],
    ],
    '^/accounting/entry/view(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Accounting\Controller\BackendController:viewEntryView',
            'verb'       => RouteVerb::GET,
            'active'     => true,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::ENTRY,
            ],
        ],
    ],
    '^/accounting/entry/create(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Accounting\Controller\BackendController:viewEntryCreate',
            'verb'       => RouteVerb::GET,
            'active'     => true,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::ENTRY,
            ],
        ],
    ],
    '^/accounting/entry/archive(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Accounting\Controller\BackendController:viewEntryArchiveList',
            'verb'       => RouteVerb::GET,
            'active'     => true,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::ENTRY,
            ],
        ],
    ],
    '^/accounting/entry/template/list(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Accounting\Controller\BackendController:viewEntryTemplateList',
            'verb'       => RouteVerb::GET,
            'active'     => true,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::ENTRY,
            ],
        ],
    ],
    '^/accounting/coa/view(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Accounting\Controller\BackendController:viewAccountView',
            'verb'       => RouteVerb::GET,
            'active'     => true,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::ACCOUNT,
            ],
        ],
    ],
    '^/accounting/coa/list(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Accounting\Controller\BackendController:viewCOAList',
            'verb'       => RouteVerb::GET,
            'active'     => true,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::GL,
            ],
        ],
    ],
    '^/accounting/coa/create(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Accounting\Controller\BackendController:viewCOACreate',
            'verb'       => RouteVerb::GET,
            'active'     => true,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::CREATE,
                'state'  => PermissionCategory::GL,
            ],
        ],
    ],

    '^/accounting/costcenter/list(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Accounting\Controller\BackendController:viewCostCenterList',
            'verb'       => RouteVerb::GET,
            'active'     => true,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::COST_CENTER,
            ],
        ],
    ],
    '^/accounting/costobject/list(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Accounting\Controller\BackendController:viewCostObjectList',
            'verb'       => RouteVerb::GET,
            'active'     => true,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::COST_OBJECT,
            ],
        ],
    ],
    '^/accounting/costcenter/view(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Accounting\Controller\BackendController:viewCostCenterView',
            'verb'       => RouteVerb::GET,
            'active'     => true,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::COST_CENTER,
            ],
        ],
    ],
    '^/accounting/costcenter/create(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Accounting\Controller\BackendController:viewCostCenterCreate',
            'verb'       => RouteVerb::GET,
            'active'     => true,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::CREATE,
                'state'  => PermissionCategory::COST_CENTER,
            ],
        ],
    ],
    '^/accounting/costobject/view(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Accounting\Controller\BackendController:viewCostObjectView',
            'verb'       => RouteVerb::GET,
            'active'     => true,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::COST_OBJECT,
            ],
        ],
    ],
    '^/accounting/costobject/create(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Accounting\Controller\BackendController:viewCostObjectCreate',
            'verb'       => RouteVerb::GET,
            'active'     => true,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::CREATE,
                'state'  => PermissionCategory::COST_OBJECT,
            ],
        ],
    ],

    '^/accounting/supplier/list(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Accounting\Controller\BackendController:viewSupplierList',
            'verb'       => RouteVerb::GET,
            'active'     => true,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::SUPPLIER,
            ],
        ],
    ],
    '^/accounting/client/list(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Accounting\Controller\BackendController:viewClientList',
            'verb'       => RouteVerb::GET,
            'active'     => true,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::CLIENT,
            ],
        ],
    ],
    '^/accounting/supplier/view(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Accounting\Controller\BackendController:viewSupplierView',
            'verb'       => RouteVerb::GET,
            'active'     => true,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::SUPPLIER,
            ],
        ],
    ],
    '^/accounting/client/view(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Accounting\Controller\BackendController:viewClientView',
            'verb'       => RouteVerb::GET,
            'active'     => true,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::CLIENT,
            ],
        ],
    ],
];

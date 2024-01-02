<?php
/**
 * Jingga
 *
 * PHP Version 8.1
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
    '^.*/accounting/personal/entries.*$' => [
        [
            'dest'       => '\Modules\Accounting\Controller\BackendController:viewPersonalEntries',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::PERSONAL,
            ],
        ],
    ],
    '^.*/accounting/impersonal/entries.*$' => [
        [
            'dest'       => '\Modules\Accounting\Controller\BackendController:viewImpersonalEntries',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::IMPERSONAL,
            ],
        ],
    ],
    '^.*/accounting/entries.*$' => [
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
    '^.*/accounting/impersonal/journal/list.*$' => [
        [
            'dest'       => '\Modules\Accounting\Controller\BackendController:viewJournalList',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::JOURNAL,
            ],
        ],
    ],
    '^.*/accounting/stack/list.*$' => [
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
    '^.*/accounting/stack/entries.*$' => [
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
    '^.*/accounting/stack/archive/list.*$' => [
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
    '^.*/accounting/stack/create.*$' => [
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
    '^.*/accounting/stack/predefined/list.*$' => [
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
    '^.*/accounting/coa/profile.*$' => [
        [
            'dest'       => '\Modules\Accounting\Controller\BackendController:viewAccountProfile',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::ACCOUNT,
            ],
        ],
    ],
    '^.*/accounting/coa/list.*$' => [
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
    '^.*/accounting/coa/create.*$' => [
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
    '^.*/accounting/gl/profile.*$' => [
        [
            'dest'       => '\Modules\Accounting\Controller\BackendController:viewGLProfile',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::GL,
            ],
        ],
    ],
    '^.*/accounting/dun/print.*$' => [
        [
            'dest'       => '\Modules\Accounting\Controller\BackendController:viewCostCenterProfile',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::COST_CENTER,
            ],
        ],
    ],
    '^.*/accounting/statement/print.*$' => [
        [
            'dest'       => '\Modules\Accounting\Controller\BackendController:viewCostCenterProfile',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::ACCOUNT,
            ],
        ],
    ],
    '^.*/accounting/balances/print.*$' => [
        [
            'dest'       => '\Modules\Accounting\Controller\BackendController:viewCostCenterProfile',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::ACCOUNT,
            ],
        ],
    ],
    '^.*/accounting/accountform/print.*$' => [
        [
            'dest'       => '\Modules\Accounting\Controller\BackendController:viewCostCenterProfile',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::ACCOUNT,
            ],
        ],
    ],

    '^.*/accounting/costcenter/list.*$' => [
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
    '^.*/accounting/costobject/list.*$' => [
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
    '^.*/accounting/costcenter/profile.*$' => [
        [
            'dest'       => '\Modules\Accounting\Controller\BackendController:viewCostCenterProfile',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::COST_CENTER,
            ],
        ],
    ],
    '^.*/accounting/costobject/profile.*$' => [
        [
            'dest'       => '\Modules\Accounting\Controller\BackendController:viewCostObjectProfile',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::COST_OBJECT,
            ],
        ],
    ],

    '^.*/accounting/supplier/list.*$' => [
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
    '^.*/accounting/client/list.*$' => [
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
    '^.*/accounting/supplier/profile.*$' => [
        [
            'dest'       => '\Modules\Accounting\Controller\BackendController:viewSupplierProfile',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::SUPPLIER,
            ],
        ],
    ],
    '^.*/accounting/client/profile.*$' => [
        [
            'dest'       => '\Modules\Accounting\Controller\BackendController:viewClientProfile',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::CLIENT,
            ],
        ],
    ],
    '^.*/accounting/supplier/entries.*$' => [
        [
            'dest'       => '\Modules\Accounting\Controller\BackendController:viewSupplierProfile',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::SUPPLIER,
            ],
        ],
    ],
    '^.*/accounting/client/entries.*$' => [
        [
            'dest'       => '\Modules\Accounting\Controller\BackendController:viewClientProfile',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::CLIENT,
            ],
        ],
    ],
];

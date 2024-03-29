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

use Modules\Accounting\Controller\ApiController;
use Modules\Accounting\Models\PermissionCategory;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/accounting/coa(\?.*|$)' => [
        [
            'dest'       => '\Modules\Accounting\Controller\ApiController:apiAccountCreate',
            'verb'       => RouteVerb::PUT,
            'csrf'       => true,
            'permission' => [
                'module' => ApiController::NAME,
                'type'   => PermissionType::CREATE,
                'state'  => PermissionCategory::ACCOUNT,
            ],
        ],
        [
            'dest'       => '\Modules\Accounting\Controller\ApiController:apiAccountUpdate',
            'verb'       => RouteVerb::SET,
            'csrf'       => true,
            'permission' => [
                'module' => ApiController::NAME,
                'type'   => PermissionType::CREATE,
                'state'  => PermissionCategory::ACCOUNT,
            ],
        ],
    ],
    '^.*/accounting/coa/l11n(\?.*|$)' => [
        [
            'dest'       => '\Modules\Accounting\Controller\ApiController:apiAccountL11nCreate',
            'verb'       => RouteVerb::PUT,
            'csrf'       => true,
            'permission' => [
                'module' => ApiController::NAME,
                'type'   => PermissionType::CREATE,
                'state'  => PermissionCategory::ACCOUNT,
            ],
        ],
        [
            'dest'       => '\Modules\Accounting\Controller\ApiController:apiAccountL11nUpdate',
            'verb'       => RouteVerb::SET,
            'csrf'       => true,
            'permission' => [
                'module' => ApiController::NAME,
                'type'   => PermissionType::CREATE,
                'state'  => PermissionCategory::ACCOUNT,
            ],
        ],
    ],

    '^.*/accounting/costcenter(\?.*|$)' => [
        [
            'dest'       => '\Modules\Accounting\Controller\ApiController:apiCostCenterCreate',
            'verb'       => RouteVerb::PUT,
            'csrf'       => true,
            'permission' => [
                'module' => ApiController::NAME,
                'type'   => PermissionType::CREATE,
                'state'  => PermissionCategory::COST_CENTER,
            ],
        ],
        [
            'dest'       => '\Modules\Accounting\Controller\ApiController:apiCostCenterUpdate',
            'verb'       => RouteVerb::SET,
            'csrf'       => true,
            'permission' => [
                'module' => ApiController::NAME,
                'type'   => PermissionType::CREATE,
                'state'  => PermissionCategory::COST_CENTER,
            ],
        ],
    ],
    '^.*/accounting/costcenter/l11n(\?.*|$)' => [
        [
            'dest'       => '\Modules\Accounting\Controller\ApiController:apiCostCenterL11nCreate',
            'verb'       => RouteVerb::PUT,
            'csrf'       => true,
            'permission' => [
                'module' => ApiController::NAME,
                'type'   => PermissionType::CREATE,
                'state'  => PermissionCategory::COST_CENTER,
            ],
        ],
        [
            'dest'       => '\Modules\Accounting\Controller\ApiController:apiCostCenterL11nUpdate',
            'verb'       => RouteVerb::SET,
            'csrf'       => true,
            'permission' => [
                'module' => ApiController::NAME,
                'type'   => PermissionType::CREATE,
                'state'  => PermissionCategory::COST_CENTER,
            ],
        ],
    ],

    '^.*/accounting/costobject(\?.*|$)' => [
        [
            'dest'       => '\Modules\Accounting\Controller\ApiController:apiCostObjectCreate',
            'verb'       => RouteVerb::PUT,
            'csrf'       => true,
            'permission' => [
                'module' => ApiController::NAME,
                'type'   => PermissionType::CREATE,
                'state'  => PermissionCategory::COST_OBJECT,
            ],
        ],
        [
            'dest'       => '\Modules\Accounting\Controller\ApiController:apiCostObjectUpdate',
            'verb'       => RouteVerb::SET,
            'csrf'       => true,
            'permission' => [
                'module' => ApiController::NAME,
                'type'   => PermissionType::CREATE,
                'state'  => PermissionCategory::COST_OBJECT,
            ],
        ],
    ],
    '^.*/accounting/costobject/l11n(\?.*|$)' => [
        [
            'dest'       => '\Modules\Accounting\Controller\ApiController:apiCostObjectL11nCreate',
            'verb'       => RouteVerb::PUT,
            'csrf'       => true,
            'permission' => [
                'module' => ApiController::NAME,
                'type'   => PermissionType::CREATE,
                'state'  => PermissionCategory::COST_OBJECT,
            ],
        ],
        [
            'dest'       => '\Modules\Accounting\Controller\ApiController:apiCostObjectL11nUpdate',
            'verb'       => RouteVerb::SET,
            'csrf'       => true,
            'permission' => [
                'module' => ApiController::NAME,
                'type'   => PermissionType::CREATE,
                'state'  => PermissionCategory::COST_OBJECT,
            ],
        ],
    ],
];

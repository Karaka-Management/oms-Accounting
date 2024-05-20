<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   Modules\Accounting
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.2
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

return [
    'POST:Module:ClientManagement-client-create' => [
        'callback' => ['\Modules\Accounting\Controller\ApiController:hookPersonalAccountCreate'],
    ],
    'POST:Module:SupplierManagement-supplier-create' => [
        'callback' => ['\Modules\Accounting\Controller\ApiController:hookPersonalAccountCreate'],
    ],
];

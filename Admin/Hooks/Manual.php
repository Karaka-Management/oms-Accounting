<?php
/**
 * Jingga
 *
 * PHP Version 8.1
 *
 * @package   Modules\Accounting
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

return [
    '/PRE:Module:Billing\-bill\-finalize/' => [
        'callback' => ['\Modules\Accounting\Controller\ApiController:eventBillArchive'],
    ],
];

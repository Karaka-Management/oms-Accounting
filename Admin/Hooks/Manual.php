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
    '/PRE:Module:Billing\-bill\-finalize/' => [
        'callback' => ['\Modules\Accounting\Controller\ApiController:eventBillArchive'],
    ],
];

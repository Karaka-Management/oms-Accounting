<?php
/**
 * Jingga
 *
 * PHP Version 8.1
 *
 * @package   Modules\Accounting\Admin
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\Accounting\Admin;

use Modules\Accounting\Models\AccountType;
use phpOMS\Application\ApplicationAbstract;
use phpOMS\Config\SettingsInterface;
use phpOMS\Localization\ISO639x1Enum;
use phpOMS\Message\Http\HttpRequest;
use phpOMS\Message\Http\HttpResponse;
use phpOMS\Module\InstallerAbstract;
use phpOMS\Module\ModuleInfo;
use phpOMS\Uri\HttpUri;

/**
 * Installer class.
 *
 * @package Modules\Accounting\Admin
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 */
final class Installer extends InstallerAbstract
{
    /**
     * Path of the file
     *
     * @var string
     * @since 1.0.0
     */
    public const PATH = __DIR__;

    /**
     * {@inheritdoc}
     */
    public static function install(ApplicationAbstract $app, ModuleInfo $info, SettingsInterface $cfgHandler) : void
    {
        parent::install($app, $info, $cfgHandler);

        self::importAccounts($app);
    }

    /**
     * Import accounts
     *
     * @param ApplicationAbstract $app Application
     *
     * @return void
     *
     * @since 1.0.0
     */
    private static function importAccounts(ApplicationAbstract $app) : void
    {
        /** @var \Modules\Accounting\Controller\ApiController $module */
        $module = $app->moduleManager->getModuleInstance('Accounting', 'Api');

        $fp = \fopen(__DIR__ . '/Install/Coa/SKR03_DE_GAAP.csv', 'r');
        if ($fp === false) {
            return;
        }

        $c           = 0;
        $definitions = [];
        $languages   = 0;

        while (($line = \fgetcsv($fp)) !== false) {
            ++$c;

            if ($c === 2) {
                $definitions = $line;
                $languages   = \count($definitions) - 19;
            }

            if ($c < 3) {
                continue;
            }

            $response = new HttpResponse();
            $request  = new HttpRequest(new HttpUri(''));

            $request->header->account = 1;
            $request->setData('code', $line[0]);
            $request->setData('content', \trim($line[19]));
            $request->setData('language', $definitions[19]);
            $module->apiAccountCreate($request, $response);

            $responseData = $response->getData('');
            if (!\is_array($responseData)) {
                continue;
            }

            $account = \is_array($responseData['response'])
                ? $responseData['response']
                : $responseData['response']->toArray();

            $accountId = $account['id'];

            for ($i = 1; $i < $languages; ++$i) {
                $response = new HttpResponse();
                $request  = new HttpRequest(new HttpUri(''));

                $request->header->account = 1;
                $request->setData('ref', $accountId);
                $request->setData('content', \trim($line[19 + $i]));
                $request->setData('language', $definitions[19 + $i]);
                $module->apiAccountL11nCreate($request, $response);
            }
        }

        \fclose($fp);
    }

    /**
     * Import accounts
     *
     * @param ApplicationAbstract $app  Application
     * @param string              $type Personal account type
     *
     * @return void
     *
     * @since 1.0.0
     */
    public static function importPersonalAccounts(ApplicationAbstract $app, string $type) : void
    {
        /** @var \Modules\Accounting\Controller\ApiController $module */
        $module = $app->moduleManager->getModuleInstance('Accounting', 'Api');

        $mapper = $type === 'client'
            ? \Modules\ClientManagement\Models\ClientMapper::class
            : \Modules\SupplierManagement\Models\SupplierMapper::class;

        $accountType = $type === 'client'
            ? AccountType::DEBITOR
            : AccountType::CREDITOR;

        foreach ($mapper::yield()->execute() as $person) {
            $response = new HttpResponse();
            $request  = new HttpRequest(new HttpUri(''));

            // @todo define default account number format for clients, if number -> consider number as starting value
            // @todo define default account number format for suppliers, if number -> consider number as starting value

            $request->header->account = 1;
            $request->setData('code', $person->number);
            $request->setData('content', \rtrim($person->account->name1 . ' ' . $person->account->name2));
            $request->setData('language', ISO639x1Enum::_EN); // @todo personal accounts shouldn't have a translation?!
            $request->setData('type', $accountType);
            $request->setData('account', $person->account->id);
            $module->apiAccountCreate($request, $response);
        }
    }
}

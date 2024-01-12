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

namespace Modules\Accounting\Controller;

use Modules\Accounting\Models\AccountAbstractMapper;
use Modules\Accounting\Models\CostCenterMapper;
use Modules\Accounting\Models\CostObjectMapper;
use Modules\Admin\Models\LocalizationMapper;
use Modules\Admin\Models\SettingsEnum;
use Modules\Auditor\Models\AuditMapper;
use Modules\ClientManagement\Models\Attribute\ClientAttributeTypeMapper;
use Modules\ClientManagement\Models\ClientMapper;
use Modules\Media\Models\MediaMapper;
use Modules\Media\Models\MediaTypeMapper;
use Modules\Organization\Models\Attribute\UnitAttributeMapper;
use Modules\SupplierManagement\Models\SupplierMapper;
use phpOMS\Asset\AssetType;
use phpOMS\Contract\RenderableInterface;
use phpOMS\DataStorage\Database\Query\Builder;
use phpOMS\DataStorage\Database\Query\OrderType;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Utils\StringUtils;
use phpOMS\Views\View;

/**
 * Controller class.
 *
 * @package Modules\Accounting
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 * @codeCoverageIgnore
 */
final class BackendController extends Controller
{
    /**
     * Routing end-point for application behavior.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewEntries(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/Accounting/Theme/Backend/entries');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1000104001, $request, $response);

        return $view;
    }

    /**
     * Routing end-point for application behavior.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewJournalList(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/Accounting/Theme/Backend/journal-list');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1000104001, $request, $response);

        return $view;
    }

    /**
     * Routing end-point for application behavior.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewStackList(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/Accounting/Theme/Backend/stack-list');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1002605001, $request, $response);

        return $view;
    }

    /**
     * Routing end-point for application behavior.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewStackPredefinedList(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/Accounting/Theme/Backend/stack-predefined-list');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1002605001, $request, $response);

        return $view;
    }

    /**
     * Routing end-point for application behavior.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewStackCreate(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/Accounting/Theme/Backend/stack-create');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1002605001, $request, $response);

        return $view;
    }

    /**
     * Routing end-point for application behavior.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewStackEntries(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/Accounting/Theme/Backend/stack-entries');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1002605001, $request, $response);

        return $view;
    }

    /**
     * Routing end-point for application behavior.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewStackArchiveList(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/Accounting/Theme/Backend/stack-archive-list');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1002605001, $request, $response);

        return $view;
    }

    /**
     * Routing end-point for application behavior.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewCOAList(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/Accounting/Theme/Backend/coa-list');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1002604001, $request, $response);

        $view->data['accounts'] = AccountAbstractMapper::getAll()
            ->with('l11n')
            ->where('l11n/language', $response->header->l11n->language)
            ->execute();

        return $view;
    }

    /**
     * Routing end-point for application behavior.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewCOACreate(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/Accounting/Theme/Backend/coa-create');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1002604001, $request, $response);

        return $view;
    }

    /**
     * Routing end-point for application behavior.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewCostCenterProfile(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/Accounting/Theme/Backend/costcenter-profile');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1002604001, $request, $response);

        return $view;
    }

    /**
     * Routing end-point for application behavior.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewCostObjectProfile(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/Accounting/Theme/Backend/costobject-profile');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1002604001, $request, $response);

        return $view;
    }

    /**
     * Routing end-point for application behavior.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewCostCenterList(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/Accounting/Theme/Backend/costcenter-list');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1002602001, $request, $response);

        $mapper = CostCenterMapper::getAll()
            ->with('l11n')
            ->where('l11n/language', $response->header->l11n->language)
            ->limit(25);

        if ($request->getData('ptype') === 'p') {
            $view->data['costcenter'] = $mapper->where('id', $request->getDataInt('id') ?? 0, '<')
                ->execute();
        } elseif ($request->getData('ptype') === 'n') {
            $view->data['costcenter'] = $mapper->where('id', $request->getDataInt('id') ?? 0, '>')
                ->execute();
        } else {
            $view->data['costcenter'] = $mapper->where('id', 0, '>')
                ->execute();
        }

        return $view;
    }

    /**
     * Routing end-point for application behavior.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewCostObjectList(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/Accounting/Theme/Backend/costobject-list');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1002603001, $request, $response);

        $mapper = CostObjectMapper::getAll()
            ->with('l11n')
            ->where('l11n/language', $response->header->l11n->language)
            ->limit(25);

        if ($request->getData('ptype') === 'p') {
            $view->data['costobject'] = $mapper->where('id', $request->getDataInt('id') ?? 0, '<')
                ->execute();
        } elseif ($request->getData('ptype') === 'n') {
            $view->data['costobject'] = $mapper->where('id', $request->getDataInt('id') ?? 0, '>')
                ->execute();
        } else {
            $view->data['costobject'] = $mapper->where('id', 0, '>')
                ->execute();
        }

        return $view;
    }

    /**
     * Routing end-point for application behavior.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewSupplierList(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/Accounting/Theme/Backend/personal-list');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1002604001, $request, $response);

        $accounts = SupplierMapper::getAll()
            ->with('account')
            ->with('mainAddress')
            ->limit(25)
            ->execute();

        $view->data['accounts'] = $accounts;

        return $view;
    }

    /**
     * Routing end-point for application behavior.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewClientList(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/Accounting/Theme/Backend/personal-list');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1002604001, $request, $response);

        $accounts = ClientMapper::getAll()
            ->with('account')
            ->with('mainAddress')
            ->limit(25)
            ->execute();

        $view->data['accounts'] = $accounts;

        return $view;
    }

    /**
     * Routing end-point for application behavior.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewSupplierProfile(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $head  = $response->data['Content']->head;
        $nonce = $this->app->appSettings->getOption('script-nonce');

        $head->addAsset(AssetType::CSS, 'Resources/chartjs/chart.css');
        $head->addAsset(AssetType::JSLATE, 'Resources/chartjs/chart.js', ['nonce' => $nonce]);
        $head->addAsset(AssetType::JSLATE, 'Resources/OpenLayers/OpenLayers.js', ['nonce' => $nonce]);
        $head->addAsset(AssetType::JSLATE, 'Modules/Accounting/Controller.js', ['nonce' => $nonce, 'type' => 'module']);

        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/Accounting/Theme/Backend/personal-profile');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1002604001, $request, $response);

        $account = SupplierMapper::get()
            ->with('account')
            ->with('mainAddress')
            ->where('id', (int) $request->getData('id'))
            ->execute();

        $view->data['account'] = $account;

        $businessStart = UnitAttributeMapper::get()
            ->with('type')
            ->with('value')
            ->where('ref', $this->app->unitId)
            ->where('type/name', 'business_year_start')
            ->execute();

        $view->data['business_start'] = $businessStart->id === 0 ? 1 : $businessStart->value->getValue();

        $view->data['hasBilling'] = $this->app->moduleManager->isActive('Billing');

        /** @var \Model\Setting $settings */
        $settings = $this->app->appSettings->get(null, SettingsEnum::DEFAULT_LOCALIZATION);

        $view->data['attributeView']                              = new \Modules\Attribute\Theme\Backend\Components\AttributeView($this->app->l11nManager, $request, $response);
        $view->data['attributeView']->data['default_localization'] = LocalizationMapper::get()->where('id', (int) $settings->id)->execute();

        /** @var \Modules\Media\Models\Media[] $files */
        $files = MediaMapper::getAll()
            ->with('types')
            ->join('id', ClientMapper::class, 'files') // id = media id, files = client relations
                ->on('id', $account->id, relation: 'files') // id = item id
            ->execute();

        $view->data['files'] = $files;

        $view->data['media-upload'] = new \Modules\Media\Theme\Backend\Components\Upload\BaseView($this->app->l11nManager, $request, $response);
        $view->data['note'] = new \Modules\Editor\Theme\Backend\Components\Note\BaseView($this->app->l11nManager, $request, $response);

        return $view;
    }

    /**
     * Routing end-point for application behavior.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewClientProfile(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $head  = $response->data['Content']->head;
        $nonce = $this->app->appSettings->getOption('script-nonce');

        $head->addAsset(AssetType::CSS, 'Resources/chartjs/chart.css');
        $head->addAsset(AssetType::JSLATE, 'Resources/chartjs/chart.js', ['nonce' => $nonce]);
        $head->addAsset(AssetType::JSLATE, 'Resources/OpenLayers/OpenLayers.js', ['nonce' => $nonce]);
        $head->addAsset(AssetType::JSLATE, 'Modules/Accounting/Controller.js', ['nonce' => $nonce, 'type' => 'module']);

        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/Accounting/Theme/Backend/personal-profile');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1002604001, $request, $response);

        $account = ClientMapper::get()
            ->with('account')
            ->with('contactElements')
            ->with('mainAddress')
            ->with('files')->limit(5, 'files')->sort('files/id', OrderType::DESC)
            ->with('notes')->limit(5, 'notes')->sort('notes/id', OrderType::DESC)
            ->where('id', (int) $request->getData('id'))
            ->execute();

        $view->data['account'] = $account;

        /** @var \Model\Setting $settings */
        $settings = $this->app->appSettings->get(null, SettingsEnum::DEFAULT_LOCALIZATION);

        $view->data['attributeView']                              = new \Modules\Attribute\Theme\Backend\Components\AttributeView($this->app->l11nManager, $request, $response);
        $view->data['attributeView']->data['default_localization'] = LocalizationMapper::get()->where('id', (int) $settings->id)->execute();

        /** @var \Modules\Attribute\Models\AttributeType[] $attributeTypes */
        $attributeTypes = ClientAttributeTypeMapper::getAll()
            ->with('l11n')
            ->where('l11n/language', $response->header->l11n->language)
            ->execute();

        $view->data['attributeTypes'] = $attributeTypes;

        // Get item profile image
        // It might not be part of the 5 newest item files from above
        // @todo It would be nice to have something like this as a default method in the model e.g.
        // ItemManagement::getRelations()->with('types')->where(...);
        // This should return the relations and NOT the model itself
        $query   = new Builder($this->app->dbPool->get());
        $results = $query->selectAs(ClientMapper::HAS_MANY['files']['external'], 'file')
            ->from(ClientMapper::TABLE)
            ->leftJoin(ClientMapper::HAS_MANY['files']['table'])
                ->on(ClientMapper::HAS_MANY['files']['table'] . '.' . ClientMapper::HAS_MANY['files']['self'], '=', ClientMapper::TABLE . '.' . ClientMapper::PRIMARYFIELD)
            ->leftJoin(MediaMapper::TABLE)
                ->on(ClientMapper::HAS_MANY['files']['table'] . '.' . ClientMapper::HAS_MANY['files']['external'], '=', MediaMapper::TABLE . '.' . MediaMapper::PRIMARYFIELD)
             ->leftJoin(MediaMapper::HAS_MANY['types']['table'])
                ->on(MediaMapper::TABLE . '.' . MediaMapper::PRIMARYFIELD, '=', MediaMapper::HAS_MANY['types']['table'] . '.' . MediaMapper::HAS_MANY['types']['self'])
            ->leftJoin(MediaTypeMapper::TABLE)
                ->on(MediaMapper::HAS_MANY['types']['table'] . '.' . MediaMapper::HAS_MANY['types']['external'], '=', MediaTypeMapper::TABLE . '.' . MediaTypeMapper::PRIMARYFIELD)
            ->where(ClientMapper::HAS_MANY['files']['self'], '=', $account->id)
            ->where(MediaTypeMapper::TABLE . '.' . MediaTypeMapper::getColumnByMember('name'), '=', 'client_profile_image');

        $accountImage = MediaMapper::get()
            ->with('types')
            ->where('id', $results)
            ->limit(1)
            ->execute();

        $view->data['accountImage'] = $accountImage;

        $businessStart = UnitAttributeMapper::get()
            ->with('type')
            ->with('value')
            ->where('ref', $this->app->unitId)
            ->where('type/name', 'business_year_start')
            ->execute();

        $view->data['business_start'] = $businessStart->id === 0 ? 1 : $businessStart->value->getValue();

        /** @var \Modules\Auditor\Models\Audit[] $audits */
        $audits = AuditMapper::getAll()
            ->where('type', StringUtils::intHash(ClientMapper::class))
            ->where('module', 'ClientManagement')
            ->where('ref', (string) $account->id)
            ->execute();

        $view->data['audits'] = $audits;

        /** @var \Modules\Media\Models\Media[] $files */
        $files = MediaMapper::getAll()
            ->with('types')
            ->join('id', ClientMapper::class, 'files') // id = media id, files = client relations
                ->on('id', $account->id, relation: 'files') // id = item id
            ->execute();

        $view->data['files'] = $files;

        $view->data['media-upload'] = new \Modules\Media\Theme\Backend\Components\Upload\BaseView($this->app->l11nManager, $request, $response);
        $view->data['note'] = new \Modules\Editor\Theme\Backend\Components\Note\BaseView($this->app->l11nManager, $request, $response);

        $view->data['hasBilling'] = $this->app->moduleManager->isActive('Billing');

        return $view;
    }
}

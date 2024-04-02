<?php
/**
 * Jingga
 *
 * PHP Version 8.2
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
use Modules\Accounting\Models\AccountL11nMapper;
use Modules\Accounting\Models\CostCenterL11nMapper;
use Modules\Accounting\Models\CostCenterMapper;
use Modules\Accounting\Models\CostObjectL11nMapper;
use Modules\Accounting\Models\CostObjectMapper;
use Modules\Accounting\Models\NullAccountAbstract;
use Modules\Accounting\Models\NullCostCenter;
use Modules\Accounting\Models\NullCostObject;
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
            ->where('account', null)
            ->executeGetArray();

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
    public function viewAccountView(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/Accounting/Theme/Backend/coa-view');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1002604001, $request, $response);

        $view->data['account'] = AccountAbstractMapper::get()
            ->with('parent')
            ->with('l11n')
            ->where('id', (int) $request->getData('id'))
            ->where('l11n/language', $response->header->l11n->language)
            ->execute();

        $view->data['l11nView'] = new \Web\Backend\Views\L11nView($this->app->l11nManager, $request, $response);

        /** @var \phpOMS\Localization\BaseStringL11n[] $l11nValues */
        $l11nValues = AccountL11nMapper::getAll()
            ->where('ref', $view->data['account']->id)
            ->executeGetArray();

        $view->data['l11nValues'] = $l11nValues;

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
        $view->setTemplate('/Modules/Accounting/Theme/Backend/coa-view');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1002604001, $request, $response);

        $view->data['account'] = new NullAccountAbstract();

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
    public function viewCostObjectCreate(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/Accounting/Theme/Backend/costobject-view');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1002603001, $request, $response);

        $view->data['costobject'] = new NullCostObject();

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
    public function viewCostCenterCreate(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/Accounting/Theme/Backend/costcenter-view');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1002602001, $request, $response);

        $view->data['costcenter'] = new NullCostCenter();

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
    public function viewCostCenterView(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/Accounting/Theme/Backend/costcenter-view');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1002602001, $request, $response);

        $view->data['costcenter'] = CostCenterMapper::get()
            ->with('parent')
            ->with('l11n')
            ->where('id', (int) $request->getData('id'))
            ->where('l11n/language', $response->header->l11n->language)
            ->execute();

        $view->data['l11nView'] = new \Web\Backend\Views\L11nView($this->app->l11nManager, $request, $response);

        /** @var \phpOMS\Localization\BaseStringL11n[] $l11nValues */
        $l11nValues = CostCenterL11nMapper::getAll()
            ->where('ref', $view->data['costcenter']->id)
            ->executeGetArray();

        $view->data['l11nValues'] = $l11nValues;

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
    public function viewCostObjectView(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/Accounting/Theme/Backend/costobject-view');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1002603001, $request, $response);

        $view->data['costobject'] = CostObjectMapper::get()
            ->with('parent')
            ->with('l11n')
            ->where('id', (int) $request->getData('id'))
            ->where('l11n/language', $response->header->l11n->language)
            ->execute();

        $view->data['l11nView'] = new \Web\Backend\Views\L11nView($this->app->l11nManager, $request, $response);

        /** @var \phpOMS\Localization\BaseStringL11n[] $l11nValues */
        $l11nValues = CostObjectL11nMapper::getAll()
            ->where('ref', $view->data['costobject']->id)
            ->executeGetArray();

        $view->data['l11nValues'] = $l11nValues;

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
            $view->data['costcenter'] = $mapper->where('id', $request->getDataInt('offset') ?? 0, '<')
                ->execute();
        } elseif ($request->getData('ptype') === 'n') {
            $view->data['costcenter'] = $mapper->where('id', $request->getDataInt('offset') ?? 0, '>')
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
            $view->data['costobject'] = $mapper->where('id', $request->getDataInt('offset') ?? 0, '<')
                ->execute();
        } elseif ($request->getData('ptype') === 'n') {
            $view->data['costobject'] = $mapper->where('id', $request->getDataInt('offset') ?? 0, '>')
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
            ->executeGetArray();

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
            ->executeGetArray();

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
    public function viewSupplierView(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $head  = $response->data['Content']->head;
        $nonce = $this->app->appSettings->getOption('script-nonce');

        $head->addAsset(AssetType::CSS, 'Resources/chartjs/chart.css?v=' . $this->app->version);
        $head->addAsset(AssetType::JSLATE, 'Resources/chartjs/chart.js?v=' . $this->app->version, ['nonce' => $nonce]);
        $head->addAsset(AssetType::JSLATE, 'Resources/OpenLayers/OpenLayers.js?v=' . $this->app->version, ['nonce' => $nonce]);
        $head->addAsset(AssetType::JSLATE, 'Modules/Accounting/Controller.js?v=' . self::VERSION, ['nonce' => $nonce, 'type' => 'module']);

        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/Accounting/Theme/Backend/personal-view');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1002604001, $request, $response);

        $view->data['account'] = SupplierMapper::get()
            ->with('account')
            ->with('account/addresses')
            ->with('account/contacts')
            ->with('mainAddress')
            ->with('files')->limit(5, 'files')->sort('files/id', OrderType::DESC)
            ->with('notes')->limit(5, 'notes')->sort('notes/id', OrderType::DESC)
            ->with('attributes')
            ->with('attributes/type')
            ->with('attributes/type/l11n')
            ->with('attributes/value')
            ->where('id', (int) $request->getData('id'))
            ->execute();

        $view->data['fiAccounts'] = AccountAbstractMapper::getAll()
            ->where('account', $view->data['account']->account->id)
            ->executeGetArray();

        $view->data['attributeView']                               = new \Modules\Attribute\Theme\Backend\Components\AttributeView($this->app->l11nManager, $request, $response);
        $view->data['attributeView']->data['default_localization'] = $this->app->l11nServer;

        $view->data['attributeTypes'] = ClientAttributeTypeMapper::getAll()
            ->with('l11n')
            ->where('l11n/language', $response->header->l11n->language)
            ->executeGetArray();

        // Get item profile image
        // @feature Create a new read mapper function that returns relation models instead of its own model
        //      https://github.com/Karaka-Management/phpOMS/issues/320
        $query   = new Builder($this->app->dbPool->get());
        $results = $query->selectAs(SupplierMapper::HAS_MANY['files']['external'], 'file')
            ->from(SupplierMapper::TABLE)
            ->leftJoin(SupplierMapper::HAS_MANY['files']['table'])
                ->on(SupplierMapper::HAS_MANY['files']['table'] . '.' . SupplierMapper::HAS_MANY['files']['self'], '=', SupplierMapper::TABLE . '.' . SupplierMapper::PRIMARYFIELD)
            ->leftJoin(MediaMapper::TABLE)
                ->on(SupplierMapper::HAS_MANY['files']['table'] . '.' . SupplierMapper::HAS_MANY['files']['external'], '=', MediaMapper::TABLE . '.' . MediaMapper::PRIMARYFIELD)
                ->leftJoin(MediaMapper::HAS_MANY['types']['table'])
                ->on(MediaMapper::TABLE . '.' . MediaMapper::PRIMARYFIELD, '=', MediaMapper::HAS_MANY['types']['table'] . '.' . MediaMapper::HAS_MANY['types']['self'])
            ->leftJoin(MediaTypeMapper::TABLE)
                ->on(MediaMapper::HAS_MANY['types']['table'] . '.' . MediaMapper::HAS_MANY['types']['external'], '=', MediaTypeMapper::TABLE . '.' . MediaTypeMapper::PRIMARYFIELD)
            ->where(SupplierMapper::HAS_MANY['files']['self'], '=', $view->data['account']->id)
            ->where(MediaTypeMapper::TABLE . '.' . MediaTypeMapper::getColumnByMember('name'), '=', 'supplier_profile_image');

        $view->data['accountImage'] = MediaMapper::get()
            ->with('types')
            ->where('id', $results)
            ->limit(1)
            ->execute();

        $businessStart = UnitAttributeMapper::get()
            ->with('type')
            ->with('value')
            ->where('ref', $this->app->unitId)
            ->where('type/name', 'business_year_start')
            ->execute();

        $view->data['business_start'] = $businessStart->id === 0 ? 1 : $businessStart->value->getValue();

        $view->data['audits'] = AuditMapper::getAll()
            ->where('type', StringUtils::intHash(ClientMapper::class))
            ->where('module', 'ClientManagement')
            ->where('ref', (string) $view->data['account']->id)
            ->executeGetArray();

        $view->data['files'] = MediaMapper::getAll()
            ->with('types')
            ->join('id', ClientMapper::class, 'files') // id = media id, files = client relations
                ->on('id', $view->data['account']->id, relation: 'files') // id = item id
            ->executeGetArray();

        $view->data['media-upload']      = new \Modules\Media\Theme\Backend\Components\Upload\BaseView($this->app->l11nManager, $request, $response);
        $view->data['note']              = new \Modules\Editor\Theme\Backend\Components\Note\BaseView($this->app->l11nManager, $request, $response);
        $view->data['address-component'] = new \Modules\Admin\Theme\Backend\Components\AddressEditor\AddressView($this->app->l11nManager, $request, $response);
        $view->data['contact-component'] = new \Modules\Admin\Theme\Backend\Components\ContactEditor\ContactView($this->app->l11nManager, $request, $response);

        $view->data['hasBilling'] = $this->app->moduleManager->isActive('Billing');

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
    public function viewClientView(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $head  = $response->data['Content']->head;
        $nonce = $this->app->appSettings->getOption('script-nonce');

        $head->addAsset(AssetType::CSS, 'Resources/chartjs/chart.css?v=' . $this->app->version);
        $head->addAsset(AssetType::JSLATE, 'Resources/chartjs/chart.js?v=' . $this->app->version, ['nonce' => $nonce]);
        $head->addAsset(AssetType::JSLATE, 'Resources/OpenLayers/OpenLayers.js?v=' . $this->app->version, ['nonce' => $nonce]);
        $head->addAsset(AssetType::JSLATE, 'Modules/Accounting/Controller.js?v=' . self::VERSION, ['nonce' => $nonce, 'type' => 'module']);

        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/Accounting/Theme/Backend/personal-view');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1002604001, $request, $response);

        $view->data['account'] = ClientMapper::get()
            ->with('account')
            ->with('account/addresses')
            ->with('account/contacts')
            ->with('mainAddress')
            ->with('files')->limit(5, 'files')->sort('files/id', OrderType::DESC)
            ->with('notes')->limit(5, 'notes')->sort('notes/id', OrderType::DESC)
            ->with('attributes')
            ->with('attributes/type')
            ->with('attributes/type/l11n')
            ->with('attributes/value')
            ->where('id', (int) $request->getData('id'))
            ->execute();

        $view->data['fiAccounts'] = AccountAbstractMapper::getAll()
            ->where('account', $view->data['account']->account->id)
            ->executeGetArray();

        $view->data['attributeView']                               = new \Modules\Attribute\Theme\Backend\Components\AttributeView($this->app->l11nManager, $request, $response);
        $view->data['attributeView']->data['default_localization'] = $this->app->l11nServer;

        $view->data['attributeTypes'] = ClientAttributeTypeMapper::getAll()
            ->with('l11n')
            ->where('l11n/language', $response->header->l11n->language)
            ->executeGetArray();

        // Get item profile image
        // @feature Create a new read mapper function that returns relation models instead of its own model
        //      https://github.com/Karaka-Management/phpOMS/issues/320
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
            ->where(ClientMapper::HAS_MANY['files']['self'], '=', $view->data['account']->id)
            ->where(MediaTypeMapper::TABLE . '.' . MediaTypeMapper::getColumnByMember('name'), '=', 'client_profile_image');

        $view->data['accountImage'] = MediaMapper::get()
            ->with('types')
            ->where('id', $results)
            ->limit(1)
            ->execute();

        $businessStart = UnitAttributeMapper::get()
            ->with('type')
            ->with('value')
            ->where('ref', $this->app->unitId)
            ->where('type/name', 'business_year_start')
            ->execute();

        $view->data['business_start'] = $businessStart->id === 0 ? 1 : $businessStart->value->getValue();

        $view->data['audits'] = AuditMapper::getAll()
            ->where('type', StringUtils::intHash(ClientMapper::class))
            ->where('module', 'ClientManagement')
            ->where('ref', (string) $view->data['account']->id)
            ->executeGetArray();

        $view->data['files'] = MediaMapper::getAll()
            ->with('types')
            ->join('id', ClientMapper::class, 'files') // id = media id, files = client relations
                ->on('id', $view->data['account']->id, relation: 'files') // id = item id
            ->executeGetArray();

        $view->data['media-upload']      = new \Modules\Media\Theme\Backend\Components\Upload\BaseView($this->app->l11nManager, $request, $response);
        $view->data['note']              = new \Modules\Editor\Theme\Backend\Components\Note\BaseView($this->app->l11nManager, $request, $response);
        $view->data['address-component'] = new \Modules\Admin\Theme\Backend\Components\AddressEditor\AddressView($this->app->l11nManager, $request, $response);
        $view->data['contact-component'] = new \Modules\Admin\Theme\Backend\Components\ContactEditor\ContactView($this->app->l11nManager, $request, $response);

        $view->data['hasBilling'] = $this->app->moduleManager->isActive('Billing');

        return $view;
    }
}

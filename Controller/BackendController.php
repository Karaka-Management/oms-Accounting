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
use Modules\ClientManagement\Models\ClientMapper;
use Modules\SupplierManagement\Models\SupplierMapper;
use phpOMS\Contract\RenderableInterface;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
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
    public function viewGLProfile(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/Accounting/Theme/Backend/gl-profile');
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
        $view->setTemplate('/Modules/Accounting/Theme/Backend/gl-profile');
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
    public function viewImpersonalEntries(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/Accounting/Theme/Backend/gl-profile');
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
    public function viewPersonalEntries(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/Accounting/Theme/Backend/gl-profile');
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
            ->execute();

        $view->data['accounts'] = $accounts;

        return $view;
    }
}

<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appdevUrlMatcher
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appdevUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);

        // _wdt
        if (0 === strpos($pathinfo, '/_wdt') && preg_match('#^/_wdt/(?<token>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::toolbarAction',)), array('_route' => '_wdt'));
        }

        if (0 === strpos($pathinfo, '/_profiler')) {
            // _profiler_search
            if ($pathinfo === '/_profiler/search') {
                return array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::searchAction',  '_route' => '_profiler_search',);
            }

            // _profiler_purge
            if ($pathinfo === '/_profiler/purge') {
                return array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::purgeAction',  '_route' => '_profiler_purge',);
            }

            // _profiler_info
            if (0 === strpos($pathinfo, '/_profiler/info') && preg_match('#^/_profiler/info/(?<about>[^/]+)$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::infoAction',)), array('_route' => '_profiler_info'));
            }

            // _profiler_import
            if ($pathinfo === '/_profiler/import') {
                return array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::importAction',  '_route' => '_profiler_import',);
            }

            // _profiler_export
            if (0 === strpos($pathinfo, '/_profiler/export') && preg_match('#^/_profiler/export/(?<token>[^/\\.]+)\\.txt$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::exportAction',)), array('_route' => '_profiler_export'));
            }

            // _profiler_phpinfo
            if ($pathinfo === '/_profiler/phpinfo') {
                return array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::phpinfoAction',  '_route' => '_profiler_phpinfo',);
            }

            // _profiler_search_results
            if (preg_match('#^/_profiler/(?<token>[^/]+)/search/results$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::searchResultsAction',)), array('_route' => '_profiler_search_results'));
            }

            // _profiler
            if (preg_match('#^/_profiler/(?<token>[^/]+)$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::panelAction',)), array('_route' => '_profiler'));
            }

            // _profiler_redirect
            if (rtrim($pathinfo, '/') === '/_profiler') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', '_profiler_redirect');
                }

                return array (  '_controller' => 'Symfony\\Bundle\\FrameworkBundle\\Controller\\RedirectController::redirectAction',  'route' => '_profiler_search_results',  'token' => 'empty',  'ip' => '',  'url' => '',  'method' => '',  'limit' => '10',  '_route' => '_profiler_redirect',);
            }

        }

        if (0 === strpos($pathinfo, '/_configurator')) {
            // _configurator_home
            if (rtrim($pathinfo, '/') === '/_configurator') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', '_configurator_home');
                }

                return array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::checkAction',  '_route' => '_configurator_home',);
            }

            // _configurator_step
            if (0 === strpos($pathinfo, '/_configurator/step') && preg_match('#^/_configurator/step/(?<index>[^/]+)$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::stepAction',)), array('_route' => '_configurator_step'));
            }

            // _configurator_final
            if ($pathinfo === '/_configurator/final') {
                return array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::finalAction',  '_route' => '_configurator_final',);
            }

        }

        if (0 === strpos($pathinfo, '/article')) {
            // article
            if (rtrim($pathinfo, '/') === '/article') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'article');
                }

                return array (  '_controller' => 'Boutique\\GestionStockBundle\\Controller\\ArticleController::indexAction',  '_route' => 'article',);
            }

            // article_show
            if (preg_match('#^/article/(?<id>[^/]+)/show$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Boutique\\GestionStockBundle\\Controller\\ArticleController::showAction',)), array('_route' => 'article_show'));
            }

            // article_new
            if ($pathinfo === '/article/new') {
                return array (  '_controller' => 'Boutique\\GestionStockBundle\\Controller\\ArticleController::newAction',  '_route' => 'article_new',);
            }

            // article_create
            if ($pathinfo === '/article/create') {
                return array (  '_controller' => 'Boutique\\GestionStockBundle\\Controller\\ArticleController::createAction',  '_method' => 'post',  '_route' => 'article_create',);
            }

            // article_edit
            if (preg_match('#^/article/(?<id>[^/]+)/edit$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Boutique\\GestionStockBundle\\Controller\\ArticleController::editAction',)), array('_route' => 'article_edit'));
            }

            // article_update
            if (preg_match('#^/article/(?<id>[^/]+)/update$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Boutique\\GestionStockBundle\\Controller\\ArticleController::updateAction',  '_method' => 'post',)), array('_route' => 'article_update'));
            }

            // article_delete
            if (preg_match('#^/article/(?<id>[^/]+)/delete$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Boutique\\GestionStockBundle\\Controller\\ArticleController::deleteAction',  '_method' => 'post',)), array('_route' => 'article_delete'));
            }

            // article_search
            if ($pathinfo === '/article/search') {
                return array (  '_controller' => 'Boutique\\GestionStockBundle\\Controller\\ArticleController::searchAction',  '_route' => 'article_search',);
            }

        }

        if (0 === strpos($pathinfo, '/stock')) {
            // stock_new
            if ($pathinfo === '/stock/new_stock') {
                return array (  '_controller' => 'Boutique\\GestionStockBundle\\Controller\\StockController::newStockAction',  '_route' => 'stock_new',);
            }

            // stock_add
            if (preg_match('#^/stock/(?<id_article>[^/]+)/add_stock(?:/(?<ajax>[^/]+))?$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Boutique\\GestionStockBundle\\Controller\\StockController::addStockAction',  '_method' => 'post',  'ajax' => false,)), array('_route' => 'stock_add'));
            }

            // stock_create
            if ($pathinfo === '/stock/create_stock') {
                return array (  '_controller' => 'Boutique\\GestionStockBundle\\Controller\\StockController::createStockAction',  '_method' => 'post',  '_route' => 'stock_create',);
            }

        }

        if (0 === strpos($pathinfo, '/facture')) {
            // facture
            if (rtrim($pathinfo, '/') === '/facture') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'facture');
                }

                return array (  '_controller' => 'Boutique\\GestionStockBundle\\Controller\\FacturationController::indexFactureAction',  '_route' => 'facture',);
            }

            // facture_show
            if (preg_match('#^/facture/(?<id>[^/]+)/show(?:/(?<pdf>[^/]+))?$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Boutique\\GestionStockBundle\\Controller\\FacturationController::showFactureAction',  'pdf' => '0',)), array('_route' => 'facture_show'));
            }

            // facture_new
            if ($pathinfo === '/facture/new') {
                return array (  '_controller' => 'Boutique\\GestionStockBundle\\Controller\\FacturationController::newFactureAction',  '_route' => 'facture_new',);
            }

            // facture_edit
            if (preg_match('#^/facture/(?<id>[^/]+)/edit$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Boutique\\GestionStockBundle\\Controller\\FacturationController::editFactureAction',)), array('_route' => 'facture_edit'));
            }

            // facture_delete
            if (preg_match('#^/facture/(?<id>[^/]+)/delete$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Boutique\\GestionStockBundle\\Controller\\FacturationController::deleteFactureAction',)), array('_route' => 'facture_delete'));
            }

            // facture_commit
            if (preg_match('#^/facture/(?<id>[^/]+)/commit$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Boutique\\GestionStockBundle\\Controller\\FacturationController::commitFactureAction',)), array('_route' => 'facture_commit'));
            }

            // facture_article_search
            if (preg_match('#^/facture/(?<id_facture>[^/]+)/articleSearch$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Boutique\\GestionStockBundle\\Controller\\FacturationController::searchArticleAction',)), array('_route' => 'facture_article_search'));
            }

            // facture_client_search
            if (preg_match('#^/facture/(?<id_facture>[^/]+)/clientSearch$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Boutique\\GestionStockBundle\\Controller\\FacturationController::searchClientAction',)), array('_route' => 'facture_client_search'));
            }

            // facture_update_total
            if (preg_match('#^/facture/(?<id_facture>[^/]+)/updateTotal$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Boutique\\GestionStockBundle\\Controller\\FacturationController::updateFactureTotalAction',)), array('_route' => 'facture_update_total'));
            }

            // facturation_article_add
            if (preg_match('#^/facture/(?<id_facture>[^/]+)/article_add/(?<id_article>[^/]+)$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Boutique\\GestionStockBundle\\Controller\\FacturationController::addArticleAction',)), array('_route' => 'facturation_article_add'));
            }

            // facturation_client_add
            if (preg_match('#^/facture/(?<id_facture>[^/]+)/client_add/(?<id_client>[^/]+)$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Boutique\\GestionStockBundle\\Controller\\FacturationController::addClientAction',)), array('_route' => 'facturation_client_add'));
            }

            // facture_article_update_quantite
            if (preg_match('#^/facture/(?<id_fact_article>[^/]+)/update$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Boutique\\GestionStockBundle\\Controller\\FacturationController::updateArticleQuantiteAction',)), array('_route' => 'facture_article_update_quantite'));
            }

            // facture_article_remove
            if (preg_match('#^/facture/(?<id_fact_article>[^/]+)/removeArticle$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Boutique\\GestionStockBundle\\Controller\\FacturationController::removeArticleAction',)), array('_route' => 'facture_article_remove'));
            }

            // facture_client_new
            if (preg_match('#^/facture/(?<id_facture>[^/]+)/newClient$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Boutique\\GestionStockBundle\\Controller\\FacturationController::newClientAction',)), array('_route' => 'facture_client_new'));
            }

        }

        if (0 === strpos($pathinfo, '/client')) {
            // client
            if (rtrim($pathinfo, '/') === '/client') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'client');
                }

                return array (  '_controller' => 'Boutique\\GestionStockBundle\\Controller\\ClientController::indexAction',  '_route' => 'client',);
            }

            // client_show
            if (preg_match('#^/client/(?<id>[^/]+)/show$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Boutique\\GestionStockBundle\\Controller\\ClientController::showAction',)), array('_route' => 'client_show'));
            }

            // client_new
            if ($pathinfo === '/client/new') {
                return array (  '_controller' => 'Boutique\\GestionStockBundle\\Controller\\ClientController::newAction',  '_route' => 'client_new',);
            }

            // client_create
            if ($pathinfo === '/client/create') {
                return array (  '_controller' => 'Boutique\\GestionStockBundle\\Controller\\ClientController::createAction',  '_method' => 'post',  '_route' => 'client_create',);
            }

            // client_edit
            if (preg_match('#^/client/(?<id>[^/]+)/edit$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Boutique\\GestionStockBundle\\Controller\\ClientController::editAction',)), array('_route' => 'client_edit'));
            }

            // client_update
            if (preg_match('#^/client/(?<id>[^/]+)/update$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Boutique\\GestionStockBundle\\Controller\\ClientController::updateAction',  '_method' => 'post',)), array('_route' => 'client_update'));
            }

            // client_delete
            if (preg_match('#^/client/(?<id>[^/]+)/delete$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Boutique\\GestionStockBundle\\Controller\\ClientController::deleteAction',)), array('_route' => 'client_delete'));
            }

        }

        if (0 === strpos($pathinfo, '/fournisseur')) {
            // fournisseur
            if (rtrim($pathinfo, '/') === '/fournisseur') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'fournisseur');
                }

                return array (  '_controller' => 'Boutique\\GestionStockBundle\\Controller\\FournisseurController::indexAction',  '_route' => 'fournisseur',);
            }

            // fournisseur_show
            if (preg_match('#^/fournisseur/(?<id>[^/]+)/show$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Boutique\\GestionStockBundle\\Controller\\FournisseurController::showAction',)), array('_route' => 'fournisseur_show'));
            }

            // fournisseur_new
            if ($pathinfo === '/fournisseur/new') {
                return array (  '_controller' => 'Boutique\\GestionStockBundle\\Controller\\FournisseurController::newAction',  '_route' => 'fournisseur_new',);
            }

            // fournisseur_create
            if ($pathinfo === '/fournisseur/create') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_fournisseur_create;
                }

                return array (  '_controller' => 'Boutique\\GestionStockBundle\\Controller\\FournisseurController::createAction',  '_route' => 'fournisseur_create',);
            }
            not_fournisseur_create:

            // fournisseur_edit
            if (preg_match('#^/fournisseur/(?<id>[^/]+)/edit$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Boutique\\GestionStockBundle\\Controller\\FournisseurController::editAction',)), array('_route' => 'fournisseur_edit'));
            }

            // fournisseur_update
            if (preg_match('#^/fournisseur/(?<id>[^/]+)/update$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_fournisseur_update;
                }

                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Boutique\\GestionStockBundle\\Controller\\FournisseurController::updateAction',)), array('_route' => 'fournisseur_update'));
            }
            not_fournisseur_update:

            // fournisseur_delete
            if (preg_match('#^/fournisseur/(?<id>[^/]+)/delete$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_fournisseur_delete;
                }

                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Boutique\\GestionStockBundle\\Controller\\FournisseurController::deleteAction',)), array('_route' => 'fournisseur_delete'));
            }
            not_fournisseur_delete:

        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}

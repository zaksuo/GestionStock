<?php

namespace Boutique\GestionStockBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Home controller.
 *
 */
class HomeController extends Controller
{
    /**
     * Lists all Article entities.
     *
     */
    public function indexAction()
    {
        return $this->render('BoutiqueGestionStockBundle:Home:index.html.twig');
    }
    
    public function rechercheGeneraleAction( Request $request ) {
        $em = $this->getDoctrine()->getManager();
        
        $search = $request->get('general_search');
        
        $clients = $em->getRepository('BoutiqueDatabaseBundle:Client')->getClientsForSearch( $search, 0, 15 );
        $articles = $em->getRepository('BoutiqueDatabaseBundle:Article')->getArticlesForSearch( $search, 0, 15 );
        $fournisseurs = $em->getRepository('BoutiqueDatabaseBundle:Fournisseur')->getFournisseursForSearch( $search, 0, 15 );
        
        return $this->render('BoutiqueGestionStockBundle:Home:search.html.twig', 
                array( 
                    'search' => $search,
                    'clients' => $clients,
                    'fournisseurs' => $fournisseurs,
                    'articles' => $articles
                    )
        );
    }
}
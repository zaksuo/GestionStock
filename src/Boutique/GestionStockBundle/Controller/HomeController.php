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
}
<?php

namespace Boutique\GestionStockBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('BoutiqueGestionStockBundle:Default:index.html.twig', array('name' => $name));
    }
}

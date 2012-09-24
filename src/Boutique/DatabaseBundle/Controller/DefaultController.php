<?php

namespace Boutique\DatabaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('BoutiqueDatabaseBundle:Default:index.html.twig', array('name' => $name));
    }
}

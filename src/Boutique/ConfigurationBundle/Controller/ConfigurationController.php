<?php

namespace Boutique\ConfigurationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ConfigurationController extends Controller
{
    public function indexAction()
    {
        return $this->render('BoutiqueConfigurationBundle:Default:index.html.twig');
    }
}

<?php

namespace Boutique\GestionStockBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Boutique\DatabaseBundle\Entity\Facture;
use Boutique\DatabaseBundle\Form\FactureType;


/**
 * Facture controller.
 *
 */
class FactureController extends Controller
{
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        
        $factures = $em->getRepository('BoutiqueDatabaseBundle:Facture')->findAll(array('orderBy' => 'date'));
        
        return $this->render('BoutiqueGestionStockBundle:Facture:index.html.twig', array(
            'factures' => $factures,
        ));
    }
    
    public function showAction( $id ) {
        $em = $this->getDoctrine()->getManager();
        
        $facture = $em->getRepository('BoutiqueDatabaseBundle:Facture')->find($id);
        
        return $this->render('BoutiqueGestionStockBundle:Facture:index.html.twig', array(
            'facture' => $facture,
        ));
    }
    
    public function newAction() {
       
    }
}
?>

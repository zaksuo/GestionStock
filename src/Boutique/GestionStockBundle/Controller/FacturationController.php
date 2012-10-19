<?php

namespace Boutique\GestionStockBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Boutique\DatabaseBundle\Entity\Facture;
use Boutique\DatabaseBundle\Entity\FactureArticle;
use Boutique\DatabaseBundle\Form\FactureArticleType;


/**
 * Facture controller.
 *
 */
class FacturationController extends Controller
{
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        
        $factures = $em->getRepository('BoutiqueDatabaseBundle:Facture')->findAll(array('orderBy' => 'date'));
        
        return $this->render('BoutiqueGestionStockBundle:Facture:index.html.twig', array(
            'factures' => $factures,
        ));
    }
    
    public function newAction() {
        $em = $this->getDoctrine()->getManager();
        
        $facture = new Facture();
        $facture->init();
        
        $em->persist($facture);
        $em->flush();
        
        return $this->render('BoutiqueGestionStockBundle:Facture:new.html.twig', array(
            'facture' => $facture
        ));
    }
    
    public function showAction( $id ) {
        $em = $this->getDoctrine()->getManager();
        
        $facture = $em->getRepository('BoutiqueDatabaseBundle:Facture')->find($id);
        
        return $this->render('BoutiqueGestionStockBundle:Facture:index.html.twig', array(
            'facture' => $facture,
        ));
    }
    
    public function searchArticleAction(Request $request) {
        $search = $request->get('search_article');
  
        if( !is_null($search) ) {
            $em = $this->getDoctrine()->getManager();
            
            $articles = $em->getRepository('BoutiqueDatabaseBundle:Article')->getArticlesForSearch($search);
        }
        
        return $this->render('BoutiqueGestionStockBundle:Ajax_Article:article_facturation.html.twig', array(
            'articles' => $articles
        ));
    }
    
    public function addArticleAction($id_facture, $id_article) {
        $em = $this->getDoctrine()->getManager();
        
        $facture = $em->getRepository('BoutiqueDatabaseBundle:Facture')->find($id_facture);
        $article = $em->getRepository('BoutiqueDatabaseBundle:Article')->find($id_article);
        
        $fact_article = new FactureArticle();
        $fact_article->setFacture($facture);
        $fact_article->setArticle($article);
        $fact_article->setPrixUnitaire($article->getPrixVente());
        
        $form   = $this->createForm(new FactureArticleType(), $fact_article);
        
        return $this->render('BoutiqueGestionStockBundle:Ajax_Article:article_quantite_form.html.twig', array(
            'article' => $article,
            'form' => $form->createView()
        ));
    }
    
    
}

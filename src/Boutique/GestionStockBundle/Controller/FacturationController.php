<?php

namespace Boutique\GestionStockBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Boutique\DatabaseBundle\Entity\Facture;
use Boutique\DatabaseBundle\Entity\FactureArticle;
use Boutique\DatabaseBundle\Form\FactureArticleType;
use Boutique\DatabaseBundle\Entity\Client;
use Boutique\DatabaseBundle\Form\ClientType;


/**
 * Facture controller.
 *
 */
class FacturationController extends Controller
{
    public function indexFactureAction() {
        $em = $this->getDoctrine()->getManager();
        
        $factures = $em->getRepository('BoutiqueDatabaseBundle:Facture')->findAll(array('orderBy' => 'date'));
        
        return $this->render('BoutiqueGestionStockBundle:Facture:index.html.twig', array(
            'factures' => $factures,
        ));
    }
    
    public function newFactureAction() {
        $em = $this->getDoctrine()->getManager();
        
        $facture = new Facture();
        $facture->init();
        
        $em->persist($facture);
        $em->flush();
        
        $client = new Client();
        $client_form = $this->createForm(new ClientType(), $client);
        
        return $this->render('BoutiqueGestionStockBundle:Facture:edit.html.twig', array(
            'facture' => $facture,
            'client_form' => $client_form->createView()
        ));
    }
    
    public function showFactureAction( $id, $pdf = 0 ) {
        $em = $this->getDoctrine()->getManager();
        
        $facture = $em->getRepository('BoutiqueDatabaseBundle:Facture')->find($id);
        
        if( $pdf ) {
            $html = $this->renderView('BoutiqueGestionStockBundle:Facture:pdf.html.twig', array('facture' => $facture));
            $pdfGenerator = $this->get('spraed.pdf.generator');
            
            return new Response($pdfGenerator->generatePDF($html),
                200,
                array('Content-Type' => 'application/pdf', 'Content-Disposition' => 'inline; filename="facture'.$id.'.pdf"' )
            );
        }
            
        return $this->render('BoutiqueGestionStockBundle:Facture:show.html.twig', array(
            'facture' => $facture,
        ));
    }
    
    public function editFactureAction( $id ) {
        $em = $this->getDoctrine()->getManager();
        
        $facture = $em->getRepository('BoutiqueDatabaseBundle:Facture')->find($id);
        
        $client = new Client();
        $client_form = $this->createForm(new ClientType(), $client);
                
        return $this->render('BoutiqueGestionStockBundle:Facture:edit.html.twig', array(
            'facture' => $facture,
            'errors' => array(),
            'client_form' => $client_form->createView()
        ));
    }
    
    public function deleteFactureAction($id) {
        $em = $this->getDoctrine()->getManager();
        
        $facture = $em->getRepository('BoutiqueDatabaseBundle:Facture')->find($id);
        
        if( $facture->hasFactArticles() ) {
            foreach( $facture->getFactArticles() as $article ) {
                $em->remove($article);
            }
        }
        
        if( $facture->hasFactRemises() ) {
            foreach( $facture->getFactRemises() as $remise ) {
                $em->remove($remise);
            }
        }
        
        $em->remove($facture);
        $em->flush();
        
        $factures = $em->getRepository('BoutiqueDatabaseBundle:Facture')->findAll(array('orderBy' => 'date'));
        
        return $this->render('BoutiqueGestionStockBundle:Facture:index.html.twig', array(
            'factures' => $factures,
        ));
    }
    
    public function commitFactureAction( $id ) {
        $em = $this->getDoctrine()->getManager();
        
        $facture = $em->getRepository('BoutiqueDatabaseBundle:Facture')->find($id);
        
        $facture->setMontantFactureHT( $facture->getPrixTotalHt());
        $facture->setMontantFactureTTC( $facture->getPrixTotalHt() + $facture->getPrixTotalTtc());
        
        foreach($facture->getFactArticles() as $fact_article) {
            $article_stock = $fact_article->getArticle()->getArticleStock();
            if( $article_stock->getQuantite() - $fact_article->getQuantite() < 0 ) {
                
            }
            else {
                $article_stock->setQuantite( $article_stock->getQuantite() - $fact_article->getQuantite());
                $em->persist($article_stock);
            }
        }
        
        $facture->setValide(true);
        $em->flush();
        
        return $this->render('BoutiqueGestionStockBundle:Facture:show.html.twig', array(
            'facture' => $facture,
        ));
    }
    
    public function updateFactureTotalAction($id_facture) {
        $em = $this->getDoctrine()->getManager();
        
        $facture = $em->getRepository('BoutiqueDatabaseBundle:Facture')->find($id_facture);
       
        return $this->render('BoutiqueGestionStockBundle:Ajax_Facture:facture_total.html.twig', array(
            'facture' => $facture
        ));
    }
    
    public function searchArticleAction(Request $request, $id_facture) {
        $em = $this->getDoctrine()->getManager();
        $search = $request->get('search_facture_article');
  
        $facture = $em->getRepository('BoutiqueDatabaseBundle:Facture')->find($id_facture);
        $articles = $em->getRepository('BoutiqueDatabaseBundle:Article')->getArticlesForSearch($search);
        
        return $this->render('BoutiqueGestionStockBundle:Ajax_Article:article_facturation.html.twig', array(
            'facture' => $facture,
            'articles' => $articles
        ));
    }
    
    public function searchClientAction(Request $request, $id_facture) {
        $em = $this->getDoctrine()->getManager();
        $search = $request->get('search_facture_client');
  
        $facture = $em->getRepository('BoutiqueDatabaseBundle:Facture')->find($id_facture);
        $clients = $em->getRepository('BoutiqueDatabaseBundle:Client')->getClientsForSearch($search);
        
        return $this->render('BoutiqueGestionStockBundle:Ajax_Client:client_facturation.html.twig', array(
            'facture' => $facture,
            'clients' => $clients
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
        $fact_article->setQuantite(1);
        
        $em->persist($fact_article);
        $em->flush();
        
        return $this->render('BoutiqueGestionStockBundle:Ajax_Facture:article_quantite_form.html.twig', array(
            'article' => $article,
            'fact_article' => $fact_article
        ));
    }
    
    public function addClientAction($id_facture, $id_client) {
        $em = $this->getDoctrine()->getManager();
        
        $facture = $em->getRepository('BoutiqueDatabaseBundle:Facture')->find($id_facture);
        $client = $em->getRepository('BoutiqueDatabaseBundle:Client')->find($id_client);
        
        $facture->setClient($client);
        $em->persist($facture);
        $em->flush();
        
        return $this->render('BoutiqueGestionStockBundle:Ajax_Client:facture_client_show.html.twig', array(
            'facture' => $facture
        ));
    }
    
    public function newClientAction(Request $request, $id_facture) {
        $em = $this->getDoctrine()->getManager();
        
        $facture = $em->getRepository('BoutiqueDatabaseBundle:Facture')->find($id_facture);
        
        $client  = new Client();
        $form = $this->createForm(new ClientType(), $client);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $client->setDateCreation(new \DateTime('now'));
            $em->persist($client);
            
            $facture->setClient($client);
            $em->persist($facture);
        
            $em->flush();

            return $this->render('BoutiqueGestionStockBundle:Ajax_Client:facture_client_show.html.twig', array(
                'facture' => $facture
            ));
        }
        
        return $this->render('BoutiqueGestionStockBundle:Ajax_Client:new.html.twig', array(
            'client' => $client
        ));
    }
    
    public function updateArticleQuantiteAction(Request $request, $id_fact_article) {
        $em = $this->getDoctrine()->getManager();
        
        $quantite = $request->get('quantite');
        $fact_article = $em->getRepository('BoutiqueDatabaseBundle:FactureArticle')->find($id_fact_article);
        
        $fact_article->setQuantite($quantite);
        $em->persist($fact_article);
        $em->flush();
        
        return $this->render('BoutiqueGestionStockBundle:Ajax_Facture:article_quantite_form.html.twig', array(
            'fact_article' => $fact_article
        ));
    }
   
    public function removeArticleAction(Request $request, $id_fact_article) {
        $em = $this->getDoctrine()->getManager();
        
        $fact_article = $em->getRepository('BoutiqueDatabaseBundle:FactureArticle')->find($id_fact_article);
        
        $em->remove($fact_article);
        $em->flush();
        
        return new Response('', 200, array('Content-Type' => 'text/html'));
    }
}

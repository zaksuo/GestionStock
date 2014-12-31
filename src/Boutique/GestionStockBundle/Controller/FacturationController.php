<?php

namespace Boutique\GestionStockBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Boutique\DatabaseBundle\Entity\Facture;
use Boutique\DatabaseBundle\Entity\FactureFilter;
use Boutique\DatabaseBundle\Form\FactureFilterType;
use Boutique\DatabaseBundle\Entity\FactureArticle;
use Boutique\DatabaseBundle\Form\FactureArticleType;
use Boutique\DatabaseBundle\Entity\FactureRemiseArticle;
use Boutique\DatabaseBundle\Entity\Client;
use Boutique\DatabaseBundle\Form\ClientType;


/**
 * Facture controller.
 *
 */
class FacturationController extends Controller
{
    public function indexFactureAction(Request $request, $year = null, $month = null) {
        $em = $this->getDoctrine()->getManager();
        
        $factureFilter = new FactureFilter();
       
        if( $request->getMethod() == 'POST' ) {
            $formFilter = $this->createForm(new FactureFilterType(), $factureFilter);
            $formFilter->bind($request);
        }
        else {
            $factureFilter->setYear($year);
            $factureFilter->setMonth($month);
            $formFilter = $this->createForm(new FactureFilterType(), $factureFilter);
        }
        
        $query = $em->getRepository('BoutiqueDatabaseBundle:Facture')->getFacturesFilter( $factureFilter->getYear(), $factureFilter->getMonth() );
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $this->get('request')->query->get('page', 1)/*page number*/,
            30 /*limit per page*/
        );
       
        $pagination->setParam('year', $factureFilter->getYear());
        $pagination->setParam('month', $factureFilter->getMonth());
            
        return $this->render('BoutiqueGestionStockBundle:Facture:index.html.twig', 
                array('pagination' => $pagination, 'form' => $formFilter->createView())
        );
    }
    
    public function newFactureAction() {
        $em = $this->getDoctrine()->getManager();
        
        $facture = new Facture();
        $facture->init();
        
        $em->persist($facture);
        $em->flush();
        
        return $this->redirect($this->generateUrl('facture_edit', array('id' => $facture->getId())));
    }
    
    public function showFactureAction( $id, $type = null ) {
        $em = $this->getDoctrine()->getManager();
        
        $facture = $em->getRepository('BoutiqueDatabaseBundle:Facture')->find($id);
        
        switch( $type ) {
            case 'pdf':
                $html = $this->renderView('BoutiqueGestionStockBundle:Facture:pdfFacture.html.twig', array('facture' => $facture));
                $pdfGenerator = $this->get('spraed.pdf.generator');

                return new Response($pdfGenerator->generatePDF($html),
                    200,
                    array('Content-Type' => 'application/pdf', 'Content-Disposition' => 'inline; filename="facture'.$id.'.pdf"' )
                );
            break;
        
            case 'ticket':
                return $this->render('BoutiqueGestionStockBundle:Facture:ticket.html.twig', array(
                    'ticket' => $facture->generateTicket(),
                ));
            break;
        
            default:
                return $this->render('BoutiqueGestionStockBundle:Facture:show.html.twig', array(
                    'facture' => $facture,
                ));
            break;
        }
            
        return $this->render('BoutiqueGestionStockBundle:Facture:show.html.twig', array(
            'facture' => $facture,
        ));
    }

    /* @TODO récupération des campagnes de remises */
    public function editFactureAction( $id ) {
        $em = $this->getDoctrine()->getManager();
        
        $facture = $em->getRepository('BoutiqueDatabaseBundle:Facture')->find($id);
        
        $client = new Client();
        $client_form = $this->createForm(new ClientType(), $client);
        $remises_factures = $em->getRepository('BoutiqueDatabaseBundle:CampagneRemise')->getFactureRemisesActives();

        return $this->render('BoutiqueGestionStockBundle:Facture:edit.html.twig', array(
            'facture' => $facture,
            'remises_facture' => $remises_factures,
            'errors' => array(),
            'form' => $client_form->createView()
        ));
    }
    
    public function deleteFactureAction($id) {
        $em = $this->getDoctrine()->getManager();
        
        $facture = $em->getRepository('BoutiqueDatabaseBundle:Facture')->find($id);
        
        if( $facture->hasFactArticles() ) {
            foreach( $facture->getFactArticles() as $article ) {
                foreach( $article->getFactureRemiseArticles() as $remise ) {
                    $em->remove($remise);
                }
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
        
        return $this->redirect($this->generateUrl('facture'));
    }
    
    public function commitFactureAction( $id ) {
        $em = $this->getDoctrine()->getManager();
        
        $facture = $em->getRepository('BoutiqueDatabaseBundle:Facture')->find($id);
        
        $this->updateTotalFacture($facture->getId());
        
        foreach($facture->getFactArticles() as $fact_article) {
            $article_stock = $fact_article->getArticle()->getArticleStock();
            if( $article_stock->getQuantite() - $fact_article->getQuantite() < 0 ) {
                
            }
            else {
                $article_stock->setQuantite( $article_stock->getQuantite() - $fact_article->getQuantite());
                $em->persist($article_stock);
            }
        }
        
        $facture->setValide( true );
        $facture->setDateValidation(new \DateTime('now'));
        $em->persist($facture);
        $em->flush();
        
        return $this->render('BoutiqueGestionStockBundle:Facture:show.html.twig', array(
            'facture' => $facture,
        ));
    }
    
    public function rollbackFactureAction( $id ) {
        $em = $this->getDoctrine()->getManager();
        
        $facture = $em->getRepository('BoutiqueDatabaseBundle:Facture')->find($id);
        
        foreach($facture->getFactArticles() as $fact_article) {
            $article_stock = $fact_article->getArticle()->getArticleStock();
            $article_stock->setQuantite( $article_stock->getQuantite() + $fact_article->getQuantite() );
            $em->persist($article_stock);
        }
        $facture->setValide( false );
        $facture->setDateValidation(null);
        $em->persist($facture);
        $em->flush();
        
        return $this->redirect($this->generateUrl('facture_edit', array('id' => $facture->getId())));
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
        $articles = $em->getRepository('BoutiqueDatabaseBundle:Article')->getArticlesForSearch($search, 0, 15);
        
        return $this->render('BoutiqueGestionStockBundle:Ajax_Article:article_facturation.html.twig', array(
            'facture' => $facture,
            'articles' => $articles
        ));
    }
    
    public function searchClientAction(Request $request, $id_facture) {
        $em = $this->getDoctrine()->getManager();
        $search = $request->get('search_facture_client');
  
        $facture = $em->getRepository('BoutiqueDatabaseBundle:Facture')->find($id_facture);
        $clients = $em->getRepository('BoutiqueDatabaseBundle:Client')->getClientsForSearch($search, 0, 15);
        
        return $this->render('BoutiqueGestionStockBundle:Ajax_Client:client_facturation.html.twig', array(
            'facture' => $facture,
            'clients' => $clients
        ));
    }
    
    public function addArticleAction($id_facture, $id_article) {
        $em = $this->getDoctrine()->getManager();
        
        $remises_article = null;
        $facture = $em->getRepository('BoutiqueDatabaseBundle:Facture')->find($id_facture);
        $article = $em->getRepository('BoutiqueDatabaseBundle:Article')->find($id_article);
        
        $ratio = ( $article->getTypeTva()->getValeur() / 100 );
        
        $fact_article = new FactureArticle();
        $fact_article->setFacture($facture);
        $fact_article->setArticle($article);
        $fact_article->setPrixUnitaire($article->getPrixVente()); // correspond au prix de vente TTC
        $fact_article->setTvaUnitaire( $article->getPrixVente() - $article->getPrixHT() );
        $fact_article->setQuantite(1);
        $em->persist($fact_article);
        
        $em->persist($facture);
        
        $remises_article = $em->getRepository('BoutiqueDatabaseBundle:CampagneArticle')->findBy(array('article' => $id_article));
        $now_date = new \DateTime('now');
        
        if( !is_null($remises_article) ) {
            foreach( $remises_article as $remise ) {
                if( $remise->getCampagneRemise()->getActive() && $now_date >= $remise->getCampagneRemise()->getDateDebut() && $now_date <= $remise->getCampagneRemise()->getDateFin() ) {
                    $fact_rem_art = new FactureRemiseArticle();
                    $fact_rem_art->setCampagneArticle($remise);
                    $fact_rem_art->setFactureArticle($fact_article);

                    $type_remise = $remise->getCampagneRemise()->getRemise()->getTypeRemise()->getLibelle();
                    switch($type_remise) {
                        case "Euros" :
                            $valeur = $remise->getCampagneRemise()->getRemise()->getValue(); 
                        break;
                        case "Pourcents" :
                            $valeur = $remise->getCampagneRemise()->getRemise()->getValue() * $fact_article->getPrixUnitaire() / 100;
                        break;
                    }
                    $fact_rem_art->setValeur(round($valeur, 2));
                    $em->persist($fact_rem_art);
                }
            }
        }
        
        $em->flush();
        $em->refresh($fact_article);
        
        $this->updateTotalFacture($id_facture);
        
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
        
        foreach( $fact_article->getFactureRemiseArticles() as $remise ) {
            $type_remise = $remise->getCampagneArticle()->getCampagneRemise()->getRemise()->getTypeRemise()->getLibelle();
            switch($type_remise) {
                case "Euros" :
                    $valeur = $remise->getCampagneArticle()->getCampagneRemise()->getRemise()->getValue() * $fact_article->getQuantite(); 
                break;
                case "Pourcents" :
                    $valeur = $remise->getCampagneArticle()->getCampagneRemise()->getRemise()->getValue() * $fact_article->getPrixUnitaire() / 100 * $fact_article->getQuantite();
                break;
            }
            $remise->setValeur(round($valeur, 2));
            $em->persist($remise);
            $em->flush();
        }
        
        $this->updateTotalFacture($fact_article->getFacture()->getId());
        
        return $this->render('BoutiqueGestionStockBundle:Ajax_Facture:article_quantite_form.html.twig', array(
            'fact_article' => $fact_article
        ));
    }
   
    public function removeArticleAction(Request $request, $id_fact_article) {
        $em = $this->getDoctrine()->getManager();
        
        $fact_article = $em->getRepository('BoutiqueDatabaseBundle:FactureArticle')->find($id_fact_article);
        $facture = $fact_article->getFacture();

        $facture_remise_articles = $em->getRepository('BoutiqueDatabaseBundle:FactureRemiseArticle')->findBy(array('factureArticle' => $id_fact_article));
        
        foreach($facture_remise_articles as $fact_rem_art) {
            $em->remove($fact_rem_art);
        }
        $em->remove($fact_article);
        $em->flush();
        
        $this->updateTotalFacture($facture->getId());
        
        return $this->redirect($this->generateUrl('facture_edit', array('id' => $facture->getId())));
    }
    
    public function removeFactRemiseArticleAction($facture, $id_fact_rem_article) {
        $em = $this->getDoctrine()->getManager();
        
        $facture_remise_article = $em->getRepository('BoutiqueDatabaseBundle:FactureRemiseArticle')->find($id_fact_rem_article);
        $facture = $em->getRepository('BoutiqueDatabaseBundle:Facture')->find($facture);
        
        $em->remove($facture_remise_article);
        $em->flush();
        
        $this->updateTotalFacture($facture->getId());
        
        return $this->redirect($this->generateUrl('facture_edit', array('id' => $facture->getId())));
    }
    
    public function updateTotalFacture($id_facture) {
        $em = $this->getDoctrine()->getManager();
        
        $facture = $em->getRepository('BoutiqueDatabaseBundle:Facture')->find($id_facture);
        
        $facture->setMontantFactureHT( $facture->getPrixTotalHT() );
        $facture->setMontantFactureTTC( $facture->getPrixTotalTTC() );
        $facture->setMontantRemise( $facture->getTotalRemises() );
        $facture->setMontantAPayer( $facture->getPrixTotalTTC() - $facture->getTotalRemises() );
        
        $em->persist($facture);
        $em->flush();
    }
}

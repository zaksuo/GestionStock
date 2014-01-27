<?php

namespace Boutique\GestionStockBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Boutique\DatabaseBundle\Entity\Inventaire;
use Boutique\DatabaseBundle\Entity\InventaireArticle;
use Boutique\DatabaseBundle\Entity\InventaireDivers;

use Boutique\DatabaseBundle\Form\InventaireDiversType;
use Boutique\DatabaseBundle\Entity\Stock;

/**
 * Home controller.
 *
 */
class InventaireController extends Controller
{
    /**
     * Lists all Article entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $dql = "SELECT i FROM BoutiqueDatabaseBundle:Inventaire i ORDER BY i.id DESC";
        $query = $em->createQuery($dql);
        
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $this->get('request')->query->get('page', 1)/*page number*/,
            30 /*limit per page*/
        );
        
        return $this->render('BoutiqueGestionStockBundle:Inventaire:index.html.twig', compact('pagination'));
    }
    
    public function newAction() {
        $em = $this->getDoctrine()->getManager();
        
        $inventaire = new \Boutique\DatabaseBundle\Entity\Inventaire();
        $inventaire->setAnnee(date('Y'));
        $inventaire->setDateCreation(new \DateTime('now'));
        $inventaire->setCloture(false);
        $em->persist($inventaire);
        
        $articles = $em->getRepository('BoutiqueDatabaseBundle:Article')->getArticlesForInventaire();
        foreach( $articles as $article ) {
            $inv_article = new InventaireArticle();
            $inv_article->setArticle($article);
            $inv_article->setInventaire($inventaire);
            $inv_article->setPrixVente($article->getPrixHT());
            $inv_article->setPrixAchat($article->getPrixAchatMoyenHT());
            $inv_article->setQuantiteEstim($article->getArticleStock()->getQuantite());
            
            $em->persist($inv_article);
        }
        
        $em->flush();
        
        return $this->redirect($this->generateUrl('inventaire_edit', array('id' => $inventaire->getId())));
    }
    
    public function deleteAction( $id ) {
        $em = $this->getDoctrine()->getManager();
        
        $inventaire = $em->getRepository('BoutiqueDatabaseBundle:Inventaire')->find($id);
        $inv_articles = $inventaire->getInvArticles(); 
        $inv_divers = $inventaire->getInvDivers();
        foreach( $inv_articles as $article ) {
            $em->remove($article);
        }
        foreach( $inv_divers as $divers ) {
            $em->remove($divers);
        }
        $em->remove($inventaire);
        $em->flush();
        
        return $this->redirect($this->generateUrl('inventaire'));
    }
    
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();
        
        $inventaire = $em->getRepository('BoutiqueDatabaseBundle:Inventaire')->find($id);
        
        $dql = "SELECT ia FROM BoutiqueDatabaseBundle:InventaireArticle ia WHERE ia.inventaire = ".$inventaire->getId();
        $query = $em->createQuery($dql);
        
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $this->get('request')->query->get('page', 1)/*page number*/,
            50 /*limit per page*/
        );
        
        return $this->render('BoutiqueGestionStockBundle:Inventaire:show.html.twig', array('inventaire' => $inventaire, 'pagination' => $pagination));
    }
    
    public function editAction( $id ) {
        $em = $this->getDoctrine()->getManager();
        
        $inventaire = $em->getRepository('BoutiqueDatabaseBundle:Inventaire')->find($id);
        
        $dql = "SELECT ia FROM BoutiqueDatabaseBundle:InventaireArticle ia WHERE ia.inventaire = ".$inventaire->getId();
        $query = $em->createQuery($dql);
        
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $this->get('request')->query->get('page', 1)/*page number*/,
            50 /*limit per page*/
        );
        
        $divers = new InventaireDivers();
        $divers->setInventaire($inventaire);
        $form_divers = $this->createForm(new InventaireDiversType(), $divers);
        
        return $this->render('BoutiqueGestionStockBundle:Inventaire:edit.html.twig', 
                array('form_divers' => $form_divers->createView(), 'inventaire' => $inventaire, 'pagination' => $pagination)
        );
    }
    
    public function printFormAction( $id ) {
        $em = $this->getDoctrine()->getManager();
        
        $inventaire = $em->getRepository('BoutiqueDatabaseBundle:Inventaire')->find($id);
        
         $html = $this->renderView('BoutiqueGestionStockBundle:Inventaire:pdfForm.html.twig', array('inventaire' => $inventaire));
         $pdfGenerator = $this->get('spraed.pdf.generator');

         return new Response($pdfGenerator->generatePDF($html),
             200,
             array('Content-Type' => 'application/pdf', 'Content-Disposition' => 'inline; filename="inventaire'.$id.'.pdf"' )
         );
    }
    
    public function updateQuantiteAction( Request $request, $id ) {
        $em = $this->getDoctrine()->getManager();

        $quantite = $request->get('quantite');
        $inv_article = $em->getRepository('BoutiqueDatabaseBundle:InventaireArticle')->find($id);
        
        $inv_article->setQuantiteReelle($quantite);
        $em->persist($inv_article);
        $em->flush();
        
        return $this->render('BoutiqueGestionStockBundle:Inventaire:_form.html.twig', array(
            'inv_article' => $inv_article
        ));
    }
    
    public function cloreAction( $id ) {
        $em = $this->getDoctrine()->getManager();
        $inventaire = $em->getRepository('BoutiqueDatabaseBundle:Inventaire')->find($id);
        
        $valeurAchat = 0;
        $valeurVente = 0;
        $valeurPerteAchat = 0;
        $valeurPerteVente = 0;
        
        foreach( $inventaire->getInvArticles() as $invArticle ) {
            $valeurAchat += $invArticle->getValeurAchat();
            $valeurVente += $invArticle->getValeurVente();
            $valeurPerteAchat += $invArticle->getPerteAchat();
            $valeurPerteVente += $invArticle->getPerteVente();
            
            if( $invArticle->hasError() ) {
                $article = $invArticle->getArticle();
                $stock_article = $article->getArticleStock();
                $quantite = $invArticle->getError();
                
                $new_stock = new Stock();
                $new_stock->setIdArticle($article);
                $new_stock->setDateEntree(new \DateTime('now'));
                $new_stock->setQuantite($quantite);
                $new_stock->setPrixAchat($invArticle->getPrixAchat());
                $new_stock->setDelottage(false);
                $new_stock->setCommentaire("Régularisation du stock après inventaire");
                $em->persist($new_stock);
                
                $stock_article->setQuantite( $stock_article->getQuantite() + $quantite );
                $em->persist($stock_article);
            }
        }

        foreach( $inventaire->getInvDivers() as $divers ) {
            $valeurAchat += $divers->getValeur();
        }
        
        $inventaire->setValeurAchat( $valeurAchat );
        $inventaire->setValeurVente( $valeurVente );
        $inventaire->setValeurPerteAchat( $valeurPerteAchat );
        $inventaire->setValeurPerteVente( $valeurPerteVente );
        $inventaire->setCloture( true );
        $inventaire->setDateCloture( new \DateTime('now') );
        
        $em->persist($inventaire);
        $em->flush();
        
        return $this->redirect($this->generateUrl('inventaire_show', array('id' => $id)));
    }
    
    public function printInventaireAction( $id ) {
        $em = $this->getDoctrine()->getManager();
        
        $data = array();
        $inventaire = $em->getRepository('BoutiqueDatabaseBundle:Inventaire')->find($id);
        $fournisseurs = $em->getRepository('BoutiqueDatabaseBundle:Fournisseur')->findAll();

        foreach( $fournisseurs as $fournisseur ) {
            $articles = $em->getRepository('BoutiqueDatabaseBundle:Article')->getArticlesPerFournisseurForInventaire( $fournisseur->getId(), $inventaire->getId() );
            $data[] = array('fournisseur' => $fournisseur, 'articles' => $articles);
        }
        
        $html = $this->renderView('BoutiqueGestionStockBundle:Inventaire:pdfInventaire.html.twig', array('inventaire' => $inventaire, 'fournisseurs' => $data));
        $pdfGenerator = $this->get('spraed.pdf.generator');

        return new Response($pdfGenerator->generatePDF($html),
            200,
            array('Content-Type' => 'application/pdf', 'Content-Disposition' => 'inline; filename="inventaire'.$id.'.pdf"' )
        );
    }
    
    public function addDiversAction( Request $request, $id ) {
        $em = $this->getDoctrine()->getManager();
        
        $inventaire = $em->getRepository('BoutiqueDatabaseBundle:Inventaire')->find($id);
        
        $divers = new InventaireDivers();
        $form = $this->createForm(new InventaireDiversType(), $divers);
        $form->bind($request);
        
        if ($form->isValid()) {
            $divers->setInventaire($inventaire);
            $em->persist($divers);
            
            $em->flush();
        }
        
        return $this->redirect($this->generateUrl('inventaire_edit', array('id' => $inventaire->getId())));
    }
    
    public function removeDiversAction( $id ) {
        $em = $this->getDoctrine()->getManager();
        
        $inv_divers = $em->getRepository('BoutiqueDatabaseBundle:InventaireDivers')->find($id);
        
        $inventaire_id = $inv_divers->getInventaire();
        
        $em->remove($inv_divers);
        $em->flush();
        
        return $this->redirect($this->generateUrl('inventaire_edit', array('id' => $inventaire_id->getId())));
    }
    
    public function searchArticleAction( Request $request, $id_inventaire ) {
        $em = $this->getDoctrine()->getManager();
        $code = $request->get('inv_search_article');
        $article = $em->getRepository("BoutiqueDatabaseBundle:Article")->findOneBy(array('code' => $code));
        if( $article instanceof \Boutique\DatabaseBundle\Entity\Article ) {
            $inv_article = $em->getRepository("BoutiqueDatabaseBundle:InventaireArticle")->findOneBy(array('inventaire' => $id_inventaire, 'article' => $article->getId()));
        }
        else {
            $inv_article = null;
        }
        return $this->render('BoutiqueGestionStockBundle:Inventaire:_article.html.twig', array(
            'article' => $inv_article
        ));
    }
    
    public function updatePrixAchatsAction( $inventaire ) {
        $em = $this->getDoctrine()->getManager();
        
        $inventaire = $em->getRepository('BoutiqueDatabaseBundle:Inventaire')->find($inventaire);
        
        foreach( $inventaire->getInvArticles() as $inv_article ) {
            if( $inv_article->getArticle()->getPrixAchatMoyenHT() != $inv_article->getPrixAchat() ) {
                $inv_article->setPrixAchat( $inv_article->getArticle()->getPrixAchatMoyenHT() );
                $em->persist($inv_article);
            }
            if( $inv_article->getArticle()->getPrixHT() != $inv_article->getPrixVente() ) {
                $inv_article->setPrixAchat( $inv_article->getArticle()->getPrixHT() );
                $em->persist($inv_article);
            }
        }
        $em->flush();
        
        return $this->redirect($this->generateUrl('inventaire_edit', array('id' => $inventaire->getId())));
    } 
}
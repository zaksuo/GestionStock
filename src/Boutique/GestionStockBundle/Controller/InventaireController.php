<?php

namespace Boutique\GestionStockBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Boutique\DatabaseBundle\Entity\Inventaire;
use Boutique\DatabaseBundle\Entity\InventaireArticle;

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
            $inv_article->setPrixUnitaire($article->getPrixHT());
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
        
        foreach( $inv_articles as $article ) {
            $em->remove($article);
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
        
        return $this->render('BoutiqueGestionStockBundle:Inventaire:edit.html.twig', array('inventaire' => $inventaire, 'pagination' => $pagination));
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
        $inventaire->clore();
        
        $em->persist($inventaire);
        $em->flush();
        
        return $this->redirect($this->generateUrl('inventaire'));
    }
}
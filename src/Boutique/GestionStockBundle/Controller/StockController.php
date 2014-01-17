<?php

namespace Boutique\GestionStockBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Boutique\DatabaseBundle\Entity\Stock;
use Boutique\DatabaseBundle\Form\StockType;

class StockController extends Controller
{
    public function newStockAction($id_article = null) {
        $em = $this->getDoctrine()->getManager();
        $stock = new Stock();
        $article = null;
        
        if( !is_null($id_article) ) {
            $article = $em->getRepository('BoutiqueDatabaseBundle:Article')->find($id_article);
        }
        
        $form = $this->createForm(new StockType(), $stock);
        
        if( !is_null($article) ) {
            return $this->render('BoutiqueGestionStockBundle:Stock:new.html.twig', array(
                'form' => $form->createView(), 
                'article' => $article,
                'edit'  => false
            ));
        }
        else {
            return $this->render('BoutiqueGestionStockBundle:Stock:new.html.twig', array(
                'form' => $form->createView(),
                'edit'  => false
            ));
        }
    }

    public function createStockAction(Request $request, $id_article) {
        $em = $this->getDoctrine()->getManager();
        
        $article = $em->getRepository('BoutiqueDatabaseBundle:Article')->find( $id_article );
        
        $stock = new Stock();
        $form = $this->createForm(new StockType(), $stock);
        $form->bind($request);
        
        if( $form->isValid() ) {
            $stock->setDateEntree(new \DateTime('now'));
            $stock->setIdArticle($article);
            $em->persist($stock);
            
            $article_stock = $em->getRepository('BoutiqueDatabaseBundle:ArticleStock')->find($article->getArticleStock());
            $article_stock->setQuantite( $article_stock->getQuantite() + $stock->getQuantite() );

            $em->persist($article_stock);
            $em->flush();

            return $this->redirect($this->generateUrl('article_show', array('id' => $id_article)));
        }
        
        return $this->render('BoutiqueGestionStockBundle:Stock:new.html.twig', array(
            'article' => $article,
            'form'   => $form->createView(),
            'edit'  => false
         ));
    }
    
    public function editStockAction($id_article, $id_stock) {
        $em = $this->getDoctrine()->getManager();
        
        $stock = $em->getRepository('BoutiqueDatabaseBundle:Stock')->find($id_stock);
        $article = $em->getRepository('BoutiqueDatabaseBundle:Article')->find($id_article);
        $form = $this->createForm(new StockType(false), $stock);
        
        return $this->render('BoutiqueGestionStockBundle:Stock:edit.html.twig', array(
            'article' => $article,
            'stock' => $stock,
            'form'   => $form->createView(),
            'edit'  => true
         ));
    }
    
    public function saveStockAction( Request $request, $id_article, $id_stock ) {
        $em = $this->getDoctrine()->getManager();
        //$stock->setDateModif(new \DateTime('now'));
        $old_stock = $em->getRepository('BoutiqueDatabaseBundle:Stock')->find( $id_stock );
        $article = $em->getRepository('BoutiqueDatabaseBundle:Article')->find( $id_article );
        
        $new_stock = new Stock();
        $form = $this->createForm(new StockType(false), $new_stock);
        $form->bind($request);
        
        if( $form->isValid() ) {
            $stock_diff = ($old_stock->getQuantite() - $new_stock->getQuantite());
           
            $old_stock->setQuantite($new_stock->getQuantite());
            $old_stock->setPrixAchat($new_stock->getPrixAchat());
            $old_stock->setDelottage($new_stock->getDelottage());
            $old_stock->setCommentaire($new_stock->getCommentaire());
            $old_stock->setDateModif(new \DateTime('now'));
            $em->persist($old_stock);
            
            $article_stock = $em->getRepository('BoutiqueDatabaseBundle:ArticleStock')->find($article->getArticleStock());
            $article_stock->setQuantite( $article_stock->getQuantite() - $stock_diff );

            $em->persist($article_stock);
            $em->flush();

            return $this->redirect($this->generateUrl('article', array('id' => $article->getId())));
        }
        
        return $this->render('BoutiqueGestionStockBundle:Stock:edit.html.twig', array(
            'stock' => $old_stock,
            'article' => $article,
            'form'   => $form->createView(),
            'edit' => true
         ));
    }
    
    public function deleteStockAction( $id_article, $id_stock ) {
        $em = $this->getDoctrine()->getManager();
        $stock = $em->getRepository('BoutiqueDatabaseBundle:Stock')->find( $id_stock );
        $article = $em->getRepository('BoutiqueDatabaseBundle:Article')->find( $id_article );
        
        $article_stock = $em->getRepository('BoutiqueDatabaseBundle:ArticleStock')->find($article->getArticleStock());
        $article_stock->setQuantite( $article_stock->getQuantite() - $stock->getQuantite() );
        $em->persist($article_stock);
        
        $em->remove($stock);
        $em->flush();
        
        return $this->redirect($this->generateUrl('article_show', array('id' => $id_article)));
    }
    
    private function recordStock( $stock, $article ) {
        
    }
}

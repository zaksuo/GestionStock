<?php

namespace Boutique\GestionStockBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Boutique\DatabaseBundle\Entity\Stock;
use Boutique\DatabaseBundle\Form\StockType;

class StockController extends Controller
{
    public function newStockAction() {
        $stock = new Stock();
        $form = $this->createForm(new StockType(), $stock);
        
        return $this->render('BoutiqueGestionStockBundle:Stock:new.html.twig', array(
            'form'   => $form->createView()
         ));
    }
    
    public function addStockAction($id_article = null) {
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('BoutiqueDatabaseBundle:Article')->find($id_article);
        
        $stock = new Stock();
        $form = $this->createForm(new StockType(), $stock);
        
        return $this->render('BoutiqueGestionStockBundle:Stock:add.html.twig', array(
            'article' => $article,
            'form'   => $form->createView()
        ));
    }

    public function createStockAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        
        $formData = $request->get('boutique_databasebundle_stocktype');
        $article = $em->getRepository('BoutiqueDatabaseBundle:Article')->find( $formData['idArticle'] );
        
        $stock = new Stock();
        $form = $this->createForm(new StockType(), $stock);
        
        $data = $request->request->get($form->getName());
                
        $children = $form->getChildren();
        $data = array_intersect_key($data, $children);
        $form->bind($data);
        
        if( $form->isValid() ) {
            $stock->setDateEntree(new \DateTime('now'));
            $stock->setIdArticle( $article );
            
            $em->persist($stock);
            
            $article_stock = $em->getRepository('BoutiqueDatabaseBundle:ArticleStock')->find($article->getArticleStock());
            $article_stock->setQuantite( $article_stock->getQuantite() + $stock->getQuantite() );

            $em->persist($article_stock);
            $em->flush();

            return $this->redirect($this->generateUrl('article'));
        }
        
        return $this->render('BoutiqueGestionStockBundle:Stock:add.html.twig', array(
            'article' => $article,
            'form'   => $form->createView()
         ));
    }
}

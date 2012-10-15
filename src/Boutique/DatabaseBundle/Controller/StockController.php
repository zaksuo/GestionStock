<?php

namespace Boutique\DatabaseBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Boutique\DatabaseBundle\Entity\Stock;
use Boutique\DatabaseBundle\Form\StockType;
use Boutique\DatabaseBundle\Form\StockArticleType;

class StockController extends Controller
{
    public function newStockAction() {
        $em = $this->getDoctrine()->getManager();
        
        $stock = new Stock();
        $form = $this->createForm(new StockType(), $stock);
        
        return $this->render('BoutiqueDatabaseBundle:Stock:new.html.twig', array(
            'form'   => $form->createView()
         ));
    }
    
    public function addStockAction($id_article) {
        $em = $this->getDoctrine()->getManager();
        
        $article = $em->getRepository('BoutiqueDatabaseBundle:Article')->find($id_article);
        $stock = new Stock();
        //$stock->setIdArticle($article);
        $form = $this->createForm(new StockArticleType(), $stock);
        
        return $this->render('BoutiqueDatabaseBundle:Stock:add.html.twig', array(
            'article' => $article,
            'form'   => $form->createView()
         ));
    }

    public function createStockAction(Request $request, $id_article) {
        $em = $this->getDoctrine()->getManager();
        
        $article = $em->getRepository('BoutiqueDatabaseBundle:Article')->find($id_article);
        $stock = new Stock();
        
        $stock->setIdArticle($article);
        $form = $this->createForm(new StockType(), $stock);
        $form->bind($request);
        
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $stock->setDateEntree(new \DateTime('now'));
            $em->persist($stock);
            
            $em->flush();
        
            return $this->redirect($this->generateUrl('article'));
        }
        
        return $this->render('BoutiqueDatabaseBundle:Stock:add.html.twig', array(
            'article' => $article,
            'form'   => $form->createView()
         ));
    }
}

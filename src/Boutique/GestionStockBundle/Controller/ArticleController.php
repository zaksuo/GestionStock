<?php

namespace Boutique\GestionStockBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Boutique\DatabaseBundle\Entity\Article;
use Boutique\DatabaseBundle\Entity\Stock;
use Boutique\DatabaseBundle\Entity\ArticleStock;

use Boutique\DatabaseBundle\Form\ArticleType;
use Boutique\DatabaseBundle\Form\ArticleStockType;


/**
 * Article controller.
 *
 */
class ArticleController extends Controller
{
    /**
     * Lists all Article entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $dql = "SELECT a FROM BoutiqueDatabaseBundle:Article a";
        $query = $em->createQuery($dql);
        
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $this->get('request')->query->get('page', 1)/*page number*/,
            30 /*limit per page*/
        );

        return $this->render('BoutiqueGestionStockBundle:Article:index.html.twig', compact('pagination'));
    }

    /**
     * Finds and displays a Article entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $article = $em->getRepository('BoutiqueDatabaseBundle:Article')->find($id);

        if (!$article) {
            throw $this->createNotFoundException('Erreur : Cet article n\'exite pas.');
        }

        return $this->render('BoutiqueGestionStockBundle:Article:show.html.twig', array(
            'article'      => $article
        ));
    }

    /**
     * Displays a form to create a new Article entity.
     *
     */
    public function newAction()
    {
        $article = new Article();
        $em = $this->getDoctrine()->getManager();
        $last_code = $em->getRepository('BoutiqueDatabaseBundle:Article')->getLastCode();
        if( is_null($last_code) ) {
            $last_code = 'AAA000';
        }
        $code = $article->generateNextCode($last_code);
        $article->setCode($code);
        $form   = $this->createForm(new ArticleStockType(), $article);
        
        return $this->render('BoutiqueGestionStockBundle:Article:new.html.twig', array(
            'article' => $article,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Article entity.
     *
     */
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $article = new Article();
        $form = $this->createForm(new ArticleStockType(), $article);
        $form->bind($request);
        
        $stock = $article->getNewStock();
        
        $last_code = $em->getRepository('BoutiqueDatabaseBundle:Article')->getLastCode();
        if( is_null($last_code) ) {
            $last_code = 'AAA000';
        }
        $code = $article->generateNextCode($last_code);
        $article->setCode($code);
        
        $article_stock = new ArticleStock();
        $article_stock->setQuantite($stock->getQuantite());
        $em->persist($article_stock);
        
        if ($form->isValid()) {
            $article->setArticleStock($article_stock);
            $em->persist($article);
            
            $stock->setDateEntree(new \DateTime('now'));
            $stock->setIdArticle($article);
            $em->persist($stock);
            
            $em->flush();

            return $this->redirect($this->generateUrl('article'));
        }

        return $this->render('BoutiqueGestionStockBundle:Article:new.html.twig', array(
            'entity' => $article,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Article entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $article = $em->getRepository('BoutiqueDatabaseBundle:Article')->find($id);

        if (!$article) {
            throw $this->createNotFoundException('Erreur : Cet article n\'existe pas.');
        }

        $editForm = $this->createForm(new ArticleType(), $article);

        return $this->render('BoutiqueGestionStockBundle:Article:edit.html.twig', array(
            'article'      => $article,
            'form'   => $editForm->createView()
        ));
    }

    /**
     * Edits an existing Article entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $article = $em->getRepository('BoutiqueDatabaseBundle:Article')->find($id);
        $code = $article->getCode();
        
        if (!$article) {
            throw $this->createNotFoundException('Erreur : Cet article n\'existe pas.');
        }

        $editForm = $this->createForm(new ArticleType(), $article);
        $editForm->bind($request);
        
        if ($editForm->isValid()) {
            $article->setCode($code);
            $em->persist($article);
            $em->flush();
            
            return $this->redirect($this->generateUrl('article'));
        }

        return $this->render('BoutiqueGestionStockBundle:Article:edit.html.twig', array(
            'entity'      => $article,
            'edit_form'   => $editForm->createView()
        ));
    }

    /**
     * Deletes a Article entity.
     *
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $article = $em->getRepository('BoutiqueDatabaseBundle:Article')->find($id);
        
        //if( )
        return $this->redirect($this->generateUrl('article'));
    }
    
    public function searchAction(Request $request) {
        $search = $request->get('search_article');
         $em = $this->getDoctrine()->getManager();
         
        if( !is_null($search) ) {
            $articles = $em->getRepository('BoutiqueDatabaseBundle:Article')->getArticlesForSearch($search, 0, 15);
        }
        else {
            $articles = $em->getRepository('BoutiqueDatabaseBundle:Article')->getArticlesForSearch('', 0, 15);
        }
        
        return $this->render('BoutiqueGestionStockBundle:Ajax_Article:article_restock.html.twig', array(
            'articles'      => $articles
        ));
    }
}

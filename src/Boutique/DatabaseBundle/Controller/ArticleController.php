<?php

namespace Boutique\DatabaseBundle\Controller;

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

        $articles = $em->getRepository('BoutiqueDatabaseBundle:Article')->findAll();

        return $this->render('BoutiqueDatabaseBundle:Article:index.html.twig', array(
            'articles' => $articles,
        ));
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

        var_dump($article->getStocks());
        
        return $this->render('BoutiqueDatabaseBundle:Article:show.html.twig', array(
            'article'      => $article
        ));
    }

    /**
     * Displays a form to create a new Article entity.
     *
     */
    public function newAction()
    {
        $entity = new Article();
        $form   = $this->createForm(new ArticleStockType(), $entity);

        return $this->render('BoutiqueDatabaseBundle:Article:new.html.twig', array(
            'entity' => $entity,
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

        return $this->render('BoutiqueDatabaseBundle:Article:new.html.twig', array(
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

        $entity = $em->getRepository('BoutiqueDatabaseBundle:Article')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Erreur : Cet article n\'existe pas.');
        }

        $editForm = $this->createForm(new ArticleType(), $entity);

        return $this->render('BoutiqueDatabaseBundle:Article:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView()
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

        if (!$article) {
            throw $this->createNotFoundException('Erreur : Cet article n\'existe pas.');
        }

        $editForm = $this->createForm(new ArticleType(), $article);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($article);
            $em->flush();
            
            return $this->redirect($this->generateUrl('article'));
        }

        return $this->render('BoutiqueDatabaseBundle:Article:edit.html.twig', array(
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
        return $this->redirect($this->generateUrl('article'));
    }
    
    public function searchAction(Request $request) {
        $search = $request->get('search_article');
  
        if( !is_null($search) ) {
            $em = $this->getDoctrine()->getManager();
            
            $articles = $em->getRepository('BoutiqueDatabaseBundle:Article')->getArticlesForSearch($search);
        }
        
        return $this->render('BoutiqueDatabaseBundle:Ajax_Article:articles.html.twig', array(
            'articles'      => $articles
        ));
    }
}

<?php

namespace Boutique\ConfigurationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use Boutique\DatabaseBundle\Entity\CampagneRemise;
use Boutique\DatabaseBundle\Entity\CampagneArticle;
use Boutique\DatabaseBundle\Form\CampagneRemiseType;

/**
 * CampagneRemise controller.
 *
 */
class CampagneRemiseController extends Controller
{
    /**
     * Lists all CampagneRemise entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BoutiqueDatabaseBundle:CampagneRemise')->findAll();

        return $this->render('BoutiqueConfigurationBundle:CampagneRemise:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a CampagneRemise entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BoutiqueDatabaseBundle:CampagneRemise')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CampagneRemise entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BoutiqueConfigurationBundle:CampagneRemise:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new CampagneRemise entity.
     *
     */
    public function newAction()
    {
        $entity = new CampagneRemise();
        $form   = $this->createForm(new CampagneRemiseType(), $entity);

        return $this->render('BoutiqueConfigurationBundle:CampagneRemise:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new CampagneRemise entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new CampagneRemise();
        $form = $this->createForm(new CampagneRemiseType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->setDateDebut(new \DateTime($this->format_date($entity->getDateDebut())));
            $entity->setDateFin(new \DateTime($this->format_date($entity->getDateFin())));
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('campagneremise_edit', array('id' => $entity->getId())));
        }

        return $this->render('BoutiqueConfigurationBundle:CampagneRemise:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing CampagneRemise entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BoutiqueDatabaseBundle:CampagneRemise')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CampagneRemise entity.');
        }

        $entity->setDateDebut($entity->getDateDebut()->format('d/m/Y'));
        $entity->setDateFin($entity->getDateFin()->format('d/m/Y'));
        $editForm = $this->createForm(new CampagneRemiseType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BoutiqueConfigurationBundle:CampagneRemise:edit.html.twig', array(
            'campagne'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView()
        ));
    }

    /**
     * Edits an existing CampagneRemise entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BoutiqueDatabaseBundle:CampagneRemise')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CampagneRemise entity.');
        }

        $entity->setDateDebut($entity->getDateDebut()->format('d/m/Y'));
        $entity->setDateFin($entity->getDateFin()->format('d/m/Y'));
        
        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new CampagneRemiseType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $entity->setDateDebut(new \DateTime($this->format_date($entity->getDateDebut())));
            $entity->setDateFin(new \DateTime($this->format_date($entity->getDateFin())));
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('campagneremise_edit', array('id' => $id)));
        }

        return $this->render('BoutiqueConfigurationBundle:CampagneRemise:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a CampagneRemise entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BoutiqueDatabaseBundle:CampagneRemise')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find CampagneRemise entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('campagneremise'));
    }

    public function addArticleAction( $campagne, $article ) {
        $em = $this->getDoctrine()->getManager();
        
        $campagne = $em->getRepository('BoutiqueDatabaseBundle:CampagneRemise')->find($campagne);
        $article = $em->getRepository('BoutiqueDatabaseBundle:Article')->find($article);
        
        $campagne_art = new CampagneArticle();
        $campagne_art->setCampagneRemise( $campagne );
        $campagne_art->setArticle( $article );
        
        $em->persist($campagne_art);
        $em->flush();
        
        return $this->render('BoutiqueConfigurationBundle:CampagneRemise:_article.html.twig', array('camp_article' => $campagne_art));
    }
    
    public function removeArticleAction( $campagne_article ) {
        $em = $this->getDoctrine()->getManager();
        
        $campagne_article = $em->getRepository('BoutiqueDatabaseBundle:CampagneArticle')->find($campagne_article);
        
        $em->remove($campagne_article);
        $em->flush();
        
        return new Response('', 200);
    }
    
    public function listeArticlesAction( $campagne ) {
        $em = $this->getDoctrine()->getManager();

        $campagne = $em->getRepository('BoutiqueDatabaseBundle:CampagneRemise')->find($campagne);
        
        $dql = "SELECT a FROM BoutiqueDatabaseBundle:Article a";
        $query = $em->createQuery($dql);
        
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $this->get('request')->query->get('page', 1)/*page number*/,
            30 /*limit per page*/
        );

        return $this->render('BoutiqueConfigurationBundle:CampagneRemise:_listArticles.html.twig', array('pagination' => $pagination, 'campagne' => $campagne));
    }
    
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
    
    private function format_date( $date_fr ) {
        $date = explode("/", $date_fr);
        return $date[2]."-".$date[1]."-".$date[0];
    }
}

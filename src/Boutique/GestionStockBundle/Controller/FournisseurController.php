<?php

namespace Boutique\GestionStockBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Boutique\DatabaseBundle\Entity\Fournisseur;
use Boutique\DatabaseBundle\Form\FournisseurType;

/**
 * Fournisseur controller.
 *
 */
class FournisseurController extends Controller
{
    /**
     * Lists all Fournisseur entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $dql = "SELECT f FROM BoutiqueDatabaseBundle:Fournisseur f";
        $query = $em->createQuery($dql);
        
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $this->get('request')->query->get('page', 1)/*page number*/,
            30 /*limit per page*/
        );

        return $this->render('BoutiqueGestionStockBundle:Fournisseur:index.html.twig', compact('pagination'));
    }

    /**
     * Finds and displays a Fournisseur entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $fournisseur = $em->getRepository('BoutiqueDatabaseBundle:Fournisseur')->find($id);

        if (!$fournisseur) {
            throw $this->createNotFoundException('Impossible de trouver le fournisseur sélectionné.');
        }
        
        $dql = "SELECT a FROM BoutiqueDatabaseBundle:Article a WHERE a.fournisseur = '".$fournisseur->getId()."'";
        $query = $em->createQuery($dql);
        
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $this->get('request')->query->get('page', 1)/*page number*/,
            30 /*limit per page*/
        );

        return $this->render('BoutiqueGestionStockBundle:Fournisseur:show.html.twig', array(
            'fournisseur'      => $fournisseur,
            'pagination'        => $pagination
        ));
    }

    /**
     * Displays a form to create a new Fournisseur entity.
     *
     */
    public function newAction()
    {
        $fournisseur = new Fournisseur();
        $form   = $this->createForm(new FournisseurType(), $fournisseur);

        return $this->render('BoutiqueGestionStockBundle:Fournisseur:new.html.twig', array(
            'fournisseur' => $fournisseur,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Fournisseur entity.
     *
     */
    public function createAction(Request $request)
    {
        $fournisseur  = new Fournisseur();
        $form = $this->createForm(new FournisseurType(), $fournisseur);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($fournisseur);
            $em->flush();

            return $this->redirect($this->generateUrl('fournisseur_show', array('id' => $fournisseur->getId())));
        }

        return $this->render('BoutiqueGestionStockBundle:Fournisseur:new.html.twig', array(
            'fournisseur' => $fournisseur,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Fournisseur entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $fournisseur = $em->getRepository('BoutiqueDatabaseBundle:Fournisseur')->find($id);

        if (!$fournisseur) {
            throw $this->createNotFoundException('Impossible de trouver le fournisseur demandé');
        }

        $editForm = $this->createForm(new FournisseurType(), $fournisseur);

        return $this->render('BoutiqueGestionStockBundle:Fournisseur:edit.html.twig', array(
            'fournisseur'      => $fournisseur,
            'form'   => $editForm->createView(),
        ));
    }

    /**
     * Edits an existing Fournisseur entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $fournisseur = $em->getRepository('BoutiqueDatabaseBundle:Fournisseur')->find($id);

        if (!$fournisseur) {
            throw $this->createNotFoundException('Impossible de trouver le fournisseur demandé');
        }

        $editForm = $this->createForm(new FournisseurType(), $fournisseur);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($fournisseur);
            $em->flush();

            return $this->redirect($this->generateUrl('fournisseur_show', array('id' => $id)));
        }

        return $this->render('BoutiqueGestionStockBundle:Fournisseur:edit.html.twig', array(
            'fournisseur'      => $fournisseur,
            'form'   => $editForm->createView(),
        ));
    }

    /**
     * Deletes a Fournisseur entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $fournisseur = $em->getRepository('BoutiqueDatabaseBundle:Fournisseur')->find($id);
        
        if (!$fournisseur) {
            throw $this->createNotFoundException('Impossible de trouver le fournisseur demandé');
        }

        $em->remove($fournisseur);
        $em->flush();

        return $this->redirect($this->generateUrl('fournisseur'));
    }
}

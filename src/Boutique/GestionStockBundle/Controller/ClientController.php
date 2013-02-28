<?php

namespace Boutique\GestionStockBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Boutique\DatabaseBundle\Entity\Client;
use Boutique\DatabaseBundle\Form\ClientType;

/**
 * Client controller.
 *
 */
class ClientController extends Controller
{
    /**
     * Lists all Client entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $dql = "SELECT c FROM BoutiqueDatabaseBundle:Client c";
        $query = $em->createQuery($dql);
        
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $this->get('request')->query->get('page', 1)/*page number*/,
            30 /*limit per page*/
        );

        return $this->render('BoutiqueGestionStockBundle:Client:index.html.twig', compact('pagination'));
    }

    /**
     * Finds and displays a Client entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $client = $em->getRepository('BoutiqueDatabaseBundle:Client')->find($id);

        if (!$client) {
            throw $this->createNotFoundException('Impossible de trouver la fiche client sélectionnée.');
        }
        
        $dql = "SELECT f FROM BoutiqueDatabaseBundle:Facture f WHERE f.client = '".$client->getId()."'";
        $query = $em->createQuery($dql);
        
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $this->get('request')->query->get('page', 1)/*page number*/,
            30 /*limit per page*/
        );

        return $this->render('BoutiqueGestionStockBundle:Client:show.html.twig', array(
            'client'      => $client,
            'pagination'  => $pagination
        ));
    }

    /**
     * Displays a form to create a new Client entity.
     *
     */
    public function newAction()
    {
        $client = new Client();
        $form   = $this->createForm(new ClientType(), $client);

        return $this->render('BoutiqueGestionStockBundle:Client:new.html.twig', array(
            'client' => $client,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Client entity.
     *
     */
    public function createAction(Request $request)
    {
        $client  = new Client();
        $form = $this->createForm(new ClientType(), $client);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $client->setDateCreation(new \DateTime('now'));
            $em->persist($client);
            $em->flush();

            return $this->redirect($this->generateUrl('client_show', array('id' => $client->getId())));
        }

        return $this->render('BoutiqueGestionStockBundle:Client:new.html.twig', array(
            'entity' => $client,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Client entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $client = $em->getRepository('BoutiqueDatabaseBundle:Client')->find($id);

        if (!$client) {
            throw $this->createNotFoundException('Impossible de trouver la fiche client sélectionnée.');
        }

        $editForm = $this->createForm(new ClientType(), $client);

        return $this->render('BoutiqueGestionStockBundle:Client:edit.html.twig', array(
            'client'      => $client,
            'form'   => $editForm->createView()
        ));
    }

    /**
     * Edits an existing Client entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $client = $em->getRepository('BoutiqueDatabaseBundle:Client')->find($id);

        if (!$client) {
            throw $this->createNotFoundException('Impossible de trouver la fiche client sélectionnée.');
        }

        $editForm = $this->createForm(new ClientType(), $client);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($client);
            $em->flush();

            return $this->redirect($this->generateUrl('client_edit', array('id' => $id)));
        }

        return $this->render('BoutiqueGestionStockBundle:Client:edit.html.twig', array(
            'client'      => $client,
            'form'   => $editForm->createView(),
        ));
    }

    /**
     * Deletes a Client entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $client = $em->getRepository('BoutiqueDatabaseBundle:Client')->find($id);

        if (!$client) {
            throw $this->createNotFoundException('Impossible de trouver la fiche client sélectionnée.');
        }

        $em->remove($client);
        $em->flush();

        return $this->redirect($this->generateUrl('client'));
    }
}

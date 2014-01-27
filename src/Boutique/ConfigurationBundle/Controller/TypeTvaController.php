<?php

namespace Boutique\ConfigurationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Boutique\DatabaseBundle\Entity\TypeTva;
use Boutique\DatabaseBundle\Form\TypeTvaType;

/**
 * TypeTva controller.
 *
 */
class TypeTvaController extends Controller
{
    /**
     * Lists all TypeTva entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BoutiqueDatabaseBundle:TypeTva')->findAll();

        return $this->render('BoutiqueConfigurationBundle:TypeTva:index.html.twig', array(
            'entities' => $entities,
        ));
    }


    /**
     * Displays a form to create a new TypeTva entity.
     *
     */
    public function newAction()
    {
        $entity = new TypeTva();
        $form   = $this->createForm(new TypeTvaType(), $entity);

        return $this->render('BoutiqueConfigurationBundle:TypeTva:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new TypeTva entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new TypeTva();
        $form = $this->createForm(new TypeTvaType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('typeTva', array('id' => $entity->getId())));
        }

        return $this->render('BoutiqueConfigurationBundle:TypeTva:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing TypeTva entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BoutiqueDatabaseBundle:TypeTva')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TypeTva entity.');
        }

        $editForm = $this->createForm(new TypeTvaType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BoutiqueConfigurationBundle:TypeTva:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing TypeTva entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BoutiqueDatabaseBundle:TypeTva')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TypeTva entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new TypeTvaType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('typeTva_edit', array('id' => $id)));
        }

        return $this->render('BoutiqueConfigurationBundle:TypeTva:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a TypeTva entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BoutiqueDatabaseBundle:TypeTva')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TypeTva entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('typeTva'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}

<?php

namespace Boutique\ConfigurationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Boutique\DatabaseBundle\Entity\Remise;
use Boutique\DatabaseBundle\Form\RemiseType;

/**
 * Remise controller.
 *
 */
class RemiseController extends Controller
{
    /**
     * Lists all Remise entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BoutiqueDatabaseBundle:Remise')->findAll();

        return $this->render('BoutiqueConfigurationBundle:Remise:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Remise entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BoutiqueDatabaseBundle:Remise')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Remise entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BoutiqueConfigurationBundle:Remise:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Remise entity.
     *
     */
    public function newAction()
    {
        $entity = new Remise();
        $form   = $this->createForm(new RemiseType(), $entity);

        return $this->render('BoutiqueConfigurationBundle:Remise:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Remise entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Remise();
        $form = $this->createForm(new RemiseType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('remise'));
        }

        return $this->render('BoutiqueConfigurationBundle:Remise:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Remise entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BoutiqueDatabaseBundle:Remise')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Remise entity.');
        }

        $editForm = $this->createForm(new RemiseType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BoutiqueConfigurationBundle:Remise:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Remise entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BoutiqueDatabaseBundle:Remise')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Remise entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new RemiseType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('remise'));
        }

        return $this->render('BoutiqueConfigurationBundle:Remise:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Remise entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BoutiqueDatabaseBundle:Remise')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Remise entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('remise'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}

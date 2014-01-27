<?php

namespace Boutique\ConfigurationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Boutique\DatabaseBundle\Entity\TypeArticle;
use Boutique\DatabaseBundle\Form\TypeArticleType;

/**
 * TypeArticle controller.
 *
 */
class TypeArticleController extends Controller
{
    /**
     * Lists all TypeArticle entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BoutiqueDatabaseBundle:TypeArticle')->findByParent(NULL);

        return $this->render('BoutiqueConfigurationBundle:TypeArticle:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a TypeArticle entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BoutiqueDatabaseBundle:TypeArticle')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TypeArticle entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BoutiqueConfigurationBundle:TypeArticle:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new TypeArticle entity.
     *
     */
    public function newAction()
    {
        $entity = new TypeArticle();
        $form   = $this->createForm(new TypeArticleType(), $entity);

        return $this->render('BoutiqueConfigurationBundle:TypeArticle:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new TypeArticle entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new TypeArticle();
        $form = $this->createForm(new TypeArticleType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('typeArticle_show', array('id' => $entity->getId())));
        }

        return $this->render('BoutiqueConfigurationBundle:TypeArticle:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing TypeArticle entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BoutiqueDatabaseBundle:TypeArticle')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TypeArticle entity.');
        }

        $editForm = $this->createForm(new TypeArticleType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BoutiqueConfigurationBundle:TypeArticle:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing TypeArticle entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BoutiqueDatabaseBundle:TypeArticle')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TypeArticle entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new TypeArticleType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('typeArticle_edit', array('id' => $id)));
        }

        return $this->render('BoutiqueConfigurationBundle:TypeArticle:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a TypeArticle entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BoutiqueDatabaseBundle:TypeArticle')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TypeArticle entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('typeArticle'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}

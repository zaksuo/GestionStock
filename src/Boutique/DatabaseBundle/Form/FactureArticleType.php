<?php

namespace Boutique\DatabaseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FactureArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('facture', 'hidden', array('required' => false, 'label' => 'Article'))
            ->add('article', 'hidden', array('required' => false, 'label' => 'Article'))
            ->add('prix unitaire', 'hidden', array('required' => false, 'label' => 'Prix de vente'))
            ->add('quantite', 'text', array('required' => false, 'label' => 'Quantité achetée'))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Boutique\DatabaseBundle\Entity\FactureArticle',
            'csrf_protection' => false
        ));
    }

    public function getName()
    {
        return 'boutique_databasebundle_facturearticletype';
    }
}

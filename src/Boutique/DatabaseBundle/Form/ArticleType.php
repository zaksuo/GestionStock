<?php

namespace Boutique\DatabaseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code', 'text', array('required' => false, 'label' => 'Code de l\'article'))
            ->add('libelle', 'text', array('required' => false, 'label' => 'Nom de l\'article'))
            ->add('fournisseur', null, array('required' => true, 'label' => 'Fournisseur'))
            ->add('codeFournisseur', 'text', array('required' => true, 'label' => 'Code fournisseur'))
            ->add('description', 'textarea', array('required' => false, 'label' => 'Description'))
            ->add('prixVente', 'text', array('required' => false, 'label' => 'Prix de vente'))
            ->add('typeArticle', null, array('required' => false, 'label' => 'Catégorie d\'article'))
            ->add('typeVente', null, array('required' => false, 'label' => 'Type de vente'))
            ->add('typeTva', null, array('required' => false, 'label' => 'T.V.A.'))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Boutique\DatabaseBundle\Entity\Article'
        ));
    }

    public function getName()
    {
        return 'boutique_databasebundle_articletype';
    }
}

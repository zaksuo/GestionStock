<?php

namespace Boutique\DatabaseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ArticleStockType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('annee', 'choice', array('required' => false, 'label' => 'Année'))
            ->add('mois', null, array('required' => false, 'label' => 'Mois'))
            ->add('codeFournisseur', 'text', array('required' => true, 'label' => 'Code fournisseur'))
            ->add('libelle', 'text', array('required' => true, 'label' => 'Nom de l\'article'))
            ->add('description', 'textarea', array('required' => false, 'label' => 'Description'))
            ->add('prixVente', 'text', array('required' => true, 'label' => 'Prix de vente'))
            ->add('typeArticle', null, array('required' => true, 'label' => 'Catégorie d\'article'))
            ->add('typeVente', null, array('required' => true, 'label' => 'Type de vente'))
            ->add('typeTva', null, array('required' => true, 'label' => 'T.V.A.'))
            ->add('new_stock', new StockType(), array('label' => ''));
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
        return 'boutique_databasebundle_articlestocktype';
    }
}

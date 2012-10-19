<?php

namespace Boutique\DatabaseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FactureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', null, array('required' => true))
            ->add('client', null, array('required' => false, 'label' => 'Nom de l\'article'))
            ->add('description', null, array('required' => false, 'label' => 'Description'))
            ->add('prixVente', null, array('required' => false, 'label' => 'Prix de vente'))
            ->add('typeArticle', null, array('required' => false, 'label' => 'Catégorie d\'article'))
            ->add('typeTva', null, array('required' => false, 'label' => 'T.V.A.'))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Boutique\DatabaseBundle\Entity\Facture'
        ));
    }

    public function getName()
    {
        return 'boutique_databasebundle_facturetype';
    }
}

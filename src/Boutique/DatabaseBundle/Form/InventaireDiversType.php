<?php

namespace Boutique\DatabaseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class InventaireDiversType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle', 'text', array('required' => true, 'label' => 'Année de l\'inventaire'))
            ->add('prixUnitaire', 'text', array('required' => true, 'label' => 'Prix unitaire'))
            ->add('quantite', 'text', array('required' => true, 'label' => 'Quantité'))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Boutique\DatabaseBundle\Entity\InventaireDivers'
        ));
    }

    public function getName()
    {
        return 'boutique_databasebundle_inventairediverstype';
    }
}

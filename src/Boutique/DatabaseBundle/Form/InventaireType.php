<?php

namespace Boutique\DatabaseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class InventaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('annee', 'text', array('required' => true, 'label' => 'Année de l\'inventaire'))
            ->add('date_creation', 'text', array('required' => true, 'label' => 'Date de début de l\'article'))
            ->add('date_cloture', null, array('required' => false, 'label' => 'Date de clôture de l\'inventaire'))
            ->add('cloture', 'radio', array('required' => true, 'label' => 'Clôturé ?'))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Boutique\DatabaseBundle\Entity\Inventaire'
        ));
    }

    public function getName()
    {
        return 'boutique_databasebundle_inventairetype';
    }
}

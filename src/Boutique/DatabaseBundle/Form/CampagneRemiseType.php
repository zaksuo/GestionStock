<?php

namespace Boutique\DatabaseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CampagneRemiseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateDebut', 'text', array('required' => true) )
            ->add('dateFin', 'text', array('required' => true) )
            ->add('active', 'checkbox', array('required' => false))
            ->add('remise')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Boutique\DatabaseBundle\Entity\CampagneRemise'
        ));
    }

    public function getName()
    {
        return 'boutique_databasebundle_campagneremisetype';
    }
}

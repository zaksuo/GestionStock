<?php

namespace Boutique\DatabaseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FournisseurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('siren')
            ->add('telephone')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Boutique\DatabaseBundle\Entity\Fournisseur'
        ));
    }

    public function getName()
    {
        return 'boutique_databasebundle_fournisseurtype';
    }
}

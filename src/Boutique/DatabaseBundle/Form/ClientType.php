<?php

namespace Boutique\DatabaseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('dateNaissance', 'text')
            ->add('mail')
            ->add('adresseNumero')
            ->add('adresseVoie')
            ->add('adresseComplement')
            ->add('codePostal')
            ->add('adresseVille')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Boutique\DatabaseBundle\Entity\Client'
        ));
    }

    public function getName()
    {
        return 'boutique_databasebundle_clienttype';
    }
}

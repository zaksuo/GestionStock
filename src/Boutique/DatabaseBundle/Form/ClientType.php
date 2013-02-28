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
            ->add('nom', 'text', array('required' => true, 'label' => 'Nom'))
            ->add('prenom', 'text', array('required' => true, 'label' => 'Prénom'))
            ->add('dateNaissance', 'date', array('required' => true, 'label' => 'Date de naissance'))
            ->add('mail', 'text', array('required' => true, 'label' => 'Adresse e-mail'))
            ->add('adresseNumero', 'text', array('required' => false, 'label' => 'Numéro'))
            ->add('adresseVoie', 'text', array('required' => false, 'label' => 'Voie'))
            ->add('adresseComplement', 'text', array('required' => false, 'label' => 'Complément'))
            ->add('codePostal', 'text', array('required' => false, 'label' => 'Code postal'))
            ->add('adresseVille', 'text', array('required' => false, 'label' => 'Ville'))
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

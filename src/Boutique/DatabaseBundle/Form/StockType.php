<?php

namespace Boutique\DatabaseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class StockType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id_article', null, array('label' => 'Article à restocker'))
            ->add('quantite', null, array('label' => 'Quantité d\'articles'))
            ->add('prix_achat', null, array('label' => 'Prix d\'achat'))
            ->add('delottage', null, array('label' => 'Ces objets ont ils été achetés en lot ?'))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Boutique\DatabaseBundle\Entity\Stock'
        ));
    }

    public function getName()
    {
        return 'boutique_databasebundle_stocktype';
    }
}

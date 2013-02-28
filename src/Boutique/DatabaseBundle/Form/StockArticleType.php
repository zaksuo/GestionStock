<?php

namespace Boutique\DatabaseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class StockArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quantite', 'text', array('required' => false, 'label' => 'Quantité d\'articles'))
            ->add('prixAchat', 'text', array('required' => false, 'label' => 'Prix d\'achat'))
            ->add('delottage', null, array('required' => false, 'label' => 'Ces objets ont ils été achetés en lot ?'))
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
        return 'boutique_databasebundle_stockarticletype';
    }
}

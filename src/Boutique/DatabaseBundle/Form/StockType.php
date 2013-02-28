<?php

namespace Boutique\DatabaseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class StockType extends AbstractType
{
    private $new;
    
    public function __construct($new=true) {
        $this->new = $new;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('idArticle', 'hidden', array('required' => false))
            ->add('quantite', 'text', array('required' => false, 'label' => 'Quantité d\'articles'))
            ->add('prixAchat', 'text', array('required' => false, 'label' => 'Prix d\'achat HT'))
            ->add('delottage', null, array('required' => false, 'label' => 'Ces objets ont ils été achetés en lot ?'))
        ;
        if( !$this->new ) {
            $builder
                ->add('id', 'hidden', array('required' => true))
                ->add('commentaire', 'textarea', array('required' => true, 'label' => 'Commentaire (Obligatoire lors d\'une modification de stock)'))
            ;
        }
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Boutique\DatabaseBundle\Entity\Stock',
            'csrf_protection' => false
        ));
    }

    public function getName()
    {
        return 'boutique_databasebundle_stocktype';
    }
}

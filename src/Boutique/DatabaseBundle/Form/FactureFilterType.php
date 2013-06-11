<?php

namespace Boutique\DatabaseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FactureFilterType extends AbstractType
{
    private $months = array('01'=>'01', '02'=>'02', '03'=>'03', '04'=>'04', '05'=>'05', '06'=>'06', '07'=>'07', '08'=>'08', '09'=>'09', '10'=>'10', '11'=>'11', '12'=>'12');
    private $years = array();
    
    public function __construct() {
        $init_year = intval('2012');
        $current_year = intval(date('Y'));
        
        for( $i = $init_year; $i <= $current_year; $i++ ) {
            $this->years[$i] = $i;
        }
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('year', 'choice', array('choices' => $this->years, 'required' => false, 'label' => 'Année', 'empty_value' => false))
            ->add('month', 'choice', array('choices' => $this->months,'required' => false, 'label' => 'Mois'))
        ;
    }

    public function getName()
    {
        return 'facture_filter';
    }
}

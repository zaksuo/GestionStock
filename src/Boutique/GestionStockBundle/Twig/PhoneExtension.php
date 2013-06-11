<?php

namespace Boutique\GestionStockBundle\Twig;

class PhoneExtension extends \Twig_Extension {
    public function getFilters() {
        return array(
            'phone_format' => new \Twig_Filter_Method($this, 'PhoneFormat', array('is_safe' => array('html')))
        );
    }

    public function PhoneFormat($string) {
        if( !empty($string) ) {
            if(is_numeric($string) and strlen($string) == 10) {
                return chunk_split($string, 2, " ");
            }
            else return $string;
        }
        else return 'Non renseigné';
    }

    public function getName() {
        return 'phone_format';
    }
}

?>
<?php

namespace Boutique\DatabaseBundle\Entity;

/**
 * Boutique\DatabaseBundle\Entity\FactureFilter
 */
class FactureFilter
{
    public $month;
    public $year;
    
    public function __construct() {
        $this->month = date('m');
        $this->year = date('Y');
    }
    
    public function setMonth( $month ) {
        $this->month = $month;
    }
    
    public function setYear( $year ) {
        $this->year = $year;
    }
    
    public function getMonth() {
        return $this->month;
    }
    
    public function getYear() {
        return $this->year;
    }
}
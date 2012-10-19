<?php

namespace Boutique\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Boutique\DatabaseBundle\Entity\FactureRemise
 */
class FactureRemise
{
    /**
     * @var integer $facture
     */
    private $facture;

    /**
     * @var integer $remise
     */
    private $remise;

    /**
     * @var float $montantRemise
     */
    private $montantRemise;

    /**
     * @var integer $id
     */
    private $id;


    /**
     * Set facture
     *
     * @param integer $facture
     * @return FactureRemise
     */
    public function setFacture($facture)
    {
        $this->facture = $facture;
    
        return $this;
    }

    /**
     * Get facture
     *
     * @return integer 
     */
    public function getFacture()
    {
        return $this->facture;
    }

    /**
     * Set remise
     *
     * @param integer $remise
     * @return FactureRemise
     */
    public function setRemise($remise)
    {
        $this->remise = $remise;
    
        return $this;
    }

    /**
     * Get remise
     *
     * @return integer 
     */
    public function getRemise()
    {
        return $this->remise;
    }

    /**
     * Set montantRemise
     *
     * @param float $montantRemise
     * @return FactureRemise
     */
    public function setMontantRemise($montantRemise)
    {
        $this->montantRemise = $montantRemise;
    
        return $this;
    }

    /**
     * Get montantRemise
     *
     * @return float 
     */
    public function getMontantRemise()
    {
        return $this->montantRemise;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}

<?php

namespace Boutique\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Boutique\DatabaseBundle\Entity\Facture
 */
class Facture
{
    /**
     * @var \DateTime $date
     */
    private $date;

    /**
     * @var integer $client
     */
    private $client;

    /**
     * @var float $montant
     */
    private $montantFacture;

    /**
     * @var float $montantRemise
     */
    private $montantRemise;

    /**
     * @var integer $id
     */
    private $id;

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Facture
     */
    public function setDate($date)
    {
        $this->date = $date;
    
        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set client
     *
     * @param integer $client
     * @return Facture
     */
    public function setClient($client)
    {
        $this->client = $client;
    
        return $this;
    }

    /**
     * Get client
     *
     * @return integer 
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set montantFacture
     *
     * @param float $montant
     * @return Facture
     */
    public function setMontantFacture($montant)
    {
        $this->montant = $montant;
    
        return $this;
    }

    /**
     * Get montantFacture
     *
     * @return float 
     */
    public function getMontantFacture()
    {
        return $this->montant;
    }

    /**
     * Set montantRemise
     *
     * @param float $montantRemise
     * @return Facture
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
    /**
     * @var boolean $valide
     */
    private $valide;


    /**
     * Set valide
     *
     * @param boolean $valide
     * @return Facture
     */
    public function setValide($valide)
    {
        $this->valide = $valide;
    
        return $this;
    }

    /**
     * Get valide
     *
     * @return boolean 
     */
    public function getValide()
    {
        return $this->valide;
    }
    
    
    public function init() {
        $this->montantFacture = 0;
        $this->montantRemise = 0;
        $this->date = new \DateTime('now');
        $this->valide = false;
        
        return $this;
    }
}
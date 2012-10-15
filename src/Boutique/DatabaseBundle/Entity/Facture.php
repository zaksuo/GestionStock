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
    private $montant;

    /**
     * @var float $tva
     */
    private $tva;

    /**
     * @var float $montantRemise
     */
    private $montantRemise;

    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var Boutique\DatabaseBundle\Entity\Remise
     */
    private $idRemise;


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
     * Set montant
     *
     * @param float $montant
     * @return Facture
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;
    
        return $this;
    }

    /**
     * Get montant
     *
     * @return float 
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * Set tva
     *
     * @param float $tva
     * @return Facture
     */
    public function setTva($tva)
    {
        $this->tva = $tva;
    
        return $this;
    }

    /**
     * Get tva
     *
     * @return float 
     */
    public function getTva()
    {
        return $this->tva;
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
     * Set idRemise
     *
     * @param Boutique\DatabaseBundle\Entity\Remise $idRemise
     * @return Facture
     */
    public function setIdRemise(\Boutique\DatabaseBundle\Entity\Remise $idRemise = null)
    {
        $this->idRemise = $idRemise;
    
        return $this;
    }

    /**
     * Get idRemise
     *
     * @return Boutique\DatabaseBundle\Entity\Remise 
     */
    public function getIdRemise()
    {
        return $this->idRemise;
    }
}
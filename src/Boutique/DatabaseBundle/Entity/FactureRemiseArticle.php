<?php

namespace Boutique\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Boutique\DatabaseBundle\Entity\FactureRemiseArticle
 */
class FactureRemiseArticle
{
    
    /**
     * @var float
     */
    private $valeur;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Boutique\DatabaseBundle\Entity\Facture
     */
    private $facture;

    /**
     * @var \Boutique\DatabaseBundle\Entity\campagneArticle
     */
    private $campageArticle;


    /**
     * Set valeur
     *
     * @param float $valeur
     * @return FactureRemiseArticle
     */
    public function setValeur($valeur)
    {
        $this->valeur = $valeur;
    
        return $this;
    }

    /**
     * Get valeur
     *
     * @return float 
     */
    public function getValeur()
    {
        return $this->valeur;
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
     * Set facture
     *
     * @param \Boutique\DatabaseBundle\Entity\Facture $facture
     * @return FactureRemiseArticle
     */
    public function setFacture(\Boutique\DatabaseBundle\Entity\Facture $facture = null)
    {
        $this->facture = $facture;
    
        return $this;
    }

    /**
     * Get facture
     *
     * @return \Boutique\DatabaseBundle\Entity\Facture 
     */
    public function getFacture()
    {
        return $this->facture;
    }

    /**
     * Set campageArticle
     *
     * @param \Boutique\DatabaseBundle\Entity\campagneArticle $campageArticle
     * @return FactureRemiseArticle
     */
    public function setCampageArticle(\Boutique\DatabaseBundle\Entity\campagneArticle $campageArticle = null)
    {
        $this->campageArticle = $campageArticle;
    
        return $this;
    }

    /**
     * Get campageArticle
     *
     * @return \Boutique\DatabaseBundle\Entity\campagneArticle 
     */
    public function getCampageArticle()
    {
        return $this->campageArticle;
    }
    /**
     * @var \Boutique\DatabaseBundle\Entity\FactureArticle
     */
    private $factureArticle;


    /**
     * Set factureArticle
     *
     * @param \Boutique\DatabaseBundle\Entity\FactureArticle $factureArticle
     * @return FactureRemiseArticle
     */
    public function setFactureArticle(\Boutique\DatabaseBundle\Entity\FactureArticle $factureArticle = null)
    {
        $this->factureArticle = $factureArticle;
    
        return $this;
    }

    /**
     * Get factureArticle
     *
     * @return \Boutique\DatabaseBundle\Entity\FactureArticle 
     */
    public function getFactureArticle()
    {
        return $this->factureArticle;
    }
    /**
     * @var \Boutique\DatabaseBundle\Entity\campagneArticle
     */
    private $campagneArticle;


    /**
     * Set campagneArticle
     *
     * @param \Boutique\DatabaseBundle\Entity\campagneArticle $campagneArticle
     * @return FactureRemiseArticle
     */
    public function setCampagneArticle(\Boutique\DatabaseBundle\Entity\campagneArticle $campagneArticle = null)
    {
        $this->campagneArticle = $campagneArticle;
    
        return $this;
    }

    /**
     * Get campagneArticle
     *
     * @return \Boutique\DatabaseBundle\Entity\campagneArticle 
     */
    public function getCampagneArticle()
    {
        return $this->campagneArticle;
    }
}
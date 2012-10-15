<?php

namespace Boutique\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Boutique\DatabaseBundle\Entity\TypeTva
 */
class TypeTva
{
    /**
     * @var string $libelle
     */
    private $libelle;

    /**
     * @var integer $valeur
     */
    private $valeur;

    /**
     * @var integer $id
     */
    private $id;

    
    public function __toString() {
        return $this->libelle;        
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     * @return TypeTva
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    
        return $this;
    }

    /**
     * Get libelle
     *
     * @return string 
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set valeur
     *
     * @param integer $valeur
     * @return TypeTva
     */
    public function setValeur($valeur)
    {
        $this->valeur = $valeur;
    
        return $this;
    }

    /**
     * Get valeur
     *
     * @return integer 
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
}
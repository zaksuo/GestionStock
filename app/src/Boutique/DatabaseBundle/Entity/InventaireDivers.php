<?php

namespace Boutique\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InventaireDivers
 */
class InventaireDivers
{
    /**
     * @var string
     */
    private $libelle;

    /**
     * @var float
     */
    private $prixUnitaire;

    /**
     * @var float
     */
    private $quantite;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Boutique\DatabaseBundle\Entity\Inventaire
     */
    private $inventaire;


    /**
     * Set libelle
     *
     * @param string $libelle
     * @return InventaireDivers
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
     * Set prixUnitaire
     *
     * @param float $prixUnitaire
     * @return InventaireDivers
     */
    public function setPrixUnitaire($prixUnitaire)
    {
        $this->prixUnitaire = $prixUnitaire;
    
        return $this;
    }

    /**
     * Get prixUnitaire
     *
     * @return float 
     */
    public function getPrixUnitaire()
    {
        return $this->prixUnitaire;
    }

    /**
     * Set quantite
     *
     * @param float $quantite
     * @return InventaireDivers
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;
    
        return $this;
    }

    /**
     * Get quantite
     *
     * @return float 
     */
    public function getQuantite()
    {
        return $this->quantite;
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
     * Set inventaire
     *
     * @param \Boutique\DatabaseBundle\Entity\Inventaire $inventaire
     * @return InventaireDivers
     */
    public function setInventaire(\Boutique\DatabaseBundle\Entity\Inventaire $inventaire = null)
    {
        $this->inventaire = $inventaire;
    
        return $this;
    }

    /**
     * Get inventaire
     *
     * @return \Boutique\DatabaseBundle\Entity\Inventaire 
     */
    public function getInventaire()
    {
        return $this->inventaire;
    }
}
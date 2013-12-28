<?php

namespace Boutique\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Inventaire
 */
class Inventaire
{
    /**
     * @var integer
     */
    private $annee;

    /**
     * @var \DateTime
     */
    private $dateCreation;

    /**
     * @var \DateTime
     */
    private $dateCloture;
    
    /**
     * @var float
     */
    private $valeurStock;
    
    /**
     * @var float
     */
    private $valeurPerteEstim;
    
    /**
     * @var boolean
     */
    private $cloture;

    /**
     * @var integer
     */
    private $id;
    
    private $invArticles;
    private $invDivers;
    

    /**
     * Set annee
     *
     * @param integer $annee
     * @return Inventaire
     */
    public function setAnnee($annee)
    {
        $this->annee = $annee;
    
        return $this;
    }

    /**
     * Get annee
     *
     * @return integer 
     */
    public function getAnnee()
    {
        return $this->annee;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     * @return Inventaire
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;
    
        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime 
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set dateCloture
     *
     * @param \DateTime $dateCloture
     * @return Inventaire
     */
    public function setDateCloture($dateCloture)
    {
        $this->dateCloture = $dateCloture;
    
        return $this;
    }

    /**
     * Get dateCloture
     *
     * @return \DateTime 
     */
    public function getDateCloture()
    {
        return $this->dateCloture;
    }

    /**
     * Set cloture
     *
     * @param boolean $cloture
     * @return Inventaire
     */
    public function setCloture($cloture)
    {
        $this->cloture = $cloture;
    
        return $this;
    }

    /**
     * Get cloture
     *
     * @return boolean 
     */
    public function getCloture()
    {
        return $this->cloture;
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
     * Get articles
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getInvArticles()
    {
        return $this->invArticles;
    }
    
    /**
     * Get divers
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getInvDivers()
    {
        return $this->invDivers;
    }
    
    /**
     * Get valeurStock
     *
     * @return float
     */
    public function getValeurStock() {
        return number_format($this->valeurStock, 2, ',', ' ');
    }
    
    /**
     * Set valeurStock
     *
     * @return float 
     */
    public function setValeurStock( $valeur ) {
        return $this->valeurStock = $valeur;
    }
    
    /**
     * Get valeurPerteEstim
     *
     * @return float
     */
    public function getValeurPerteEstim() {
        return number_format($this->valeurPerteEstim, 2, ',', ' ');
    }
    
    /**
     * Set valeurPerteEstim
     *
     * @return float 
     */
    public function setValeurPerteEstim( $valeur ) {
        return $this->valeurPerteEstim = $valeur;
    }
    
    public function clore() {
        $valeurStock = 0;
        $valeurPerte = 0;
        
        foreach( $this->invArticles as $article ) {
            $valeurStock += $article->getValeur();
            $valeurPerte += $article->getPerte();
        }

        foreach( $this->invDivers as $divers ) {
            $valeurStock += $divers->getValeur();
        }
        
        $this->valeurStock = $valeurStock;
        $this->valeurPerteEstim = $valeurPerte;
        $this->cloture = true;
        $this->dateCloture = new \DateTime('now');
        
        return $this;
    }
}
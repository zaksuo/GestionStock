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
    private $valeurAchat;
    
    /**
     * @var float
     */
    private $valeurPerteAchat;
    
    /**
     * @var float
     */
    private $valeurVente;
    
    /**
     * @var float
     */
    private $valeurPerteVente;
    
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
     * Get valeurAchat
     *
     * @return float
     */
    public function getValeurAchat() {
        return $this->valeurAchat;
    }
    
    /**
     * Set valeurAchat
     *
     * @return float 
     */
    public function setValeurAchat( $valeur ) {
        return $this->valeurAchat = $valeur;
    }
    
    /**
     * Get valeurPerteAchat
     *
     * @return float
     */
    public function getValeurPerteAchat() {
        return $this->valeurPerteAchat;
    }
    
    /**
     * Set valeurPerteAchat
     *
     * @return float 
     */
    public function setValeurPerteAchat( $valeur ) {
        return $this->valeurPerteAchat = $valeur;
    }
    
    /**
     * Get valeurVente
     *
     * @return float
     */
    public function getValeurVente() {
        return $this->valeurVente;
    }
    
    /**
     * Set valeurVente
     *
     * @return float 
     */
    public function setValeurVente( $valeur ) {
        return $this->valeurVente = $valeur;
    }
    
    /**
     * Get valeurPerteVente
     *
     * @return float
     */
    public function getValeurPerteVente() {
        return $this->valeurPerteVente;
    }
    
    /**
     * Set valeurPerteVente
     *
     * @return float 
     */
    public function setValeurPerteVente( $valeur ) {
        return $this->valeurPerteVente = $valeur;
    }
    
    public function clore() {
        $valeurAchat = 0;
        $valeurVente = 0;
        $valeurPerteAchat = 0;
        $valeurPerteVente = 0;
        
        foreach( $this->invArticles as $article ) {
            $valeurAchat += $article->getValeurAchat();
            $valeurVente += $article->getValeurVente();
            $valeurPerteAchat += $article->getPerteAchat();
            $valeurPerteVente += $article->getPerteVente();
        }

        foreach( $this->invDivers as $divers ) {
            $valeurStock += $divers->getValeur();
        }
        
        $this->valeurAchat = $valeurAchat;
        $this->valeurVente = $valeurVente;
        $this->valeurPerteAchat = $valeurPerteAchat;
        $this->valeurPerteVente = $valeurPerteVente;
        $this->cloture = true;
        $this->dateCloture = new \DateTime('now');
        
        return $this;
    }
}
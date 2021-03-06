<?php

namespace Boutique\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InventaireArticle
 */
class InventaireArticle
{
    /**
     * @var float
     */
    private $prixVente;

    /**
     * @var float
     */
    private $quantite;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Boutique\DatabaseBundle\Entity\Article
     */
    private $article;

    /**
     * @var \Boutique\DatabaseBundle\Entity\Inventaire
     */
    private $inventaire;


    /**
     * Set prixUnitaire
     *
     * @param float $prixVente
     * @return InventaireArticle
     */
    public function setPrixVente($prixVente)
    {
        $this->prixVente = $prixVente;
    
        return $this;
    }

    /**
     * Get prixVente
     *
     * @return float 
     */
    public function getPrixVente()
    {
        return $this->prixVente;
        
    }

    /**
     * Set quantite
     *
     * @param float $quantite
     * @return InventaireArticle
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
     * Set article
     *
     * @param \Boutique\DatabaseBundle\Entity\Article $article
     * @return InventaireArticle
     */
    public function setArticle(\Boutique\DatabaseBundle\Entity\Article $article = null)
    {
        $this->article = $article;
    
        return $this;
    }

    /**
     * Get article
     *
     * @return \Boutique\DatabaseBundle\Entity\Article 
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Set inventaire
     *
     * @param \Boutique\DatabaseBundle\Entity\Inventaire $inventaire
     * @return InventaireArticle
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
    /**
     * @var float
     */
    private $quantiteEstim;

    /**
     * @var float
     */
    private $quantiteReelle;


    /**
     * Set quantiteEstim
     *
     * @param float $quantiteEstim
     * @return InventaireArticle
     */
    public function setQuantiteEstim($quantiteEstim)
    {
        $this->quantiteEstim = $quantiteEstim;
    
        return $this;
    }

    /**
     * Get quantiteEstim
     *
     * @return float 
     */
    public function getQuantiteEstim()
    {
        return $this->quantiteEstim;
    }

    /**
     * Set quantiteReelle
     *
     * @param float $quantiteReelle
     * @return InventaireArticle
     */
    public function setQuantiteReelle($quantiteReelle)
    {
        $this->quantiteReelle = $quantiteReelle;
    
        return $this;
    }

    /**
     * Get quantiteReelle
     *
     * @return float 
     */
    public function getQuantiteReelle()
    {
        return $this->quantiteReelle;
    }
    
    public function getValeurAchat() {
        $valeur = 0;
        
        if( !is_null($this->quantiteReelle) ) {
            $valeur = $this->quantiteReelle * $this->prixAchat;
        }
        else {
            $valeur = $this->quantiteEstim * $this->prixAchat;
        }
        
        return $valeur;
    }
    
    public function getValeurVente() {
        $valeur = 0;
        
        if( !is_null($this->quantiteReelle) ) {
            $valeur = $this->quantiteReelle * $this->prixVente;
        }
        else {
            $valeur = $this->quantiteEstim * $this->prixVente;
        }
        
        return $valeur;
    }
    
    public function getPerteAchat() {
        $valeur = 0;
        
        if( !is_null($this->quantiteReelle) ) {
            $valeur = ($this->quantiteReelle - $this->quantiteEstim) * $this->prixAchat;
        }
        if( $valeur < 0 ) {
            return abs($valeur);
        }
        else return 0;
    }
    
    public function getPerteVente() {
        $valeur = 0;
        
        if( !is_null($this->quantiteReelle) ) {
            $valeur = ($this->quantiteReelle - $this->quantiteEstim) * $this->prixVente;
        }
        if( $valeur < 0 ) {
            return abs($valeur);
        }
        else return 0;
    }
    
    public function hasError() {
        if( !is_null($this->quantiteReelle) ) {
            if( $this->quantiteEstim - $this->quantiteReelle != 0 ) { 
                return true;
            }
            else return false;
        }
        else return false;
    }
    
    public function getError() {
        return $this->quantiteReelle - $this->quantiteEstim;
    }
    /**
     * @var float
     */
    private $prixAchat;


    /**
     * Set prixAchat
     *
     * @param float $prixAchat
     * @return InventaireArticle
     */
    public function setPrixAchat($prixAchat)
    {
        $this->prixAchat = $prixAchat;
    
        return $this;
    }

    /**
     * Get prixAchat
     *
     * @return float 
     */
    public function getPrixAchat()
    {
        return $this->prixAchat;
    }
}
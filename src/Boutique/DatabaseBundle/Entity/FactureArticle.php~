<?php

namespace Boutique\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Boutique\DatabaseBundle\Entity\FactureArticle
 */
class FactureArticle
{
    /**
     * @var integer $quantite
     */
    private $quantite;

    /**
     * @var integer $id
     */
    private $id;

    /**
    * @var float $prixUnitaire
    */
    private $prixUnitaire;

    /**
    * @var float $tvaUnitaire
    */
    private $tvaUnitaire;
        
    /**
     * @var Boutique\DatabaseBundle\Entity\Facture
     */
    private $facture;

    /**
     * @var Boutique\DatabaseBundle\Entity\Article
     */
    private $article;
    
    
    /**
     * Set quantite
     *
     * @param integer $quantite
     * @return FactureArticle
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;
    
        return $this;
    }

    /**
     * Get quantite
     *
     * @return integer 
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
     * Set prixUnitaire
     *
     * @param integer $prixUnitaire
     * @return FactureArticle
     */
    public function setPrixUnitaire($prixUnitaire)
    {
        $this->prixUnitaire = $prixUnitaire;
    
        return $this;
    }

    /**
     * Get prixUnitaire
     *
     * @return integer 
     */
    public function getPrixUnitaire()
    {
        return $this->prixUnitaire;
    }

    /**
     * Set facture
     *
     * @param Boutique\DatabaseBundle\Entity\Facture $facture
     * @return FactureArticle
     */
    public function setFacture(\Boutique\DatabaseBundle\Entity\Facture $facture = null)
    {
        $this->facture = $facture;
    
        return $this;
    }

    /**
     * Get facture
     *
     * @return Boutique\DatabaseBundle\Entity\Facture 
     */
    public function getFacture()
    {
        return $this->facture;
    }

    /**
     * Set article
     *
     * @param Boutique\DatabaseBundle\Entity\Article $article
     * @return FactureArticle
     */
    public function setArticle(\Boutique\DatabaseBundle\Entity\Article $article = null)
    {
        $this->article = $article;
    
        return $this;
    }

    /**
     * Get article
     *
     * @return Boutique\DatabaseBundle\Entity\Article 
     */
    public function getArticle()
    {
        return $this->article;
    }
    
    /**
     * Set tvaUnitaire
     *
     * @param float $tvaUnitaire
     * @return FactureArticle
     */
    public function setTvaUnitaire($tvaUnitaire)
    {
        $this->tvaUnitaire = $tvaUnitaire;
    
        return $this;
    }

    /**
     * Get tvaUnitaire
     *
     * @return float 
     */
    public function getTvaUnitaire()
    {
        return $this->tvaUnitaire;
    }
    
    
    public function getTotalPrixArticleTTC() {
        return round($this->quantite * $this->prixUnitaire, 2);
    }
    
    public function getTotalPrixArticleHT() {
        return round($this->quantite * ( $this->prixUnitaire - $this->tvaUnitaire ), 2);
    }
    
    public function getPrixArticleHT() {
        return round( $this->prixUnitaire - $this->tvaUnitaire, 2);
    }
    
    public function getTvaArticle() {
        return round($this->tvaUnitaire, 2);
    }
    
    public function getTotalTvaArticle() {
        return round( $this->tvaUnitaire * $this->quantite, 2 );
    }
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $factureRemiseArticles;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->factureRemiseArticles = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add factureRemiseArticles
     *
     * @param \Boutique\DatabaseBundle\Entity\FactureRemiseArticle $factureRemiseArticles
     * @return FactureArticle
     */
    public function addFactureRemiseArticle(\Boutique\DatabaseBundle\Entity\FactureRemiseArticle $factureRemiseArticles)
    {
        $this->factureRemiseArticles[] = $factureRemiseArticles;
    
        return $this;
    }

    /**
     * Remove factureRemiseArticles
     *
     * @param \Boutique\DatabaseBundle\Entity\FactureRemiseArticle $factureRemiseArticles
     */
    public function removeFactureRemiseArticle(\Boutique\DatabaseBundle\Entity\FactureRemiseArticle $factureRemiseArticles)
    {
        $this->factureRemiseArticles->removeElement($factureRemiseArticles);
    }

    /**
     * Get factureRemiseArticles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFactureRemiseArticles()
    {
        return $this->factureRemiseArticles;
    }
}
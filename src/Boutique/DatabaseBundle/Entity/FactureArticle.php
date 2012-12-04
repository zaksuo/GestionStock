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

    private $prixUnitaire;

    /**
     * @var Boutique\DatabaseBundle\Entity\Facture
     */
    private $facture;

    /**
     * @var Boutique\DatabaseBundle\Entity\Article
     */
    private $article;


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
        return number_format($this->prixUnitaire, 2);
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
    
    public function getArticlePrixTotal() {
        return number_format(round($this->quantite * $this->prixUnitaire, 2), 2);
    }
    
    public function getTva() {
        return number_format(round($this->prixUnitaire * $this->getArticle()->getTypeTva()->getValeur() / 100, 2), 2);
    }
    
    public function getTotalArticleTva() {
        return number_format(round( $this->prixUnitaire * $this->getArticle()->getTypeTva()->getValeur() / 100 * $this->quantite, 2 ), 2);
    }
    
    public function getPrixUnitaireTTC() {
        return number_format(round( $this->getPrixUnitaire() + $this->getTva() ,2),2);
    }
    
    public function getTotalArticleTTC() {
        return number_format(round( $this->getPrixUnitaireTTC() * $this->quantite ,2),2);
    }
} 
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
    
    private $factArticles;
    private $factRemises;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->articles = new \Doctrine\Common\Collections\ArrayCollection();
        $this->remises = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
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
     * @param Boutique\DatabaseBundle\Entity\Client $client
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
        $this->montantFactureHT = 0;
        $this->montantFactureTTC = 0;
        $this->montantRemiseHT = 0;
        $this->montantRemiseTTC = 0;
        $this->date = new \DateTime('now');
        $this->valide = false;
        
        return $this;
    }
    
    /**
     * Add articles
     *
     * @param Boutique\DatabaseBundle\Entity\FactureArticle $article
     * @return Facture
     */
    public function addFactArticle(\Boutique\DatabaseBundle\Entity\FactureArticle $article)
    {
        $this->articles[] = $article;
    
        return $this;
    }

    /**
     * Remove articles
     *
     * @param Boutique\DatabaseBundle\Entity\FactureArticle $article
     */
    public function removeFactArticle(\Boutique\DatabaseBundle\Entity\FactureArticle $article)
    {
        $this->articles->removeElement($article);
    }

    /**
     * Get articles
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getFactArticles()
    {
        return $this->factArticles;
    }

    /**
     * Add remises
     *
     * @param Boutique\DatabaseBundle\Entity\FactureRemise $remise
     * @return Facture
     */
    public function addFactRemise(\Boutique\DatabaseBundle\Entity\FactureRemise $remise)
    {
        $this->remises[] = $remise;
    
        return $this;
    }

    /**
     * Remove remises
     *
     * @param Boutique\DatabaseBundle\Entity\FactureRemise $remise
     */
    public function removeFactRemise(\Boutique\DatabaseBundle\Entity\FactureRemise $remise)
    {
        $this->remises->removeElement($remise);
    }

    /**
     * Get remises
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getFactRemises()
    {
        return $this->factRemises;
    }
    
    public function hasFactArticles() {
        if( count($this->factArticles) > 0 )
            return true;
        return false;
    }
    
    public function hasFactRemises() {
        if( count($this->factRemises) > 0 )
            return true;
        return false;
    }
    
    public function getPrixTotalHt() {
        $prix_total_ht = 0;
        
        if( count( $this->getFactArticles() ) > 0 ) {
            foreach($this->factArticles as $article) {
                $prix_total_ht += $article->getQuantite() * $article->getPrixUnitaire();
            }
        }
        
        return round( $prix_total_ht, 2 );
    }
    
    public function getTvaTotal() {
        $tva_total = 0;
        if( count( $this->getFactArticles() ) > 0 ) {
            foreach($this->factArticles as $article) {
                $tva_total += $article->getArticle()->getTypeTva()->getValeur() * ($article->getQuantite() * $article->getPrixUnitaire()) /100;
            }
        }
        return round( $tva_total, 2 );
    }
    
    public function getPrixTotalTtc() {
        $prix_total = $this->getPrixTotalHt() + $this->getTvaTotal();
        return round( $prix_total, 2 );
    }
    /**
     * @var float $montantFactureHT
     */
    private $montantFactureHT;

    /**
     * @var float $montantFactureTTC
     */
    private $montantFactureTTC;

    /**
     * @var float $montantRemiseHT
     */
    private $montantRemiseHT;

    /**
     * @var float $montantRemiseTTC
     */
    private $montantRemiseTTC;


    /**
     * Set montantFactureHT
     *
     * @param float $montantFactureHT
     * @return Facture
     */
    public function setMontantFactureHT($montantFactureHT)
    {
        $this->montantFactureHT = $montantFactureHT;
    
        return $this;
    }

    /**
     * Get montantFactureHT
     *
     * @return float 
     */
    public function getMontantFactureHT()
    {
        return $this->montantFactureHT;
    }

    /**
     * Set montantFactureTTC
     *
     * @param float $montantFactureTTC
     * @return Facture
     */
    public function setMontantFactureTTC($montantFactureTTC)
    {
        $this->montantFactureTTC = $montantFactureTTC;
    
        return $this;
    }

    /**
     * Get montantFactureTTC
     *
     * @return float 
     */
    public function getMontantFactureTTC()
    {
        return $this->montantFactureTTC;
    }

    /**
     * Set montantRemiseHT
     *
     * @param float $montantRemiseHT
     * @return Facture
     */
    public function setMontantRemiseHT($montantRemiseHT)
    {
        $this->montantRemiseHT = $montantRemiseHT;
    
        return $this;
    }

    /**
     * Get montantRemiseHT
     *
     * @return float 
     */
    public function getMontantRemiseHT()
    {
        return $this->montantRemiseHT;
    }

    /**
     * Set montantRemiseTTC
     *
     * @param float $montantRemiseTTC
     * @return Facture
     */
    public function setMontantRemiseTTC($montantRemiseTTC)
    {
        $this->montantRemiseTTC = $montantRemiseTTC;
    
        return $this;
    }

    /**
     * Get montantRemiseTTC
     *
     * @return float 
     */
    public function getMontantRemiseTTC()
    {
        return $this->montantRemiseTTC;
    }
}
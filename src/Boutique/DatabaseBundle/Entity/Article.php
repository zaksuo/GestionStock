<?php

namespace Boutique\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Boutique\DatabaseBundle\Entity\Article
 */
class Article
{
    /**
     * @var string $code
     */
    private $code;

    /**
     * @var string $libelle
     */
    private $libelle;

    /**
     * @var string $desc
     */
    private $description;

    /**
     * @var float $prixVente
     */
    private $prixVente;

    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var Boutique\DatabaseBundle\Entity\TypeArticle
     */
    private $typeArticle;

    /**
     * @var Boutique\DatabaseBundle\Entity\TypeTva
     */
    private $typeTva;

    private $new_stock;
    private $stocks;
    
    
    /**
     * Set code
     *
     * @param string $code
     * @return Article
     */
    public function setCode($code)
    {
        $this->code = $code;
    
        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     * @return Article
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
     * Set desc
     *
     * @param string $description
     * @return Article
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get desc
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set prixVente
     *
     * @param float $prixVente
     * @return Article
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set typeArticle
     *
     * @param Boutique\DatabaseBundle\Entity\TypeArticle $typeArticle
     * @return Article
     */
    public function setTypeArticle(\Boutique\DatabaseBundle\Entity\TypeArticle $typeArticle = null)
    {
        $this->typeArticle = $typeArticle;
    
        return $this;
    }

    /**
     * Get typeArticle
     *
     * @return Boutique\DatabaseBundle\Entity\TypeArticle 
     */
    public function getTypeArticle()
    {
        return $this->typeArticle;
    }

    /**
     * Set typeTva
     *
     * @param Boutique\DatabaseBundle\Entity\TypeTva $typeTva
     * @return Article
     */
    public function setTypeTva(\Boutique\DatabaseBundle\Entity\TypeTva $typeTva = null)
    {
        $this->typeTva = $typeTva;
    
        return $this;
    }

    /**
     * Get typeTva
     *
     * @return Boutique\DatabaseBundle\Entity\TypeTva 
     */
    public function getTypeTva()
    {
        return $this->typeTva;
    }
    
    /**
     * Get stock
     *
     * @return Boutique\DatabaseBundle\Entity\Stock 
     */
    public function getNewStock() {
        return $this->new_stock;
    }
    
    /**
     * Set stock
     *
     * @return Boutique\DatabaseBundle\Entity\Stock 
     */
    public function setNewStock($new_stock) {
        $this->new_stock = $new_stock;
    }
    
    public function getStocks() {
        return $this->stocks;
    }
    
    public function setStocks($stocks) {
        $this->stock = $stocks;
    }
    
    /**
     * @var Boutique\DatabaseBundle\Entity\ArticleStock
     */
    private $articleStock;


    /**
     * Set articleStock
     *
     * @param Boutique\DatabaseBundle\Entity\ArticleStock $articleStock
     * @return Article
     */
    public function setArticleStock(\Boutique\DatabaseBundle\Entity\ArticleStock $articleStock = null)
    {
        $this->articleStock = $articleStock;
    
        return $this;
    }

    /**
     * Get articleStock
     *
     * @return Boutique\DatabaseBundle\Entity\ArticleStock 
     */
    public function getArticleStock()
    {
        return $this->articleStock;
    }
}
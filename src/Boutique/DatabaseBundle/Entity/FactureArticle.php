<?php

namespace Boutique\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Boutique\DatabaseBundle\Entity\FactureArticle
 */
class FactureArticle
{
    /**
     * @var integer $idRemise
     */
    private $idRemise;

    /**
     * @var integer $quantite
     */
    private $quantite;

    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var Boutique\DatabaseBundle\Entity\Article
     */
    private $idArticle;

    /**
     * @var Boutique\DatabaseBundle\Entity\Facture
     */
    private $idFacture;

    /**
     * @var Boutique\DatabaseBundle\Entity\Stock
     */
    private $idStock;


    /**
     * Set idRemise
     *
     * @param integer $idRemise
     * @return FactureArticle
     */
    public function setIdRemise($idRemise)
    {
        $this->idRemise = $idRemise;
    
        return $this;
    }

    /**
     * Get idRemise
     *
     * @return integer 
     */
    public function getIdRemise()
    {
        return $this->idRemise;
    }

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
     * Set idArticle
     *
     * @param Boutique\DatabaseBundle\Entity\Article $idArticle
     * @return FactureArticle
     */
    public function setIdArticle(\Boutique\DatabaseBundle\Entity\Article $idArticle = null)
    {
        $this->idArticle = $idArticle;
    
        return $this;
    }

    /**
     * Get idArticle
     *
     * @return Boutique\DatabaseBundle\Entity\Article 
     */
    public function getIdArticle()
    {
        return $this->idArticle;
    }

    /**
     * Set idFacture
     *
     * @param Boutique\DatabaseBundle\Entity\Facture $idFacture
     * @return FactureArticle
     */
    public function setIdFacture(\Boutique\DatabaseBundle\Entity\Facture $idFacture = null)
    {
        $this->idFacture = $idFacture;
    
        return $this;
    }

    /**
     * Get idFacture
     *
     * @return Boutique\DatabaseBundle\Entity\Facture 
     */
    public function getIdFacture()
    {
        return $this->idFacture;
    }

    /**
     * Set idStock
     *
     * @param Boutique\DatabaseBundle\Entity\Stock $idStock
     * @return FactureArticle
     */
    public function setIdStock(\Boutique\DatabaseBundle\Entity\Stock $idStock = null)
    {
        $this->idStock = $idStock;
    
        return $this;
    }

    /**
     * Get idStock
     *
     * @return Boutique\DatabaseBundle\Entity\Stock 
     */
    public function getIdStock()
    {
        return $this->idStock;
    }
}
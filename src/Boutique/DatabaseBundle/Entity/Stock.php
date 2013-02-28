<?php

namespace Boutique\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Boutique\DatabaseBundle\Entity\Stock
 */
class Stock
{
    /**
     * @var \DateTime $dateEntree
     */
    private $dateEntree;

    /**
     * @var integer $quantite
     */
    private $quantite;

    /**
     * @var float $prixAchat
     */
    private $prixAchat;

    /**
     * @var boolean $delottage
     */
    private $delottage;

    /**
     * @var \DateTime $dateDerniereSortie
     */
    private $dateDerniereSortie;

    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var Boutique\DatabaseBundle\Entity\Article
     */
    private $idArticle;


    /**
     * Set dateEntree
     *
     * @param \DateTime $dateEntree
     * @return Stock
     */
    public function setDateEntree($dateEntree)
    {
        $this->dateEntree = $dateEntree;
    
        return $this;
    }

    /**
     * Get dateEntree
     *
     * @return \DateTime 
     */
    public function getDateEntree()
    {
        return $this->dateEntree;
    }

    /**
     * Set quantite
     *
     * @param integer $quantite
     * @return Stock
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
     * Set prixAchat
     *
     * @param float $prixAchat
     * @return Stock
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

    /**
     * Set delottage
     *
     * @param boolean $delottage
     * @return Stock
     */
    public function setDelottage($delottage)
    {
        $this->delottage = $delottage;
    
        return $this;
    }

    /**
     * Get delottage
     *
     * @return boolean 
     */
    public function getDelottage()
    {
        return $this->delottage;
    }

    /**
     * Set dateDerniereSortie
     *
     * @param \DateTime $dateDerniereSortie
     * @return Stock
     */
    public function setDateDerniereSortie($dateDerniereSortie)
    {
        $this->dateDerniereSortie = $dateDerniereSortie;
    
        return $this;
    }

    /**
     * Get dateDerniereSortie
     *
     * @return \DateTime 
     */
    public function getDateDerniereSortie()
    {
        return $this->dateDerniereSortie;
    }

    /**
     * Set id
     *
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this->id;
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
     * @return Stock
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
     * @var \DateTime
     */
    private $dateModif;

    /**
     * @var string
     */
    private $commentaire;


    /**
     * Set dateModif
     *
     * @param \DateTime $dateModif
     * @return Stock
     */
    public function setDateModif($dateModif)
    {
        $this->dateModif = $dateModif;
    
        return $this;
    }

    /**
     * Get dateModif
     *
     * @return \DateTime 
     */
    public function getDateModif()
    {
        return $this->dateModif;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     * @return Stock
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;
    
        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string 
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }
}
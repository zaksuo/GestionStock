<?php

namespace Boutique\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fournisseur
 */
class Fournisseur
{
    /**
     * @var string
     */
    private $nom;

    /**
     * @var integer
     */
    private $id;
    private $articles;

    public function __toString() {
        return $this->nom;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Fournisseur
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    
        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
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
     * @return string 
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function setArticles($articles)
    {
        return $this->articles = $articles;
    }
    
    /**
     * @var string
     */
    private $siren;

    /**
     * @var string
     */
    private $telephone;


    /**
     * Set siren
     *
     * @param string $siren
     * @return Fournisseur
     */
    public function setSiren($siren)
    {
        $this->siren = $siren;
    
        return $this;
    }

    /**
     * Get siren
     *
     * @return string 
     */
    public function getSiren()
    {
        return $this->siren;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     * @return Fournisseur
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    
        return $this;
    }

    /**
     * Get telephone
     *
     * @return string 
     */
    public function getTelephone()
    {
        return $this->telephone;
    }
}
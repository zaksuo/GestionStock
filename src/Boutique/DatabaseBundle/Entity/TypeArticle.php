<?php

namespace Boutique\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Boutique\DatabaseBundle\Entity\TypeArticle
 */
class TypeArticle
{
    /**
     * @var string $libelle
     */
    private $libelle;

    /**
     * @var string $desc
     */
    private $desc;

    /**
     * @var integer $id
     */
    private $id;

    public function __toString() {
        return $this->libelle;
    }
    
    
    /**
     * Set libelle
     *
     * @param string $libelle
     * @return TypeArticle
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
     * @param string $desc
     * @return TypeArticle
     */
    public function setDesc($desc)
    {
        $this->desc = $desc;
    
        return $this;
    }

    /**
     * Get desc
     *
     * @return string 
     */
    public function getDesc()
    {
        return $this->desc;
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
     * @var string $description
     */
    private $description;


    /**
     * Set description
     *
     * @param string $description
     * @return TypeArticle
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }
}
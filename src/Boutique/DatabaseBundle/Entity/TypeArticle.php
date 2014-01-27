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
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $children;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
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
    /**
     * @var integer
     */
    private $parent;


    /**
     * Set parent
     *
     * @param integer $parent
     * @return TypeArticle
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
    
        return $this;
    }

    /**
     * Get parent
     *
     * @return integer 
     */
    public function getParent()
    {
        return $this->parent;
    }

    public function hasChildren()
    {
        if(count($this->children) > 0) {
            return true;
        }
        else return false;
    }
    
    /**
     * Add children
     *
     * @param \Boutique\DatabaseBundle\Entity\TypeArticle $children
     * @return TypeArticle
     */
    public function addChildren(\Boutique\DatabaseBundle\Entity\TypeArticle $children)
    {
        $this->children[] = $children;
    
        return $this;
    }

    /**
     * Remove children
     *
     * @param \Boutique\DatabaseBundle\Entity\TypeArticle $children
     */
    public function removeChildren(\Boutique\DatabaseBundle\Entity\TypeArticle $children)
    {
        $this->children->removeElement($children);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChildren()
    {
        return $this->children;
    }
}
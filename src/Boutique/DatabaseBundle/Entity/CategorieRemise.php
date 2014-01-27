<?php

namespace Boutique\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Boutique\DatabaseBundle\Entity\CategorieRemise
 */
class CategorieRemise
{
    /**
     * @var string
     */
    private $libelle;

    /**
     * @var integer
     */
    private $id;

    
    public function __toString() {
        return $this->libelle;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     * @return CategorieRemise
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}
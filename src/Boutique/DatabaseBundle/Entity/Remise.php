<?php

namespace Boutique\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Boutique\DatabaseBundle\Entity\Remise
 */
class Remise
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Boutique\DatabaseBundle\Entity\TypeRemise
     */
    private $typeRemise;

    /**
     * @var \Boutique\DatabaseBundle\Entity\CategorieRemise
     */
    private $categorieRemise;

    public function __toString() {
        return "Remise : ".$this->value." ".$this->typeRemise->getSigle()." sur ".strtolower($this->categorieRemise->getLibelle());
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
     * Set typeRemise
     *
     * @param \Boutique\DatabaseBundle\Entity\TypeRemise $typeRemise
     * @return Remise
     */
    public function setTypeRemise(\Boutique\DatabaseBundle\Entity\TypeRemise $typeRemise = null)
    {
        $this->typeRemise = $typeRemise;
    
        return $this;
    }

    /**
     * Get typeRemise
     *
     * @return \Boutique\DatabaseBundle\Entity\TypeRemise 
     */
    public function getTypeRemise()
    {
        return $this->typeRemise;
    }

    /**
     * Set categorieRemise
     *
     * @param \Boutique\DatabaseBundle\Entity\CategorieRemise $categorieRemise
     * @return Remise
     */
    public function setCategorieRemise(\Boutique\DatabaseBundle\Entity\CategorieRemise $categorieRemise = null)
    {
        $this->categorieRemise = $categorieRemise;
    
        return $this;
    }

    /**
     * Get categorieRemise
     *
     * @return \Boutique\DatabaseBundle\Entity\CategorieRemise 
     */
    public function getCategorieRemise()
    {
        return $this->categorieRemise;
    }
    /**
     * @var string
     */
    private $value;


    /**
     * Set value
     *
     * @param string $value
     * @return Remise
     */
    public function setValue($value)
    {
        $this->value = $value;
    
        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }
}
<?php

namespace Boutique\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Boutique\DatabaseBundle\Entity\Remise
 */
class Remise
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var Boutique\DatabaseBundle\Entity\TypeRemise
     */
    private $typeRemise;


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
     * @param Boutique\DatabaseBundle\Entity\TypeRemise $typeRemise
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
     * @return Boutique\DatabaseBundle\Entity\TypeRemise 
     */
    public function getTypeRemise()
    {
        return $this->typeRemise;
    }
}
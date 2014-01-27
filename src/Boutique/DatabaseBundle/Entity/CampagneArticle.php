<?php

namespace Boutique\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Boutique\DatabaseBundle\Entity\CampagneArticle
 */
class CampagneArticle
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Boutique\DatabaseBundle\Entity\CampagneRemise
     */
    private $campagneRemise;

    /**
     * @var \Boutique\DatabaseBundle\Entity\Article
     */
    private $article;


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
     * Set campagneRemise
     *
     * @param \Boutique\DatabaseBundle\Entity\CampagneRemise $campagneRemise
     * @return CampagneArticle
     */
    public function setCampagneRemise(\Boutique\DatabaseBundle\Entity\CampagneRemise $campagneRemise = null)
    {
        $this->campagneRemise = $campagneRemise;
    
        return $this;
    }

    /**
     * Get campagneRemise
     *
     * @return \Boutique\DatabaseBundle\Entity\CampagneRemise 
     */
    public function getCampagneRemise()
    {
        return $this->campagneRemise;
    }

    /**
     * Set article
     *
     * @param \Boutique\DatabaseBundle\Entity\Article $article
     * @return CampagneArticle
     */
    public function setArticle(\Boutique\DatabaseBundle\Entity\Article $article = null)
    {
        $this->article = $article;
    
        return $this;
    }

    /**
     * Get article
     *
     * @return \Boutique\DatabaseBundle\Entity\Article 
     */
    public function getArticle()
    {
        return $this->article;
    }
}
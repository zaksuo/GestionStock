<?php

namespace Boutique\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CampagneRemise
 */
class CampagneRemise
{
    /**
     * @var String
     */
    private $nomCampagne;

    /**
     * @var \DateTime
     */
    private $dateDebut;

    /**
     * @var \DateTime
     */
    private $dateFin;

    /**
     * @var boolean
     */
    private $active;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Boutique\DatabaseBundle\Entity\Remise
     */
    private $remise;

    /**
     * @return String
     */
    public function getNomCampagne()
    {
        return $this->nomCampagne;
    }

    /**
     * @param String $nomCampagne
     */
    public function setNomCampagne($nomCampagne)
    {
        $this->nomCampagne = $nomCampagne;
    }

    /**
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     * @return CampagneRemise
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;
    
        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime 
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     * @return CampagneRemise
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;
    
        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime 
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set active
     *
     * @param boolean $active
     * @return CampagneRemise
     */
    public function setActive($active)
    {
        $this->active = $active;
    
        return $this;
    }

    /**
     * Get active
     *
     * @return boolean 
     */
    public function getActive()
    {
        return $this->active;
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
     * Set remise
     *
     * @param \Boutique\DatabaseBundle\Entity\Remise $remise
     * @return CampagneRemise
     */
    public function setRemise(\Boutique\DatabaseBundle\Entity\Remise $remise = null)
    {
        $this->remise = $remise;
    
        return $this;
    }

    /**
     * Get remise
     *
     * @return \Boutique\DatabaseBundle\Entity\Remise 
     */
    public function getRemise()
    {
        return $this->remise;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $campagneArticles;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->campagneArticles = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add campagneArticles
     *
     * @param \Boutique\DatabaseBundle\Entity\CampagneArticle $campagneArticles
     * @return CampagneRemise
     */
    public function addCampagneArticle(\Boutique\DatabaseBundle\Entity\CampagneArticle $campagneArticles)
    {
        $this->campagneArticles[] = $campagneArticles;
    
        return $this;
    }

    /**
     * Remove campagneArticles
     *
     * @param \Boutique\DatabaseBundle\Entity\CampagneArticle $campagneArticles
     */
    public function removeCampagneArticle(\Boutique\DatabaseBundle\Entity\CampagneArticle $campagneArticles)
    {
        $this->campagneArticles->removeElement($campagneArticles);
    }

    /**
     * Get campagneArticles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCampagneArticles()
    {
        return $this->campagneArticles;
    }
    
    public function hasArticle( $id ) {
        foreach( $this->campagneArticles as $campArticle ) {
            $article_id = $campArticle->getArticle()->getId();
            if( $article_id == $id ) {
                return true;
            }
        }
        return false;
    }
}
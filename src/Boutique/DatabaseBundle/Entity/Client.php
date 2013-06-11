<?php

namespace Boutique\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Boutique\DatabaseBundle\Entity\Client
 */
class Client
{
    /**
     * @var string $nom
     */
    private $nom;

    /**
     * @var string $prenom
     */
    private $prenom;

    /**
     * @var string $mail
     */
    private $mail;

    /**
     * @var string $telephone
     */
    private $telephone;    
    
    /**
     * @var integer $id
     */
    private $id;
    /**
     * @var \DateTime $dateCreation
     */
    
    private $dateCreation;

    /**
     * @var integer $adresseNumero
     */
    private $adresseNumero;

    /**
     * @var string $adresseVoie
     */
    private $adresseVoie;

    /**
     * @var string $adresseComplement
     */
    private $adresseComplement;

    /**
     * @var string $codePostal
     */
    private $codePostal;

    /**
     * @var string $adresseVille
     */
    private $adresseVille;



    /**
     * Set nom
     *
     * @param string $nom
     * @return Client
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
     * Set prenom
     *
     * @param string $prenom
     * @return Client
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    
        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set mail
     *
     * @param string $mail
     * @return Client
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    
        return $this;
    }

    /**
     * Get mail
     *
     * @return string 
     */
    public function getMail()
    {
        return $this->mail;
    }
    
     /**
     * Set telephone
     *
     * @param string $telephone
     * @return Client
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
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     * @return Client
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;
    
        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime 
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set adresseNumero
     *
     * @param integer $adresseNumero
     * @return Client
     */
    public function setAdresseNumero($adresseNumero)
    {
        $this->adresseNumero = $adresseNumero;
    
        return $this;
    }

    /**
     * Get adresseNumero
     *
     * @return integer 
     */
    public function getAdresseNumero()
    {
        return $this->adresseNumero;
    }

    /**
     * Set adresseVoie
     *
     * @param string $adresseVoie
     * @return Client
     */
    public function setAdresseVoie($adresseVoie)
    {
        $this->adresseVoie = $adresseVoie;
    
        return $this;
    }

    /**
     * Get adresseVoie
     *
     * @return string 
     */
    public function getAdresseVoie()
    {
        return $this->adresseVoie;
    }

    /**
     * Set adresseComplement
     *
     * @param string $adresseComplement
     * @return Client
     */
    public function setAdresseComplement($adresseComplement)
    {
        $this->adresseComplement = $adresseComplement;
    
        return $this;
    }

    /**
     * Get adresseComplement
     *
     * @return string 
     */
    public function getAdresseComplement()
    {
        return $this->adresseComplement;
    }

    /**
     * Set codePostal
     *
     * @param string $codePostal
     * @return Client
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;
    
        return $this;
    }

    /**
     * Get codePostal
     *
     * @return string 
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * Set adresseVille
     *
     * @param string $adresseVille
     * @return Client
     */
    public function setAdresseVille($adresseVille)
    {
        $this->adresseVille = $adresseVille;
    
        return $this;
    }

    /**
     * Get adresseVille
     *
     * @return string 
     */
    public function getAdresseVille()
    {
        return $this->adresseVille;
    }
    /**
     * @var \DateTime $dateNaissance
     */
    private $dateNaissance;


    /**
     * Set dateNaissance
     *
     * @param \DateTime $dateNaissance
     * @return Client
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;
    
        return $this;
    }

    /**
     * Get dateNaissance
     *
     * @return \DateTime 
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }
}
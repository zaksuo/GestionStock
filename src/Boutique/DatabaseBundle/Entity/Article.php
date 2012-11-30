<?php

namespace Boutique\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Boutique\DatabaseBundle\Entity\Article
 */
class Article
{
    /**
     * @var string $code
     */
    private $code;

    /**
     * @var string $libelle
     */
    private $libelle;

    /**
     * @var string $desc
     */
    private $description;

    /**
     * @var float $prixVente
     */
    private $prixVente;

    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var Boutique\DatabaseBundle\Entity\TypeArticle
     */
    private $typeArticle;

    /**
     * @var Boutique\DatabaseBundle\Entity\TypeTva
     */
    private $typeTva;

    /**
     * @var Boutique\DatabaseBundle\Entity\Fournisseur
     */
    private $fournisseur;
    private $codeFournisseur;
    private $gencodeFournisseur;
    private $new_stock;
    private $stocks;
    
    
    /**
     * Set code
     *
     * @param string $code
     * @return Article
     */
    public function setCode($code)
    {
        $this->code = $code;
    
        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     * @return Article
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
     * @param string $description
     * @return Article
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get desc
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set prixVente
     *
     * @param float $prixVente
     * @return Article
     */
    public function setPrixVente($prixVente)
    {
        $this->prixVente = $prixVente;
    
        return $this;
    }

    /**
     * Get prixVente
     *
     * @return float 
     */
    public function getPrixVente()
    {
        return $this->prixVente;
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
     * Set typeArticle
     *
     * @param Boutique\DatabaseBundle\Entity\TypeArticle $typeArticle
     * @return Article
     */
    public function setTypeArticle(\Boutique\DatabaseBundle\Entity\TypeArticle $typeArticle = null)
    {
        $this->typeArticle = $typeArticle;
    
        return $this;
    }

    /**
     * Get typeArticle
     *
     * @return Boutique\DatabaseBundle\Entity\TypeArticle 
     */
    public function getTypeArticle()
    {
        return $this->typeArticle;
    }

    /**
     * Set typeTva
     *
     * @param Boutique\DatabaseBundle\Entity\TypeTva $typeTva
     * @return Article
     */
    public function setTypeTva(\Boutique\DatabaseBundle\Entity\TypeTva $typeTva = null)
    {
        $this->typeTva = $typeTva;
    
        return $this;
    }

    /**
     * Get typeTva
     *
     * @return Boutique\DatabaseBundle\Entity\TypeTva 
     */
    public function getTypeTva()
    {
        return $this->typeTva;
    }
    
    /**
     * Get stock
     *
     * @return Boutique\DatabaseBundle\Entity\Stock 
     */
    public function getNewStock() {
        return $this->new_stock;
    }
    
    /**
     * Set stock
     *
     * @return Boutique\DatabaseBundle\Entity\Stock 
     */
    public function setNewStock($new_stock) {
        $this->new_stock = $new_stock;
    }
    
    public function getStocks() {
        return $this->stocks;
    }
    
    public function setStocks($stocks) {
        $this->stock = $stocks;
    }
    
    /**
     * @var Boutique\DatabaseBundle\Entity\ArticleStock
     */
    private $articleStock;


    /**
     * Set articleStock
     *
     * @param Boutique\DatabaseBundle\Entity\ArticleStock $articleStock
     * @return Article
     */
    public function setArticleStock(\Boutique\DatabaseBundle\Entity\ArticleStock $articleStock = null)
    {
        $this->articleStock = $articleStock;
    
        return $this;
    }

    /**
     * Get articleStock
     *
     * @return Boutique\DatabaseBundle\Entity\ArticleStock 
     */
    public function getArticleStock()
    {
        return $this->articleStock;
    }
    /**
     * @var Boutique\DatabaseBundle\Entity\TypeVente
     */
    private $typeVente;


    /**
     * Set typeVente
     *
     * @param Boutique\DatabaseBundle\Entity\TypeVente $typeVente
     * @return Article
     */
    public function setTypeVente(\Boutique\DatabaseBundle\Entity\TypeVente $typeVente = null)
    {
        $this->typeVente = $typeVente;
    
        return $this;
    }

    /**
     * Get typeVente
     *
     * @return Boutique\DatabaseBundle\Entity\TypeVente 
     */
    public function getTypeVente()
    {
        return $this->typeVente;
    }
    
    /**
     * Set fournisseur
     *
     * @param Boutique\DatabaseBundle\Entity\Fournisseur $fournisseur
     * @return Article
     */
    public function setFournisseur(\Boutique\DatabaseBundle\Entity\Fournisseur $fournisseur = null)
    {
        $this->fournisseur = $fournisseur;
    
        return $this;
    }

    /**
     * Get fournisseur
     *
     * @return Boutique\DatabaseBundle\Entity\Fournisseur 
     */
    public function getFournisseur()
    {
        return $this->fournisseur;
    }
    
    /**
     * Set codeFournisseur
     *
     * @param $codeFournisseur
     * @return Article
     */
    public function setCodeFournisseur($codeFournisseur = null)
    {
        $this->codeFournisseur = $codeFournisseur;
    
        return $this;
    }

    /**
     * Get codeFournisseur
     *
     * @return codeFournisseur 
     */
    public function getCodeFournisseur()
    {
        return $this->codeFournisseur;
    }
    
    /**
     * Set codeFournisseur
     *
     * @param $codeFournisseur
     * @return Article
     */
    public function setGencodeFournisseur($gencodeFournisseur = null)
    {
        $this->gencodeFournisseur = $gencodeFournisseur;
    
        return $this;
    }

    /**
     * Get codeFournisseur
     *
     * @return codeFournisseur 
     */
    public function getGencodeFournisseur()
    {
        return $this->gencodeFournisseur;
    }
    
    public function getPrixTTC() {
        return number_format(round($this->prixVente + ($this->prixVente * $this->getTypeTva()->getValeur())/100, 2), 2);
    }
    
    private $alpha_num = array(
        'A' => 0, 'B' => 1, 'C' => 2, 'D' => 3, 'E' => 4, 'F' => 5, 'G' => 6, 'H' => 7, 'I' => 8, 'J' => 9, 'K' => 10, 'L' => 11, 'M' => 12,
        'N' => 13, 'O' => 14, 'P' => 15, 'Q' => 16, 'R' => 17, 'S' => 18, 'T' => 19, 'U' => 20, 'V' => 21, 'W' => 22, 'X' => 23, 'Y' => 24, 'Z' => 25
    );
    
    private $num_alpha = array(
        0 => 'A', 1 => 'B', 2 => 'C', 3 => 'D', 4 => 'E', 5 => 'F', 6 => 'G', 7 => 'H', 8 => 'I', 9 => 'J', 10 => 'K', 11 => 'L', 12 => 'M', 
        13 => 'N', 14 => 'O', 15 => 'P', 16 => 'Q', 17 => 'R', 18 => 'S', 19 => 'T', 20 => 'U', 21 => 'V', 22 => 'W', 23 => 'X', 24 => 'Y', 25 => 'Z'
    );
    
    public function generateNextCode($last_code) {
        $tab_code = str_split($last_code, 1);
        
        //var_dump($tab_code[5]); exit;

        if( $tab_code[5] < 9 ) {
            $tab_code[5] = $tab_code[5] + 1;
        }
        else {
            $tab_code[5] = 0;
            if( $tab_code[4] < 9 ) {
                $tab_code[4] = $tab_code[4] + 1;
            }
            else {
                $tab_code[4] = 0;
                if( $tab_code[3] < 9 ) {
                    $tab_code[3] = $tab_code[3] + 1;
                }
                else {
                    $tab_code[3] = 1;
                    if( $this->alpha_num[$tab_code[2]] < 25 ) {
                        $tab_code[2] = $this->num_alpha[$this->alpha_num[$tab_code[2]] + 1];
                    }
                    else {
                        $tab_code[2] = $this->num_alpha[1];
                        if( $this->alpha_num[$tab_code[1]] < 25 ) {
                            $tab_code[1] = $this->num_alpha[$this->alpha_num[$tab_code[1]] + 1];
                        }
                        else {
                            $tab_code[0] = $this->num_alpha[1];
                            if( $this->alpha_num[$tab_code[0]] < 25 ) {
                                $tab_code[0] = $this->num_alpha[$this->alpha_num[$tab_code[0]] + 1];
                            }
                            else {
                                return false;
                            }
                        }
                    }
                }
            }
        }
        return implode($tab_code);
    }
}
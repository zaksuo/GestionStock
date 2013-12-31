<?php

namespace Boutique\DatabaseBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ArticleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ArticleRepository extends EntityRepository
{	
    public function getArticlesForSearch( $search, $offset = 0, $limit = 0 ) {
        
        $search = $this->splitSearch( $search );
        
        
        $qb = $this->getEntityManager()
                ->createQueryBuilder()
                ->select('article')
                ->from('BoutiqueDatabaseBundle:Article', 'article');
            
            if( count($search) > 1 ) {
                $qb->where("article.libelle LIKE '%".$search[0]."%'")
                        ->orWhere("article.code LIKE '%".$search[0]."%'")
                        ->orWhere("article.description LIKE '%".$search[0]."%'");
                
                for( $i = 0; $i < count($search) - 1; $i++ ) {
                    $qb->orWhere("article.libelle LIKE '%".$search[$i]."%'");
                }
                for( $i = 0; $i < count($search) - 1; $i++ ) {
                    $qb->orWhere("article.code LIKE '%".$search[$i]."%'");
                }
                for( $i = 0; $i < count($search) - 1; $i++ ) {
                    $qb->orWhere("article.description LIKE '%".$search[$i]."%'");
                }
            }
            else {
                $qb->where("article.libelle LIKE '%".$search[0]."%'")
                        ->orWhere("article.code LIKE '%".$search[0]."%'")
                        ->orWhere("article.description LIKE '%".$search[0]."%'");
            }
                
            $qb->orderBy('article.code', 'ASC')
                ->setFirstResult($offset)
                ->setMaxResults($limit);

        //var_dump($qb->getQuery()->getSQL()); exit;

        $data = $qb->getQuery()->getResult();

        return $data;
    }
    
    public function getLastCode() {
        $qb = $this->getEntityManager()
                ->createQueryBuilder()
                ->select('article.code')
                ->from('BoutiqueDatabaseBundle:Article', 'article')
                ->orderBy("article.id", "DESC");
        $data = $qb->getQuery()->getArrayResult();

        return (isset($data[0]))?$data[0]['code']:null;
    }
    
    public function getArticlesForInventaire() {
        $qb = $this->getEntityManager()
                ->createQueryBuilder()
                ->select('article')
                ->from('BoutiqueDatabaseBundle:Article', 'article')
                ->join('article.articleStock', 'stock')
                ->join('article.typeTva', 'type_tva');
        $data = $qb->getQuery()->getResult();

        return $data;
    }
    
    private function splitSearch( $search ) {
        if( !empty($search) ) {
            $search = explode(' ', $search);
        }
        else {
            $search[0] = $search;
        }
        return $search;
    }
    
    public function getArticlesPerFournisseurForInventaire( $fournisseur, $inventaire ) {
        $qb = $this->getEntityManager()
                ->createQueryBuilder()
                ->select('inventaire_article')
                ->from('BoutiqueDatabaseBundle:InventaireArticle', 'inventaire_article')
                ->join('inventaire_article.article', 'article')
                ->join('inventaire_article.inventaire', 'inventaire')
                ->where('article.fournisseur = ' . $fournisseur)
                ->andWhere('inventaire.id = ' . $inventaire)
                ->orderBy('article.code');
        
        $data = $qb->getQuery()->getResult();
        
        return $data;
    }
    
    public function getVentesForArticle( $id ) {
        $qb = $this->getEntityManager()
                ->createQueryBuilder()
                ->select('facture_article.quantite, client.id AS client_id, client.nom, client.prenom, facture.dateValidation, facture.id AS facture_id')
                ->from('BoutiqueDatabaseBundle:FactureArticle', 'facture_article')
                ->join('facture_article.facture', 'facture')
                ->join('facture.client', 'client')
                ->where('facture_article.article = ' . $id)
                ->andWhere('facture.dateValidation IS NOT NULL')
                ->orderBy('facture.dateValidation', 'DESC');
        
        $data = $qb->getQuery()->getResult();
        
        return $data;
    }
    
}
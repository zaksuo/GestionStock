<?php

namespace Boutique\DatabaseBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ArticleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FournisseurRepository extends EntityRepository
{	
    public function getFournisseursForSearch( $search, $offset = 0, $limit = 0 ) {
        $qb = $this->getEntityManager()
                ->createQueryBuilder()
                ->select('fournisseur')
                ->from('BoutiqueDatabaseBundle:Fournisseur', 'fournisseur')
                ->where("fournisseur.nom LIKE '%".$search."%'")
                ->orWhere("fournisseur.siren LIKE '%".$search."%'")
                //->orWhere("article.codeFournisseur LIKE '%".$search."%'")
                ->orWhere("fournisseur.telephone LIKE '%".$search."%'")
                ->orderBy('fournisseur.nom', 'ASC')
                ->setFirstResult($offset)
                ->setMaxResults($limit);

        //var_dump($qb->getQuery()->getSQL()); exit;

        $data = $qb->getQuery()->getResult();

        return $data;
    }
}
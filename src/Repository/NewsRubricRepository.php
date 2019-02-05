<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class NewsRubricRepository extends EntityRepository
{

    public function getRubricNews()
    {
        $qb = $this->createQueryBuilder('rn');
        $qb->orderBy('rn.level', 'ASC');
        $qb->andWhere('rn.published = 1');

        return $qb->getQuery()->getResult();
    }

    public function getRubricProductFull()
    {
        $qb = $this->createQueryBuilder('rp');

        return $qb->getQuery()->getResult();
    }

    public function getIdProducts()
    {
        $qb = $this->createQueryBuilder('ip')->select('count(p.rubricProduct)');
        $qb->leftJoin(Product::class, 'p', 'WITH', 'p.rubricProduct = ip.id');
        $qb->groupBy('p.rubricProduct');
//        $out = [];
//        $idRubricProduct = $qb->getQuery()->getArrayResult();
//        foreach ($idRubricProduct as $row) {
//            $out[$row['id']] = $row['id'];
//        }
//        return $out;
        $result = $qb->getQuery()->getResult();

        return $result ? array_shift($result) : 0;


    }

    public function searchRubricName($terms)
    {
        $qb = $this->createQueryBuilder('r')
            ->select('r.title, r.description, r.headTitle');
//        if (!empty($terms['alias'])) {
//            $qb->where('r.alias in (:alias)');
//            $qb->setParameter('alias', $terms['alias']);
//        }
        if (!empty($terms['rubricAlias'])) {
            $qb->where('r.alias in (:alias)');
            $qb->setParameter('alias', $terms['rubricAlias']);
        }

        return $qb->getQuery()->getOneOrNullResult();
    }

    public function searchRubricNameInProduct($id)
    {
        $qb = $this->createQueryBuilder('r')
            ->select('r.title, r.alias');
        $qb->leftJoin(Product::class, 'p', 'WITH', 'p.rubricProduct = r.id');
        $qb->where('p.id = :id');
        $qb->setParameter('id', $id);


        return $qb->getQuery()->getOneOrNullResult();
    }

    public function countRubricProduct()
    {
        $qb = $this->createQueryBuilder('rc')->select('count(rc.id)');
        $result = $qb->getQuery()->getOneOrNullResult();

        return $result ? array_shift($result) : 0;
    }

    public function countProductInRubric()
    {
        $qb = $this->createQueryBuilder('rc')->select('count(p.rubricProduct)');
        $qb->leftJoin(Product::class, 'p', 'WITH', 'p.rubricProduct = rc.id');
//        $qb = $this->getRubricProduct();
        $qb->andWhere('pc.id in (:ids)');
        $qb->setParameter('ids', $idRubric);
        $result = $qb->getQuery()->getOneOrNullResult();

        return $result ? array_shift($result) : 0;
    }

}

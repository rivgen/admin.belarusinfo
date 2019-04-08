<?php

namespace App\Repository;

use App\Application\Sonata\UserBundle\Entity\User;
use App\Entity\City;
use App\Entity\Company;
use App\Entity\CompanyContent;
use App\Entity\CompanyTags;
use App\Entity\Product;
use App\Entity\ProductCompany;
use App\Entity\Region;
use App\Entity\RubricCompany;
use App\Entity\Rubrics;
use App\Entity\Tags;
use App\Entity\Tel;
use Doctrine\ORM\EntityRepository;

class JosContentRepository extends EntityRepository
{
    public function loginUser($loginId)
    {
        $qb = $this->createQueryBuilder('c')->select('u.username');
        $qb->leftJoin(User::class, 'u', 'WITH', 'c.createdBy = u.id')
            ->andWhere('c.createdBy = loginId')
            ->setParameter('loginId', $loginId)
        ;

        return $qb->getQuery()->getResult();
    }


    public function searchArr($terms)
    {

        $qb = $this->createQueryBuilder('n');
        $limit = $terms['limit'];
        $qb->setMaxResults($limit);
        $offset = ($limit * $terms['page']) - $limit;
        $qb->setFirstResult($offset);
//        $qb->leftJoin(City::class, 'city', 'WITH', 'c.city = city.id');
//        ->leftJoin('User\Entity\User', 'u', \Doctrine\ORM\Query\Expr\Join::WITH, 'a.user = u.id')
//        $qb->leftJoin(Region::class, 'r', 'WITH', 'c.regionId = r.id');
//        $qb->leftJoin(Tel::class, 't', 'WITH', 't.companyId = c.id')
//            ->andWhere('t.ordering = 1');;

        $qb->orderBy('n.id', 'DESC');
//        $qb = $this->applyTerms($qb, $terms);
//        $qb = $this->applyTagIds($qb, $tagIds);
//        $companyIds = $this->getCompanyIdsByRubricAlias($terms);
//        dump($companyIds);
//        if (!empty($companyIds)) {
//            $qb->where('c.id in (:id)');
//            $qb->setParameter('id', $companyIds);
//        }

        return $qb->getQuery()->getArrayResult();
    }

    public function searchCom($id)
    {
        $qb = $this->createQueryBuilder('n')->select('n.id, n.newsTitle, n.newsRubric, n.introtext, n.fullText, c.title, c.address, c.email, c.site, c.id companyId, city.cityName cityName, city.cTitle cTitle, t.phone');
        $qb->andWhere('n.id = :id');
        $qb->setParameter('id', $id);
        $qb->leftJoin(Company::class, 'c', 'WITH', 'n.companyId = c.id');
        $qb->leftJoin(City::class, 'city', 'WITH', 'c.city = city.id');
        $qb->leftJoin(Tel::class, 't', 'WITH', 't.companyId = c.id')
            ->andWhere('t.ordering = 1');
//        $qb->leftJoin(Region::class, 'r', 'WITH', 'c.regionId = r.id');
//        dump($qb->getQuery()->getSQL());

        return $qb->getQuery()->getOneOrNullResult();
    }

    public function showNewsTop()
    {
        $qb = $this->createQueryBuilder('n')->select('n.id, n.newsTitle, n.newsRubric, n.introtext');
        $qb->andWhere('n.catid = 1');
        $qb->orderBy('n.created', 'DESC');

        return $qb->getQuery()->getArrayResult();
    }
    public function showNews()
    {
        $qb = $this->createQueryBuilder('n')->select('n.id, n.newsTitle, n.newsRubric, n.introtext');
        $qb->andWhere('n.catid = 2');
        $qb->orderBy('n.created', 'DESC');

        return $qb->getQuery()->getArrayResult();
    }

    public function searchNews($id)
    {
        $qb = $this->createQueryBuilder('n')->select('n.id, n.newsTitle, n.introtext');
        $qb->andWhere('n.companyId in (:id)');
        $qb->setParameter('id', $id);
//        $qb->leftJoin(Company::class, 'c', 'WITH', 'n.companyId = c.id');
//        $qb->andWhere('n.catid = 2');
        $qb->orderBy('n.created', 'DESC');

        return $qb->getQuery()->getArrayResult();
    }
}
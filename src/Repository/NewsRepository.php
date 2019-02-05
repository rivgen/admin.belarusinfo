<?php

namespace App\Repository;

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

class NewsRepository extends EntityRepository
{
    public function countTotal($terms)
    {
        $qb = $this->createQueryBuilder('n')->select('count(n.id)');
//        $qb = $this->applyTerms($qb, $terms);
        $result = $qb->getQuery()->getOneOrNullResult();

        return $result ? array_shift($result) : 0;
    }

    protected function applyTerms($qb, $terms)
    {
$cityIds = [];
        if (!empty($terms['region201'])) {
            $cityIds = array_merge($cityIds, $terms['region201']);
        }
        if (!empty($terms['region202'])) {
            $cityIds = array_merge($cityIds, $terms['region202']);
        }
        if (!empty($terms['region203'])) {
            $cityIds = array_merge($cityIds, $terms['region203']);
        }
        if (!empty($terms['region204'])) {
            $cityIds = array_merge($cityIds, $terms['region204']);
        }
        if (!empty($terms['region205'])) {
            $cityIds = array_merge($cityIds, $terms['region205']);
        }
        if (!empty($terms['region206'])) {
            $cityIds = array_merge($cityIds, $terms['region206']);
        }
        if (!empty($cityIds)) {
            $qb->andWhere('c.city in (:city)');
            $qb->setParameter('city', $cityIds);
        }
//        if (!empty($terms['203'])) {
//            $qb->andWhere('c.city in (:city)');
//            $qb->setParameter('city', $terms['203']);
//        }
//        if (!empty($terms['204'])) {
//            $qb->andWhere('c.city in (:city)');
//            $qb->setParameter('city', $terms['204']);
//        }
//        if (!empty($terms['205'])) {
//            $qb->andWhere('c.city in (:city)');
//            $qb->setParameter('city', $terms['205']);
//        }
//        if (!empty($terms['206'])) {
//            $qb->andWhere('c.city in (:city)');
//            $qb->setParameter('city', $terms['206']);
//        }
        if (!empty($terms['regions'])) {
            $qb->andWhere('c.regionId in (:regionId)');
            $qb->setParameter('regionId', $terms['regions']);
        }
        if (!empty($terms['alias'])) {
            $qb->leftJoin(RubricCompany::class, 'rc', 'WITH', 'c.id = rc.companyId');
            $qb->leftJoin(Rubrics::class, 'rubric', 'WITH', 'rc.rubric = rubric.id');
            $qb->andWhere('rubric.alias = :alias2');
            $qb->setParameter('alias2', $terms['alias']);
        }
        if (!empty($terms['tags'])) {
            $qb->leftJoin(CompanyTags::class, 'ct', 'WITH', 'c.id = ct.companyId');
//            $qb->leftJoin(Tags::class, 't', 'WITH', 't.id = ct.tagsId');
            $qb->andWhere('ct.tagsId in (:id)');
            $qb->setParameter('id', $terms['tags']);
        }
//dump($terms);
        return $qb;
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
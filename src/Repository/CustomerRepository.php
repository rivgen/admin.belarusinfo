<?php

namespace App\Repository;

use App\Entity\Comment;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;


class CustomerRepository extends EntityRepository
{

    public function findCustomer($customerId)
    {
        $qb = $this->createQueryBuilder('c')->select('c.id');
        $qb->andWhere('c.id = :id');
        $qb->setParameter('id', $customerId);
        return $qb->getQuery()->getResult();
    }

}

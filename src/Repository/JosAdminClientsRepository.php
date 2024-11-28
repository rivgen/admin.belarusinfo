<?php

namespace App\Repository;

use App\Entity\JosAdminClients;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method JosAdminClients|null find($id, $lockMode = null, $lockVersion = null)
 * @method JosAdminClients|null findOneBy(array $criteria, array $orderBy = null)
 * @method JosAdminClients[]    findAll()
 * @method JosAdminClients[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JosAdminClientsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, JosAdminClients::class);
    }

    // /**
    //  * @return JosClients[] Returns an array of JosClients objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('j.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?JosClients
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

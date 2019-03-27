<?php

namespace App\Repository;

use App\Entity\JosClients;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method JosClients|null find($id, $lockMode = null, $lockVersion = null)
 * @method JosClients|null findOneBy(array $criteria, array $orderBy = null)
 * @method JosClients[]    findAll()
 * @method JosClients[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JosClientsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, JosClients::class);
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

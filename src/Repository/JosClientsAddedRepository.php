<?php

namespace App\Repository;

use App\Entity\JosClientsAdded;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method JosClientsAdded|null find($id, $lockMode = null, $lockVersion = null)
 * @method JosClientsAdded|null findOneBy(array $criteria, array $orderBy = null)
 * @method JosClientsAdded[]    findAll()
 * @method JosClientsAdded[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JosClientsAddedRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, JosClientsAdded::class);
    }

    private function regex ($column)
    {
        return "regexp($column, '^[0-9]9') = 1";
    }

    /**
     * @return JosClientsAdded[] Returns an array of Company objects
     */
    public function getCompanies(): array
    {
        return $this->createQueryBuilder('jca')
            ->andWhere($this->regex('jca.unp'))
            ->orderBy('jca.id', 'DESC')
            ->groupBy('jca.unp', 'jca.name')
            ->getQuery()
            ->getResult();
    }
}

<?php

namespace App\Repository;

use App\Entity\SousEmbranchement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SousEmbranchement|null find($id, $lockMode = null, $lockVersion = null)
 * @method SousEmbranchement|null findOneBy(array $criteria, array $orderBy = null)
 * @method SousEmbranchement[]    findAll()
 * @method SousEmbranchement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SousEmbranchementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SousEmbranchement::class);
    }

    // /**
    //  * @return SousEmbranchement[] Returns an array of SousEmbranchement objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SousEmbranchement
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

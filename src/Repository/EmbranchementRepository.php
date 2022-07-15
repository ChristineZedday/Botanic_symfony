<?php

namespace App\Repository;

use App\Entity\Embranchement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Embranchement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Embranchement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Embranchement[]    findAll()
 * @method Embranchement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmbranchementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Embranchement::class);
    }

    // /**
    //  * @return Embranchement[] Returns an array of Embranchement objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Embranchement
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

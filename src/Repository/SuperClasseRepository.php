<?php

namespace App\Repository;

use App\Entity\SuperClasse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SuperClasse|null find($id, $lockMode = null, $lockVersion = null)
 * @method SuperClasse|null findOneBy(array $criteria, array $orderBy = null)
 * @method SuperClasse[]    findAll()
 * @method SuperClasse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SuperClasseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SuperClasse::class);
    }

    // /**
    //  * @return SuperClasse[] Returns an array of SuperClasse objects
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
    public function findOneBySomeField($value): ?SuperClasse
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

<?php

namespace App\Repository;

use App\Entity\Pruduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Pruduct|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pruduct|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pruduct[]    findAll()
 * @method Pruduct[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PruductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pruduct::class);
    }

    // /**
    //  * @return Pruduct[] Returns an array of Pruduct objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Pruduct
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

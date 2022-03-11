<?php

namespace App\Repository;

use App\Entity\Promosport;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Promosport|null find($id, $lockMode = null, $lockVersion = null)
 * @method Promosport|null findOneBy(array $criteria, array $orderBy = null)
 * @method Promosport[]    findAll()
 * @method Promosport[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PromosportRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Promosport::class);
    }

    // /**
    //  * @return Promosport[] Returns an array of Promosport objects
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
    public function findOneBySomeField($value): ?Promosport
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

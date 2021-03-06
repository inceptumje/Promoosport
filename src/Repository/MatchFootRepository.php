<?php

namespace App\Repository;

use App\Entity\MatchFoot;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MatchFoot|null find($id, $lockMode = null, $lockVersion = null)
 * @method MatchFoot|null findOneBy(array $criteria, array $orderBy = null)
 * @method MatchFoot[]    findAll()
 * @method MatchFoot[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MatchFootRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MatchFoot::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(MatchFoot $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(MatchFoot $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return MatchFoot[] Returns an array of MatchFoot objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    public function findByLeague($leagueId)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.league = :leagueId')
            ->setParameter('leagueId',$leagueId)
            ->getQuery()
            ->getResult();
    }

    /*
    public function findOneBySomeField($value): ?MatchFoot
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

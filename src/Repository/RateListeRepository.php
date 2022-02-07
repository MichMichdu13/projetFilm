<?php

namespace App\Repository;

use App\Entity\RateListe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RateListe|null find($id, $lockMode = null, $lockVersion = null)
 * @method RateListe|null findOneBy(array $criteria, array $orderBy = null)
 * @method RateListe[]    findAll()
 * @method RateListe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RateListeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RateListe::class);
    }

    // /**
    //  * @return RateListe[] Returns an array of RateListe objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RateListe
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

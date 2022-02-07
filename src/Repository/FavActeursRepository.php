<?php

namespace App\Repository;

use App\Entity\FavActeurs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FavActeurs|null find($id, $lockMode = null, $lockVersion = null)
 * @method FavActeurs|null findOneBy(array $criteria, array $orderBy = null)
 * @method FavActeurs[]    findAll()
 * @method FavActeurs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FavActeursRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FavActeurs::class);
    }

    // /**
    //  * @return FavActeurs[] Returns an array of FavActeurs objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FavActeurs
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

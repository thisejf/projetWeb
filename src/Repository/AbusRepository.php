<?php

namespace App\Repository;

use App\Entity\Abus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Abus|null find($id, $lockMode = null, $lockVersion = null)
 * @method Abus|null findOneBy(array $criteria, array $orderBy = null)
 * @method Abus[]    findAll()
 * @method Abus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AbusRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Abus::class);
    }

    // /**
    //  * @return Abus[] Returns an array of Abus objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Abus
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

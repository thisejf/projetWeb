<?php

namespace App\Repository;

use App\Entity\Prestataire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Prestataire|null find($id, $lockMode = null, $lockVersion = null)
 * @method Prestataire|null findOneBy(array $criteria, array $orderBy = null)
 * @method Prestataire[]    findAll()
 * @method Prestataire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrestataireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Prestataire::class);
    }

    public function last4Prestataire(){
        $limit = 4;
        return $this->createQueryBuilder('p')
            ->select('p','l.localite','c.commune','cp.codePostal')
            ->join('App\Entity\Localite','l','WITH','p.localite = l.id')
            ->join('App\Entity\Commune','c','WITH','p.commune = c.id')
            ->join('App\Entity\CodePostal','cp','WITH','p.codePostal = cp.id')
            ->orderBy('p.inscription','DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    public function findAllData(){
        return $this->createQueryBuilder('p')
            ->select('p','l.localite','c.commune','cp.codePostal')
            ->join('App\Entity\Localite','l','WITH','p.localite = l.id')
            ->join('App\Entity\Commune','c','WITH','p.commune = c.id')
            ->join('App\Entity\CodePostal','cp','WITH','p.codePostal = cp.id')
            ->getQuery()
            ->getResult();
    }

    public function findOneDataBy($id){
        return $this->createQueryBuilder('p')
            ->select('p','l.localite','c.commune','cp.codePostal')
            ->where('p.id = :id')
            ->setParameter('id', $id)
            ->join('App\Entity\Localite','l')
            ->join('App\Entity\Commune','c','WITH','p.commune = c.id')
            ->join('App\Entity\CodePostal','cp','WITH','p.codePostal = cp.id')
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Prestataire[] Returns an array of Prestataire objects
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
    public function findOneBySomeField($value): ?Prestataire
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

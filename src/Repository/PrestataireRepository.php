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
            ->select('p')
            ->leftJoin('p.localite','l')
            ->addSelect('l')
            ->leftJoin('p.commune','c')
            ->addSelect('c')
            ->leftJoin('p.codePostal','cp')
            ->addSelect('cp')
            ->leftJoin('p.image','i')
            ->addSelect('i')
            ->orderBy('p.inscription','DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    public function findAllData(){
        return $this->createQueryBuilder('p')
            ->select('p')
            ->leftJoin('p.localite','l')
            ->addSelect('l')
            ->leftJoin('p.commune','c')
            ->addSelect('c')
            ->leftJoin('p.codePostal','cp')
            ->addSelect('cp')
            ->leftJoin('p.image','i')
            ->addSelect('i')
            ->orderBy('p.nom','ASC')
            ->getQuery()
            ->getResult();
    }

    public function findOneDataBy($id){
        return $this->createQueryBuilder('p')
            ->select('p')
            ->where('p.id = :id')
            ->setParameter('id', $id)
            ->leftJoin('p.localite','l')
            ->addSelect('l')
            ->leftJoin('p.commune','c')
            ->addSelect('c')
            ->leftJoin('p.codePostal','cp')
            ->addSelect('cp')
            ->leftJoin('p.image','i')
            ->addSelect('i')
            ->getQuery()
            ->getResult();
    }

    public function search(array $query){

        return $this->createQueryBuilder('p')
            ->select('p')
            ->andWhere('p.nom LIKE :prestataire')
            ->setParameter('prestataire', '%'.$query['prestataire'].'%')
            ->leftJoin('p.categorieDeServices', 'categorie')
            ->addSelect('categorie')
            ->andWhere('categorie.nom LIKE :categorie')
            ->setParameter('categorie', $query['categorie'])
            ->leftJoin('p.codePostal','cp')
            ->addSelect('cp')
            ->leftJoin('p.localite','l')
            ->addSelect('l')
            ->leftJoin('p.commune','c')
            ->addSelect('c')
            ->leftJoin('p.image','i')
            ->addSelect('i')
            ->orderBy('p.nom','ASC')
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

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
            ->where('p.nom IS NOT NULL')
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

        $qb =  $this->createQueryBuilder('p')
                ->select('p');

        if($query['prestataire'] !== ""){
            $qb =  $qb->andWhere('p.nom LIKE :prestataire')
                ->setParameter('prestataire', '%'.$query['prestataire'].'%');
        }

        $qb = $qb->leftJoin('p.categorieDeServices', 'categorie')
            ->addSelect('categorie');

        if($query['categorie'] !== ""){
            $qb =  $qb->andWhere('categorie.nom LIKE :categorie')
                ->setParameter('categorie', $query['categorie']);
        }

        $qb = $qb->leftJoin('p.codePostal','cp')
            ->addSelect('cp')
            ->leftJoin('p.localite','l')
            ->addSelect('l')
            ->leftJoin('p.commune','c')
            ->addSelect('c');

        if($query['localite'] !==""){

            if(is_numeric($query['localite'])){
                $qb =  $qb->andWhere('cp.codePostal LIKE :localite')
                    ->setParameter('localite', $query['localite']);
            }else{
                $qb =  $qb->andWhere('c.commune LIKE :localite OR l.localite LIKE :localite')
                    ->setParameter('localite', '%'.$query['localite'].'%');
            }

        }

        $qb = $qb->leftJoin('p.image','i')
            ->addSelect('i')
            ->orderBy('p.nom','ASC')
            ->getQuery()
            ->getResult();

        return $qb;
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

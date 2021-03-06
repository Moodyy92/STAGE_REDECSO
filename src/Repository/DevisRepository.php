<?php

namespace App\Repository;

use App\Entity\Devis;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Devis|null find($id, $lockMode = null, $lockVersion = null)
 * @method Devis|null findOneBy(array $criteria, array $orderBy = null)
 * @method Devis[]    findAll()
 * @method Devis[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DevisRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Devis::class);
    }

    // /**
    //  * @return Devis[] Returns an array of Devis objects
    //  */

    public function findAllAsArray()
    {
        return $this->createQueryBuilder('d')

            ->orderBy('d.id', 'ASC')
            ->getQuery()
            ->getArrayResult()
        ;
    }
    public function findOneAsArray($id)
    {
        return $this->createQueryBuilder('d')

            ->andWhere('d.id = :id')
            ->setParameter('id',$id)
            ->orderBy('d.id', 'ASC')
            ->getQuery()
            ->getArrayResult()[0]
            ;
    }


    /*
    public function findOneBySomeField($value): ?Devis
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

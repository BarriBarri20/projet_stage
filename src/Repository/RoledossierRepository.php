<?php

namespace App\Repository;

use App\Entity\Roledossier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Roledossier|null find($id, $lockMode = null, $lockVersion = null)
 * @method Roledossier|null findOneBy(array $criteria, array $orderBy = null)
 * @method Roledossier[]    findAll()
 * @method Roledossier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RoledossierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Roledossier::class);
    }

    // /**
    //  * @return Roledossier[] Returns an array of Roledossier objects
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
    public function findOneBySomeField($value): ?Roledossier
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

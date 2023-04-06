<?php

namespace App\Repository;

use App\Entity\TypeServeur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeServeur|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeServeur|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeServeur[]    findAll()
 * @method TypeServeur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeServeurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeServeur::class);
    }

    // /**
    //  * @return TypeServeur[] Returns an array of TypeServeur objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TypeServeur
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

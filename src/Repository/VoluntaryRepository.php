<?php

namespace App\Repository;

use App\Entity\Voluntary;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Voluntary|null find($id, $lockMode = null, $lockVersion = null)
 * @method Voluntary|null findOneBy(array $criteria, array $orderBy = null)
 * @method Voluntary[]    findAll()
 * @method Voluntary[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VoluntaryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Voluntary::class);
    }

    // /**
    //  * @return Voluntary[] Returns an array of Voluntary objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Voluntary
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

<?php

namespace App\Repository;

use App\Entity\Sickness;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Sickness|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sickness|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sickness[]    findAll()
 * @method Sickness[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SicknessRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sickness::class);
    }

    // /**
    //  * @return Information[] Returns an array of Information objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Information
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function getall()
    {
        return $this->createQueryBuilder('i')
            ->getQuery()
            ->getResult();
    }
}

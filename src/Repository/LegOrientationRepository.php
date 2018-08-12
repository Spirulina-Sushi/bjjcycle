<?php

namespace App\Repository;

use App\Entity\LegOrientation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method LegOrientation|null find($id, $lockMode = null, $lockVersion = null)
 * @method LegOrientation|null findOneBy(array $criteria, array $orderBy = null)
 * @method LegOrientation[]    findAll()
 * @method LegOrientation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LegOrientationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, LegOrientation::class);
    }

//    /**
//     * @return LegOrientation[] Returns an array of LegOrientation objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LegOrientation
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

<?php

namespace App\Repository;

use App\Entity\ArmOrientation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ArmOrientation|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArmOrientation|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArmOrientation[]    findAll()
 * @method ArmOrientation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArmOrientationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ArmOrientation::class);
    }

//    /**
//     * @return ArmOrientation[] Returns an array of ArmOrientation objects
//     */
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
    public function findOneBySomeField($value): ?ArmOrientation
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

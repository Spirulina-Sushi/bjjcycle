<?php

namespace App\Repository;

use App\Entity\Subsystem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Subsystem|null find($id, $lockMode = null, $lockVersion = null)
 * @method Subsystem|null findOneBy(array $criteria, array $orderBy = null)
 * @method Subsystem[]    findAll()
 * @method Subsystem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubsystemRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Subsystem::class);
    }

//    /**
//     * @return Subsystem[] Returns an array of Subsystem objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Subsystem
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

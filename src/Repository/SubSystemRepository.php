<?php

namespace App\Repository;

use App\Entity\SubSystem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SubSystem|null find($id, $lockMode = null, $lockVersion = null)
 * @method SubSystem|null findOneBy(array $criteria, array $orderBy = null)
 * @method SubSystem[]    findAll()
 * @method SubSystem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubSystemRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SubSystem::class);
    }

//    /**
//     * @return SubSystem[] Returns an array of SubSystem objects
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
    public function findOneBySomeField($value): ?SubSystem
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

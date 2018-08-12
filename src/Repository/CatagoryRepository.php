<?php

namespace App\Repository;

use App\Entity\Catagory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Catagory|null find($id, $lockMode = null, $lockVersion = null)
 * @method Catagory|null findOneBy(array $criteria, array $orderBy = null)
 * @method Catagory[]    findAll()
 * @method Catagory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CatagoryRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Catagory::class);
    }

//    /**
//     * @return Catagory[] Returns an array of Catagory objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Catagory
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
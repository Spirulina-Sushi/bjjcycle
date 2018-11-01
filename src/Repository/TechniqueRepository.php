<?php

namespace App\Repository;

use App\Entity\Technique;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;



/**
 * @method Technique|null find($id, $lockMode = null, $lockVersion = null)
 * @method Technique|null findOneBy(array $criteria, array $orderBy = null)
 * @method Technique[]    findAll()
 * @method Technique[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TechniqueRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Technique::class);
    }

    /**
     * @return Technique[] Returns an array of Technique objects
     */
    public function findByPosition($position)
    {

        return $this->createQueryBuilder('t')
            ->leftJoin('t.startPosition', 'p')
            ->andWhere('p.name = :position')
            ->setParameter('position', $position)
            ->orderBy('p.name', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }



    public function findFlowStarterStanding($game): ?Technique
    {
        return $this->createQueryBuilder('t')
            ->leftJoin('t.startPosition', 'p')
            ->leftJoin('p.subsystem', 'ss')
            ->leftJoin('ss.system', 's')
            ->leftJoin('s.game', 'g')
            ->andWhere('g.name = :game')
            ->setParameter('game', $game)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    
    
    public function findFlowIteration($startingPosition): ?Technique
    {
        return $this->createQueryBuilder('t')
            ->leftJoin('t.startPosition', 'p')
            ->andWhere('p.name = :position')
            ->setParameter('position', $startingPosition)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

}

<?php

namespace App\Repository;

use App\Entity\Answerchoice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Answerchoice|null find($id, $lockMode = null, $lockVersion = null)
 * @method Answerchoice|null findOneBy(array $criteria, array $orderBy = null)
 * @method Answerchoice[]    findAll()
 * @method Answerchoice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnswerchoiceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Answerchoice::class);
    }

//    /**
//     * @return Answerchoice[] Returns an array of Answerchoice objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Answerchoice
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

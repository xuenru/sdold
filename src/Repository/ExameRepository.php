<?php

namespace App\Repository;

use App\Entity\Exame;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Exame|null find($id, $lockMode = null, $lockVersion = null)
 * @method Exame|null findOneBy(array $criteria, array $orderBy = null)
 * @method Exame[]    findAll()
 * @method Exame[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExameRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Exame::class);
    }

//    /**
//     * @return Exame[] Returns an array of Exame objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Exame
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

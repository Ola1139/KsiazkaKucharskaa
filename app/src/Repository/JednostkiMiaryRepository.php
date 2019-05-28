<?php

namespace App\Repository;

use App\Entity\JednostkiMiary;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method JednostkiMiary|null find($id, $lockMode = null, $lockVersion = null)
 * @method JednostkiMiary|null findOneBy(array $criteria, array $orderBy = null)
 * @method JednostkiMiary[]    findAll()
 * @method JednostkiMiary[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JednostkiMiaryRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, JednostkiMiary::class);
    }

    // /**
    //  * @return JednostkiMiary[] Returns an array of JednostkiMiary objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('j.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?JednostkiMiary
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

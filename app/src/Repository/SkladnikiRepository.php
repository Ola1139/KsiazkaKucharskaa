<?php

namespace App\Repository;

use App\Entity\Skladniki;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Skladniki|null find($id, $lockMode = null, $lockVersion = null)
 * @method Skladniki|null findOneBy(array $criteria, array $orderBy = null)
 * @method Skladniki[]    findAll()
 * @method Skladniki[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SkladnikiRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Skladniki::class);
    }

    // /**
    //  * @return Skladniki[] Returns an array of Skladniki objects
    //  */
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
    public function findOneBySomeField($value): ?Skladniki
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

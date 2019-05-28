<?php

namespace App\Repository;

use App\Entity\Dane;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Dane|null find($id, $lockMode = null, $lockVersion = null)
 * @method Dane|null findOneBy(array $criteria, array $orderBy = null)
 * @method Dane[]    findAll()
 * @method Dane[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DaneRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Dane::class);
    }

    // /**
    //  * @return Dane[] Returns an array of Dane objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Dane
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

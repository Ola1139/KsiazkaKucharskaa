<?php

namespace App\Repository;

use App\Entity\Skargi;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Skargi|null find($id, $lockMode = null, $lockVersion = null)
 * @method Skargi|null findOneBy(array $criteria, array $orderBy = null)
 * @method Skargi[]    findAll()
 * @method Skargi[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SkargiRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Skargi::class);
    }

    // /**
    //  * @return Skargi[] Returns an array of Skargi objects
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
    public function findOneBySomeField($value): ?Skargi
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

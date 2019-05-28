<?php

namespace App\Repository;

use App\Entity\Ulubione;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Ulubione|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ulubione|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ulubione[]    findAll()
 * @method Ulubione[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UlubioneRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Ulubione::class);
    }

    // /**
    //  * @return Ulubione[] Returns an array of Ulubione objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Ulubione
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

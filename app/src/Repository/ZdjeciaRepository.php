<?php

namespace App\Repository;

use App\Entity\Zdjecia;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Zdjecia|null find($id, $lockMode = null, $lockVersion = null)
 * @method Zdjecia|null findOneBy(array $criteria, array $orderBy = null)
 * @method Zdjecia[]    findAll()
 * @method Zdjecia[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ZdjeciaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Zdjecia::class);
    }

    // /**
    //  * @return Zdjecia[] Returns an array of Zdjecia objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('z')
            ->andWhere('z.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('z.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Zdjecia
    {
        return $this->createQueryBuilder('z')
            ->andWhere('z.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

<?php

namespace App\Repository;

use App\Entity\Komentarze;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Komentarze|null find($id, $lockMode = null, $lockVersion = null)
 * @method Komentarze|null findOneBy(array $criteria, array $orderBy = null)
 * @method Komentarze[]    findAll()
 * @method Komentarze[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KomentarzeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Komentarze::class);
    }

    // /**
    //  * @return Komentarze[] Returns an array of Komentarze objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('k.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Komentarze
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

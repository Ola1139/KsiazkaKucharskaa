<?php

namespace App\Repository;

use App\Entity\PrzepisySkladniki;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PrzepisySkladniki|null find($id, $lockMode = null, $lockVersion = null)
 * @method PrzepisySkladniki|null findOneBy(array $criteria, array $orderBy = null)
 * @method PrzepisySkladniki[]    findAll()
 * @method PrzepisySkladniki[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrzepisySkladnikiRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PrzepisySkladniki::class);
    }

    // /**
    //  * @return PrzepisySkladniki[] Returns an array of PrzepisySkladniki objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PrzepisySkladniki
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

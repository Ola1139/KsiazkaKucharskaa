<?php

namespace App\Repository;

use App\Entity\Przepisy;
use App\Entity\Uzytkownicy;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Uzytkownicy|null find($id, $lockMode = null, $lockVersion = null)
 * @method Uzytkownicy|null findOneBy(array $criteria, array $orderBy = null)
 * @method Uzytkownicy[]    findAll()
 * @method Uzytkownicy[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UzytkownicyRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Uzytkownicy::class);
    }
    /**
     * Save record.
     *
     * @param \App\Entity\Uzytkownicy $uzytkownicy Uzytkownicy entity
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Uzytkownicy $uzytkownicy): void
    {
        $this->_em->persist($uzytkownicy);
        $this->_em->flush($uzytkownicy);
    }
    // /**
    //  * @return Uzytkownicy[] Returns an array of Uzytkownicy objects
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
    public function findOneBySomeField($value): ?Uzytkownicy
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

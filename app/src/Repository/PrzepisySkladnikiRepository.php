<?php

namespace App\Repository;

use App\Entity\PrzepisySkladniki;
use App\Entity\Skladniki;
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
    /**
     * Save record.
     *
     * @param \App\Entity\PrzepisySkladniki $skladniki PrzepisySkladniki entity
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(PrzepisySkladniki $przepisySkladniki): void
    {
        $this->_em->persist($przepisySkladniki);
        $this->_em->flush($przepisySkladniki);
    }

    /**
     * Delete record.
     *
     * @param \App\Entity\PrzepisySkladniki $przepisySkladniki PrzepisySkladniki entity
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(PrzepisySkladniki $przepisySkladniki): void
    {

        $this->_em->remove($przepisySkladniki);
        $this->_em->flush($przepisySkladniki);

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

<?php

namespace App\Repository;

use App\Entity\Przepisy;
use App\Entity\Skladniki;
use App\Entity\Uzytkownicy;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
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

    /**
     * Get or create new query builder.
     *
     * @param \Doctrine\ORM\QueryBuilder|null $queryBuilder Query builder
     *
     * @return \Doctrine\ORM\QueryBuilder Query builder
     */
    private function getOrCreateQueryBuilder(QueryBuilder $queryBuilder = null): QueryBuilder
    {
        return $queryBuilder ?: $this->createQueryBuilder('t');
    }

    /**
     * Query all records.
     *
     * @return \Doctrine\ORM\QueryBuilder Query builder
     */
    public function queryAll(): QueryBuilder
    {
        return $this->getOrCreateQueryBuilder()
            ->orderBy('t.id', 'DESC');
    }
    /**
     * Query skladnik by title
     *
     * @param \App\Entity\Skladniki|null $skladniki USkladniki entity
     *
     * @return \Doctrine\ORM\QueryBuilder Query builder
     */
    public function queryByAuthor(Skladniki $skladniki = null): QueryBuilder
    {

        $queryBuilder =$this->queryAll() ;

        if (!is_null($skladniki)) {
            $queryBuilder->andWhere('t.nazwa = :nazwa')
                ->setParameter('nazwa', $skladniki);
        }

        return $queryBuilder;
    }

    /**
     * Save record.
     *
     * @param \App\Entity\Skladniki $skladniki Skladniki entity
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Skladniki $skladniki): void
    {
        $this->_em->persist($skladniki);
        $this->_em->flush($skladniki);
    }

    /**
     * Delete record.
     *
     * @param \App\Entity\Skladniki $skladniki Skladniki entity
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(Skladniki $skladniki)
    {

        $this->_em->remove($skladniki);
        $this->_em->flush($skladniki);
    }

    /**
     * Search record.
     *
     * @param \App\Entity\Skladniki $skladniki Skladniki entity
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */

    public function findByPrzepisId($id)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.id = :val')
            ->setParameter('val', $id)
            ->orderBy('c.id', 'ASC')
            ->getQuery()->getOneOrNullResult();
    }

    /**
     * Find skladnik record.
     *
     * @param \App\Entity\Skladniki $skladniki Skladniki entity
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */

    public function findBySkladnik($nazwa)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.nazwa = :nazwa')
            ->setParameter('nazwa', $nazwa)
            ->orderBy('c.nazwa', 'ASC')
            ->getQuery()->getOneOrNullResult();
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

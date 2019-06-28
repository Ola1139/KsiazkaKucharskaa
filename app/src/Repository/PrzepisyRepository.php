<?php
/**
 * Przepisy repository.
 */

namespace App\Repository;

use App\Entity\Przepisy;
use App\Entity\Uzytkownicy;
use App\Entity\Zdjecia;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class TaskRepository.
 *
 * @method Przepisy|null find($id, $lockMode = null, $lockVersion = null)
 * @method Przepisy|null findOneBy(array $criteria, array $orderBy = null)
 * @method Przepisy[]    findAll()
 * @method Przepisy[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrzepisyRepository extends ServiceEntityRepository
{


    /**
     * PrzepisyRepository constructor.
     *
     * @param \Symfony\Bridge\Doctrine\RegistryInterface $registry Registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Przepisy::class);
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
     * Save record.
     *
     * @param \App\Entity\Przepisy $przepisy Przepis entity
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Przepisy $przepisy): void
    {
        $this->_em->persist($przepisy);
        $this->_em->flush($przepisy);
    }

    /**
     * Delete record.
     *
     * @param \App\Entity\Przepisy $przepis Przepis entity
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(Przepisy $przepis)
    {

        $this->_em->remove($przepis);
        $this->_em->flush($przepis);
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
     * Query tasks by autor
     *
     * @param \App\Entity\Uzytkownicy|null $uzytkownicy Uzytkownicy entity
     *
     * @return \Doctrine\ORM\QueryBuilder Query builder
     */
    public function queryByAuthor(Uzytkownicy $uzytkownicy = null): QueryBuilder
    {

        $queryBuilder =$this->queryAll() ;

        if (!is_null($uzytkownicy)) {
            $queryBuilder->andWhere('t.autor = :autor')
                ->setParameter('autor', $uzytkownicy);
        }

        return $queryBuilder;
    }

    /**
     * Query tasks by autor
     *
     * @param \App\Entity\Uzytkownicy|null $uzytkownicy Uzytkownicy entity
     *
     * @return \Doctrine\ORM\QueryBuilder Query builder
     */
    public function queryByTitle(Przepisy $title = null): QueryBuilder
    {

        $queryBuilder =$this->queryAll() ;

        if (!is_null($title)) {
            $queryBuilder->andWhere('t.tytul = :tytul')
                ->setParameter('tytul', $title);
        }

        return $queryBuilder;
    }



    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Przepisy
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
<?php

namespace App\Repository;

use App\Entity\Kategorie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Kategorie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Kategorie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Kategorie[]    findAll()
 * @method Kategorie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KategorieRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Kategorie::class);
    }

    /**
     * Query by category.
     *
     * @return \Doctrine\ORM\QueryBuilder Query builder
     */
    public function queryByCategory(int $id): QueryBuilder
    {
        return $this->getOrCreateQueryBuilder()
            ->where('type.kategoria = '.$id)
            ->orderBy('type.id', 'DESC');
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
        return $queryBuilder ?: $this->createQueryBuilder('type');
    }

    // /**
    //  * @return Kategorie[] Returns an array of Kategorie objects
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
    public function findOneBySomeField($value): ?Kategorie
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

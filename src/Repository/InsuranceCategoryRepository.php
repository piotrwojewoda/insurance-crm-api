<?php

namespace App\Repository;

use App\Entity\InsuranceCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method InsuranceCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method InsuranceCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method InsuranceCategory[]    findAll()
 * @method InsuranceCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InsuranceCategoryRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, InsuranceCategory::class);
    }

    // /**
    //  * @return InsuranceCategory[] Returns an array of InsuranceCategory objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?InsuranceCategory
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

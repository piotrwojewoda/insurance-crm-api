<?php

namespace App\Repository;

use App\Entity\InsuranceValue;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method InsuranceValue|null find($id, $lockMode = null, $lockVersion = null)
 * @method InsuranceValue|null findOneBy(array $criteria, array $orderBy = null)
 * @method InsuranceValue[]    findAll()
 * @method InsuranceValue[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InsuranceValueRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, InsuranceValue::class);
    }

    // /**
    //  * @return InsuranceValue[] Returns an array of InsuranceValue objects
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
    public function findOneBySomeField($value): ?InsuranceValue
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

<?php

namespace App\Repository;

use App\Entity\InsuranceType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method InsuranceType|null find($id, $lockMode = null, $lockVersion = null)
 * @method InsuranceType|null findOneBy(array $criteria, array $orderBy = null)
 * @method InsuranceType[]    findAll()
 * @method InsuranceType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InsuranceTypeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, InsuranceType::class);
    }

    // /**
    //  * @return InsuranceType[] Returns an array of InsuranceType objects
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
    public function findOneBySomeField($value): ?InsuranceType
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

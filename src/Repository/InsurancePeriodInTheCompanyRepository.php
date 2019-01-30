<?php

namespace App\Repository;

use App\Entity\InsurancePeriodInTheCompany;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method InsurancePeriodInTheCompany|null find($id, $lockMode = null, $lockVersion = null)
 * @method InsurancePeriodInTheCompany|null findOneBy(array $criteria, array $orderBy = null)
 * @method InsurancePeriodInTheCompany[]    findAll()
 * @method InsurancePeriodInTheCompany[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InsurancePeriodInTheCompanyRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, InsurancePeriodInTheCompany::class);
    }

    // /**
    //  * @return InsurancePeriodInTheCompany[] Returns an array of InsurancePeriodInTheCompany objects
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
    public function findOneBySomeField($value): ?InsurancePeriodInTheCompany
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

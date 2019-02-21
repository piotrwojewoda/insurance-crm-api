<?php

namespace App\Repository;

use App\Entity\Company;
use App\Entity\InsurancePeriodInTheCompany;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Company|null find($id, $lockMode = null, $lockVersion = null)
 * @method Company|null findOneBy(array $criteria, array $orderBy = null)
 * @method Company[]    findAll()
 * @method Company[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompanyRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Company::class);
    }

     /**
      * @return Company[] Returns an array of Company objects
     */

    public function findCurrentClients($companyId)
    {
        return $query = $this->createQueryBuilder('c')
            ->join(InsurancePeriodInTheCompany::class,'ipitc')
            ->andWhere('ipitc.enddate > :val')
            ->andWhere('ipitc.company = :id')
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->setParameter('val', new \DateTime())
            ->setParameter('id',$companyId)
            ->getQuery()
            ->getResult()
        ;

    }




    public function findCompanyByPolicy($policyId)
    {
        $query =  $query = $this->createQueryBuilder('c')
            ->innerJoin(InsurancePeriodInTheCompany::class,'ipitc','WITH','ipitc.company = c.id')
          //  ->innerJoin( Company::class,'company','WITH','ipitc.company = company.id')
           ->andWhere('ipitc.enddate > :val')
            ->andWhere('ipitc.policy = :id')
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->setParameter('val', new \DateTime())
            ->setParameter('id',$policyId)
            ->getQuery();

        return $query->getOneOrNullResult();
    }





    /*
    public function findOneBySomeField($value): ?Company
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

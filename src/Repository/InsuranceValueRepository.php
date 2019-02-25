<?php

namespace App\Repository;

use App\Entity\InsurancePeriodInTheCompany;
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



    public function findValueByClient($clientId)
    {
        $query =  $query = $this->createQueryBuilder('iv')
            ->innerJoin(InsurancePeriodInTheCompany::class,'ipitc','WITH','ipitc.value = iv.id')
            ->andWhere('ipitc.client = :clientId')
         //   ->andWhere('ipitc.enddate > :val')
            ->setMaxResults(1)
        //    ->setParameter('val', new \DateTime())
            ->setParameter('clientId',$clientId)
            ->getQuery();
      //  print_r($clientId);
      //  print_r($query->getSQL());
      //  die();

        return $query->getResult();
    }


    public function findCurrentClientsByCompany($companyId)
    {
        $query =  $query = $this->createQueryBuilder('c')
            ->innerJoin(InsurancePeriodInTheCompany::class,'ipitc','WITH','ipitc.client = c.id')
            ->andWhere('ipitc.enddate > :val')
            ->andWhere('ipitc.company = :id')
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->setParameter('val', new \DateTime())
            ->setParameter('id',$companyId)
            ->getQuery();

        return $query->getResult();
    }

}

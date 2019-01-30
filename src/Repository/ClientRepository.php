<?php

namespace App\Repository;

use App\Entity\Client;
use App\Entity\InsurancePeriodInTheCompany;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Client|null find($id, $lockMode = null, $lockVersion = null)
 * @method Client|null findOneBy(array $criteria, array $orderBy = null)
 * @method Client[]    findAll()
 * @method Client[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClientRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Client::class);
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

    public function findCurrentClientsByPolicy($policyId)
    {
        $query =  $query = $this->createQueryBuilder('c')
            ->innerJoin(InsurancePeriodInTheCompany::class,'ipitc','WITH','ipitc.client = c.id')
            ->andWhere('ipitc.enddate > :val')
            ->andWhere('ipitc.policy = :id')
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->setParameter('val', new \DateTime())
            ->setParameter('id',$policyId)
            ->getQuery();

        return $query->getResult();
    }
}

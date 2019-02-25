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
}

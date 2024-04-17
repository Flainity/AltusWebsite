<?php

namespace App\Bundles\MainBundle\Repository;

use App\Bundles\MainBundle\Entity\VoucherType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<VoucherType>
 *
 * @method VoucherType|null find($id, $lockMode = null, $lockVersion = null)
 * @method VoucherType|null findOneBy(array $criteria, array $orderBy = null)
 * @method VoucherType[]    findAll()
 * @method VoucherType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VoucherTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VoucherType::class);
    }
}
<?php

namespace App\Bundles\MainBundle\Repository;

use App\Bundles\MainBundle\Entity\PaypalPayment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PaypalPayment>
 *
 * @method PaypalPayment|null find($id, $lockMode = null, $lockVersion = null)
 * @method PaypalPayment|null findOneBy(array $criteria, array $orderBy = null)
 * @method PaypalPayment[]    findAll()
 * @method PaypalPayment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PaypalPaymentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PaypalPayment::class);
    }
}
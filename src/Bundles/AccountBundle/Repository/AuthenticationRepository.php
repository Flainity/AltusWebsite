<?php

namespace App\Bundles\AccountBundle\Repository;

use App\Bundles\AccountBundle\Entity\Authentication;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Authentication>
 *
 * @method Authentication|null find($id, $lockMode = null, $lockVersion = null)
 * @method Authentication|null findOneBy(array $criteria, array $orderBy = null)
 * @method Authentication[]    findAll()
 * @method Authentication[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuthenticationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Authentication::class);
    }
}

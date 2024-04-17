<?php

namespace App\Bundles\CharacterBundle\Repository;

use App\Bundles\CharacterBundle\Entity\CharacterShape;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CharacterShape>
 *
 * @method CharacterShape|null find($id, $lockMode = null, $lockVersion = null)
 * @method CharacterShape|null findOneBy(array $criteria, array $orderBy = null)
 * @method CharacterShape[]    findAll()
 * @method CharacterShape[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CharacterShapeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CharacterShape::class);
    }
}
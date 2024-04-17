<?php

namespace App\Bundles\MainBundle\Entity;

use App\Bundles\MainBundle\Repository\VoucherTypeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VoucherTypeRepository::class)]
#[ORM\Table(name: '`tVoucherType`')]
class VoucherType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $identifier;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    public function getId(): int
    {
        return $this->id;
    }

    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    public function setIdentifier(string $identifier): VoucherType
    {
        $this->identifier = $identifier;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): VoucherType
    {
        $this->name = $name;
        return $this;
    }
}
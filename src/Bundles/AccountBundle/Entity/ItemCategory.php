<?php

namespace App\Bundles\AccountBundle\Entity;

use App\Bundles\AccountBundle\Repository\AuthenticationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AuthenticationRepository::class)]
#[ORM\Table(name: '`tItemCategory`')]
class ItemCategory implements \JsonSerializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'nId', type: Types::SMALLINT)]
    private int $id;

    #[ORM\Column(name: 'sName', length: 255)]
    private string $name;

    #[ORM\Column(name: 'bIsActive')]
    private bool $active = true;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): ItemCategory
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): ItemCategory
    {
        $this->name = $name;
        return $this;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): ItemCategory
    {
        $this->active = $active;
        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'active' => $this->active,
        ];
    }
}

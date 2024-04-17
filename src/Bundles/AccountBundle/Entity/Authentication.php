<?php

namespace App\Bundles\AccountBundle\Entity;

use App\Bundles\AccountBundle\Repository\AuthenticationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AuthenticationRepository::class)]
#[ORM\Table(name: '`tUserAuth`')]
class Authentication
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'nAuthID', type: Types::SMALLINT)]
    private int $id;

    #[ORM\Column(name: 'sAuthName', length: 255)]
    private string $name;

    #[ORM\Column(name: 'bIsLoginable')]
    private bool $is_loginable = true;

    #[ORM\OneToMany(targetEntity: User::class, mappedBy: 'authentication')]
    private Collection $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function isIsLoginable(): ?bool
    {
        return $this->is_loginable;
    }

    public function setIsLoginable(bool $is_loginable): static
    {
        $this->is_loginable = $is_loginable;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setAuthentication($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getAuthentication() === $this) {
                $user->setAuthentication(null);
            }
        }

        return $this;
    }
}

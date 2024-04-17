<?php

namespace App\Bundles\AccountBundle\Entity;

use App\Bundles\AccountBundle\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`tUser`')]
#[ORM\HasLifecycleCallbacks]
#[UniqueEntity(fields: ['username'], message: 'There is already an account with this username')]
class User implements UserInterface, PasswordAuthenticatedUserInterface, \JsonSerializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'nUserNo', type: 'integer')]
    private int $id;

    #[ORM\Column(name: 'sUserID', length: 255)]
    private string $username;

    #[ORM\Column(name: 'sUserPW', length: 255)]
    private string $password;

    #[ORM\Column(name: 'bIsBlock')]
    private bool $is_blocked = false;

    #[ORM\Column(name: 'bIsDelete')]
    private bool $is_deleted = false;

    #[ORM\Column(name: 'sUserIP', length: 255)]
    private string $ip;

    #[ORM\Column(name: 'dDate', type: 'datetime')]
    private \DateTime $created_at;

    #[ORM\Column(name: 'nCoins', type: 'integer')]
    private int $coins;

    #[ORM\Column(name: 'sEmail', length: 255)]
    private string $email;

    #[ORM\ManyToOne(fetch: 'EAGER', inversedBy: 'users')]
    #[ORM\JoinColumn(name: 'nAuthID', referencedColumnName: 'nAuthID', nullable: false)]
    private Authentication $authentication;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function isIsBlocked(): ?bool
    {
        return $this->is_blocked;
    }

    public function setIsBlocked(bool $is_blocked): static
    {
        $this->is_blocked = $is_blocked;

        return $this;
    }

    public function isIsDeleted(): ?bool
    {
        return $this->is_deleted;
    }

    public function setIsDeleted(bool $is_deleted): static
    {
        $this->is_deleted = $is_deleted;

        return $this;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function setIp(string $ip): static
    {
        $this->ip = $ip;

        return $this;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTime $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getCoins(): ?int
    {
        return $this->coins;
    }

    public function setCoins(int $coins): static
    {
        $this->coins = $coins;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getAuthentication(): ?Authentication
    {
        return $this->authentication;
    }

    public function setAuthentication(?Authentication $authentication): static
    {
        $this->authentication = $authentication;

        return $this;
    }

    public function getRoles(): array
    {
        return [];
    }

    public function eraseCredentials(): void
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUserIdentifier(): string
    {
        return $this->username;
    }

    #[ORM\PrePersist]
    public function setCreatedAtValue(): void
    {
        $this->created_at = new \DateTime();
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'email' => $this->email,
            'coins' => $this->coins,
            'authentication' => $this->authentication->getName(),
        ];
    }
}

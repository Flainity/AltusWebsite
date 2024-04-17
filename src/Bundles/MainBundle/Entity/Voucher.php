<?php

namespace App\Bundles\MainBundle\Entity;

use App\Bundles\MainBundle\Repository\VoucherRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VoucherRepository::class)]
#[ORM\Table(name: '`tVoucher`')]
class Voucher
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $code;

    #[ORM\ManyToOne(targetEntity: VoucherType::class)]
    #[ORM\JoinColumn(name: 'type', referencedColumnName: 'id', nullable: false)]
    private VoucherType $type;

    public function getId(): int
    {
        return $this->id;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): Voucher
    {
        $this->code = $code;
        return $this;
    }

    public function getType(): VoucherType
    {
        return $this->type;
    }

    public function setType(VoucherType $type): Voucher
    {
        $this->type = $type;
        return $this;
    }
}
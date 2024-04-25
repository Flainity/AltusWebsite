<?php

namespace App\Bundles\MainBundle\Entity;

use App\Bundles\MainBundle\Repository\PaypalPaymentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaypalPaymentRepository::class)]
#[ORM\Table(name: '`tPaypalPayment`')]
class PaypalPayment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $paymentId;

    #[ORM\Column(type: 'string', length: 255)]
    private string $payerId;

    #[ORM\Column(type: 'string', length: 255)]
    private string $paymentStatus;

    #[ORM\Column(type: 'integer')]
    private string $paymentAmount;

    public function getId(): int
    {
        return $this->id;
    }

    public function getPaymentId(): string
    {
        return $this->paymentId;
    }

    public function setPaymentId(string $paymentId): PaypalPayment
    {
        $this->paymentId = $paymentId;
        return $this;
    }

    public function getPayerId(): string
    {
        return $this->payerId;
    }

    public function setPayerId(string $payerId): PaypalPayment
    {
        $this->payerId = $payerId;
        return $this;
    }

    public function getPaymentStatus(): string
    {
        return $this->paymentStatus;
    }

    public function setPaymentStatus(string $paymentStatus): PaypalPayment
    {
        $this->paymentStatus = $paymentStatus;
        return $this;
    }

    public function getPaymentAmount(): int
    {
        return $this->paymentAmount;
    }

    public function setPaymentAmount(int $paymentAmount): PaypalPayment
    {
        $this->paymentAmount = $paymentAmount;
        return $this;
    }
}
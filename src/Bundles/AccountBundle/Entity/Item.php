<?php

namespace App\Bundles\AccountBundle\Entity;

use App\Bundles\AccountBundle\Repository\ItemRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ItemRepository::class)]
#[ORM\Table(name: '`tItem`')]
class Item implements \JsonSerializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'nId', type: 'integer')]
    private int $id;

    #[ORM\Column(name: 'nGoodsNo', type: 'integer')]
    private int $goodsNumber;

    #[ORM\Column(name: 'sItemName', length: 255)]
    private string $name;

    #[ORM\Column(name: 'nItemPrice', type: 'integer')]
    private int $price;

    #[ORM\Column(name: 'sItemDesc', length: 2000)]
    private string $description;

    #[ORM\Column(name: 'nItemUnit', type: 'integer')]
    private int $unit;

    #[ORM\Column(name: 'nItemStock', type: 'integer')]
    private int $stock;

    #[ORM\Column(name: 'bIsSaleOff')]
    private bool $saleOff = false;

    #[ORM\Column(name: 'nItemDiscount', type: 'integer')]
    private int $discount;

    #[ORM\Column(name: 'bIsEnable')]
    private bool $enabled = false;

    #[ORM\Column(name: 'dCreateDate', type: 'datetime')]
    private \DateTime $created_at;

    #[ORM\Column(name: 'dDiscountStartAt', type: 'datetime', nullable: true)]
    private ?\DateTime $discount_start_at;

    #[ORM\Column(name: 'dDiscountEndAt', type: 'datetime', nullable: true)]
    private ?\DateTime $discount_end_at;

    #[ORM\Column(name: 'bIsNew')]
    private bool $new = false;

    #[ORM\Column(name: 'bIsPopular')]
    private bool $popular = false;

    #[ORM\Column(name: 'bIsRecommend')]
    private bool $recommended = false;

    #[ORM\Column(name: 'sItemImg', length: 255, nullable: true)]
    private ?string $image;

    #[ORM\ManyToOne(targetEntity: ItemCategory::class)]
    #[ORM\JoinColumn(name: 'nCategoryId', referencedColumnName: 'nId', nullable: true)]
    private ItemCategory $category;

    #[ORM\Column(name: 'sShortDesc', length: 50)]
    private string $shortDescription;

    public function getId(): int
    {
        return $this->id;
    }

    public function getGoodsNumber(): int
    {
        return $this->goodsNumber;
    }

    public function setGoodsNumber(int $goodsNumber): Item
    {
        $this->goodsNumber = $goodsNumber;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Item
    {
        $this->name = $name;
        return $this;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setPrice(int $price): Item
    {
        $this->price = $price;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): Item
    {
        $this->description = $description;
        return $this;
    }

    public function getUnit(): int
    {
        return $this->unit;
    }

    public function setUnit(int $unit): Item
    {
        $this->unit = $unit;
        return $this;
    }

    public function getStock(): int
    {
        return $this->stock;
    }

    public function setStock(int $stock): Item
    {
        $this->stock = $stock;
        return $this;
    }

    public function isSaleOff(): bool
    {
        return $this->saleOff;
    }

    public function setSaleOff(bool $saleOff): Item
    {
        $this->saleOff = $saleOff;
        return $this;
    }

    public function getDiscount(): int
    {
        return $this->discount;
    }

    public function setDiscount(int $discount): Item
    {
        $this->discount = $discount;
        return $this;
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): Item
    {
        $this->enabled = $enabled;
        return $this;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTime $created_at): Item
    {
        $this->created_at = $created_at;
        return $this;
    }

    public function getDiscountStartAt(): ?\DateTime
    {
        return $this->discount_start_at;
    }

    public function setDiscountStartAt(?\DateTime $discount_start_at): Item
    {
        $this->discount_start_at = $discount_start_at;
        return $this;
    }

    public function getDiscountEndAt(): ?\DateTime
    {
        return $this->discount_end_at;
    }

    public function setDiscountEndAt(?\DateTime $discount_end_at): Item
    {
        $this->discount_end_at = $discount_end_at;
        return $this;
    }

    public function isNew(): bool
    {
        return $this->new;
    }

    public function setNew(bool $new): Item
    {
        $this->new = $new;
        return $this;
    }

    public function isPopular(): bool
    {
        return $this->popular;
    }

    public function setPopular(bool $popular): Item
    {
        $this->popular = $popular;
        return $this;
    }

    public function isRecommended(): bool
    {
        return $this->recommended;
    }

    public function setRecommended(bool $recommended): Item
    {
        $this->recommended = $recommended;
        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): Item
    {
        $this->image = $image;
        return $this;
    }

    public function getCategory(): ItemCategory
    {
        return $this->category;
    }

    public function setCategory(ItemCategory $category): Item
    {
        $this->category = $category;
        return $this;
    }

    public function getShortDescription(): string
    {
        return $this->shortDescription;
    }

    public function setShortDescription(string $shortDescription): Item
    {
        $this->shortDescription = $shortDescription;
        return $this;
    }

    public function getDiscountedPrice(): int
    {
        return $this->price - ($this->price * ($this->discount / 100));
    }

    public function isDiscounted(): bool
    {
        $today = new \DateTime();

        if ($this->discount_start_at === null || $this->discount_end_at === null) {
            return false;
        }

        return $today >= $this->discount_start_at && $today <= $this->discount_end_at;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'goodsNumber' => $this->goodsNumber,
            'name' => $this->name,
            'price' => $this->price,
            'description' => $this->description,
            'unit' => $this->unit,
            'stock' => $this->stock,
            'saleOff' => $this->saleOff,
            'discount' => $this->discount,
            'enabled' => $this->enabled,
            'createdAt' => $this->created_at,
            'discountStartAt' => $this->discount_start_at,
            'discountEndAt' => $this->discount_end_at,
            'new' => $this->new,
            'popular' => $this->popular,
            'recommended' => $this->recommended,
            'image' => $this->image,
            'shortDescription' => $this->shortDescription,
            'isDiscounted' => $this->isDiscounted(),
        ];
    }
}
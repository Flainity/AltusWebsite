<?php

namespace App\Bundles\CharacterBundle\Entity;

use App\Bundles\CharacterBundle\Repository\CharacterRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CharacterRepository::class)]
#[ORM\Table(name: 'tCharacter')]
class Character implements \JsonSerializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'nCharNo', type: 'integer')]
    private int $id;

    #[ORM\Column(name: 'sID', type: 'string')]
    private string $name;

    #[ORM\Column(name: 'nUserNo', type: 'integer')]
    private int $userId;

    #[ORM\Column(name: 'nAdminLevel', type: 'integer')]
    private int $adminLevel;

    #[ORM\Column(name: 'dCreateDate', type: 'datetime_immutable')]
    private \DateTimeImmutable $createdAt;

    #[ORM\Column(name: 'bDeleted', type: 'boolean')]
    private bool $isDeleted = false;

    #[ORM\Column(name: 'sLoginZone', type: 'string')]
    private string $currentMap;

    #[ORM\Column(name: 'nLoginZoneX', type: 'integer')]
    private int $currentMapX;

    #[ORM\Column(name: 'nLoginZoneY', type: 'integer')]
    private int $currentMapY;

    #[ORM\Column(name: 'nPKCount', type: 'integer')]
    private int $killPoints;

    #[ORM\Column(name: 'nLevel', type: 'integer')]
    private int $level;

    #[ORM\Column(name: 'nExp', type: 'integer')]
    private int $experience;

    #[ORM\Column(name: 'nLoginCount', type: 'integer')]
    private int $loginCount;

    #[ORM\Column(name: 'nFame', type: 'integer')]
    private int $fame;

    #[ORM\Column(name: 'nPlayMin', type: 'integer')]
    private int $playTime;

    #[ORM\Column(name: 'nMoney', type: 'integer')]
    private int $money;

    #[ORM\Column(name: 'nStrength', type: 'integer')]
    private int $strength;

    #[ORM\Column(name: 'nConstitute', type: 'integer')]
    private int $constitution;

    #[ORM\Column(name: 'nDexterity', type: 'integer')]
    private int $dexterity;

    #[ORM\Column(name: 'nIntelligence', type: 'integer')]
    private int $intelligence;

    #[ORM\Column(name: 'nMentalPower', type: 'integer')]
    private int $mentalPower;

    #[ORM\OneToOne(targetEntity: CharacterShape::class, fetch: 'EAGER')]
    #[ORM\JoinColumn(name: 'nCharNo', referencedColumnName: 'nCharNo', nullable: false)]
    private CharacterShape $shape;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Character
    {
        $this->name = $name;
        return $this;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): Character
    {
        $this->userId = $userId;
        return $this;
    }

    public function getAdminLevel(): int
    {
        return $this->adminLevel;
    }

    public function setAdminLevel(int $adminLevel): Character
    {
        $this->adminLevel = $adminLevel;
        return $this;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): Character
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function isDeleted(): bool
    {
        return $this->isDeleted;
    }

    public function setIsDeleted(bool $isDeleted): Character
    {
        $this->isDeleted = $isDeleted;
        return $this;
    }

    public function getCurrentMap(): string
    {
        return $this->currentMap;
    }

    public function setCurrentMap(string $currentMap): Character
    {
        $this->currentMap = $currentMap;
        return $this;
    }

    public function getCurrentMapX(): int
    {
        return $this->currentMapX;
    }

    public function setCurrentMapX(int $currentMapX): Character
    {
        $this->currentMapX = $currentMapX;
        return $this;
    }

    public function getCurrentMapY(): int
    {
        return $this->currentMapY;
    }

    public function setCurrentMapY(int $currentMapY): Character
    {
        $this->currentMapY = $currentMapY;
        return $this;
    }

    public function getKillPoints(): int
    {
        return $this->killPoints;
    }

    public function setKillPoints(int $killPoints): Character
    {
        $this->killPoints = $killPoints;
        return $this;
    }

    public function getLevel(): int
    {
        return $this->level;
    }

    public function setLevel(int $level): Character
    {
        $this->level = $level;
        return $this;
    }

    public function getExperience(): int
    {
        return $this->experience;
    }

    public function setExperience(int $experience): Character
    {
        $this->experience = $experience;
        return $this;
    }

    public function getLoginCount(): int
    {
        return $this->loginCount;
    }

    public function setLoginCount(int $loginCount): Character
    {
        $this->loginCount = $loginCount;
        return $this;
    }

    public function getFame(): int
    {
        return $this->fame;
    }

    public function setFame(int $fame): Character
    {
        $this->fame = $fame;
        return $this;
    }

    public function getPlayTime(): int
    {
        return $this->playTime;
    }

    public function setPlayTime(int $playTime): Character
    {
        $this->playTime = $playTime;
        return $this;
    }

    public function getMoney(): int
    {
        return $this->money;
    }

    public function setMoney(int $money): Character
    {
        $this->money = $money;
        return $this;
    }

    public function getStrength(): int
    {
        return $this->strength;
    }

    public function setStrength(int $strength): Character
    {
        $this->strength = $strength;
        return $this;
    }

    public function getConstitution(): int
    {
        return $this->constitution;
    }

    public function setConstitution(int $constitution): Character
    {
        $this->constitution = $constitution;
        return $this;
    }

    public function getDexterity(): int
    {
        return $this->dexterity;
    }

    public function setDexterity(int $dexterity): Character
    {
        $this->dexterity = $dexterity;
        return $this;
    }

    public function getIntelligence(): int
    {
        return $this->intelligence;
    }

    public function setIntelligence(int $intelligence): Character
    {
        $this->intelligence = $intelligence;
        return $this;
    }

    public function getMentalPower(): int
    {
        return $this->mentalPower;
    }

    public function setMentalPower(int $mentalPower): Character
    {
        $this->mentalPower = $mentalPower;
        return $this;
    }

    public function getShape(): CharacterShape
    {
        return $this->shape;
    }

    public function setShape(CharacterShape $shape): Character
    {
        $this->shape = $shape;
        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'userId' => $this->userId,
            'adminLevel' => $this->adminLevel,
            'createdAt' => $this->createdAt->format('Y-m-d H:i:s'),
            'isDeleted' => $this->isDeleted,
            'currentMap' => $this->currentMap,
            'killPoints' => $this->killPoints,
            'level' => $this->level,
            'experience' => $this->experience,
            'loginCount' => $this->loginCount,
            'fame' => $this->fame,
            'playTime' => $this->playTime,
            'money' => $this->money,
            'strength' => $this->strength,
            'constitution' => $this->constitution,
            'dexterity' => $this->dexterity,
            'intelligence' => $this->intelligence,
            'mentalPower' => $this->mentalPower,
            'shape' => $this->shape
        ];
    }
}
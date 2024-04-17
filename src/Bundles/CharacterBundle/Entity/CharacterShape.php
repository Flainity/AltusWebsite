<?php

namespace App\Bundles\CharacterBundle\Entity;

use App\Bundles\CharacterBundle\Repository\CharacterShapeRepository;
use App\Entity\Test;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CharacterShapeRepository::class)]
#[ORM\Table(name: 'tCharacterShape')]
class CharacterShape implements \JsonSerializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'nCharNo', type: 'integer')]
    private int $id;

    #[ORM\Column(name: 'nClass', type: 'integer')]
    private int $class;

    #[ORM\Column(name: 'nRace', type: 'integer')]
    private int $race;

    #[ORM\Column(name: 'nGender', type: 'integer')]
    private int $gender;

    #[ORM\Column(name: 'nHairType', type: 'integer')]
    private int $hair;

    #[ORM\Column(name: 'nHairColor', type: 'integer')]
    private int $hairColor;

    #[ORM\Column(name: 'nFaceShape', type: 'integer')]
    private int $face;

    #[ORM\OneToOne(mappedBy: 'shape', cascade: ['persist', 'remove'])]
    private ?Character $character = null;

    public function getId(): int
    {
        return $this->id;
    }

    public function getClass(): int
    {
        return $this->class;
    }

    public function setClass(int $class): CharacterShape
    {
        $this->class = $class;
        return $this;
    }

    public function getRace(): int
    {
        return $this->race;
    }

    public function setRace(int $race): CharacterShape
    {
        $this->race = $race;
        return $this;
    }

    public function getGender(): int
    {
        return $this->gender;
    }

    public function setGender(int $gender): CharacterShape
    {
        $this->gender = $gender;
        return $this;
    }

    public function getHair(): int
    {
        return $this->hair;
    }

    public function setHair(int $hair): CharacterShape
    {
        $this->hair = $hair;
        return $this;
    }

    public function getHairColor(): int
    {
        return $this->hairColor;
    }

    public function setHairColor(int $hairColor): CharacterShape
    {
        $this->hairColor = $hairColor;
        return $this;
    }

    public function getFace(): int
    {
        return $this->face;
    }

    public function setFace(int $face): CharacterShape
    {
        $this->face = $face;
        return $this;
    }

    public function getClassName(): string
    {
        return match ($this->class) {
            1 => 'Fighter',
            2 => 'Clever Fighter',
            3 => 'Warrior',
            4 => 'Gladiator',
            5 => 'Knight',
            6 => 'Cleric',
            7 => 'High Cleric',
            8 => 'Paladin',
            9 => 'Holy Knight',
            10 => 'Guardian',
            11 => 'Archer',
            12 => 'Hawk Archer',
            13 => 'Scout',
            14 => 'Sharpshooter',
            15 => 'Ranger',
            16 => 'Mage',
            17 => 'Wiz Mage',
            18 => 'Enchanter',
            19 => 'Warlock',
            20 => 'Wizard',
            21 => 'Trickster',
            22 => 'Gambit',
            23 => 'Renegade',
            24 => 'Spectre',
            25 => 'Reaper',
            default => 'Unknown',
        };
    }

    public function getCharacters(): ?Character
    {
        return $this->character;
    }

    public function setCharacter(Character $character): static
    {
        if ($character->getShape() !== $this) {
            $character->setShape($this);
        }

        $this->character = $character;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'class' => $this->class,
            'race' => $this->race,
            'gender' => $this->gender,
            'className' => $this->getClassName(),
        ];
    }
}
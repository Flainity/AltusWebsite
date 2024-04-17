<?php

namespace App\Bundles\CharacterBundle\Manager;

use App\Bundles\AccountBundle\Entity\User;
use App\Bundles\CharacterBundle\Entity\Character;
use App\Bundles\CharacterBundle\Repository\CharacterRepository;
use App\Bundles\MainBundle\Exception\SettingNotFoundException;
use App\Bundles\MainBundle\Manager\SettingManager;
use App\Bundles\MainBundle\Model\SettingType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\SecurityBundle\Security;

readonly class CharacterManager
{
    public function __construct(
        private CharacterRepository $characterRepository,
        private Security            $security,
        private SettingManager      $settingManager
    ){
    }

    public function getCharactersByUserId(int $userId, bool $includeDeleted = false): array
    {
        return $this->characterRepository->findBy(['userId' => $userId, 'isDeleted' => $includeDeleted]);
    }

    public function getCharacterById(int $characterId): ?Character
    {
        return $this->characterRepository->findOneBy(['id' => $characterId]);
    }

    public function fixCharacterPosition(int $characterId): bool
    {
        $character = $this->getCharacterById($characterId);

        if ($character === null) {
            return false;
        }

        /** @var User $user */
        $user = $this->security->getUser();

        if ($character->getUserId() !== $user->getId()) {
            return false;
        }

        try {
            $resetMap = $this->settingManager->getValueByKey(SettingType::RESET_MAP->value);
            $resetMapX = $this->settingManager->getValueByKey(SettingType::RESET_MAP_X->value);
            $resetMapY = $this->settingManager->getValueByKey(SettingType::RESET_MAP_Y->value);

            $character->setCurrentMap($resetMap);
            $character->setCurrentMapX($resetMapX);
            $character->setCurrentMapY($resetMapY);

            $this->characterRepository->save($character);
        } catch (SettingNotFoundException $exception) {
            return false;
        }

        return true;
    }
}
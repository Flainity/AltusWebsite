<?php

namespace App\Bundles\AccountBundle\Controller\Frontend;

use App\Bundles\AccountBundle\Entity\Authentication;
use App\Bundles\AccountBundle\Entity\User;
use App\Bundles\AccountBundle\Form\RegistrationFormType;
use App\Bundles\MainBundle\Exception\SettingNotFoundException;
use App\Bundles\MainBundle\Manager\SettingManager;
use App\Bundles\MainBundle\Model\SettingType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

#[Route('/security', name: 'security.')]
class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    #[Route('/register', name: 'register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, Security $security, EntityManagerInterface $entityManager, SettingManager $settingManager, ManagerRegistry $doctrine): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $user->setIp($request->getClientIp());

            try {
                $defaultAuthentication = $settingManager->getValueByKey(SettingType::DEFAULT_AUTHENTICATION->value);
            } catch (SettingNotFoundException $exception) {
                $this->addFlash('error', 'An error occurred while registering your account. Please contact an administrator. Error code: REG-001');
                return $this->redirectToRoute('security.register');
            }

            $authentication = $doctrine->getRepository(Authentication::class)->findOneBy(['id' => $defaultAuthentication]);
            $user->setAuthentication($authentication);

            $entityManager->persist($user);
            $entityManager->flush();

            return $security->login($user, 'form_login', 'main');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route(path: '/logout', name: 'logout')]
    public function logout(): Response
    {
        return $this->redirectToRoute('account.security.login');
    }
}
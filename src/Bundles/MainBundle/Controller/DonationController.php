<?php

namespace App\Bundles\MainBundle\Controller;

use App\Bundles\AbstractFiestaController;
use App\Bundles\MainBundle\Form\PaypalDonationType;
use App\Bundles\MainBundle\Manager\PaypalManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DonationController extends AbstractFiestaController
{
    #[Route('/donate', name: 'donate')]
    public function index(Request $request, PaypalManager $paypalManager): Response
    {
        $form = $this->createForm(PaypalDonationType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $authentication = $paypalManager->createAuthentication();
            dd($authentication, $authentication->getAccessToken());
        }

        return $this->render('pages/donation/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
<?php

namespace App\Bundles\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class PaypalDonationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('amount', ChoiceType::class, [
            'choices' => [
                '5' => 5,
                '10' => 10,
                '15' => 15,
                '20' => 20,
                '25' => 25,
                '30' => 30,
                '35' => 35,
                '40' => 40,
                '45' => 45,
                '50' => 50,
            ],
            'label' => 'Amount',
            'required' => true,
            'attr' => [
                'class' => 'form-control',
            ],
        ]);
    }
}
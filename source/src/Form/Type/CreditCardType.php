<?php

declare(strict_types=1);

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class CreditCardType extends AbstractType
{
    public function getParent(): string
    {
        return PaymentType::class;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('holderName', TextType::class)
            ->add('expirationDate',  TextType::class)
            ->add('cvvNumber', TextType::class)
            ->add('proceedCc', SubmitType::class, ['label' => 'Proceed the Payment']);
    }
}
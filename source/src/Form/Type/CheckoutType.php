<?php

declare(strict_types=1);

namespace App\Form\Type;

use App\Entity\Cart;
use App\Entity\CreditCard;
use App\Entity\Payment;
use App\Entity\Paypal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CheckoutType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => Cart::class]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('payment', ChoiceType::class, [
            'expanded' => true,
            'label' => false,
            'choices' => [
                new Paypal(),
                new CreditCard(),
            ],
            'choice_label' => fn (Payment $payment) => \strtoupper($payment->getLabel()),
            'choice_value' => 'key',
        ]);
    }
}
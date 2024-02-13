<?php

declare(strict_types=1);

namespace App\Payment;

use App\Payment\Method\PaymentMethodInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;

final class PaymentFormGuesser
{
    public function __construct(private readonly FormFactoryInterface $builder,)
    {
    }

    public function selectPaymentForm(PaymentMethodInterface $strategy): FormInterface
    {
        return $this->builder->create(
            $strategy->getFormType(),
            options: ['action' => $strategy->getPaymentProcessor()]
        );
    }
}
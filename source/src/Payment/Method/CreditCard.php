<?php

declare(strict_types=1);

namespace App\Payment\Method;

use App\Form\Type\CreditCardType;

class CreditCard extends AbstractPaymentMethod
{
    public function getFormType(): string
    {
        return CreditCardType::class;
    }

    public function getIdentifier(): string
    {
        return 'credit_card';
    }
}

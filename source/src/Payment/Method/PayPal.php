<?php

declare(strict_types=1);

namespace App\Payment\Method;

use App\Form\Type\PayPalType;

class PayPal extends AbstractPaymentMethod
{
    public function getFormType(): string
    {
        return PayPalType::class;
    }

    public function getIdentifier(): string
    {
        return 'paypal';
    }
}

<?php

declare(strict_types=1);

namespace App\Payment\Method;

abstract class AbstractPaymentMethod implements PaymentMethodInterface
{
    public function __construct(protected string $processUrl)
    {
    }

    public function supports(string $method): bool
    {
        return $this->getIdentifier() === $method;
    }

    public function getPaymentProcessor(): string
    {
        return $this->processUrl;
    }
}

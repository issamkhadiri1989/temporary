<?php

declare(strict_types=1);

namespace App\Payment;

use App\Entity\Payment;
use App\Payment\Method\PaymentMethodInterface;
use Symfony\Component\DependencyInjection\Attribute\TaggedIterator;

class PaymentMethodSelector
{
    public function __construct(
        #[TaggedIterator('app.payment_method')]
        private readonly iterable $paymentHandlers,
    ) {
    }

    /**
     * Detect the strategy to use according to the method selected.
     *
     * @param string $method
     *
     * @return PaymentMethodInterface
     */
    public function getPaymentStrategy(string $method): PaymentMethodInterface
    {
        foreach ($this->paymentHandlers as $handler) {
            if ($handler->supports($method)) {
                return $handler;
            }
        }

        throw new \RuntimeException('No payment strategy supporting the ' . $method);
    }
}

<?php

namespace App\Payment\Method;

/**
 * This contract is used to describe any payment method.
 */
interface PaymentMethodInterface
{
    /**
     * Returns true when the given method is supported by one of the strategies.
     *
     * @param string $method
     *
     * @return bool
     */
    public function supports(string $method): bool;

    /**
     * Returns the FQCN of the form type to use to perform payment.
     *
     * @return string
     */
    public function getFormType(): string;

    /**
     * The payment method identifier.
     *
     * @return string
     */
    public function getIdentifier(): string;

    /**
     * The target URL to use to process the payment.
     *
     * @return string
     */
    public function getPaymentProcessor(): string;
}

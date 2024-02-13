<?php

declare(strict_types=1);

namespace App\Entity;

class Paypal extends Payment
{
    public function __construct()
    {
        $this->key = 'paypal';
        $this->label = 'PayPal';
    }
}
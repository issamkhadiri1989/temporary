<?php

declare(strict_types=1);

namespace App\Entity;

class CreditCard extends Payment
{
    public function __construct()
    {
        $this->key = 'credit_card';
        $this->label = 'Credit Card';
    }
}
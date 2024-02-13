<?php

declare(strict_types=1);

namespace App\Event;

use App\Entity\Cart;
use App\Enum\CartStatus;

class CartStatusChangeEvent
{
    public function __construct(
        private readonly Cart $cart,
        private readonly CartStatus $status
    ) {
    }

    public function getCart(): Cart
    {
        return $this->cart;
    }

    public function getStatus(): CartStatus
    {
        return $this->status;
    }
}

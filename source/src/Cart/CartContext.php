<?php

declare(strict_types=1);

namespace App\Cart;

use App\Cart\Handler\CartHandlerInterface;
use App\Model\CartItem as CartItemValueObject;

class CartContext
{
    public function addToCart(CartHandlerInterface $strategy, int $quantity, int $productIdentifier, string $productName): void
    {
        // get a fresh instance of the cart
        $cart = $strategy->getInstance();
        $item = new CartItemValueObject($productIdentifier, $quantity, 0.0, $productName);

        $strategy->add($item, $cart);
    }
}
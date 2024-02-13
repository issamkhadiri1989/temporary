<?php

declare(strict_types=1);

namespace App\Cart\Handler;

use App\Model\Cart as CartValueObject;
use App\Model\CartItem as CartItemValueObject;
use Symfony\Component\DependencyInjection\Attribute\AsAlias;
use Symfony\Component\HttpFoundation\RequestStack;

#[AsAlias]
final class SessionCartHandler implements CartHandlerInterface
{
    public function __construct(private readonly RequestStack $stack)
    {
    }

    public function add(CartItemValueObject $item, CartValueObject $cart): void
    {
        // add to cart
        $newContent = $cart->add($item);

        // update the content of the cart
        $this->update($newContent, $cart);
    }

    public function getInstance(): CartValueObject
    {
        $session = $this->stack->getSession();

        if (!$session->has('cart_content')) {
            $session->set('cart_content', $instance = new CartValueObject());
        } else {
            $instance = $session->get('cart_content');
        }

        return $instance;
    }

    public function update(CartValueObject $newContent, CartValueObject $currentCart): void
    {
        $updatedCart = $currentCart->clear();

        foreach ($newContent->getItems() as $item) {
            $updatedCart->add($item);
        }

        $session = $this->stack->getSession();
        $session->set('cart_content', $updatedCart);
    }

    public function clear(CartValueObject $currentCart): void
    {
       $newCart = $currentCart->clear();
       $this->update($newCart, $currentCart);
    }
}
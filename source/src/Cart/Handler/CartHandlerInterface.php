<?php

namespace App\Cart\Handler;

use App\Model\Cart as CartValueObject;
use App\Model\CartItem as CartItemValueObject;

/**
 * Interface representing the Strategies to be used while handling the cart.
 */
interface CartHandlerInterface
{
    /**
     * Add the element to Cart.
     *
     * @param CartItemValueObject $item
     * @param CartValueObject $cart
     *
     * @return void
     */
    public function add(CartItemValueObject $item, CartValueObject $cart): void;

    /**
     * Gets the Cart instance.
     *
     * @return mixed
     */
    public function getInstance(): CartValueObject;

    /**
     * Update the content of the Cart with the new content.
     *
     * @param CartValueObject $newContent
     * @param CartValueObject $currentCart
     *
     * @return void
     */
    public function update(CartValueObject $newContent, CartValueObject $currentCart): void;

    /**
     * Clears the content of the Cart.
     *
     * @param CartValueObject $currentCart
     *
     * @return void
     */
    public function clear(CartValueObject $currentCart): void;
}
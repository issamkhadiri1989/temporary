<?php

declare(strict_types=1);

namespace App\Cart\Handler;

use App\Model\Cart as CartValueObject;
use App\Model\CartItem as CartItemValueObject;
use Doctrine\ORM\EntityManagerInterface;

final class DatabaseCartHandler implements CartHandlerInterface
{
    public function __construct(private readonly EntityManagerInterface $manager)
    {
    }

    public function add(CartItemValueObject $item, CartValueObject $cart): void
    {
        // TODO: Implement add() method.
    }

    public function getInstance(): CartValueObject
    {
        return new CartValueObject();
    }

    public function update(CartValueObject $newContent, CartValueObject $currentCart): void
    {
        // TODO: Implement update() method.
    }

    public function clear(CartValueObject $currentCart): void
    {
        // TODO: Implement clear() method.
    }
}
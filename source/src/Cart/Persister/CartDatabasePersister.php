<?php

namespace App\Cart\Persister;

use App\Entity\Cart;
use Doctrine\ORM\EntityManagerInterface;

final class CartDatabasePersister implements CartPersisterInterface
{
    public function __construct(private readonly EntityManagerInterface $manager)
    {

    }

    public function persist(Cart $cart): void
    {
        if (\count($cart->getItems()) === 0) {
            return;
        }

        $this->manager->persist($cart);
        foreach ($cart->getItems() as $cartItem) {
            $cartItem->setPrice($cartItem->getProduct()->getPrice());

            $this->manager->persist($cartItem);
        }

        $this->manager->flush();
    }
}
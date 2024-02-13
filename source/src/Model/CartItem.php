<?php

declare(strict_types=1);

namespace App\Model;

/**
 * This object represents the Cart Item.
 */
final class CartItem
{
    public function __construct(
        public readonly int $productIdentifier,
        public readonly int $quantity,
        public readonly float $price,
        public readonly string $productName,
    ) {

    }

    public function equals(CartItem $item): bool
    {
        return $this->productIdentifier === $item->productIdentifier;
    }
}
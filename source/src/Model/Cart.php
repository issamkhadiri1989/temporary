<?php

declare(strict_types=1);

namespace App\Model;

/**
 * this object represents the Cart
 */
final class Cart
{
    private array $items;

    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    public function add(CartItem $item): Cart
    {
        // first, find in the list if the item is already existing in the list.
        $element = \array_filter($this->items, fn (CartItem $element) => $element->equals($item));

        // if no element was found
        if (empty($element)) {
            $this->items[] = $item;
        } else {
            $index = \array_key_first($element);
            $this->items[$index] = new CartItem(
                $item->productIdentifier,
                $item->quantity + $this->items[$index]->quantity,
                0.0,
                $item->productName,
            );
        }

        return new Cart($this->items);
    }

    public function clear(): Cart
    {
        return $this->setItems([]);
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function setItems(array $items): Cart
    {
        $this->items = $items;

        return $this;
    }
}

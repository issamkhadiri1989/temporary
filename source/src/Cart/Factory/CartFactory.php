<?php

namespace App\Cart\Factory;

use App\Cart\Handler\CartHandlerInterface;
use App\Entity\Cart;
use App\Entity\CartItem;
use App\Entity\Product;
use App\Enum\CartStatus;
use App\Model\Cart as CartValueObject;
use Doctrine\ORM\EntityManagerInterface;

final class CartFactory
{
    public function __construct(private readonly EntityManagerInterface $manager)
    {

    }

    /**
     * Build Cart entity from depending on the Strategy used.
     *
     * @param CartHandlerInterface $handler
     *
     * @return Cart
     */
    public function build(CartHandlerInterface $handler): Cart
    {
        $input = $handler->getInstance();

        $cart = new Cart();
        $cart->setStatus(CartStatus::placed)
            ->setCreatedAt(new \DateTimeImmutable());

        $this->loadEntries($input, $cart);

        return $cart;
    }

    private function loadEntries(CartValueObject $input, Cart $cartEntity): void
    {
        $requestedProducts = \array_column($input->getItems(), 'quantity', 'productIdentifier');

        $products = $this->manager
            ->getRepository(Product::class)
            ->findBy(['id' => \array_keys($requestedProducts)]);

        foreach ($products as $product) {
            $cartEntity->addItem((new CartItem())
                ->setQuantity($requestedProducts[$product->getId()])
                ->setProduct($product));
        }
    }
}
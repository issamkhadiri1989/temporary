<?php

namespace App\Listener;

use App\Entity\Cart;
use App\Enum\CartStatus;
use App\Event\CartStatusChangeEvent;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Events;

#[AsEntityListener(event: Events::prePersist, method: 'markCartAsNew', entity: Cart::class)]
#[AsEntityListener(event: 'app.event.order_status_changed', method: 'updateStatus', entity: Cart::class)]
class CartStatusDefinerListener
{
    public function markCartAsNew(Cart $cart, PrePersistEventArgs $event): void
    {
        $cart->setStatus(CartStatus::new);
    }

    public function updateStatus(CartStatusChangeEvent $event): void
    {

    }
}

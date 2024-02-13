<?php

declare(strict_types=1);

namespace App\Listener;

use App\Event\CartStatusChangeEvent;
use App\Notifier\MailNotifier;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

class CartStatusChangedListener
{
    public function __construct(private readonly MailNotifier $notifier)
    {
    }

    #[AsEventListener(event: 'app.event.order_status_changed',)]
    public function onChangedEvent(CartStatusChangeEvent $event): void
    {
        $this->notifier->newCartPlacedNotification(...);
    }
}
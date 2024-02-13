<?php

namespace App\Notifier;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;

final class MailNotifier
{
    public function __construct(
        private readonly MailerInterface $mailer,
        private readonly string $support
    ) {

    }

    public function newCartPlacedNotification(string $destination): void
    {
        $message = (new TemplatedEmail())
            ->from($this->support)
            ->to($destination)
            ->htmlTemplate('email/new_order_placed.html.twig')
            ->context([
                'send_email' => $destination,
            ]);

        $this->mailer->send($message);
    }
}
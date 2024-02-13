<?php

namespace App\Controller;

use App\Cart\Handler\CartHandlerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Attribute\Target;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Notifier\NotifierInterface;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_default')]
    public function index(
        NotifierInterface $notifier,
        #[Target('databaseCartHandler')]
        CartHandlerInterface $handler
    ): Response {
        $cart = $handler->getInstance();

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
}
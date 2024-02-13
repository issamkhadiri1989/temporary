<?php

namespace App\Controller;

use App\Cart\Factory\CartFactory;
use App\Cart\Handler\CartHandlerInterface;
use App\Cart\Persister\CartPersisterInterface;
use App\Entity\Cart;
use App\Enum\CartStatus;
use App\Event\CartStatusChangeEvent;
use App\Form\Type\CartType;
use App\Form\Type\CheckoutType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'app_cart')]
    public function index(
        CartFactory            $factory,
        CartPersisterInterface $persister,
        Request                $request,
        CartHandlerInterface   $handler
    ): Response {
        $cart = $factory->build($handler);

        $form = $this->createForm(CartType::class, $cart);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $content = $form->getData();
            $persister->persist($content);
            $handler->clear($handler->getInstance());

            $request->getSession()->set('cart_id', $content->getId());

            return $this->redirectToRoute('app_valid_cart');
        }

        return $this->render('cart/index.html.twig', [
            'cart' => $form,
        ]);
    }

    #[Route('/cart/clear', name: 'app_clear_cart')]
    public function clear(CartHandlerInterface $handler): Response
    {
        $cart = $handler->getInstance();
        $handler->clear($cart);

        return $this->redirectToRoute('app_default');
    }

    #[Route('/cart/checkout', name: 'app_checkout_cart')]
    public function checkout(
        EntityManagerInterface $manager,
        Request                $request,
    ): Response {
        $cartIdentifier = $request->getSession()->get('cart_id');

        /** @var Cart $cart */
        $cart = $manager->getRepository(Cart::class)->find($cartIdentifier);

        $form = $this->createForm(CheckoutType::class, $cart);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $method = $data->getPayment()->getKey();

            $request->getSession()->set('strategy', $method);

            return $this->redirectToRoute('app_payment');
        }

        return $this->render('cart/checkout.html.twig', [
            'cart' => $cart,
            'form' => $form,
        ]);
    }

    #[Route('/cart/valid', name: 'app_valid_cart')]
    public function valid(Request $request, EventDispatcherInterface $dispatcher, EntityManagerInterface $manager): Response
    {
        $cartIdentifier = $request->getSession()->get('cart_id');

        /** @var Cart $cart */
        $cart = $manager->getRepository(Cart::class)->find($cartIdentifier);

        $event = new CartStatusChangeEvent($cart, CartStatus::placed);

        $dispatcher->dispatch($event,/* 'app.event.order_status_changed'*/);

        return $this->render('cart/valid.html.twig');

    }
}

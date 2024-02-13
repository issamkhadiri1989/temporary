<?php

namespace App\Controller;

use App\Payment\PaymentFormGuesser;
use App\Payment\PaymentMethodSelector;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PaymentController extends AbstractController
{
    #[Route('/payment', name: 'app_payment')]
    public function index(Request $request, PaymentMethodSelector $selector, PaymentFormGuesser $guesser): Response
    {
        $method = $request->getSession()->get('strategy');

        $strategy = $selector->getPaymentStrategy($method);

        $paymentForm = $guesser->selectPaymentForm($strategy);
        $paymentForm->handleRequest($request);

        if ($paymentForm->isSubmitted() && $paymentForm->isValid()) {
            $data = $paymentForm->getData();

            // ...
        }

        return $this->render('payment/index.html.twig', [
            'payment' => $paymentForm,
        ]);
    }
}

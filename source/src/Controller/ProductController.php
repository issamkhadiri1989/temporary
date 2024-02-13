<?php

namespace App\Controller;

use App\Cart\CartContext;
use App\Cart\Handler\CartHandlerInterface;
use App\Entity\CartItem;
use App\Entity\Product;
use App\Form\Type\CartItemType;
use App\Form\Type\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductController extends AbstractController
{
    #[Route('/product/{slug}', name: 'app_product')]
    public function index(
        Request $request,
        Product $product,
        CartHandlerInterface $handler,
        CartContext $context
    ): Response {
        $item = new CartItem();
        $item->setQuantity(1);
        $form = $this->createForm(CartItemType::class, $item);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $context->addToCart($handler, $item->getQuantity(), $product->getId(), $product->getName());

            return $this->redirectToRoute('app_cart');
        }

        return $this->render('product/index.html.twig', [
            'form' => $form,
            'product' => $product,
        ]);
    }

    #[Route('/product/add', name: 'app_add_product')]
    public function add(Request $request): Response
    {
        $item = new Product();
        $form = $this->createForm(ProductType::class, $item);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

        }

        return $this->render('product/edit.html.twig', [
            'form' => $form,
        ]);
    }
}

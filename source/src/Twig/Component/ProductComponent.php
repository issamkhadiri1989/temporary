<?php

declare(strict_types=1);

namespace App\Twig\Component;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(name: 'product')]
class ProductComponent
{
    public string $name;

    public bool $forSale;

    public string $thumbnail;

    public float $price;
}
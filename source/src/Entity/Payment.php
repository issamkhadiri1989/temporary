<?php

declare(strict_types=1);

namespace App\Entity;

abstract class Payment
{
    protected string $key, $label;

    public function getKey(): string
    {
        return $this->key;
    }
    public function getLabel(): string
    {
        return $this->label;
    }

}
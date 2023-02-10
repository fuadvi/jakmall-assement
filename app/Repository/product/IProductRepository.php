<?php

namespace App\Repository\product;

use Illuminate\Support\Collection;

interface IProductRepository
{
    public function list(): array;
    public function get(int $productId,  array $products): array;
}
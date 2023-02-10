<?php

namespace App\Services\Product;
interface IProductService
{
    public function getProduct() : array;
    public function getProductById(int $productId) : array;
}
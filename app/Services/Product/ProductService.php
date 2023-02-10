<?php

namespace App\Services\Product;

use App\Repository\product\IProductRepository;
use Illuminate\Support\Facades\Cache;

class ProductService implements IProductService
{


    public function __construct(IProductRepository $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    public function getProduct() : array
    {
        return $this->productRepo->list();
    }

    public function getProductById(int $productId): array
    {
        $products = $this->productRepo->list();
        return $this->productRepo->get($productId, $products);
    }


}
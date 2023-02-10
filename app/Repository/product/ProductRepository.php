<?php

namespace App\Repository\product;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;

class ProductRepository implements IProductRepository
{
    private $product;

    /**
     * @param $product
     */
    public function __construct()
    {
        $products = File::get(database_path('products.json'));
        $this->product = json_decode($products, true);
    }


    public function list(): array
    {
        return $this->product;
    }

    public function get(int $productId, array $products): array
    {
        return array_filter($products, function ($review) use ($productId) {
            return $review['id'] === $productId;
        });
    }


}
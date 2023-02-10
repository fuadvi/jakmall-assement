<?php

namespace App\Repository\product;

use Illuminate\Support\Facades\Cache;
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
        if (!Cache::has('product'))
        {
            return $this->product;
        }
        return Cache::get('product');
    }

    public function get(int $productId, array $products): array
    {
        if (!Cache::has('product_'.$productId))
        {
            return array_filter($products, function ($products) use ($productId) {
                return $products['id'] === $productId;
            });
        }
        return Cache::get('product_'.$productId);
    }
}
<?php

namespace Tests\Feature;

use App\Services\Product\IProductService;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class ProductServiceTest extends TestCase
{
    protected $productService;
    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->productService = $this->app->make(IProductService::class);
    }

    private function ExpectedListProduk()
    {
        $products = File::get(database_path('products.json'));
        return json_decode($products, true);
    }

    private function ExpectedProdukById(int $productId)
    {
        return array_filter($this->ExpectedListProduk(), function ($products) use ($productId) {
            return $products['id'] === $productId;
        });
    }

    /**
     * @test
     *
     * @return void
     */
    public function will_return_service_not_null(): void
    {

        $this->assertNotNull($this->productService);
    }

    /**
     * @test
     *
     * @return void
     */
    public function will_return_list_product(): void
    {
        $products = $this->ExpectedListProduk();
        $this->assertEquals(collect($this->productService->getProduct())->toJson(), collect($products)->toJson());
    }

    /**
     * @test
     *
     * @return void
     */
    public function will_return_product_by_id_exitst(): void
    {
        $product = $this->ExpectedProdukById(1);
        $this->assertEquals(collect($this->productService->getProductById(1))->toJson(), collect($product)->toJson());
    }

    /**
     * @test
     *
     * @return void
     */
    public function will_return_product_by_id_not_contains(): void
    {
        $product = $this->ExpectedProdukById(55);
        $this->assertNotContains(collect($this->productService->getProductById(55))->toJson(),$product);
    }


}
<?php

namespace App\Commands;

use LaravelZero\Framework\Commands\Command;
use \App\Services\Product\IProductService;
use \App\Services\Review\IReviewService;


class ReviewProductCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'review:product {productId : Id for product}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'List review of product';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(
        IProductService $product,
        IReviewService $review
    )
    {
        $productId = (int) $this->argument('productId');
        $products = $product->getProductById($productId);

        if (!$products) {
            $this->warn('Failed to retrieve products');
            ReviewProductCommand::FAILURE;
        }

        $reviews = $review->getReview();

        if (!$reviews) {
            $this->warn('Failed to retrieve reviews');
            ReviewProductCommand::FAILURE;
        }

        $product_reviews = $review->getReviewByProductId($productId);

        if (!$product_reviews) {
            $this->warn('Failed to retrieve product reviews');
            ReviewProductCommand::FAILURE;
        }

        $result = $review->calculate($product_reviews);
        $this->line(collect($result)->toJson());
    }
}

<?php

namespace App\Commands;

use LaravelZero\Framework\Commands\Command;


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
        \App\Services\Product\IProductService $product,
        \App\Services\Review\IReviewService $review
    )
    {
        $productId = (int) $this->argument('productId');
        $products = $product->getProductById($productId);

        if (!$products) {
            $this->warn('Failed to retrieve products statistics');
            ReviewProductCommand::FAILURE;
        }

        $reviews = $review->getReview();

        if (!$reviews) {
            $this->warn('Failed to retrieve reviews statistics');
            ReviewProductCommand::FAILURE;
        }

        $product_reviews = $review->getReviewById($productId);

        if (!$product_reviews) {
            $this->warn('Failed to retrieve product reviews statistics');
            ReviewProductCommand::FAILURE;
        }

        $result = $review->calculate($product_reviews);
        $this->line(collect($result)->toJson());
    }
}

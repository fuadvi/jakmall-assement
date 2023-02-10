<?php

namespace App\Repository\Review;

use Illuminate\Support\Facades\File;

class ReviewRepository implements \App\Repository\Review\IReviewRepository
{
    private $reviews;

    /**
     * @param $reviews
     */
    public function __construct()
    {
        $reviews = File::get(database_path('reviews.json'));
        $this->reviews = json_decode($reviews, true);
    }

    public function list(): array
    {
        return $this->reviews;
    }

    public function get(int $productId, array $reviews): array
    {
        return array_filter($reviews, function ($review) use ($productId) {
            return $review['product_id'] === $productId;
        });
    }


}
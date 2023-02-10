<?php

namespace App\Repository\Review;

use Illuminate\Support\Facades\Cache;
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
        if (!Cache::has('review'))
        {
            return $this->reviews;
        }
        return Cache::get('review');

    }

    public function get(int $productId, array $reviews): array
    {
        if (!Cache::has('product_review'))
        {
            return array_filter($reviews, function ($review) use ($productId) {
                return $review['product_id'] === $productId;
            });
        }
       return Cache::get('product_review');
    }


}
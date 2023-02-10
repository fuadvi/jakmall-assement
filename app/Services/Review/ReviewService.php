<?php

namespace App\Services\Review;

use App\Repository\Review\IReviewRepository;

class ReviewService implements IReviewService
{

    public function __construct(IReviewRepository $reviewRepo)
    {
        $this->reviewRepo = $reviewRepo;
    }

    public function getReview(): array
    {
        return $this->reviewRepo->list();
    }

    public function getReviewById(int $reviewId): array
    {
        $review =$this->reviewRepo->list();
        return $this->reviewRepo->get($reviewId, $review);
    }

    public function calculate(array $product_reviews): array
    {
        $total_reviews = count($product_reviews);
        $average_ratings = array_sum(array_column($product_reviews, 'rating')) / $total_reviews;
        $star_ratings = array_count_values(array_column($product_reviews, 'rating'));

        return [
            'total_reviews' => $total_reviews,
            'average_ratings' =>(float) number_format($average_ratings, 1, '.', '') ,
            '5_star' => $star_ratings[5] ?? 0,
            '4_star' => $star_ratings[4] ?? 0,
            '3_star' => $star_ratings[3] ?? 0,
            '2_star' => $star_ratings[2] ?? 0,
            '1_star' => $star_ratings[1] ?? 0,
        ];

    }


}
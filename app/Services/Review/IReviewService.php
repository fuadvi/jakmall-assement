<?php

namespace App\Services\Review;

interface IReviewService
{
    public function getReview(): array;
    public function getReviewById(int $reviewId): array;
    public function calculate(array $product_reviews): array;
}
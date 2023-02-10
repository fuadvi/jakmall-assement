<?php

namespace App\Services\Review;

interface IReviewService
{
    public function getReview(): array;
    public function getReviewByProductId(int $productId): array;
    public function calculate(array $product_reviews): array;
}
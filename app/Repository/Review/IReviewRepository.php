<?php

namespace App\Repository\Review;

interface IReviewRepository
{
    public function list(): array;
    public function get(int $productId,  array $reviews): array;
}
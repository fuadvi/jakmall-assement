<?php

namespace App\Commands;

use LaravelZero\Framework\Commands\Command;

class ReviewSummaryCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'review:summary';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Summary list of review';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(\App\Services\Review\IReviewService $review)
    {

        $reviews = $review->getReview();
        if (!$reviews)
        {
            $this->warn('Failed to retrieve reviews');
            ReviewProductCommand::FAILURE;
        }

        $result = $review->calculate($reviews);
        $this->info(collect($result)->toJson());
    }
}

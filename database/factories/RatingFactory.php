<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Image;
use App\Models\Rating;
use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rating>
 */
class RatingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userIds = User::query()->pluck('id')->toArray();
        return [
            'user_id'=>Arr::random($userIds),
            'rating'=>fake()->numberBetween(1,5),
            'ratingable_id'=>1,
            'ratingable_type'=>1,
        ];
    }
    public function configure()
    {
        return $this->afterCreating(function (Rating $rating) {
            if (rand(0, 2) == 0) {
                $articlesIds = Article::query()->pluck('id')->toArray();
                $rating->ratingable_id =Arr::random($articlesIds);
                $rating->ratingable_type =Article::class;
            }elseif (rand(0, 2) == 1) {
                $videoIds = Video::query()->pluck('id')->toArray();
                $rating->ratingable_id =Arr::random($videoIds);
                $rating->ratingable_type =Video::class;
            }else{
                $imageIds = Image::query()->pluck('id')->toArray();
                $rating->ratingable_id =Arr::random($imageIds);
                $rating->ratingable_type =Image::class;
            }
            $rating->save();
        });
    }
}

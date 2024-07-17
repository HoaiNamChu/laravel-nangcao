<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Image;
use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
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
            'content'=>fake()->text(),
            'commentable_id'=>1,
            'commentable_type'=>1,
        ];
    }
    public function configure()
    {
        return $this->afterCreating(function (Comment $comment) {
            if (rand(0, 2) == 0) {
                $articlesIds = Article::query()->pluck('id')->toArray();
                $comment->commentable_id =Arr::random($articlesIds);
                $comment->commentable_type =Article::class;
            }elseif (rand(0, 2) == 1) {
                $videoIds = Video::query()->pluck('id')->toArray();
                $comment->commentable_id =Arr::random($videoIds);
                $comment->commentable_type =Video::class;
            }else{
                $imageIds = Image::query()->pluck('id')->toArray();
                $comment->commentable_id =Arr::random($imageIds);
                $comment->commentable_type =Image::class;
            }
            $comment->save();
        });
    }
}

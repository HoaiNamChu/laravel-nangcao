
<div>
    <h1>Comment bai viet id {{ $article->id }}</h1>
    @foreach($article->comments as $comment)
        {{ $comment->id  }}
    @endforeach
    <div>
        {{ $agvRatingArticle }}
    </div>
</div>

<div>
    <h1>Rating video id {{ $video->id }}</h1>
    @foreach($video->ratings as $rating)
        {{ $rating->id  }}
    @endforeach
</div>

<div>
    <h1>Comment cua user id {{ $user->id }}</h1>
    @foreach($user->comments as $comment)
        {{ $comment->id  }}
    @endforeach
</div>

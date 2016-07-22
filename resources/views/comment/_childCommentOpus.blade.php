@foreach($comment->allChildComments as $childComment)
    <div class="child-comment container">
        <div class="container-fluid comment anchor" id="cid:{{ $childComment->id }}">
            @if(!isset($childComment->deleted) or !$childComment->deleted)
                <div class="col-md-2 comment-avatar">
                    <div class="text-center">
                        <a href="{{ action('ProfileController@show', $childComment->user->slug) }}">
                            <img src="{{ $childComment->user->getAvatar() }}" alt="avatar">
                        </a>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="row"><span class="comment-name">{!! $childComment->user->decorateUsername()  !!}</span>
                        > <a href="{{ Request::url() }}#cid:{{ $comment->id }}">{!! $comment->user->decorateUsername()  !!}</a></div>
                    <div class="comment-body">
                        <div class="comment-date">{{ $childComment->created_at }}</div>
                        <p class="comment-text">{{ $childComment->body }}</p>
                    </div>
                </div>
                <div class="container">
                    @include('comment._replyChild', ['comment'=>$childComment])
                </div>
            @else
                <b>Deleted</b>
            @endif
        </div>
        @if($childComment->allChildComments->count() >= 2)
            <div>
                <a class="btn btn-link" href="{{ action('CommentController@show', $childComment->id) }}">View More</a>
            </div>
        @elseif($childComment->allChildComments->count() < 2)
            @include('comment._childCommentOpus', ['comment' => $childComment, 'opus'=>$opus])
        @endif
    </div>
@endforeach
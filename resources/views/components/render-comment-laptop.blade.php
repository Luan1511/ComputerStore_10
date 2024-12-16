@if (isset($comments))
    @foreach ($comments as $comment)
        <div class="comment-item">
            <div class="comment-user">
                @if ($comment->user->img)
                    <img src="{{ asset('storage/' . $comment->user->img) }}" alt="" height="30" width="30">
                @else
                    <img src="{{ asset('storage/images/User/1.png') }}" alt="" height="30" width="30">
                @endif
                <span>{{ $comment->user->name }}</span>
            </div>
            <div class="comment-content">
                {{ $comment->content }}
            </div>
            <div class="comment-date">
                {{ $comment->created_at->format('d/m/Y H:i') }}
            </div>
        </div>
    @endforeach
@endif

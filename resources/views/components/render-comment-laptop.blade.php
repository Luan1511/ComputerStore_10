@if (isset($comments))
    @if ($comments->count() < 1)
        <p>No comments yet.</p>
    @endif
    @foreach ($comments as $comment)
        <div class="comment-item">
            <div>
                <div class="comment-user">
                    @if ($comment->user->img)
                        <img src="{{ asset('storage/' . $comment->user->img) }}" alt="" height="30"
                            width="30">
                    @else
                        <img src="{{ asset('storage/images/User/1.png') }}" alt="" height="30" width="30">
                    @endif
                    <span>{{ $comment->user->name }}</span>
                </div>
                <div class="comment-content">
                    {{ $comment->content }}
                </div>
                <div class="star">
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= $comment->rating)
                            <i class="fa fa-star"></i>
                        @else
                            <i class="fa fa-star-o"></i>
                        @endif
                    @endfor
                </div>
                <div class="comment-date">
                    {{ $comment->created_at->format('d/m/Y H:i') }}
                </div>
            </div>
            {{-- <a class="brand-btn" style="height: 35px">Edit</a> --}}
        </div>
    @endforeach
@endif

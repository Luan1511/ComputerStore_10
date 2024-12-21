@php
    use Carbon\Carbon;
@endphp

<div class="right message right-message d-flex">
    @if (isset($message->content))
        <p>{{ $message->content }}</p>
        <div class="date-mess"> {{ Carbon::parse($message->created_at)->format('H:i - d/m/y') }} </div>
    @else
        <p>{{ $message }}</p>
        <div class="date-mess"> {{ Carbon::parse(now())->format('H:i - d/m/y') }} </div>
    @endif

    @if (isset($message->user->img))
        @if (Auth::user()->authority == 1)
            <img src="{{ asset('storage/' . $message->admin->user->img) }}" alt="Avatar" height="30px" width="30px"
                style="border-radius: 50%">
        @else
            <img src="{{ asset('storage/' . $message->user->img) }}" alt="Avatar" height="30px" width="30px"
                style="border-radius: 50%">
        @endif
    @else
        @if (Auth::user()->img == null)
            <img src="{{ asset('storage/images/users/1.jpg') }}" alt="Avatar" height="30px" width="30px"
                style="border-radius: 50%">
        @else
            <img src="{{ asset('storage/' . Auth::user()->img) }}" alt="Avatar" height="30px" width="30px"
                style="border-radius: 50%">
        @endif
    @endif
</div>

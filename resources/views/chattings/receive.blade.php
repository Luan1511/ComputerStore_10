@php
    use Carbon\Carbon;
@endphp

@if (isset($messages))
    @foreach ($messages as $message)
        @if (Auth::user()->authority == 1)
            @if ($message->admin_id == null)
                <div class="left message left-message d-flex">
                    @if (isset($message->user->img))
                        <img src="{{ asset('storage/' . $message->user->img) }}" alt="Avatar" height="30px"
                            width="30px" style="border-radius: 50%">
                    @else
                        <img src="{{ asset('storage/images/users/1.jpg') }}" alt="Avatar" height="30px" width="30px"
                            style="border-radius: 50%">
                    @endif
                    <p>{{ $message->content }}</p>
                    <div class="date-mess"> {{ Carbon::parse($message->created_at)->format('H:i - d/m/y') }} </div>
                </div>
            @else
                @include('chattings.broadcast')
            @endif
        @else
            @if ($message->admin_id != null)
                <div class="left message left-message d-flex">
                    @if (isset($message->user->img))
                        <img src="{{ asset('storage/' . $message->user->img) }}" alt="Avatar" height="30px"
                            width="30px" style="border-radius: 50%">
                    @else
                        <img src="{{ asset('storage/images/users/1.jpg') }}" alt="Avatar" height="30px"
                            width="30px" style="border-radius: 50%">
                    @endif
                    <p>{{ $message->content }}</p>
                    <div class="date-mess"> {{ Carbon::parse($message->created_at)->format('H:i - d/m/y') }} </div>
                </div>
            @else
                @include('chattings.broadcast')
            @endif
        @endif
    @endforeach
@else
    <div class="left message left-message d-flex">
        <img src="{{ asset('storage/images/users/1.jpg') }}" alt="Avatar" height="30px" width="30px"
            style="border-radius: 50%">
        <p>{{ $message }}</p>
        <div class="date-mess"> {{ Carbon::parse(now())->format('H:i - d/m/y') }} </div>
    </div>
@endif

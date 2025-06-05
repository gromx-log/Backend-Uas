@extends('layout.app')

@section('content')
<div class="container">
    <h1>{{ $user->display_name ?? $user->username }}'s Profile</h1>

    <p><strong>Username:</strong> {{ '@' . $user->username }}</p>

    @if ($user->bio)
        <p><strong>Bio:</strong> {{ $user->bio }}</p>
    @endif

    <p><strong>Followers:</strong> {{ $user->followers_count }}</p>
    <p><strong>Following:</strong> {{ $user->following_count }}</p>

    {{-- Optional: tombol follow/unfollow nanti bisa di sini --}}
    @if (auth()->check() && auth()->id() !== $user->userId)
        <form method="POST" action="{{ $isFollowing ? route('users.unfollow', $user) : route('users.follow', $user) }}">
            @csrf
            @if ($isFollowing)
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Unfollow</button>
            @else
                <button type="submit" class="btn btn-primary">Follow</button>
            @endif
        </form>
    @endif
</div>
@endsection

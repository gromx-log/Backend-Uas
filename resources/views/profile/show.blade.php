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
</div>
@endsection

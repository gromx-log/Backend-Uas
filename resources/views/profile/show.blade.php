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
    <!-- Follow/Unfollow Button -->
    @if(auth()->check() && auth()->user()->userId != $user->userId)
        <div id="follow-button-container">
            @if($isFollowing)
                <form action="{{ route('users.unfollow', $user) }}" method="POST" id="unfollow-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-full border border-gray-500 font-semibold">
                        Following
                    </button>
                </form>
            @else
                <form action="{{ route('users.follow', $user) }}" method="POST" id="follow-form">
                    @csrf
                    <button type="submit" class="bg-white hover:bg-gray-100 text-black px-4 py-2 rounded-full font-semibold">
                        Follow
                    </button>
                </form>
            @endif
        </div>
    @endif
</div>
@endsection

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Followers - {{ $user->username }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
<div class="container mx-auto py-8 max-w-2xl">
    <!-- Header -->
    <div class="mb-6">
        <a href="{{ route('profile.show', $user->userHandle) }}">
            <button class="bg-blue-500 text-white px-4 py-2 rounded-full font-bold hover:bg-blue-600 transition">← Back to Profile</button>
        </a>
    </div>

    <!-- Page Title -->
    <div class="bg-white rounded-2xl shadow-md p-6 mb-6">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center text-lg font-bold text-gray-600">
                {{ strtoupper(substr($user->username, 0, 2)) }}
            </div>
            <div>
                <h1 class="text-2xl font-bold text-gray-900">{{ $user->username }}</h1>
                <p class="text-gray-500">{{ $followers->total() }} Followers</p>
            </div>
        </div>
    </div>

    <!-- Followers List -->
    <div class="bg-white rounded-2xl shadow-md">
        @forelse($followers as $follower)
            <div class="flex items-center justify-between p-6 {{ !$loop->last ? 'border-b border-gray-100' : '' }}">
                <div class="flex items-center gap-4">
                    <!-- Avatar -->
                    <div class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center text-lg font-bold text-gray-600">
                        {{ strtoupper(substr($follower->username, 0, 2)) }}
                    </div>
                    
                    <!-- User Info -->
                    <div class="flex-1">
                        <div class="flex items-center gap-2">
                            @if(auth()->check() && auth()->user()->userId == $follower->userId)
                                <a href="{{ route('profile.show', $follower->userHandle) }}" class="font-bold text-gray-900 hover:underline">
                                    {{ $follower->username }}
                                </a>
                            @else
                                <a href="{{ route('users.show', $follower->userHandle) }}" class="font-bold text-gray-900 hover:underline">
                                    {{ $follower->username }}
                                </a>
                            @endif
                        </div>
                        <p class="text-gray-500 text-sm">
                            <span class="font-mono">{{ '@' . ltrim($follower->userHandle, '@') }}</span>
                        </p>
                        @if($follower->bio)
                            <p class="text-gray-700 text-sm mt-1">{{ Str::limit($follower->bio, 100) }}</p>
                        @endif
                    </div>
                </div>

                <!-- Follow Button -->
                @if(auth()->check() && auth()->user()->userId != $follower->userId)
                    <div class="flex-shrink-0">
                        @if($follower->is_following)
                            <form action="{{ route('users.unfollow', $follower) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-gray-500 text-white px-4 py-2 rounded-full font-bold hover:bg-gray-600 transition text-sm border border-gray-500">
                                    Following
                                </button>
                            </form>
                        @else
                            <form action="{{ route('users.follow', $follower) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-full font-bold hover:bg-blue-600 transition text-sm">
                                    Follow
                                </button>
                            </form>
                        @endif
                    </div>
                @endif
            </div>
        @empty
            <div class="p-12 text-center">
                <div class="text-gray-400 mb-4">
                    <svg class="w-16 h-16 mx-auto" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-500 mb-2">No followers yet</h3>
                <p class="text-gray-400">{{ $user->username }} doesn't have any followers yet.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($followers->hasPages())
        <div class="mt-6">
            {{ $followers->links() }}
        </div>
    @endif
</div>
</body>
</html>
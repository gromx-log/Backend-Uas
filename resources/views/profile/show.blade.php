<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile - {{ $user->display_name ?? $user->username }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
<div class="container mx-auto py-8">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('home') }}">
            <button class="bg-blue-500 text-white px-4 py-2 rounded-full font-bold hover:bg-blue-600 transition">← Home</button>
        </a>
    </div>
    <!-- Profile Card -->
    <div class="bg-white rounded-2xl shadow-md max-w-xl mx-auto">
        <div class="bg-gradient-to-r from-blue-400 to-gray-900 h-32 rounded-t-2xl relative">
            <div class="absolute -bottom-10 left-6 w-24 h-24 bg-gray-200 rounded-full border-4 border-white flex items-center justify-center text-3xl font-bold text-gray-600">
                {{ strtoupper(substr($user->display_name ?? $user->username, 0, 2)) }}
            </div>
        </div>
        <div class="pt-16 px-8 pb-8">
            @if(auth()->check() && auth()->user()->userId != $user->userId)
                <div class="flex justify-end mb-4">
                    @if($isFollowing)
                        <form action="{{ route('users.unfollow', $user) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-gray-500 text-white px-4 py-2 rounded-full font-bold hover:bg-gray-600 transition border border-gray-500">
                                Following
                            </button>
                        </form>
                    @else
                        <form action="{{ route('users.follow', $user) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-full font-bold hover:bg-blue-600 transition">
                                Follow
                            </button>
                        </form>
                    @endif
                </div>
            @endif

            <div class="mb-2">
                <h1 class="text-2xl font-bold text-gray-900">{{ $user->display_name ?? $user->username }}</h1>
                <p class="text-gray-500 text-base">{{ '@' . $user->userHandle }}</p>
            </div>
            @if ($user->bio)
                <div class="mb-4">
                    <p class="text-gray-800">{{ $user->bio }}</p>
                </div>
            @endif
            <div class="flex gap-8 mt-4">
                <div>
                    <span class="font-bold text-gray-900">{{ $user->following->count() }}</span>
                    <span class="text-gray-500">Following</span>
                </div>
                <div>
                    <span class="font-bold text-gray-900">{{ $user->followers->count() }}</span>
                    <span class="text-gray-500">Followers</span>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
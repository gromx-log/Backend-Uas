<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile - {{ $user->display_name ?? $user->username }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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
            <!-- Edit Profile Button for current user -->
            @if(auth()->check() && auth()->user()->userId == $user->userId)
                <div class="flex justify-end mb-4">
                    <a href="{{ route('profile.edit') }}">
                        <button class="bg-gray-200 text-gray-800 px-4 py-2 rounded-full font-bold hover:bg-gray-300 transition border border-gray-300">
                            Edit Profile
                        </button>
                    </a>
                </div>
            @elseif(auth()->check() && auth()->user()->userId != $user->userId)
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

            {{-- username and handle --}}
            <div class="mb-2">
                <h1 class="text-2xl font-bold text-gray-900">{{ $user->username }}</h1>
                <p class="text-gray-500 text-base mt-1">
                    <span class="font-mono bg-gray-200 px-2 py-1 rounded">{{ '@' . ltrim($user->userHandle, '@') }}</span>
                </p>
            </div>
            {{-- bio --}}
            @if ($user->bio)
                <div class="mb-4">
                    <p class="text-gray-800">{{ $user->bio }}</p>
                </div>
            @endif
            {{-- following count, followers count, bookmark shortcut --}}
            <div class="flex gap-8 mt-4 mb-6">
                <div>
                    <a href="{{ route('users.following', $user->userHandle) }}" class="hover:underline">
                        <span class="font-bold text-gray-900">{{ $user->following->count() }}</span>
                        <span class="text-gray-500">Following</span>
                    </a>
                </div>
                <div>
                    <a href="{{ route('users.followers', $user->userHandle) }}" class="hover:underline">
                        <span class="font-bold text-gray-900">{{ $user->followers->count() }}</span>
                        <span class="text-gray-500">Followers</span>
                    </a>
                </div>
                <div>
                    <a href="{{ route('users.bookmarks', $user->userHandle) }}" class="hover:underline flex items-center">
                        <i class="fas fa-bookmark mr-1 text-yellow-400"></i>
                        <span class="text-gray-500">Bookmarks</span>
                    </a>
                </div>
            </div>

            <!-- User Posts Feed -->
            <div class="mt-10 max-w-xl mx-auto">
                {{-- header --}}
                <h2 class="text-xl font-semibold text-gray-800 mb-4"> Posts </h2>
                <div class="space-y-0">
                    @if(isset($posts) && $posts->count())
                        @foreach($posts as $post)
                            <div class="border-b border-gray-300 p-4 bg-white hover:bg-gray-100 transition cursor-pointer" onclick="window.location='{{ route('posts.show', $post->postId) }}'">
                                {{-- profile picture --}}
                                <div class="flex space-x-3">
                                    <a href="{{ route('profile.show', $post->user->userHandle ?? 'unknown') }}" 
                                        class="w-12 h-12 bg-gray-300 rounded-full flex-shrink-0 flex items-center justify-center text-lg font-bold text-white hover:bg-gray-400 transition-colors" 
                                        onclick="event.stopPropagation();">
                                        {{ strtoupper(substr($post->user->display_name ?? $post->user->username, 0, 2)) }}
                                    </a>
                                    
                                    <div class="flex-1 min-w-0">
                                        {{-- user info and post timestamp --}}
                                        <div class="flex items-center space-x-2 mb-1">
                                            {{-- username --}}
                                            <a href="{{ route('profile.show', $post->user->userHandle ?? 'unknown') }}" class="font-bold text-gray-900 hover:underline" onclick="event.stopPropagation();">
                                                {{ $post->user->username ?? 'Unknown' }}
                                            </a>

                                            {{-- userhandle --}}
                                            <span class="text-gray-500 text-sm">{{ '@' . ltrim($post->user->userHandle ?? 'unknown', '@') }}</span>
                                            {{-- timestamp --}}

                                            <span class="text-gray-500 text-sm">· {{ $post->created_at->format('M j') }}</span>
                                        </div>

                                        {{-- if post is a reply --}}
                                        @if($post->parent && $post->parent->user)
                                            <div class="text-sm text-gray-500 mb-1">
                                                Replying to 
                                                <a href="{{ route('profile.show', $post->parent->user->userHandle ?? 'unknown') }}" 
                                                class="text-blue-500 hover:underline" 
                                                onclick="event.stopPropagation();">
                                                    {{ '@' . ltrim($post->parent->user->userHandle ?? 'unknown', '@') }}
                                                </a>
                                            </div>
                                        @endif
                                        {{-- post content --}}
                                        <p class="text-gray-800 mb-3">{{ $post->content }}</p>

                                        {{-- post icons (likes,comments,bookmark,etc) --}}
                                        <div class="flex items-center justify-between max-w-md">
                                            {{-- Comment button --}}
                                            <button class="flex items-center space-x-2 text-gray-500 hover:text-blue-400 group" onclick="event.stopPropagation(); window.location='{{ route('posts.show', $post->postId) }}';">
                                                <div class="p-2 rounded-full group-hover:bg-blue-100 transition-colors">
                                                    <i class="far fa-comment text-sm"></i>
                                                </div>
                                                <span class="text-sm">{{ $post->commentsCount() }}</span>
                                            </button>

                                            <!-- Like button -->
                                            <div class="flex items-center space-x-2">
                                                @if(auth()->check() && $post->isLikedBy(auth()->user()->userId))
                                                    <form action="{{ route('posts.unlike', $post->postId) }}" method="POST" onclick="event.stopPropagation();">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-500 hover:text-red-400">
                                                            <i class="fas fa-heart text-sm"></i>
                                                        </button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('posts.like', $post->postId) }}" method="POST" onclick="event.stopPropagation();">
                                                        @csrf
                                                        <button type="submit" class="text-gray-500 hover:text-red-400">
                                                            <i class="far fa-heart text-sm"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                                <span class="text-sm {{ $post->isLikedBy(auth()->user()->userId ?? 0) ? 'text-red-500' : 'text-gray-500' }}">
                                                    {{ $post->likesCount() }}
                                                </span>
                                            </div>

                                            <!-- Bookmark button -->
                                            @auth
                                            <form action="{{ route('bookmarks.toggle', $post->postId) }}" method="POST" onclick="event.stopPropagation();">
                                                @csrf
                                                <button type="submit" class="text-gray-500 hover:text-yellow-400">
                                                    @if(auth()->user()->bookmarks->contains($post->postId))
                                                        <i class="fas fa-bookmark text-yellow-400 text-sm"></i>
                                                    @else
                                                        <i class="far fa-bookmark text-sm"></i>
                                                    @endif
                                                </button>
                                            </form>
                                            @endauth
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="p-8 text-center">
                            <p class="text-gray-500 text-lg">This user hasn't posted anything yet.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
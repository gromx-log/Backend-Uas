<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bookmarks</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-black text-white min-h-screen px-4 py-6">
    <div class="max-w-2xl mx-auto">

        <div class="mb-6">
            <a href="{{ route('home') }}">
                <button class="bg-blue-500 text-white px-4 py-2 rounded-full font-bold hover:bg-blue-600 transition">
                    ← Back to Home
                </button>
            </a>
        </div>

        <h1 class="text-2xl font-bold mb-4 text-white">Bookmarked Posts</h1>

        @forelse ($bookmarks as $post)
            <div class="border-b border-gray-700 p-4 hover:bg-gray-900 transition cursor-pointer rounded"
                onclick="window.location='{{ route('posts.show', $post->postId) }}'">
                
                <div class="flex space-x-3">
                    <!-- Avatar with initials -->
                    <a href="{{ route('profile.show', $post->user->userHandle ?? 'unknown') }}"
                        class="w-12 h-12 bg-gray-600 rounded-full flex items-center justify-center text-lg font-bold text-white hover:bg-gray-500"
                        onclick="event.stopPropagation();">
                        {{ strtoupper(substr($post->user->display_name ?? $post->user->username, 0, 2)) }}
                    </a>

                    <div class="flex-1">
                        <!-- User Info -->
                        <div class="flex items-center space-x-2 mb-1">
                            <a href="{{ route('profile.show', $post->user->userHandle ?? 'unknown') }}"
                                class="font-bold hover:underline text-white"
                                onclick="event.stopPropagation();">
                                {{ $post->user->username ?? 'Unknown' }}
                            </a>
                            <span class="text-gray-400 text-sm">
                                {{ '@' . ltrim($post->user->userHandle ?? 'unknown', '@') }} · {{ $post->created_at->format('M j') }}
                            </span>
                        </div>

                        <!-- Post Content -->
                        <p class="text-gray-200 mb-3">{{ $post->content }}</p>

                        <!-- Actions -->
                        <div class="flex items-center space-x-6 text-sm text-gray-400">
                            <!-- Reply -->
                            <div onclick="event.stopPropagation();" class="flex items-center space-x-1 hover:text-blue-400 cursor-pointer">
                                <i class="far fa-comment"></i>
                                <span>{{ $post->commentsCount() }}</span>
                            </div>

                            <!-- Like -->
                            <div class="flex items-center space-x-1" onclick="event.stopPropagation();">
                                @if(auth()->check() && $post->isLikedBy(auth()->user()->userId))
                                    <form action="{{ route('posts.unlike', $post->postId) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-400">
                                            <i class="fas fa-heart"></i>
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('posts.like', $post->postId) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="hover:text-red-400">
                                            <i class="far fa-heart"></i>
                                        </button>
                                    </form>
                                @endif
                                <span class="{{ $post->isLikedBy(auth()->user()->userId ?? 0) ? 'text-red-500' : '' }}">
                                    {{ $post->likesCount() }}
                                </span>
                            </div>

                            <!-- Bookmark -->
                            @auth
                            <form action="{{ route('bookmarks.toggle', $post->postId) }}" method="POST" onclick="event.stopPropagation();">
                                @csrf
                                <button type="submit" class="hover:text-yellow-400">
                                    @if(auth()->user()->bookmarks->contains($post->postId))
                                        <i class="fas fa-bookmark text-yellow-400"></i>
                                    @else
                                        <i class="far fa-bookmark"></i>
                                    @endif
                                </button>
                            </form>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-gray-500 text-center mt-12">You haven't bookmarked any posts yet.</p>
        @endforelse
    </div>
</body>
</html>

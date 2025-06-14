<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $user->username }}'s Bookmarks</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white min-h-screen">
<div class="container mx-auto py-8">
    <div class="mb-6">
        <a href="{{ route('profile.show', $user->userHandle) }}">
            <button class="bg-blue-500 text-white px-4 py-2 rounded-full font-bold hover:bg-blue-600 transition">← Back to Profile</button>
        </a>
    </div>
    <h1 class="text-2xl font-bold mb-6">{{ $user->username }}'s Bookmarked Posts</h1>
    @if($bookmarkedPosts->isEmpty())
        <p class="text-gray-400">No bookmarks yet.</p>
    @else
        <div class="space-y-4">
            @foreach($bookmarkedPosts as $post)
                <div class="bg-gray-800 rounded-lg p-4">
                    <div class="flex items-center space-x-3 mb-2">
                        <a href="{{ route('profile.show', $post->user->userHandle) }}" class="font-bold text-blue-400 hover:underline">
                            {{ $post->user->username }}
                        </a>
                        <span class="text-gray-500 text-sm">{{ '@' . $post->user->userHandle }}</span>
                        <span class="text-gray-500 text-sm">·</span>
                        <span class="text-gray-500 text-sm">{{ $post->created_at ? $post->created_at->format('M j, Y') : '' }}</span>
                    </div>
                    <div class="text-white mb-2">{{ $post->content }}</div>
                </div>
            @endforeach
        </div>
    @endif
</div>
</body>
</html>

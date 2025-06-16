<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookmarks</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white p-4">

    <div class="container mx-auto py-8">
        <div class="mb-6">
            <a href="{{ route('home') }}">
                <button class="bg-blue-500 text-white px-4 py-2 rounded-full font-bold hover:bg-blue-600 transition">
                    ← Back to Home
                </button>
            </a>
        </div>

        <h1 class="text-2xl font-bold mb-4">Bookmarked Posts</h1>

        @forelse ($bookmarks as $post)
            <div class="bg-gray-800 p-4 rounded mb-4">
                <h2 class="text-xl font-semibold">{{ $post->user->username ?? 'Unknown' }}</h2>
                <p class="text-gray-300">{{ $post->content }}</p>
                <span class="text-sm text-gray-500">{{ $post->created_at->format('Y-m-d H:i') }}</span>
            </div>
        @empty
            <p class="text-gray-500">Belum ada post yang di-bookmark.</p>
        @endforelse
    </div>

</body>
</html>

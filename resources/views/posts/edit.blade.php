<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Comment</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white min-h-screen">
<div class="flex items-center justify-center min-h-screen">
    <div class="bg-gray-900 rounded-2xl shadow-lg p-8 w-full max-w-xl">
        <div class="flex items-center mb-6">
            <a href="{{ route('posts.show', $post->parent_post_id ?: $post->postId) }}" class="inline-flex items-center text-blue-400 hover:underline font-bold text-lg">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Back to Post
            </a>
        </div>
        <h2 class="text-2xl font-bold mb-6 text-white">Edit Comment</h2>
        @if ($errors->any())
            <div class="bg-red-700 text-red-200 p-3 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('posts.update', $post->postId) }}" method="POST" class="flex items-start space-x-4">
            @csrf
            @method('PUT')
            <div class="w-12 h-12 bg-gray-700 rounded-full flex items-center justify-center text-xl font-bold mt-1">
                <i class="fas fa-user text-gray-400"></i>
            </div>
            <div class="flex-1">
                <textarea name="content" rows="4" maxlength="280"
                    class="w-full bg-gray-800 text-white rounded-lg p-4 resize-none focus:outline-none focus:ring-2 focus:ring-blue-500 mb-4 placeholder-gray-400"
                    placeholder="Edit your comment...">{{ old('content', $post->content) }}</textarea>
                <div class="flex justify-end space-x-2">
                    <a href="{{ route('posts.show', $post->parent_post_id ?: $post->postId) }}" class="bg-gray-700 hover:bg-gray-600 text-white font-bold py-2 px-6 rounded-full transition-colors">Cancel</a>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-8 rounded-full transition-colors">
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
</body>
</html>

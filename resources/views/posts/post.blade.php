<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Post</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white min-h-screen">
<div class="flex items-center justify-center min-h-screen">
    <div class="bg-gray-900 rounded-2xl shadow-lg p-8 w-full max-w-xl">
        <h2 class="text-2xl font-bold mb-6 text-white">Create a Post</h2>
        @if ($errors->any())
            <div class="bg-red-700 text-red-200 p-3 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('posts.store') }}" method="POST">
            @csrf
            <div class="flex items-start space-x-4 mb-4">
                <div class="w-12 h-12 bg-gray-700 rounded-full flex items-center justify-center text-xl font-bold">
                    <i class="fas fa-user text-gray-400"></i>
                </div>
                <textarea name="content" rows="4" maxlength="280" class="w-full bg-gray-800 text-white rounded-lg p-4 resize-none focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="What's happening?">{{ old('content') }}</textarea>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-8 rounded-full transition-colors">
                    Post
                </button>
            </div>
        </form>
    </div>
</div>
</body>
</html>

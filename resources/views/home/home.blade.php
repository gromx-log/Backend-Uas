<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home / X</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-black text-white min-h-screen">
    <div class="flex max-w-screen-xl mx-auto">
        <!-- Left Sidebar -->
        <div class="w-64 p-4 fixed h-full">
            <div class="space-y-6">
                <!-- Logo -->
                <div class="text-2xl font-bold">
                    <i class="fab fa-twitter text-blue-400"></i>
                </div>
                
                <!-- Navigation Menu -->
                <nav class="space-y-2">
                    <a href="{{ route('home') }}" class="flex items-center space-x-3 p-3 rounded-full hover:bg-gray-900 transition-colors">
                        <i class="fas fa-home text-xl"></i>
                        <span class="text-xl">Home</span>
                    </a>
                    <a href="#" class="flex items-center space-x-3 p-3 rounded-full hover:bg-gray-900 transition-colors">
                        <i class="fas fa-hashtag text-xl"></i>
                        <span class="text-xl">Explore</span>
                    </a>
                    <a href="#" class="flex items-center space-x-3 p-3 rounded-full hover:bg-gray-900 transition-colors">
                        <i class="fas fa-bell text-xl"></i>
                        <span class="text-xl">Notifications</span>
                    </a>
                    <a href="#" class="flex items-center space-x-3 p-3 rounded-full hover:bg-gray-900 transition-colors">
                        <i class="fas fa-envelope text-xl"></i>
                        <span class="text-xl">Messages</span>
                    </a>
                    <a href="{{ route('bookmarks.index') }}" class="flex items-center space-x-3 p-3 rounded-full hover:bg-gray-900 transition-colors">
                        <i class="fas fa-bookmark text-xl"></i>
                        <span class="text-xl">Bookmarks</span>
                    </a>

                    </a>
                    <a href="{{ route('profile.show', $user->userHandle) }}" class="flex items-center space-x-3 p-3 rounded-full hover:bg-gray-900 transition-colors">
                        <i class="fas fa-user text-xl"></i>
                        <span class="text-xl">Profile</span>
                    </a>
                </nav>
                
                <!-- Tweet Button -->
                <form action="{{ route('posts.create') }}" method="GET">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-8 rounded-full w-full transition-colors">
                        Post
                    </button>
                </form>

                <!-- User Profile Section -->
                <a href="{{ route('profile.show', $user->userHandle) }}">
                <div class="mt-auto pt-4">
                    <div class="flex items-center space-x-3 p-3 rounded-full hover:bg-gray-900 cursor-pointer">
                        <div class="flex-1">
                            <div class="font-bold">{{$user->username}}</div>
                            <div class="text-gray-500 text-sm">{{ '@' . $user->userHandle }}</div>
                        </div>
                        
                    </div>
                </div>
                </a>
            </div>
        </div>


        <!-- Main Content -->
            <div class="flex-1 ml-64 border-x border-gray-800">
                <!-- Header -->
                <div class="sticky top-0 bg-black bg-opacity-80 backdrop-blur p-4 border-b border-gray-800">
                    <h1 class="text-xl font-bold">Home</h1>
                </div>

                <!-- Success Message -->
                @if(session('success'))
                    <div class="bg-green-700 bg-opacity-80 text-green-200 p-3 rounded mb-4 mx-4">
                        {{ session('success') }}
                    </div>
                @endif
                
                <!-- Timeline/Feed -->
                <div class="p-4 space-y-6">
                    @forelse($posts as $post)
                        <a href="{{ route('posts.show', $post->postId) }}" class="block bg-gray-900 p-4 rounded-lg shadow-md hover:bg-gray-800 transition">
                            <div class="flex justify-between items-center mb-2">
                                <div class="text-sm text-gray-400">
                                    <strong class="text-white">{{ $post->user->username ?? 'Unknown' }}</strong>
                                    <span class="ml-2">{{ $post->created_at->format('Y-m-d H:i') }}</span>
                                </div>
                            </div>
                            <p class="text-white text-base">{{ $post->content }}</p>
                        </a>
                    @empty
                        <p class="text-center text-gray-500">No posts found.</p>
                    @endforelse
                </div>

            </div>


        <!-- Right Sidebar -->
        <div class="w-80 p-4">
            <!-- Search Box -->
            <!-- Trending -->
            <!-- Who to Follow -->
        </div>
    </div>
</body>
</html>

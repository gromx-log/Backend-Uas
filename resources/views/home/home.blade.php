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
                <div class="text-2xl font-bold flex items-center space-x-2 mb-4">
                    <i class="fab fa-twitter text-blue-400"></i>
                    <span class="text-blue-400">X</span>
                </div>
                
                <!-- Navigation Menu -->
                <nav class="space-y-2">
                    <a href="{{ route('home') }}" class="flex items-center space-x-3 p-3 rounded-full hover:bg-gray-900 transition-colors">
                        <i class="fas fa-home text-xl"></i>
                        <span class="text-xl">Home</span>
                    </a>
                    <!-- Search button - now functional -->
                    <button onclick="toggleSearch()" class="flex items-center space-x-3 p-3 rounded-full hover:bg-gray-900 transition-colors w-full text-left">
                        <i class="fas fa-search text-xl"></i>
                        <span class="text-xl">Search</span>
                    </button>
                    <!-- Bookmarks button for current user -->
                    <a href="{{ route('bookmarks.index') }}" class="flex items-center space-x-3 p-3 rounded-full hover:bg-gray-900 transition-colors">
                        <i class="fas fa-bookmark text-xl"></i>
                        <span class="text-xl">Bookmarks</span>
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
                            <div class="text-gray-500 text-sm">{{ '@' . ltrim($user->userHandle, '@') }}</div>
                        </div>
                        
                    </div>
                </div>
                </a>

                <!-- Logout Button -->
                <form method="POST" action="{{ route('logout') }}" class="pt-4">
                    @csrf
                    <button type="submit" class="flex items-center space-x-3 p-3 rounded-full hover:bg-gray-900 transition-colors text-red-500 w-full">
                        <i class="fas fa-sign-out-alt text-xl"></i>
                        <span class="text-xl font-semibold">Logout</span>
                    </button>
                </form>

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
            <div class="space-y-0">
                @if(isset($posts))
                    @forelse($posts as $post)
                        <div class="border-b border-gray-800 p-4 hover:bg-gray-950 transition cursor-pointer" onclick="window.location='{{ route('posts.show', $post->postId) }}'">
                            <div class="flex space-x-3">
                                <a href="{{ route('profile.show', $post->user->userHandle ?? 'unknown') }}" 
                                   class="w-12 h-12 bg-gray-600 rounded-full flex-shrink-0 flex items-center justify-center hover:bg-gray-500 transition-colors" 
                                   onclick="event.stopPropagation();">
                                    <i class="fas fa-user text-gray-400"></i>
                                </a>
                        
                                <!-- Post content -->
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center space-x-2 mb-1">
                                        <a href="{{ route('profile.show', $post->user->userHandle ?? 'unknown') }}" 
                                           class="font-bold text-white hover:underline" 
                                           onclick="event.stopPropagation();">
                                            {{ $post->user->username ?? 'Unknown' }}
                                        </a>
                                        <a href="{{ route('profile.show', $post->user->userHandle ?? 'unknown') }}" 
                                           class="text-gray-500 text-sm hover:underline" 
                                           onclick="event.stopPropagation();">
                                            {{ '@' . ltrim($post->user->userHandle ?? 'unknown', '@') }}
                                        </a>
                                        <span class="text-gray-500 text-sm">·</span>
                                        <span class="text-gray-500 text-sm">{{ $post->created_at->format('M j') }}</span>
                                    </div>
                                    
                                    <!-- Post text -->
                                    <p class="text-white text-base mb-3">{{ $post->content }}</p>
                                    
                                    <!-- Action buttons with counts -->
                                    <div class="flex items-center justify-between max-w-md">
                                        <!-- Comment button -->
                                        <button class="flex items-center space-x-2 text-gray-500 hover:text-blue-400 group" onclick="event.stopPropagation(); window.location='{{ route('posts.show', $post->postId) }}';">
                                            <div class="p-2 rounded-full group-hover:bg-blue-900 group-hover:bg-opacity-20 transition-colors">
                                                <i class="far fa-comment text-sm"></i>
                                            </div>
                                            <span class="text-sm">{{ $post->commentsCount() }}</span>
                                        </button>
                                        <!-- Like button -->
                                        <div class="flex items-center space-x-2">
                                            @if(auth()->check() && $post->isLikedBy(auth()->user()->userId))
                                                <form action="{{ route('posts.unlike', $post->postId) }}" method="POST" class="inline" onclick="event.stopPropagation();">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="flex items-center space-x-2 text-red-500 hover:text-red-400 group">
                                                        <div class="p-2 rounded-full group-hover:bg-red-900 group-hover:bg-opacity-20 transition-colors">
                                                            <i class="fas fa-heart text-sm"></i>
                                                        </div>
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('posts.like', $post->postId) }}" method="POST" class="inline" onclick="event.stopPropagation();">
                                                    @csrf
                                                    <button type="submit" class="flex items-center space-x-2 text-gray-500 hover:text-red-400 group">
                                                        <div class="p-2 rounded-full group-hover:bg-red-900 group-hover:bg-opacity-20 transition-colors">
                                                            <i class="far fa-heart text-sm"></i>
                                                        </div>
                                                    </button>
                                                </form>
                                            @endif
                                            <span class="text-sm {{ $post->isLikedBy(auth()->user()->userId ?? 0) ? 'text-red-500' : 'text-gray-500' }}">
                                                {{ $post->likesCount() }}
                                            </span>
                                        </div>
                                        <!-- Bookmark button -->
                                        @auth
                                        <form action="{{ route('bookmarks.toggle', $post->postId) }}" method="POST" onclick="event.stopPropagation();" class="inline">
                                            @csrf
                                            <button type="submit" class="flex items-center space-x-2 text-gray-500 hover:text-yellow-400 group">
                                                <div class="p-2 rounded-full group-hover:bg-yellow-900 group-hover:bg-opacity-20 transition-colors">
                                                    @if(auth()->user()->bookmarks->contains($post->postId))
                                                        <i class="fas fa-bookmark text-sm text-yellow-400"></i>
                                                    @else
                                                        <i class="far fa-bookmark text-sm"></i>
                                                    @endif
                                                </div>
                                            </button>
                                        </form>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-8 text-center">
                            <p class="text-gray-500 text-lg">No posts found.</p>
                            <p class="text-gray-600 text-sm mt-2">Be the first to share something!</p>
                        </div>
                    @endforelse
                @else
                    <div class="p-8 text-center">
                        <p class="text-gray-500 text-lg">No posts found.</p>
                        <p class="text-gray-600 text-sm mt-2">Be the first to share something!</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Right Sidebar -->
        <div class="w-80 p-4">
            <!-- Search Box -->
            <div id="search-section">
                <h2 class="text-xl font-bold mb-4">Search</h2>
                <form action="{{ route('search.users') }}" method="GET" id="search-form">
                    <div class="relative bg-gray-800 rounded-full p-3 mb-4 flex items-center">
                        <input type="text" placeholder="Search by username or userhandle" class="w-full bg-transparent outline-none text-white placeholder-gray-500 pr-12" name="query" value="{{ old('query', $query ?? '') }}" id="search-input">
                        <button type="submit" class="absolute right-5 text-blue-400 hover:text-blue-600 focus:outline-none">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>

                <!-- Search Results -->
                @if(isset($users) && isset($query))
                    <div class="mt-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold">Search Results for "{{ $query }}"</h3>
                            <a href="{{ route('home') }}" class="text-blue-400 hover:text-blue-300 text-sm">
                                <i class="fas fa-times"></i> Clear
                            </a>
                        </div>
                        @if($users->isEmpty())
                            <p class="text-gray-500">No users found.</p>
                        @else
                            <ul class="space-y-4">
                                @foreach($users as $userResult)
                                    <li class="bg-gray-800 rounded-lg p-4 hover:bg-gray-700 transition-colors">
                                        <a href="{{ route('profile.show', $userResult->userHandle) }}" class="block">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-12 h-12 bg-gray-600 rounded-full flex-shrink-0 flex items-center justify-center">
                                                    <i class="fas fa-user text-gray-400"></i>
                                                </div>
                                                <div>
                                                    <h4 class="text-lg font-semibold text-white hover:underline">
                                                        {{ $userResult->username }}
                                                    </h4>
                                                    <p class="text-gray-400 text-sm">{{ '@' . ltrim($userResult->userHandle, '@') }}</p>
                                                    @if($userResult->bio)
                                                        <p class="text-gray-300 text-sm mt-1">{{ $userResult->bio }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @endif
            </div>


        </div>
    </div>
    
    <script>
        // Function to toggle search focus
        function toggleSearch() {
            const searchInput = document.getElementById('search-input');
            const searchSection = document.getElementById('search-section');
            
            // Scroll to search section
            searchSection.scrollIntoView({ behavior: 'smooth' });
            
            // Focus on search input
            setTimeout(() => {
                searchInput.focus();
            }, 300);
        }

        // Auto-submit search form when user stops typing
        let searchTimeout;
        document.getElementById('search-input').addEventListener('input', function() {
            clearTimeout(searchTimeout);
            const query = this.value.trim();
            
            if (query.length >= 2) {
                searchTimeout = setTimeout(() => {
                    document.getElementById('search-form').submit();
                }, 500); // Wait 500ms after user stops typing
            }
        });

        // Handle search form submission
        document.getElementById('search-form').addEventListener('submit', function(e) {
            const query = document.getElementById('search-input').value.trim();
            if (query.length < 2) {
                e.preventDefault();
                alert('Please enter at least 2 characters to search');
            }
        });
    </script>
</body>
</html>
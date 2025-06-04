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
                    <a href="#" class="flex items-center space-x-3 p-3 rounded-full hover:bg-gray-900 transition-colors">
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
                    <a href="#" class="flex items-center space-x-3 p-3 rounded-full hover:bg-gray-900 transition-colors">
                        <i class="fas fa-bookmark text-xl"></i>
                        <span class="text-xl">Bookmarks</span>
                    </a>
                    <a href="#" class="flex items-center space-x-3 p-3 rounded-full hover:bg-gray-900 transition-colors">
                        <i class="fas fa-user text-xl"></i>
                        <span class="text-xl">Profile</span>
                    </a>
                </nav>
                
                <!-- Tweet Button -->
                <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-8 rounded-full w-full transition-colors">
                    Post
                </button>
                
                <!-- User Profile Section -->
                <div class="mt-auto pt-4">
                    <div class="flex items-center space-x-3 p-3 rounded-full hover:bg-gray-900 cursor-pointer">
                        <img src="https://via.placeholder.com/40x40/gray/white?text=U" alt="Profile" class="w-10 h-10 rounded-full">
                        <div class="flex-1">
                            <div class="font-bold">Username</div>
                            <div class="text-gray-500 text-sm">@username</div>
                        </div>
                        <i class="fas fa-ellipsis-h"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="flex-1 ml-64 border-x border-gray-800">
            <!-- Header -->
            <div class="sticky top-0 bg-black bg-opacity-80 backdrop-blur p-4 border-b border-gray-800">
                <h1 class="text-xl font-bold">Home</h1>
            </div>
            
            <!-- Tweet Compose -->
            <div class="border-b border-gray-800 p-4">
                <div class="flex space-x-4">
                    <img src="https://via.placeholder.com/48x48/gray/white?text=U" alt="Your avatar" class="w-12 h-12 rounded-full">
                    <div class="flex-1">
                        <textarea 
                            placeholder="What is happening?!" 
                            class="w-full text-xl bg-transparent resize-none outline-none placeholder-gray-500 min-h-[120px]"
                            maxlength="280"
                        ></textarea>
                        
                        <!-- Tweet Options -->
                        <div class="flex items-center justify-between mt-4">
                            <div class="flex space-x-4 text-blue-400">
                                <button class="hover:bg-blue-900 hover:bg-opacity-20 p-2 rounded-full">
                                    <i class="fas fa-image"></i>
                                </button>
                                <button class="hover:bg-blue-900 hover:bg-opacity-20 p-2 rounded-full">
                                    <i class="fas fa-film"></i>
                                </button>
                                <button class="hover:bg-blue-900 hover:bg-opacity-20 p-2 rounded-full">
                                    <i class="fas fa-poll"></i>
                                </button>
                                <button class="hover:bg-blue-900 hover:bg-opacity-20 p-2 rounded-full">
                                    <i class="fas fa-smile"></i>
                                </button>
                            </div>
                            
                            <div class="flex items-center space-x-4">
                                <span class="text-sm text-gray-500">
                                    <span id="char-count">0</span>/280
                                </span>
                                <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-6 rounded-full disabled:opacity-50">
                                    Post
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Timeline/Feed -->
            <div class="divide-y divide-gray-800">
                <!-- Sample Tweet 1 -->
                <article class="p-4 hover:bg-gray-950 transition-colors cursor-pointer">
                    <div class="flex space-x-3">
                        <img src="https://via.placeholder.com/48x48/blue/white?text=JD" alt="User avatar" class="w-12 h-12 rounded-full">
                        <div class="flex-1">
                            <div class="flex items-center space-x-2">
                                <h3 class="font-bold">John Doe</h3>
                                <span class="text-gray-500">@johndoe</span>
                                <span class="text-gray-500">·</span>
                                <span class="text-gray-500">2h</span>
                            </div>
                            
                            <div class="mt-2">
                                <p>Just finished working on an amazing project! Laravel + Vue.js is such a powerful combination. 🚀 #coding #laravel #vuejs</p>
                            </div>
                            
                            <!-- Tweet Actions -->
                            <div class="flex items-center justify-between mt-4 max-w-md">
                                <button class="flex items-center space-x-2 text-gray-500 hover:text-blue-400 group">
                                    <div class="p-2 rounded-full group-hover:bg-blue-900 group-hover:bg-opacity-20">
                                        <i class="fas fa-comment"></i>
                                    </div>
                                    <span class="text-sm">12</span>
                                </button>
                                
                                <button class="flex items-center space-x-2 text-gray-500 hover:text-green-400 group">
                                    <div class="p-2 rounded-full group-hover:bg-green-900 group-hover:bg-opacity-20">
                                        <i class="fas fa-retweet"></i>
                                    </div>
                                    <span class="text-sm">8</span>
                                </button>
                                
                                <button class="flex items-center space-x-2 text-gray-500 hover:text-red-400 group">
                                    <div class="p-2 rounded-full group-hover:bg-red-900 group-hover:bg-opacity-20">
                                        <i class="fas fa-heart"></i>
                                    </div>
                                    <span class="text-sm">24</span>
                                </button>
                                
                                <button class="flex items-center space-x-2 text-gray-500 hover:text-blue-400 group">
                                    <div class="p-2 rounded-full group-hover:bg-blue-900 group-hover:bg-opacity-20">
                                        <i class="fas fa-share"></i>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                </article>
                
                <!-- Sample Tweet 2 -->
                <article class="p-4 hover:bg-gray-950 transition-colors cursor-pointer">
                    <div class="flex space-x-3">
                        <img src="https://via.placeholder.com/48x48/green/white?text=AS" alt="User avatar" class="w-12 h-12 rounded-full">
                        <div class="flex-1">
                            <div class="flex items-center space-x-2">
                                <h3 class="font-bold">Alice Smith</h3>
                                <span class="text-gray-500">@alicesmith</span>
                                <span class="text-gray-500">·</span>
                                <span class="text-gray-500">4h</span>
                            </div>
                            
                            <div class="mt-2">
                                <p>Beautiful sunset today! Sometimes we need to take a break from coding and enjoy nature. 🌅</p>
                                <div class="mt-3 rounded-2xl overflow-hidden">
                                    <img src="https://via.placeholder.com/500x300/orange/white?text=Sunset" alt="Sunset" class="w-full">
                                </div>
                            </div>
                            
                            <!-- Tweet Actions -->
                            <div class="flex items-center justify-between mt-4 max-w-md">
                                <button class="flex items-center space-x-2 text-gray-500 hover:text-blue-400 group">
                                    <div class="p-2 rounded-full group-hover:bg-blue-900 group-hover:bg-opacity-20">
                                        <i class="fas fa-comment"></i>
                                    </div>
                                    <span class="text-sm">5</span>
                                </button>
                                
                                <button class="flex items-center space-x-2 text-gray-500 hover:text-green-400 group">
                                    <div class="p-2 rounded-full group-hover:bg-green-900 group-hover:bg-opacity-20">
                                        <i class="fas fa-retweet"></i>
                                    </div>
                                    <span class="text-sm">3</span>
                                </button>
                                
                                <button class="flex items-center space-x-2 text-gray-500 hover:text-red-400 group">
                                    <div class="p-2 rounded-full group-hover:bg-red-900 group-hover:bg-opacity-20">
                                        <i class="fas fa-heart"></i>
                                    </div>
                                    <span class="text-sm">42</span>
                                </button>
                                
                                <button class="flex items-center space-x-2 text-gray-500 hover:text-blue-400 group">
                                    <div class="p-2 rounded-full group-hover:bg-blue-900 group-hover:bg-opacity-20">
                                        <i class="fas fa-share"></i>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                </article>
                
                <!-- Sample Tweet 3 -->
                <article class="p-4 hover:bg-gray-950 transition-colors cursor-pointer">
                    <div class="flex space-x-3">
                        <img src="https://via.placeholder.com/48x48/purple/white?text=BW" alt="User avatar" class="w-12 h-12 rounded-full">
                        <div class="flex-1">
                            <div class="flex items-center space-x-2">
                                <h3 class="font-bold">Bob Wilson</h3>
                                <span class="text-gray-500">@bobwilson</span>
                                <span class="text-gray-500">·</span>
                                <span class="text-gray-500">6h</span>
                            </div>
                            
                            <div class="mt-2">
                                <p>Tips for beginner developers:<br>
                                1. Practice coding daily<br>
                                2. Build projects, not just tutorials<br>
                                3. Join coding communities<br>
                                4. Don't be afraid to make mistakes<br><br>
                                Keep learning! 💪 #coding #webdev</p>
                            </div>
                            
                            <!-- Tweet Actions -->
                            <div class="flex items-center justify-between mt-4 max-w-md">
                                <button class="flex items-center space-x-2 text-gray-500 hover:text-blue-400 group">
                                    <div class="p-2 rounded-full group-hover:bg-blue-900 group-hover:bg-opacity-20">
                                        <i class="fas fa-comment"></i>
                                    </div>
                                    <span class="text-sm">18</span>
                                </button>
                                
                                <button class="flex items-center space-x-2 text-gray-500 hover:text-green-400 group">
                                    <div class="p-2 rounded-full group-hover:bg-green-900 group-hover:bg-opacity-20">
                                        <i class="fas fa-retweet"></i>
                                    </div>
                                    <span class="text-sm">15</span>
                                </button>
                                
                                <button class="flex items-center space-x-2 text-gray-500 hover:text-red-400 group">
                                    <div class="p-2 rounded-full group-hover:bg-red-900 group-hover:bg-opacity-20">
                                        <i class="fas fa-heart"></i>
                                    </div>
                                    <span class="text-sm">67</span>
                                </button>
                                
                                <button class="flex items-center space-x-2 text-gray-500 hover:text-blue-400 group">
                                    <div class="p-2 rounded-full group-hover:bg-blue-900 group-hover:bg-opacity-20">
                                        <i class="fas fa-share"></i>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
        
        <!-- Right Sidebar -->
        <div class="w-80 p-4">
            <!-- Search Box -->
            <div class="bg-gray-900 rounded-full p-3 mb-4">
                <div class="flex items-center space-x-3">
                    <i class="fas fa-search text-gray-500"></i>
                    <input type="text" placeholder="Search" class="bg-transparent outline-none flex-1 text-white">
                </div>
            </div>
            
            <!-- Trending -->
            <div class="bg-gray-900 rounded-2xl p-4 mb-4">
                <h2 class="text-xl font-bold mb-4">What's happening</h2>
                <div class="space-y-3">
                    <div class="hover:bg-gray-800 p-2 rounded cursor-pointer">
                        <p class="text-gray-500 text-sm">Trending in Technology</p>
                        <p class="font-bold">#Laravel</p>
                        <p class="text-gray-500 text-sm">42.1K posts</p>
                    </div>
                    <div class="hover:bg-gray-800 p-2 rounded cursor-pointer">
                        <p class="text-gray-500 text-sm">Trending</p>
                        <p class="font-bold">#WebDevelopment</p>
                        <p class="text-gray-500 text-sm">28.5K posts</p>
                    </div>
                    <div class="hover:bg-gray-800 p-2 rounded cursor-pointer">
                        <p class="text-gray-500 text-sm">Technology · Trending</p>
                        <p class="font-bold">PHP 8.3</p>
                        <p class="text-gray-500 text-sm">15.2K posts</p>
                    </div>
                </div>
            </div>
            
            <!-- Who to Follow -->
            <div class="bg-gray-900 rounded-2xl p-4">
                <h2 class="text-xl font-bold mb-4">Who to follow</h2>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <img src="https://via.placeholder.com/40x40/red/white?text=TC" alt="User" class="w-10 h-10 rounded-full">
                            <div>
                                <p class="font-bold">Tech Community</p>
                                <p class="text-gray-500 text-sm">@techcommunity</p>
                            </div>
                        </div>
                        <button class="bg-white text-black font-bold py-1 px-4 rounded-full text-sm hover:bg-gray-200">
                            Follow
                        </button>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <img src="https://via.placeholder.com/40x40/teal/white?text=CD" alt="User" class="w-10 h-10 rounded-full">
                            <div>
                                <p class="font-bold">Code Daily</p>
                                <p class="text-gray-500 text-sm">@codedaily</p>
                            </div>
                        </div>
                        <button class="bg-white text-black font-bold py-1 px-4 rounded-full text-sm hover:bg-gray-200">
                            Follow
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        // Character counter for tweet compose
        const textarea = document.querySelector('textarea');
        const charCount = document.getElementById('char-count');
        
        textarea.addEventListener('input', function() {
            const count = this.value.length;
            charCount.textContent = count;
            
            if (count > 280) {
                charCount.classList.add('text-red-500');
            } else {
                charCount.classList.remove('text-red-500');
            }
        });
        
        // Like button interaction (dummy)
        document.querySelectorAll('.fa-heart').forEach(button => {
            button.addEventListener('click', function(e) {
                e.stopPropagation();
                this.classList.toggle('text-red-500');
                this.classList.toggle('fas');
                this.classList.toggle('far');
            });
        });
    </script>
</body>
</html>


<html>
    <h1>Home</h1>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
</html>
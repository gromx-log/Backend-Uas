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
            <!-- Sudah disediakan sebelumnya -->
            <!-- Timeline/Feed -->
            <!-- Sudah disediakan sebelumnya -->
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

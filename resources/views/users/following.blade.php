<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Following of {{ $user->display_name ?? $user->username }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
<div class="container mx-auto py-8">
    <div class="mb-6">
        <a href="{{ route('profile.show', $user->userHandle) }}">
            <button class="bg-blue-500 text-white px-4 py-2 rounded-full font-bold hover:bg-blue-600 transition">← Back to Profile</button>
        </a>
    </div>
    <h1 class="text-2xl font-bold mb-6">Following</h1>
    @if($following->isEmpty())
        <p class="text-gray-500">Not following anyone.</p>
    @else
        <ul class="space-y-4">
            @foreach($following as $followed)
                <li class="bg-white rounded-lg shadow p-4 flex items-center">
                    <div class="w-12 h-12 bg-gray-300 rounded-full flex items-center justify-center font-bold text-xl text-gray-700 mr-4">
                        {{ strtoupper(substr($followed->username, 0, 2)) }}
                    </div>
                    <div>
                        <a href="{{ route('profile.show', $followed->userHandle) }}" class="text-lg font-semibold text-blue-500 hover:underline">
                            {{ $followed->username }}
                        </a>
                        <div class="text-gray-500 text-sm">{{ '@' . ltrim($followed->userHandle, '@') }}</div>
                        <div class="text-gray-400 text-xs">{{ $followed->bio }}</div>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</div>
</body>
</html>

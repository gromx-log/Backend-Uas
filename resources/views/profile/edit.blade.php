<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
<div class="container mx-auto py-8">
    <div class="max-w-lg mx-auto bg-white rounded-xl shadow-md p-8">
        <h1 class="text-2xl font-bold mb-6">Edit Profile</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <ul class="mb-4">
                @foreach($errors->all() as $error)
                    <li class="text-red-600">{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block font-semibold mb-1">Username:</label>
                <input type="text" name="username" value="{{ old('username', $user->username) }}" class="w-full border border-gray-300 rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">Display Name:</label>
                <input type="text" name="display_name" value="{{ old('display_name', $user->display_name) }}" class="w-full border border-gray-300 rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">Bio:</label>
                <textarea name="bio" class="w-full border border-gray-300 rounded px-3 py-2">{{ old('bio', $user->bio) }}</textarea>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-full font-bold hover:bg-blue-600 transition">Save Changes</button>
        </form>
    </div>
</div>
</body>
</html>

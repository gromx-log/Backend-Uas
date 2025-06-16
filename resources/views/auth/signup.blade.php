<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Signup</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-8">
        <h1 class="text-2xl font-bold text-center text-blue-500 mb-6">Create Your Account</h1>

        <form method="POST" action="{{ route('signup.submit') }}" class="space-y-4">
            @csrf

            <!-- Username -->
            <div>
                <label for="username" class="block text-sm font-semibold text-gray-700">Username</label>
                <input
                    name="username"
                    type="text"
                    required
                    value="{{ old('username') }}"
                    class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-300"
                >
            </div>

            <!-- Handle -->
            <div>
                <label for="userHandle" class="block text-sm font-semibold text-gray-700">User Handle (@)</label>
                <input
                    name="userHandle"
                    type="text"
                    required
                    value="{{ old('userHandle') }}"
                    class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-300"
                >
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700">Email</label>
                <input
                    name="email"
                    type="email"
                    required
                    value="{{ old('email') }}"
                    class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-300"
                >
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
                <input
                    name="password"
                    type="password"
                    required
                    class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-300"
                >
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-sm font-semibold text-gray-700">Confirm Password</label>
                <input
                    name="password_confirmation"
                    type="password"
                    required
                    class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-300"
                >
            </div>

            <!-- Bio -->
            <div>
                <label for="bio" class="block text-sm font-semibold text-gray-700">Bio</label>
                <textarea
                    name="content"
                    rows="2"
                    class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-300 resize-none"
                >{{ old('content') }}</textarea>
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition-colors">
                    Sign Up
                </button>
            </div>

            <!-- Errors -->
            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-3 rounded mt-4">
                    <ul class="list-disc pl-5 space-y-1 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </form>

        <!-- Link to Login -->
        <p class="text-center text-sm text-gray-600 mt-6">
            Already have an account?
            <a href="{{ route('show.login') }}" class="text-blue-500 hover:underline">Login here</a>
        </p>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-8">
        <h1 class="text-2xl font-bold text-center text-blue-500 mb-6">Login Form</h1>

        <form method="POST" action="{{ route('login.submit') }}" class="space-y-4">
            @csrf

            {{-- Email --}}
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

            {{-- Password --}}
            <div>
                <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
                <input
                    name="password"
                    type="password"
                    required
                    class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-300"
                >
            </div>

            {{-- Submit Button --}}
            <div>
                <button type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition-colors">
                    Login
                </button>
            </div>

            {{-- Errors --}}
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

        {{-- Sign Up Button --}}
        <p class="text-center text-sm text-gray-600 mt-6">
            Don't have an account?
            <a href="{{ route('show.signup') }}" class="text-blue-500 hover:underline">Sign up</a>
        </p>
    </div>
</body>
</html>

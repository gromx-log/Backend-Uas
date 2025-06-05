<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>
<body>

    <h1>Home</h1>

    <p><strong>Welcome, {{ Auth::user()->display_name ?? Auth::user()->username }}!</strong></p>
    <p>Username: {{ Auth::user()->username }}</p>
    <p>Bio: {{ Auth::user()->bio ?? 'No bio yet.' }}</p>

    <p>
        <a href="{{ route('profile.edit') }}">Edit Profile</a> |
        <a href="{{ route('profile.show', Auth::user()->username) }}">View Public Profile</a>
    </p>
    <br>

    {{-- Tombol ke halaman post --}}
    <form action="{{ route('posts.index') }}" method="GET">
        <button type="submit">Buat Post</button>
    </form>

    {{-- Tombol logout --}}
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>

    <br>
</body>
</html>

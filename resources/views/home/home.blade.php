<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>
<body>

    <h1>Home</h1>

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

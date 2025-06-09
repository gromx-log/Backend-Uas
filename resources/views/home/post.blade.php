<!DOCTYPE html>
<html>
<head>
    <title>Post Page</title>
</head>
<body>

    <h1>Post Something</h1>
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if(session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    {{-- Form untuk membuat post --}}
    <form method="POST" action="{{ route('posts.store') }}">
        @csrf
        <textarea name="content" rows="4" cols="50" placeholder="Write your post here..." required></textarea><br><br>
        <button type="submit">Post</button>
    </form>

</body>
</html>
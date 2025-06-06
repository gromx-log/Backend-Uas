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

    <hr>

    <h2>All Posts</h2>

    {{-- Daftar semua post --}}
    @forelse($posts as $post)
        <div style="margin-bottom: 20px;">
            {{-- Menggunakan $post->user->username untuk menampilkan nama pengguna --}}
            <p><strong>{{ $post->user->username ?? 'Unknown' }}</strong> - {{ $post->created_at->format('Y-m-d H:i') }}</p>
            <p>{{ $post->content }}</p>

            {{-- Tombol delete hanya untuk post milik user --}}
            @if(auth()->id() === $post->userId) {{-- Perbaikan: Gunakan $post->userId --}}
                <form method="POST" action="{{ route('posts.destroy', $post->postId) }}"> {{-- Perbaikan: Gunakan $post->postId --}}
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Delete this post?')">Delete</button>
                </form>
            @endif
        </div>
        <hr>
    @empty
        <p>No posts found.</p>
    @endforelse

</body>
</html>
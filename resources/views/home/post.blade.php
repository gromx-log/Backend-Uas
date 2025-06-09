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

    @forelse($posts as $post)
        <div style="margin-bottom: 20px;">
            {{-- Info post --}}
            <p><strong>{{ $post->user->username ?? 'Unknown' }}</strong> - {{ $post->created_at->format('Y-m-d H:i') }}</p>
            <p>{{ $post->content }}</p>

            {{-- Delete post kalau user yang punya --}}
            @if(auth()->id() === $post->userId)
                <form method="POST" action="{{ route('posts.destroy', $post->postId) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Delete this post?')">Delete</button>
                </form>
            @endif

            {{-- 🔽 Form reply --}}
            <form method="POST" action="{{ route('posts.reply', $post->postId) }}">
                @csrf
                <textarea name="content" rows="2" cols="50" placeholder="Reply to this post..." required></textarea><br>
                <button type="submit">Reply</button>
            </form>

            {{-- 🔽 Menampilkan reply (jika ada) --}}
            @if($post->replies && $post->replies->count())
                <div style="margin-left: 20px; margin-top: 10px; padding-left: 10px; border-left: 2px solid #ccc;">
                    <strong>Replies:</strong>
                    @foreach($post->replies as $reply)
                        <div style="margin-top: 5px;">
                            <p><strong>{{ $reply->user->username ?? 'Unknown' }}</strong>: {{ $reply->content }}</p>
                            <small>{{ $reply->created_at->diffForHumans() }}</small>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
        <hr>
    @empty
        <p>No posts found.</p>
    @endforelse

</body>
</html>

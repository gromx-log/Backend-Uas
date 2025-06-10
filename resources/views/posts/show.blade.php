<div style="border: 1px solid #ccc; padding: 16px; margin-bottom: 20px; border-radius: 8px; max-width: 600px;">
    {{-- 🧾 Post Info --}}
    <div style="margin-bottom: 10px;">
        <p style="margin: 0;"><strong>{{ $post->user->username ?? 'Unknown' }}</strong></p>
        <small>{{ $post->created_at->format('Y-m-d H:i') }}</small>
    </div>

    {{-- 📄 Post Content --}}
    <p style="font-size: 16px; line-height: 1.4;">{{ $post->content }}</p>

    {{-- 🗑️ Delete Button (if user owns post) --}}
    @if(auth()->id() === $post->userId)
        <form method="POST" action="{{ route('posts.destroy', $post->postId) }}" style="margin-top: 10px;">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Delete this post?')" style="color: red;">Delete</button>
        </form>
    @endif

    {{-- 💬 Reply Form --}}
    <form method="POST" action="{{ route('posts.reply', $post->postId) }}" style="margin-top: 12px;">
        @csrf
        <textarea name="content" rows="2" cols="50" placeholder="Reply to this post..." required style="width: 100%; padding: 8px; border-radius: 4px; border: 1px solid #ccc;"></textarea>
        <br>
        <button type="submit" style="margin-top: 6px;">Reply</button>
    </form>

    {{-- 🧵 Replies --}}
    @if($post->replies && $post->replies->count())
        <div style="margin-top: 16px; padding-left: 12px; border-left: 2px solid #ccc;">
            <strong>Replies:</strong>
            @foreach($post->replies as $reply)
                <div style="margin-top: 8px; background: #f9f9f9; padding: 8px; border-radius: 6px;">
                    <p style="margin: 0;">
                        <strong>{{ $reply->user->username ?? 'Unknown' }}</strong>: {{ $reply->content }}
                    </p>
                    <small>{{ $reply->created_at ?? 'Unknown'}}</small>
                </div>
            @endforeach
        </div>
    @endif
</div>

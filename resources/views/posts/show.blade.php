{{-- Back Button --}}
<div style="margin-bottom: 20px;">
    <button onclick="history.back()" style="background: #1da1f2; color: white; border: none; padding: 8px 16px; border-radius: 20px; cursor: pointer; font-weight: bold;">
        ← Back
    </button>
</div>

<div style="border: 1px solid #e1e8ed; padding: 20px; margin-bottom: 20px; border-radius: 16px; max-width: 600px; background: white; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
    {{-- 🧾 Post Info --}}
    <div style="margin-bottom: 12px; display: flex; align-items: center; gap: 8px;">
        {{-- Profile Picture Placeholder --}}
        <div style="width: 40px; height: 40px; background: #f0f0f0; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; color: #666; font-size: 14px;">
            {{ strtoupper(substr($post->user->username ?? 'U', 0, 2)) }}
        </div>
        <div>
            <p style="margin: 0; font-weight: bold; color: #14171a; font-size: 15px;">{{ $post->user->username ?? 'Unknown' }}</p>
            <small style="color: #657786; font-size: 13px;">{{ $post->created_at->format('M j, Y · g:i A') }}</small>
        </div>
    </div>

    {{-- 📄 Post Content --}}
    <div style="margin-bottom: 16px;">
        <p style="font-size: 16px; line-height: 1.4; color: #14171a; margin: 0;">{{ $post->content }}</p>
    </div>

    {{-- Action Buttons --}}
    <div style="display: flex; gap: 12px; align-items: center; padding-top: 12px; border-top: 1px solid #e1e8ed;">
        {{-- Bookmark Button --}}
        <form method="POST" action="{{ route('bookmarks.toggle', $post->postId) }}" style="display: inline;">
            @csrf
            <button type="submit" style="background: none; border: none; color: #657786; cursor: pointer; display: flex; align-items: center; gap: 4px; padding: 6px 12px; border-radius: 20px; font-size: 13px; font-weight: 500;">
                @if(auth()->user()->bookmarks->contains($post))
                    <span>🔖</span> Bookmarked
                @else
                    <span>🔖</span> Bookmark
                @endif
            </button>
        </form>

        {{-- 🗑️ Delete Button (if user owns post) --}}
        @if(auth()->id() === $post->userId)
            <form method="POST" action="{{ route('posts.destroy', $post->postId) }}" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Delete this post?')" style="background: none; border: none; color: #e0245e; cursor: pointer; display: flex; align-items: center; gap: 4px; padding: 6px 12px; border-radius: 20px; font-size: 13px; font-weight: 500;">
                    <span>🗑️</span> Delete
                </button>
            </form>
        @endif
    </div>

    {{-- 💬 Reply Form --}}
    <div style="margin-top: 16px; padding-top: 16px; border-top: 1px solid #e1e8ed;">
        <form method="POST" action="{{ route('posts.reply', $post->postId) }}">
            @csrf
            <div style="display: flex; gap: 12px; align-items: flex-start;">
                {{-- Profile Picture Placeholder untuk Reply --}}
                <div style="width: 32px; height: 32px; background: #f0f0f0; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; color: #666; font-size: 12px; flex-shrink: 0;">
                    {{ strtoupper(substr(auth()->user()->username ?? 'U', 0, 2)) }}
                </div>
                <div style="flex: 1;">
                    <textarea name="content" rows="3" placeholder="Reply to this post..." required style="width: 100%; padding: 12px; border-radius: 12px; border: 1px solid #e1e8ed; resize: vertical; font-size: 15px; font-family: inherit; outline: none;"></textarea>
                    <button type="submit" style="background: #1da1f2; color: white; border: none; padding: 8px 20px; border-radius: 20px; font-weight: bold; cursor: pointer; margin-top: 8px; font-size: 14px;">
                        Reply
                    </button>
                </div>
            </div>
        </form>
    </div>

    {{-- 🧵 Replies --}}
    @if($post->replies && $post->replies->count())
        <div style="margin-top: 20px; padding-top: 16px; border-top: 1px solid #e1e8ed;">
            <h3 style="font-size: 16px; font-weight: bold; color: #14171a; margin-bottom: 16px;">
                {{ $post->replies->count() }} {{ $post->replies->count() == 1 ? 'Reply' : 'Replies' }}
            </h3>
            @foreach($post->replies as $reply)
                <div style="margin-bottom: 16px; padding: 16px; background: #f7f9fa; border-radius: 12px; border-left: 3px solid #1da1f2;">
                    <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 8px;">
                        {{-- Profile Picture Placeholder untuk Reply --}}
                        <div style="width: 32px; height: 32px; background: #e1e8ed; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; color: #657786; font-size: 12px;">
                            {{ strtoupper(substr($reply->user->username ?? 'U', 0, 2)) }}
                        </div>
                        <div>
                            <p style="margin: 0; font-weight: bold; color: #14171a; font-size: 14px;">
                                {{ $reply->user->username ?? 'Unknown' }}
                            </p>
                            <small style="color: #657786; font-size: 12px;">
                                {{ $reply->created_at ? $reply->created_at->format('M j, Y · g:i A') : 'Unknown' }}
                            </small>
                        </div>
                    </div>
                    <p style="margin: 0; color: #14171a; line-height: 1.4; font-size: 15px;">
                        {{ $reply->content }}
                    </p>
                </div>
            @endforeach
        </div>
    @endif
</div>

<style>
    /* Hover effects */
    button:hover {
        opacity: 0.9;
        transform: translateY(-1px);
        transition: all 0.2s ease;
    }
    
    /* Focus styles untuk textarea */
    textarea:focus {
        border-color: #1da1f2 !important;
        box-shadow: 0 0 0 2px rgba(29, 161, 242, 0.2);
    }
    
    /* Responsive design */
    @media (max-width: 480px) {
        div[style*="max-width: 600px"] {
            margin: 0 10px !important;
            padding: 16px !important;
        }
    }
</style>
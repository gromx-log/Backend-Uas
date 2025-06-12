<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Post Detail</title>
    <style>
        body {
            margin: 0;
            background-color: #000;
            color: #e7e9ea;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            border-left: 1px solid #2f3336;
            border-right: 1px solid #2f3336;
            min-height: 100vh;
            padding: 20px;
        }

        /* Back button styling - Elvan's feature */
        .back-button {
            background: #1d9bf0;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 20px;
            cursor: pointer;
            font-weight: bold;
            margin-bottom: 20px;
            transition: all 0.2s ease;
        }

        .back-button:hover {
            background: #1a8cd8;
            transform: translateY(-1px);
        }

        .post {
            border-bottom: 1px solid #2f3336;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }

        .user-info {
            font-weight: bold;
            margin-bottom: 4px;
        }

        .handle-time {
            color: #71767b;
            font-size: 14px;
        }

        .post-content {
            font-size: 18px;
            margin: 15px 0;
        }

        .reply-form textarea {
            width: 100%;
            background-color: #000;
            border: 1px solid #2f3336;
            color: #e7e9ea;
            padding: 10px;
            resize: none;
            font-size: 16px;
            margin-bottom: 10px;
            border-radius: 12px;
            transition: border-color 0.2s ease;
        }

        .reply-form textarea:focus {
            border-color: #1d9bf0;
            outline: none;
            box-shadow: 0 0 0 2px rgba(29, 155, 240, 0.2);
        }

        .reply-form button {
            background-color: #1d9bf0;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 9999px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .reply-form button:hover {
            background-color: #1a8cd8;
        }

        .reply {
            border-top: 1px solid #2f3336;
            padding-top: 10px;
            margin-top: 10px;        
        }

        .reply-box {
            padding: 12px;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .reply-box:hover {
            background-color: #16181c;
        }

        .reply-divider {
            border-top: 1px solid #2f3336;
        }

        .user-info a,
        .handle-time a {
            color: #1d9bf0;
            text-decoration: none;
        }

        .user-info a:hover,
        .handle-time a:hover {
            text-decoration: underline;
        }

        .bookmark, .delete {
            color: #1d9bf0;
            font-size: 14px;
            margin-right: 15px;
            cursor: pointer;
            text-decoration: none;
            background: none;
            border: none;
            transition: opacity 0.2s ease;
        }

        .bookmark:hover, .delete:hover {
            opacity: 0.8;
        }

        .delete {
            color: #f4212e;
        }

        a {
            color: #1d9bf0;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .reply-link {
            display: block;
            cursor: pointer;
        }

        /* Responsive design */
        @media (max-width: 480px) {
            .container {
                padding: 16px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        {{-- Back Button - Elvan's feature --}}
        <button onclick="history.back()" class="back-button">
            ← Back
        </button>

        <div class="post">
            <div class="user-info" onclick="event.stopPropagation();">
                <a href="{{ route('profile.show', $post->user->userHandle) }}">
                    {{ $post->user->username ?? 'Unknown' }}
                </a>
            </div>
            <div class="handle-time">
                <a href="{{ route('profile.show', $post->user->userHandle) }}">
                    @ {{ $post->user->userHandle ?? 'unknown' }}
                </a> · {{ $post->created_at->format('M j, Y H:i') }}
            </div>
            <div class="post-content">{{ $post->content }}</div>

            @if(auth()->id() === $post->userId)
                <form method="POST" action="{{ route('posts.destroy', $post->postId) }}" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete" onclick="return confirm('Delete this post?')">Delete Post</button>
                </form>
            @endif

            <form method="POST" action="{{ route('bookmarks.toggle', $post->postId) }}" style="display:inline;">
                @csrf
                <button type="submit" class="bookmark">
                    @if(auth()->user()->bookmarks->contains($post))
                        ✅ Bookmarked
                    @else
                        🔖 Bookmark
                    @endif
                </button>
            </form>
        </div>

        <div class="reply-form">
            <form method="POST" action="{{ route('posts.reply', $post->postId) }}">
                @csrf
                <textarea name="content" rows="3" placeholder="Reply to this post..." required></textarea>
                <br>
                <button type="submit">Reply</button>
            </form>
        </div>

       <div class="replies">
            @forelse($post->replies as $index => $reply)
                <div
                    onclick="window.location='{{ route('posts.show', $reply->postId) }}'"
                    class="reply-box {{ $index !== 0 ? 'reply-divider' : '' }}"
                >
                    <div class="user-info" onclick="event.stopPropagation();">
                        <a href="{{ route('profile.show', $reply->user->userHandle) }}">
                            {{ $reply->user->username ?? 'Unknown' }}
                        </a>
                    </div>
                    <div class="handle-time" onclick="event.stopPropagation();">
                        <a href="{{ route('profile.show', $reply->user->userHandle) }}">
                            @ {{ $reply->user->userHandle ?? 'unknown' }}
                        </a> · {{ $reply->created_at->format('M j, Y H:i') }}
                    </div>
                    <div class="post-content">
                        {{ $reply->content }}
                    </div>
                </div>
            @empty
                <p style="color:#71767b;">No replies yet. Be the first!</p>
            @endforelse
        </div>

    </div>
</body>
</html>
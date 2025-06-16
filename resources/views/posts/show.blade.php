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
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            border-left: 1px solid #2f3336;
            border-right: 1px solid #2f3336;
            min-height: 100vh;
            padding: 20px;
        }

        /* Back button styling - Enhanced spacing */
        .back-button {
            background: #1d9bf0;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 20px;
            cursor: pointer;
            font-weight: bold;
            margin-bottom: 30px;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-block;
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
            line-height: 1.4;
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
            box-sizing: border-box;
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

        /* Modern X-style Action buttons */
        .action-buttons {
            display: flex;
            justify-content: space-between;
            max-width: 425px;
            margin: 15px 0;
            padding: 10px 0;
            border-top: 1px solid #2f3336;
            border-bottom: 1px solid #2f3336;
        }

        .action-btn {
            background: none;
            border: none;
            color: #71767b;
            font-size: 13px;
            cursor: pointer;
            padding: 8px;
            border-radius: 50%;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 34px;
            height: 34px;
            position: relative;
        }

        .action-btn:hover {
            background-color: rgba(29, 155, 240, 0.1);
        }

        .action-btn .count {
            margin-left: 8px;
            font-size: 13px;
            color: #71767b;
        }

        /* Reply button styling */
        .reply-btn {
            color: #71767b;
        }

        .reply-btn:hover {
            background-color: rgba(29, 155, 240, 0.1);
            color: #1d9bf0;
        }

        .reply-group {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* Like button styling */
        .like-btn {
            color: #71767b;
        }

        .like-btn:hover {
            background-color: rgba(249, 24, 128, 0.1);
            color: #f91880;
        }

        .like-btn.liked {
            color: #f91880;
        }

        .like-btn.liked:hover {
            background-color: rgba(249, 24, 128, 0.1);
        }

        .like-group {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* Bookmark button styling */
        .bookmark-btn {
            color: #71767b;
        }

        .bookmark-btn:hover {
            background-color: rgba(0, 186, 124, 0.1);
            color: #00ba7c;
        }

        .bookmark-btn.bookmarked {
            color: #1d9bf0;
        }

        .bookmark-btn.bookmarked:hover {
            background-color: rgba(29, 155, 240, 0.1);
        }

        /* SVG Icons */
        .icon {
            width: 18px;
            height: 18px;
            fill: currentColor;
        }

        /* Owner actions styling */
        .owner-actions {
            display: flex;
            gap: 15px;
            margin-top: 15px;
            padding-top: 10px;
            border-top: 1px solid #2f3336;
        }

        .edit-btn {
            background: none;
            border: none;
            color: #1d9bf0;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            padding: 6px 12px;
            border-radius: 15px;
            transition: all 0.2s ease;
        }

        .edit-btn:hover {
            background-color: rgba(29, 155, 240, 0.1);
            color: #1d9bf0;
        }

        .delete-btn {
            background: none;
            border: none;
            color: #f4212e;
            font-size: 14px;
            cursor: pointer;
            padding: 6px 12px;
            border-radius: 15px;
            transition: all 0.2s ease;
        }

        .delete-btn:hover {
            background-color: rgba(244, 33, 46, 0.1);
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

        /* Comment form styling */
        .comment-form {
            background: #16181c;
            border-radius: 16px;
            padding: 16px;
            margin: 20px 0;
            display: flex;
            gap: 12px;
            align-items: flex-start;
        }

        .comment-avatar {
            width: 40px;
            height: 40px;
            background: #71767b;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #000;
            font-weight: bold;
            flex-shrink: 0;
        }

        .comment-input-area {
            flex: 1;
        }

        .comment-input-area textarea {
            width: 100%;
            background: #000;
            border: 1px solid #2f3336;
            color: #e7e9ea;
            padding: 12px;
            border-radius: 12px;
            resize: none;
            font-size: 16px;
            margin-bottom: 12px;
            box-sizing: border-box;
        }

        .comment-input-area textarea:focus {
            border-color: #1d9bf0;
            outline: none;
            box-shadow: 0 0 0 2px rgba(29, 155, 240, 0.2);
        }

        .comment-submit-btn {
            background: #1d9bf0;
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 20px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .comment-submit-btn:hover {
            background: #1a8cd8;
        }

        /* Comments section styling */
        .comments-section {
            margin-top: 20px;
        }

        .comments-title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 16px;
            color: #e7e9ea;
        }

        .comment-item {
            background: #16181c;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 12px;
            display: flex;
            gap: 12px;
            align-items: flex-start;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .comment-item:hover {
            background: #1a1d21;
        }

        .comment-avatar-small {
            width: 32px;
            height: 32px;
            background: #71767b;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #000;
            font-weight: bold;
            font-size: 12px;
            flex-shrink: 0;
        }

        .comment-content {
            flex: 1;
        }

        .comment-header {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 6px;
        }

        .comment-username {
            font-weight: bold;
            color: #e7e9ea;
        }

        .comment-handle {
            color: #71767b;
            font-size: 14px;
        }

        .comment-time {
            color: #71767b;
            font-size: 14px;
        }

        .comment-text {
            color: #e7e9ea;
            line-height: 1.4;
        }

        .no-comments {
            color: #71767b;
            text-align: center;
            padding: 40px 20px;
            font-style: italic;
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
        {{-- Back Button - Enhanced to go to home page --}}
        <a href="{{ route('home') }}" class="back-button">
            ← Home
        </a>

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

            {{-- Modern X-style Action buttons --}}
            <div class="action-buttons">
                {{-- Reply button --}}
                <div class="reply-group">
                    <button class="action-btn reply-btn" onclick="document.querySelector('.comment-form textarea').focus()">
                        <svg class="icon" viewBox="0 0 24 24">
                            <path d="M1.751 10c0-4.42 3.584-8.005 8.005-8.005h4.366c4.49 0 8.129 3.64 8.129 8.129s-3.64 8.129-8.129 8.129H2.084L1.751 10z"/>
                            <path d="M12.5 8.5l-2 2 2 2"/>
                        </svg>
                    </button>
                    <span class="count">{{ $post->replies ? $post->replies->count() : 0 }}</span>
                </div>

                {{-- Like button --}}
                <div class="like-group">
                    <form method="POST" action="{{ route('posts.like', $post->postId) }}" style="display:inline;">
                        @csrf
                        @if($post->isLikedBy(auth()->id()))
                            @method('DELETE')
                        @endif
                        <button type="submit" class="action-btn like-btn {{ $post->isLikedBy(auth()->id()) ? 'liked' : '' }}">
                            @if($post->isLikedBy(auth()->id()))
                                <svg class="icon" viewBox="0 0 24 24">
                                    <path d="M20.884 13.19c-1.351 2.48-4.001 5.12-8.379 7.67l-.503.3-.504-.3c-4.379-2.55-7.029-5.19-8.382-7.67-1.36-2.5-1.41-4.86-.514-6.67.887-1.79 2.647-2.91 4.601-3.01 1.651-.09 3.368.56 4.798 2.01 1.429-1.45 3.146-2.1 4.796-2.01 1.954.1 3.714 1.22 4.601 3.01.896 1.81.846 4.17-.514 6.67z"/>
                                </svg>
                            @else
                                <svg class="icon" viewBox="0 0 24 24">
                                    <path d="M16.697 5.5c-1.222-.06-2.679.51-3.89 2.16l-.805 1.09-.806-1.09C9.984 6.01 8.526 5.44 7.304 5.5c-1.243.07-2.349.78-2.91 1.91-.552 1.12-.633 2.78.479 4.82 1.074 1.97 3.257 4.27 7.129 6.61 3.87-2.34 6.052-4.64 7.126-6.61 1.111-2.04 1.03-3.7.477-4.82-.561-1.13-1.666-1.84-2.908-1.91zm4.187 7.69c-1.351 2.48-4.001 5.12-8.379 7.67l-.503.3-.504-.3c-4.379-2.55-7.029-5.19-8.382-7.67-1.36-2.5-1.41-4.86-.514-6.67.887-1.79 2.647-2.91 4.601-3.01 1.651-.09 3.368.56 4.798 2.01 1.429-1.45 3.146-2.1 4.796-2.01 1.954.1 3.714 1.22 4.601 3.01.896 1.81.846 4.17-.514 6.67z"/>
                                </svg>
                            @endif
                        </button>
                    </form>
                    <span class="count">{{ $post->likes->count() }}</span>
                </div>

                {{-- Bookmark button --}}
                <div>
                    <form method="POST" action="{{ route('bookmarks.toggle', $post->postId) }}" style="display:inline;">
                        @csrf
                        <button type="submit" class="action-btn bookmark-btn {{ auth()->user()->bookmarks->contains($post) ? 'bookmarked' : '' }}">
                            @if(auth()->user()->bookmarks->contains($post))
                                <svg class="icon" viewBox="0 0 24 24">
                                    <path d="M4 4.5C4 3.12 5.119 2 6.5 2h11C18.881 2 20 3.12 20 4.5v18.44l-8-5.71-8 5.71V4.5z"/>
                                </svg>
                            @else
                                <svg class="icon" viewBox="0 0 24 24">
                                    <path d="M4 4.5C4 3.12 5.119 2 6.5 2h11C18.881 2 20 3.12 20 4.5v18.44l-8-5.71-8 5.71V4.5zM6.5 4c-.276 0-.5.22-.5.5v14.56l6-4.29 6 4.29V4.5c0-.28-.224-.5-.5-.5h-11z"/>
                                </svg>
                            @endif
                        </button>
                    </form>
                </div>
            </div>

            {{-- Owner actions (Edit/Delete) --}}
            @if(auth()->id() === $post->userId)
                <div class="owner-actions">
                    <a href="{{ route('posts.edit', $post->postId) }}" class="edit-btn">
                        ✏️ Edit
                    </a>
                    <form method="POST" action="{{ route('posts.destroy', $post->postId) }}" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-btn" onclick="return confirm('Delete this post?')">
                            Delete
                        </button>
                    </form>
                </div>
            @endif
        </div>

        {{-- Comment Form --}}
        @auth
        <div class="comment-form">
            <div class="comment-avatar">
                {{ strtoupper(substr(auth()->user()->username ?? 'U', 0, 1)) }}
            </div>
            <div class="comment-input-area">
                <form action="{{ route('posts.reply', $post->postId) }}" method="POST">
                    @csrf
                    <textarea name="content" rows="3" maxlength="280" placeholder="Write a comment..." required></textarea>
                    <button type="submit" class="comment-submit-btn">
                        Comment
                    </button>
                </form>
            </div>
        </div>
        @endauth

        {{-- Comments Section (Single unified display) --}}
        <div class="comments-section">
            <h3 class="comments-title">Comments</h3>
            @forelse($post->replies as $reply)
                <div class="comment-item" onclick="window.location='{{ route('posts.show', $reply->postId) }}'">
                    <div class="comment-avatar-small">
                        {{ strtoupper(substr($reply->user->username ?? 'U', 0, 1)) }}
                    </div>
                    <div class="comment-content">
                        <div class="comment-header">
                            <a href="{{ route('profile.show', $reply->user->userHandle) }}" class="comment-username" onclick="event.stopPropagation();">
                                {{ $reply->user->username ?? 'Unknown' }}
                            </a>
                            <span class="comment-handle">{{ '@' . ltrim($reply->user->userHandle ?? 'unknown', '@') }}</span>
                            <span class="comment-time">·</span>
                            <span class="comment-time">{{ $reply->created_at->format('M j, Y H:i') }}</span>
                            @if(auth()->check() && $reply->userId === auth()->id())
                                <a href="{{ route('posts.edit', $reply->postId) }}" class="edit-btn" onclick="event.stopPropagation();">Edit</a>
                            @endif
                        </div>
                        <div class="comment-text">
                            {{ $reply->content }}
                        </div>
                    </div>
                </div>
            @empty
                <div class="no-comments">
                    No comments yet. Be the first to comment!
                </div>
            @endforelse
        </div>
    </div>
</body>
</html>
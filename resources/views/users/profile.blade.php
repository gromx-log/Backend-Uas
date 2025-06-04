<!-- Follow stats -->
<div class="follow-stats mb-3">
    <a href="{{ route('users.followers', $user) }}">
        <strong>{{ $user->followersCount() }}</strong> Followers
    </a>
    <a href="{{ route('users.following', $user) }}">
        <strong>{{ $user->followingCount() }}</strong> Following  
    </a>
</div>

<!-- Follow button -->
@auth
    @if(auth()->id() != $user->id)
        <button id="follow-btn" class="btn btn-primary" data-user-id="{{ $user->id }}">
            {{ auth()->user()->isFollowing($user->id) ? 'Unfollow' : 'Follow' }}
        </button>
    @endif
@endauth

<script>
document.addEventListener('DOMContentLoaded', function() {
    const followBtn = document.getElementById('follow-btn');
    if (followBtn) {
        followBtn.addEventListener('click', function() {
            const btn = this;
            const userId = btn.dataset.userId;
            const isFollowing = btn.textContent.trim() === 'Unfollow';
            const method = isFollowing ? 'DELETE' : 'POST';
            
            fetch(`/users/${userId}/follow`, {
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'followed') {
                    btn.textContent = 'Unfollow';
                    btn.classList.remove('btn-primary');
                    btn.classList.add('btn-secondary');
                } else {
                    btn.textContent = 'Follow';
                    btn.classList.remove('btn-secondary'); 
                    btn.classList.add('btn-primary');
                }
                // Update follower count
                const followerCount = document.querySelector('.followers-count');
                if (followerCount) {
                    followerCount.textContent = data.followers_count;
                }
            });
        });
    }
});
</script>
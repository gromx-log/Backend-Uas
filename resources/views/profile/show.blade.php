@extends('layout.app')
@section('content')
<div class="container">
    {{-- Back Button --}}
    <div style="margin-bottom: 20px;">
        <a href="{{ route('home') }}" style="text-decoration: none;">
            <button style="background: #1da1f2; color: white; border: none; padding: 8px 16px; border-radius: 20px; cursor: pointer; font-weight: bold;">
                ← Home
            </button>
        </a>
    </div>

    {{-- Profile Card dengan desain mirip Twitter --}}
    <div style="border: 1px solid #e1e8ed; border-radius: 16px; background: white; max-width: 600px; margin: 0 auto;">
        {{-- Header Section --}}
        <div style="background: linear-gradient(135deg, #1da1f2, #14171a); height: 120px; border-radius: 16px 16px 0 0; position: relative;">
            {{-- Profile Picture Placeholder --}}
            <div style="position: absolute; bottom: -30px; left: 20px; width: 80px; height: 80px; background: #f0f0f0; border-radius: 50%; border: 4px solid white; display: flex; align-items: center; justify-content: center; font-weight: bold; color: #666;">
                {{ strtoupper(substr($user->display_name ?? $user->username, 0, 2)) }}
            </div>
        </div>

        {{-- Profile Info Section --}}
        <div style="padding: 40px 20px 20px 20px;">
            {{-- Follow Button (positioned at top right) --}}
            @if(auth()->check() && auth()->user()->userId != $user->userId)
                <div style="text-align: right; margin-bottom: 10px;" id="follow-button-container">
                    @if($isFollowing)
                        <form action="{{ route('users.unfollow', $user) }}" method="POST" id="unfollow-form" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: #657786; color: white; border: none; padding: 8px 20px; border-radius: 20px; font-weight: bold; cursor: pointer; border: 1px solid #657786;">
                                Following
                            </button>
                        </form>
                    @else
                        <form action="{{ route('users.follow', $user) }}" method="POST" id="follow-form" style="display: inline;">
                            @csrf
                            <button type="submit" style="background: #1da1f2; color: white; border: none; padding: 8px 20px; border-radius: 20px; font-weight: bold; cursor: pointer;">
                                Follow
                            </button>
                        </form>
                    @endif
                </div>
            @endif

            {{-- Name and Username --}}
            <div style="margin-bottom: 12px;">
                <h1 style="font-size: 20px; font-weight: bold; margin: 0; color: #14171a;">
                    {{ $user->display_name ?? $user->username }}
                </h1>
                <p style="color: #657786; margin: 2px 0 0 0; font-size: 15px;">
                    {{ '@' . $user->username }}
                </p>
            </div>

            {{-- Bio --}}
            @if ($user->bio)
                <div style="margin-bottom: 16px;">
                    <p style="color: #14171a; line-height: 1.4; margin: 0; font-size: 15px;">
                        {{ $user->bio }}
                    </p>
                </div>
            @endif

            {{-- Followers/Following Stats --}}
            <div style="display: flex; gap: 20px; margin-top: 16px;">
                <div>
                    <span style="font-weight: bold; color: #14171a;">{{ $user->following->count() }}</span>
                    <span style="color: #657786; font-size: 14px;">Following</span>
                </div>
                <div>
                    <span style="font-weight: bold; color: #14171a;">{{ $user->followers->count() }}</span>
                    <span style="color: #657786; font-size: 14px;">Followers</span>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Hover effects untuk tombol */
    button:hover {
        opacity: 0.9;
        transform: translateY(-1px);
        transition: all 0.2s ease;
    }
    
    /* Responsive design */
    @media (max-width: 480px) {
        .container > div[style*="max-width: 600px"] {
            margin: 0 10px !important;
        }
    }
</style>
@endsection
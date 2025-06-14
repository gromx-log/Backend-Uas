@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Search Results for "{{ $query }}"</h1>

        @if($users->isEmpty())
            <p class="text-gray-500">No users found.</p>
        @else
            <ul class="space-y-4">
                @foreach($users as $user)
                    <li class="bg-gray-800 rounded-lg p-4">
                        <a href="{{ route('profile.show', $user->userHandle) }}" class="text-lg font-semibold text-blue-500 hover:underline">
                            {{ $user->username }}
                        </a>
                        <p class="text-gray-400">{{ $user->bio }}</p>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection

@extends('layout.app')

@section('content')
    <h1>Edit Profile</h1>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li style="color:red;">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PUT')

        <label>Username:</label><br>
        <input type="text" name="username" value="{{ old('username', $user->username) }}"><br><br>

        <label>Display Name:</label><br>
        <input type="text" name="display_name" value="{{ old('display_name', $user->display_name) }}"><br><br>

        <label>Bio:</label><br>
        <textarea name="bio">{{ old('bio', $user->bio) }}</textarea><br><br>

        <button type="submit">Save Changes</button>
    </form>
@endsection

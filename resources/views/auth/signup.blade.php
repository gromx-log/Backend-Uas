<html>
    <h1>Signup Form</h1>
    <form method="POST" action="{{ route('signup.submit') }}">
        @csrf
        
        <label for="username">Username:</label>
        <br>
        <input 
            name="username" 
            type="text"
            required
            value="{{ old('username') }}">
        <br>

        <label for="userHandle">User Handle (@):</label>
        <br>
        <input 
            name="userHandle" 
            type="text"
            required
            value="{{ old('userHandle') }}">
        <br>

        <label for="email">Email:</label>
        <br>
        <input 
            name="email" 
            type="email"
            required
            value="{{ old('email') }}">
        <br>

        <label for="password">Password:</label>
        <br>
        <input 
            name="password" 
            type="password"
            required >
        <br>

        <label for="password_confirmation">Confirm Password:</label>
        <br>
        <input 
            name="password_confirmation" 
            type="password"
            required >
        <br>
        
        <label for="bio">Bio:</label>
        <br>
        <textarea name="content" rows="2"></textarea>
        <br>

        <br>
        <button type="submit">Signup</button>

        @if ($errors->any())
            <h3>Errors:</h3>
            <ul>
                @foreach ($errors->all() as $errors)
                    <li> {{$errors}} </li>
                @endforeach
            </ul>
        
        @endif
    </form>
</html>

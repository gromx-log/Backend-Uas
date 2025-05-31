<html>
    <h1>Login form</h1>
    <form method="POST" action="{{ route('login.submit') }}">
        @csrf
        
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

        <br>
        <button type="submit">Login</button>

        @if ($errors->any())
            <h3>Errors:</h3>
            <ul>
                @foreach ($errors->all() as $errors)
                    <li> {{$errors}} </li>
                @endforeach
            </ul>
        
        @endif
    </form>
    <a href="{{ route('show.signup') }}">Buat Akun</a>
</html>
<?php
    $message = isset($_GET['message']) ? htmlspecialchars($_GET['message']) : '';
    // echo $message
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/styleLogin.css'])

    <title>Document</title>

</head>

{{-- @section('content') --}}
<body class="loginBody">
    <div class="loginBox">
        <div class="loginWelcome">
            <h3> Welcome Back </h3>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <br>
            <label class="loginText"> Email </label> <br>
            <input id="email" placeholder="Please enter your email." type="email" class="loginTextArea @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus> <br>
            
            <label class="loginText"> Password </label> <br>
            <input id="password" placeholder="Please enter your password."type="password" class="loginTextArea @error('password') is-invalid @enderror" name="password" required> <br>

            
            @if($errors->any())
                <div class="alert alert-danger" style="color:red; font-size: 15px;">
                    <div>
                        @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
            @endif
            
            <button type="submit" class="loginButton">
                {{ __('Login') }}
            </button>
            {{-- <input class="loginButton" name="login" type="submit" value="Login"> <br> --}}
        </form>

        <div>
            <a class="loginLink" href="{{ route('register') }}"> Don't have an account? Sign up!</a>
        </div>
    </div>
    <script>
        window.onload = function() {
            const message = "<?php echo $message; ?>";
            if (message) {
                alert(message);
            }
        }
    </script>
</body>
</html>

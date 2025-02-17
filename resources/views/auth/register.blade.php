<?php
    $message = isset($_GET['message']) ? htmlspecialchars($_GET['message']) : '';
    // echo $message
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <link rel="stylesheet" href="style.css"/> --}}
    @vite(['resources/css/sign.css'])

    <title>Document</title>
    <script>
        window.onload = function() {
            const message = "<?php echo $message; ?>";
            if (message) {
                alert(message);
            }
        }
    </script>
</head>
<body class="loginBody">
    <div class="loginBox">
        <div class="loginWelcome">
            <h3> Welcome </h3>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <br>
            <label class="loginText"> First Name</label> <br>
            <input type="text" placeholder="Please enter your First Name." class="loginTextArea" id="firstName" name="firstName" value="{{ old('firstName') }}" required> <br>

            <label class="loginText"> Last Name</label> <br>
            <input type="text" placeholder="Please enter your Last Name." class="loginTextArea" id="lastName" name="lastName" value="{{ old('lastName') }}" required> <br>

            {{-- <label class="loginText"> Username </label> <br>
            <input type="text" placeholder="Please enter a Username" class="loginTextArea" id="username" name="username" value="{{ old('username') }}" required> <br> --}}

            <label class="loginText"> Email</label> <br>
            <input type="email" placeholder="Please enter your Email Address." class="loginTextArea" id="email" name="email" value="{{ old('email') }}" required> <br>
            
            <label class="loginText"> Password</label> <br>
            <input type="password" placeholder="Please enter a password." class="loginTextArea" id="password" name="password" required> <br>

            
            <label class="loginText"> Confirm Password</label> <br>
            <input type="password" placeholder="Please enter a password." class="loginTextArea" id="password_confirmation" name="password_confirmation" required> <br>
            
            @if($errors->any())
                <div class="alert alert-danger" style="color:red; font-size: 15px;">
                    <div>
                        @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
            @endif
            
            <button type="submit" class="loginButton">{{ __(key: '  Register') }}</button>
            {{-- <input class="loginButton" name="register" type="submit" value="Register"> <br> --}}
        </form>
        <div>
            <a class="loginLink" href="{{ route('login') }}"> Already have an account? Login!</a>
        </div>
    </div>
</body>
</html>

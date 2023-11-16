<!-- dalam file login.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .login-container {
            max-width: 500px;
            margin: auto;
            margin-top: 100px;
        }

        .login-form {
            background-color: #ffffff;
            padding: 40px; /* Meningkatkan padding untuk membuat kotak lebih besar */
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.5s ease-in-out;
        }

        .btn-logo {
            width: 40px; /* Adjust the width to your preference */
            margin: 5px; /* Add some margin for spacing */
            opacity: 0; /* Initially set opacity to 0 */
            animation: fadeInLogo 0.5s ease-in-out forwards; /* Animation for fade-in */
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInLogo {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>
</head>
<body>

    <div class="container login-container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-8"> <!-- Menyesuaikan lebar kolom agar lebih besar -->
                <div class="login-form">
                    <h2 class="text-center mb-4">Login</h2>

                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form method="POST" action="{{ url('/login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </form>

                    <div class="text-center mt-3">
                        <p>Belum punya akun? <a href="{{ route('register') }}">Daftar disini</a>.</p>
                    </div>

                    <!-- Add social login logos with animations -->
                    <div class="text-center mt-3">
                        <p>Login with:</p>
                        <a href="{{ url('/login/facebook') }}"><img src="https://bkgp.hk/images/fb.png" alt="Facebook Logo" class="btn-logo"></a>
                        <a href="{{ url('/login/google') }}"><img src="https://th.bing.com/th/id/OIP.vERNCr_aTs370w5UXLAPgQAAAA?pid=ImgDet&rs=1" alt="Google Logo" class="btn-logo"></a>
                        <a href="{{ url('/login/discord') }}"><img src="https://is2-ssl.mzstatic.com/image/thumb/Purple113/v4/0d/d4/0a/0dd40aad-aa42-ca4c-0d2d-73e8bfcab7ed/source/512x512bb.jpg" alt="Discord Logo" class="btn-logo"></a>
                        <a href="{{ url('/login/instagram') }}"><img src="https://logodownload.org/wp-content/uploads/2017/04/instagram-logo.png" alt="Instagram Logo" class="btn-logo"></a>
                        <a href="{{ url('/login/vk') }}"><img src="https://s3.amazonaws.com/freebiesupply/large/2x/vk-logo-transparent.png" alt="VK Logo" class="btn-logo"></a>
                    </div>

                    <!-- Button to go back to the home page -->
                    <div class="text-center mt-3">
                        <a href="{{ route('home') }}" class="btn btn-link">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>

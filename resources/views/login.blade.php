<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login | Student Activity Tracker</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /*
         * Color Palette:
         * --primary-color: #4e73df (Blue - Used for headers, buttons, and accents)
         * --secondary-color: #f8f9fc (Light gray - Used for background elements)
         * Background gradient: #f5f7fa to #c3cfe2 (Light blue/gray gradient)
         * Text: Black/Dark gray on light backgrounds, White on dark backgrounds
         * Shadows: rgba(0, 0, 0, 0.1) for subtle depth
         * Button hover: rgba(78, 115, 223, 0.4) for blue shadow effect
         */
        :root {
            --primary-color: #4e73df;
            --secondary-color: #f8f9fc;
        }
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px;
        }
        .login-container {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
        }
        .login-header {
            background-color: var(--primary-color);
            color: white;
            padding: 20px 15px;
            text-align: center;
            font-size: clamp(18px, 5vw, 24px);
            font-weight: bold;
        }
        .login-body {
            padding: 20px 15px;
        }
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
        }
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 10px;
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(78, 115, 223, 0.4);
        }
        .form-floating {
            margin-bottom: 20px;
        }
        .register-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
        }
        .register-link:hover {
            text-decoration: underline;
        }
        @media (max-width: 576px) {
            .login-body {
                padding: 15px;
            }
            h2 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <i class="fas fa-chart-line me-2"></i> Student Activity Tracker
        </div>
        <div class="login-body">
            <h2 class="text-center mb-4">Welcome Back</h2>

            @if(session('error'))
                <div class="alert alert-danger mb-3">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                </div>
            @endif

            <form action="/login" method="POST">
                @csrf
                <div class="form-floating">
                    <input type="email" class="form-control" id="login-email" name="email" placeholder="name@example.com" required>
                    <label for="login-email"><i class="fas fa-envelope me-2"></i>Email address</label>
                </div>

                <div class="form-floating">
                    <input type="password" class="form-control" id="login-password" name="password" placeholder="Password" required>
                    <label for="login-password"><i class="fas fa-lock me-2"></i>Password</label>
                </div>

                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-sign-in-alt me-2"></i> Login
                    </button>
                </div>
            </form>

            <div class="text-center mt-4">
                <p>Don't have an account? <a href="#" class="register-link">Register here</a></p>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

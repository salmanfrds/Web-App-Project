<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Activity Tracker</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #f8f9fc;
        }
        body {
            background: linear-gradient(to bottom, #f5f7fa, #c3cfe2);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .navbar {
            background-color: var(--primary-color);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
        }
        .nav-link {
            color: white !important;
            font-weight: 500;
            transition: all 0.3s;
        }
        .nav-link:hover {
            transform: translateY(-2px);
        }
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        .btn-primary:hover {
            box-shadow: 0 0 15px rgba(78, 115, 223, 0.4);
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0.15rem 1.75rem rgba(0, 0, 0, 0.1);
        }
        footer {
            background-color: #2c3e50;
            margin-top: auto;
        }
        main {
            flex: 1;
            padding: 2rem 0;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-dark py-3" style="background-color: #4e73df;">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="http://localhost:8000/images/iium-logo.png" alt="" width="40" class="me-2"> Activity Tracker
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item mx-2 my-lg-0 my-2">
                        <a class="nav-link" href="/"><i class="fas fa-home me-2"></i> Dashboard</a>
                    </li>
                    <li class="nav-item mx-2 my-lg-0 my-2">
                        <a class="nav-link" href="/activities"><i class="fas fa-list-check me-2"></i> Activities</a>
                    </li>
                    <li class="nav-item mx-2 my-lg-0 my-2">
                        <a class="nav-link" href="/profile"><i class="fas fa-user me-2"></i> Profile</a>
                    </li>
                    <li class="nav-item mx-2 my-lg-0 my-2">
                        <form action="/logout" method="POST" class="m-0 p-0">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link" style="background: none; border: none; padding: 0.5rem 0; width: 100%; text-align: left;">
                                <i class="fas fa-sign-out-alt me-2"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container">
        <div class="row">
            <div class="col-12">
                @yield('content')
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="py-4 text-white">
        <div class="container text-center">
            <p class="mb-0 small">&copy; {{ date('Y') }} Student Activity Tracker. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>

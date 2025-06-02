<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Activity Tracker</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col min-h-screen bg-gray-100">
    <!-- Header -->
    <header class="bg-blue-600 text-white shadow-md">
        <div class="container mx-auto px-4 py-3">
            <div class="navbar flex justify-between items-center">
              <div class="logo text-xl font-bold">Student Activity Tracker</div>
              <div class="nav-links space-x-4">
                <a href="/" class="hover:underline">Dashboard</a>
                <a href="/activities" class="hover:underline">Activities</a>
                <a href="/profile" class="hover:underline">Profile</a>
                <a href="/logout" class="hover:underline">Logout</a>
              </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-6 flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-4">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; {{ date('Y') }} Student Activity Tracker. All rights reserved.</p>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>

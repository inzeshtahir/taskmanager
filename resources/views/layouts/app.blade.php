<!DOCTYPE html>
<html lang="en" class="{{ session('theme') === 'dark' ? 'dark' : '' }}">
<head>
    <meta charset="UTF-8">
    <title>Task Manager</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Tailwind CSS (via Vite) -->
    @vite('resources/css/app.css')

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background-color: #f8f9fa;
            padding: 1rem;
            position: fixed;
            top: 0;
            bottom: 0;
            left: -250px;
            transition: left 0.3s ease;
            z-index: 1000;
        }

        .sidebar.show {
            left: 0;
        }

        .main-content {
            margin-left: 0;
            transition: margin-left 0.3s ease;
        }

        .main-content.shifted {
            margin-left: 250px;
        }

        .menu-toggle {
            background: none;
            border: none;
            font-size: 24px;
            margin: 1rem;
        }
    </style>
</head>
<body class="bg-white dark:bg-gray-900 text-gray-900 dark:text-white">

    <!-- Theme Toggle Button -->
    <div class="text-end p-2 pe-4">
        <form method="POST" action="{{ route('toggle.theme') }}">
            @csrf
            <button type="submit" class="btn btn-sm btn-outline-primary">
                {{ session('theme') === 'dark' ? '☀ Light Mode' : '🌙 Dark Mode' }}
            </button>
        </form>
    </div>

    <!-- Sidebar -->
    <div id="sidebar" class="sidebar">
        <h5 class="mb-3 text-primary">My Tasks</h5>
        @auth
            <a href="{{ route('tasks.index') }}" class="btn btn-outline-primary w-100 mb-2">← Back to Tasks</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-danger w-100">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="btn btn-outline-primary w-100">Login</a>
        @endauth
    </div>

    <!-- Main Content -->
    <div id="main" class="main-content">
        <!-- Navbar -->
        <nav class="navbar navbar-dark bg-dark">
            <div class="container-fluid">
                <button class="menu-toggle text-white" onclick="toggleSidebar()">☰</button>
                <a class="navbar-brand" href="{{ route('tasks.index') }}">Task Manager</a>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="container mt-4">
            @yield('content')
        </main>
    </div>

    <!-- Footer with GitHub -->
    <footer class="text-center py-3 mt-5 bg-dark text-white">
        <small>
            <a href="https://github.com/inzeshtahir/taskmanager.git" target="_blank" class="text-info text-decoration-underline">
                <i class="fab fa-github"></i> GitHub
            </a>
        </small>
    </footer>
    <footer class="footer text-center mt-5">
        <div class="container">
            <span>Made using Laravel & Bootstrap</span>
        </div>
    </footer>

    <!-- JS -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const main = document.getElementById('main');
            sidebar.classList.toggle('show');
            main.classList.toggle('shifted');
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>
</html>

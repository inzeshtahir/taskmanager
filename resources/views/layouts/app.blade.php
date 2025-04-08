<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task Manager</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
<body>

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

    <!-- Content Wrapper -->
    <div id="main" class="main-content">
        <!-- Top bar -->
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
     <!-- Footer -->
     <footer class="text-center py-3 mt-5 bg-dark text-white">
    <small>
       <!-- FontAwesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

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

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const main = document.getElementById('main');
            sidebar.classList.toggle('show');
            main.classList.toggle('shifted');
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
@stack('scripts')
</html>

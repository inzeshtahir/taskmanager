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
            background-color: #f1f1f1;
            padding: 1rem;
            position: fixed;
            top: 0;
            bottom: 0;
            left: -250px;
            transition: left 0.3s ease;
            z-index: 1000;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
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
            color: #fff;
        }

        .navbar {
            background: linear-gradient(to right, #dc3545, #0d6efd); /* red to blue */
        }

        .navbar-brand {
            font-weight: bold;
        }

        .sidebar-title {
            font-weight: bold;
            color: #dc3545;
        }

        .back-btn, .logout-btn {
            width: 100%;
            margin-bottom: 10px;
        }

        .logout-btn {
            background-color: #dc3545;
            color: white;
        }

        .logout-btn:hover {
            background-color: #bb2d3b;
        }

        .back-btn {
            background-color: #0d6efd;
            color: white;
        }

        .back-btn:hover {
            background-color: #0b5ed7;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div id="sidebar" class="sidebar">
        <h5 class="sidebar-title">📋 My Tasks</h5>
        @auth
            <a href="{{ route('tasks.index') }}" class="btn back-btn">← Back to Tasks</a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn logout-btn">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="btn back-btn">Login</a>
        @endauth
    </div>

    <!-- Content Wrapper -->
    <div id="main" class="main-content">
        <!-- Top Navbar -->
        <nav class="navbar navbar-dark">
            <div class="container-fluid">
                <button class="menu-toggle" onclick="toggleSidebar()">☰</button>
                <a class="navbar-brand" href="{{ route('tasks.index') }}">Task Manager</a>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="container mt-4">
            @yield('content')
        </main>
    </div>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('show');
            document.getElementById('main').classList.toggle('shifted');
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

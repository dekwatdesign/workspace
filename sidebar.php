<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Sidebar</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }

        /* Sidebar style */
        .sidebar {
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background-color: #f8f9fa;
            width: 250px;
            transition: all 0.3s ease;
        }

        .sidebar .nav-link {
            color: #333;
            padding: 15px;
            display: block;
        }

        .sidebar .nav-link:hover {
            background-color: #e2e6ea;
        }

        /* Main content style */
        .content {
            margin-left: 250px;
            padding: 20px;
            transition: all 0.3s ease;
        }

        /* Collapsed Sidebar */
        .sidebar.collapsed {
            width: 70px;
        }

        .sidebar.collapsed .nav-link {
            text-align: center;
            padding: 15px 0;
        }

        .sidebar.collapsed .nav-link span {
            display: none;
        }

        .content.collapsed {
            margin-left: 70px;
        }

        /* Toggle button */
        .toggle-btn {
            position: absolute;
            top: 10px;
            left: 260px;
            cursor: pointer;
        }

        .sidebar.collapsed + .toggle-btn {
            left: 80px;
        }

        /* Responsive Design */
        @media screen and (max-width: 768px) {
            .sidebar {
                left: -250px;
            }

            .sidebar.collapsed {
                left: 0;
            }

            .content {
                margin-left: 0;
            }

            .toggle-btn {
                left: 10px;
            }

            .sidebar.collapsed + .toggle-btn {
                left: 80px;
            }
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-book"></i>
                    <span>Blog Calendar</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-cogs"></i>
                    <span>Settings</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Toggle Button -->
    <div class="toggle-btn" id="toggleBtn">
        <i class="fas fa-bars fa-2x"></i>
    </div>

    <!-- Main Content -->
    <div class="content" id="mainContent">
        <h1>Welcome to the Dashboard</h1>
        <p>Your content goes here.</p>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#toggleBtn').on('click', function () {
                $('#sidebar').toggleClass('collapsed');
                $('#mainContent').toggleClass('collapsed');
            });
        });
    </script>
</body>
</html>

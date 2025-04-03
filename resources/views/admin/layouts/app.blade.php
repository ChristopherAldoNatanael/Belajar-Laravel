<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <link rel="icon" href="{{ asset('gambar/logo-nav.png') }}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Custom styles -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fc;
        }
        
        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100vh;
            background: linear-gradient(180deg, #1a1c23 0%, #2c3e50 100%);
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            z-index: 1000;
        }
        
        .sidebar-brand {
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .sidebar-brand h4 {
            margin: 0;
            font-weight: 700;
            color: white;
            letter-spacing: 1px;
        }
        
        .sidebar-divider {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin: 1rem 0;
        }
        
        .nav-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            color: rgba(255, 255, 255, 0.8) !important;
            font-weight: 500;
            border-left: 4px solid transparent;
        }
        
        .nav-link:hover {
            color: white !important;
            background-color: rgba(255, 255, 255, 0.1);
            border-left-color: #1cc88a;
        }
        
        .nav-link.active {
            color: white !important;
            background-color: rgba(78, 115, 223, 0.2);
            border-left-color: #4e73df;
        }
        
        .nav-link i {
            margin-right: 0.75rem;
            font-size: 1rem;
        }
        
        /* Main Content Styles */
        .main-content {
            margin-left: 250px;
            min-height: 100vh;
            padding: 1.5rem;
        }
        
        /* Header Styles */
        .topbar {
            height: 70px;
            background-color: white;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1.5rem;
            margin-bottom: 1.5rem;
            border-radius: 0.5rem;
        }
        
        .topbar-divider {
            width: 0;
            border-right: 1px solid #e3e6f0;
            height: 40px;
            margin: auto 1rem;
        }
        
        .user-profile {
            display: flex;
            align-items: center;
        }
        
        .user-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 0.75rem;
            object-fit: cover;
            border: 2px solid #4e73df;
        }
        
        /* Card Styles */
        .card {
            border: none;
            border-radius: 0.5rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
        }
        
        .card-header {
            background-color: white;
            border-bottom: 1px solid #e3e6f0;
            padding: 1rem 1.5rem;
            font-weight: 700;
        }
        
        /* Table Styles */
        .table thead th {
            background-color: #f8f9fc;
            border-bottom: 2px solid #e3e6f0;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.05em;
            padding: 1rem;
        }
        
        /* Notification Badge */
        .notification-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #e74a3b;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        /* Responsive Sidebar */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .main-content.sidebar-open {
                margin-left: 250px;
            }
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-brand">
                <h4><i class="fas fa-utensils me-2"></i> Admin Panel</h4>
            </div>
            
            <div class="sidebar-divider"></div>
            
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                </li>
                
                <div class="sidebar-divider"></div>
                <div class="sidebar-heading">
                    <small class="text-muted text-uppercase px-3 py-2 d-block">Management</small>
                </div>
                
                <!-- Users Management -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.user-management.*') ? 'active' : '' }}" href="{{ route('admin.user-management.index') }}">
                        <i class="fas fa-users"></i> User Management
                    </a>
                </li>
                
                <!-- Menu Management -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.menu-management.*') ? 'active' : '' }}" href="{{ route('admin.menu-management.index') }}">
                        <i class="fas fa-utensils"></i> Menu Management
                    </a>
                </li>
                
                <div class="sidebar-divider"></div>
                <div class="sidebar-heading">
                    <small class="text-muted text-uppercase px-3 py-2 d-block">Account</small>
                </div>
                
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-user-cog"></i> Settings
                    </a>
                </li>
                
                <li class="nav-item">
                    <form action="{{ route('admin.signOut') }}" method="POST" class="px-3 py-2">
                        @csrf
                        <button type="submit" class="btn btn-danger w-100 d-flex align-items-center justify-content-center">
                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>

        <!-- Main content -->
        <div class="main-content" id="mainContent">
            <!-- Topbar -->
            <div class="topbar">
                <button id="sidebarToggle" class="btn btn-link">
                    <i class="fas fa-bars"></i>
                </button>
                
                <div class="d-flex align-items-center">
                    <div class="dropdown">
                        <button class="btn btn-link text-dark dropdown-toggle" type="button" id="notificationsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-bell fa-fw"></i>
                            <span class="badge rounded-pill bg-danger">3</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationsDropdown" style="width: 300px;">
                            <li><h6 class="dropdown-header">Notifications Center</h6></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="me-3">
                                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                            <i class="fas fa-file-alt"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-muted">December 12, 2023</div>
                                        <span>A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item text-center small text-muted" href="#">Show All Alerts</a>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="topbar-divider"></div>
                    
                    <div class="user-profile">
                        <img src="https://ui-avatars.com/api/?name=Admin&background=4e73df&color=fff" alt="Admin">
                        <div>
                            <div class="fw-bold">Admin User</div>
                            <div class="small text-muted">Administrator</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Page Content -->
            <div class="container-fluid">
                @yield('content')
            </div>
            
            <!-- Footer -->
            <footer class="bg-white mt-5 p-4 rounded shadow-sm">
                <div class="container">
                    <div class="copyright text-center">
                        <span>Copyright © Restaurant Admin 2023</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script>
        // Toggle sidebar
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            
            sidebar.classList.toggle('show');
            mainContent.classList.toggle('sidebar-open');
        });
        
        // Mobile responsive adjustments
        function checkScreenSize() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            
            if (window.innerWidth < 768) {
                sidebar.classList.remove('show');
                mainContent.classList.remove('sidebar-open');
            } else {
                sidebar.classList.add('show');
                mainContent.classList.add('sidebar-open');
            }
        }
        
        // Check on load and resize
        window.addEventListener('load', checkScreenSize);
        window.addEventListener('resize', checkScreenSize);
    </script>
    
    @yield('scripts')
</body>
</html>

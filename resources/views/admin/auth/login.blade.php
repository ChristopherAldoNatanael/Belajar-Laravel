<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Login - Ayam Goreng Joss Gandos</title>
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
</head>
<body>
    <div class="admin-login-container">
        <div class="container">
            <div class="row vh-100 align-items-center justify-content-center">
                <div class="col-12 col-md-8 col-lg-5">
                    <!-- Alert Messages -->
                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show animate__animated animate__fadeInDown" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            <span>{{ session('error') }}</span>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show animate__animated animate__fadeInDown" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-check-circle me-2"></i>
                            <span>{{ session('success') }}</span>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    
                    <!-- Login Card -->
                    <div class="card admin-login-card animate__animated animate__fadeIn">
                        <div class="card-header admin-card-header">
                            <div class="admin-logo-container">
                                <div class="admin-logo-circle">
                                    <i class="fas fa-drumstick-bite"></i>
                                </div>
                            </div>
                            <h4 class="text-center mt-4 mb-0">Admin Dashboard</h4>
                            <p class="text-center text-white-50 mb-0">Ayam Goreng Joss Gandos</p>
                        </div>
                        
                        <div class="card-body p-4 p-lg-5">
                            <div class="admin-welcome-text text-center mb-4">
                                <h5 class="fw-bold">Welcome Back, Admin</h5>
                                <p class="text-muted small">Please sign in to access the admin dashboard</p>
                            </div>
                            
                            <form method="POST" action="{{ route('admin.authenticate') }}" class="admin-login-form">
                                @csrf
                                
                                <div class="form-group mb-4">
                                    <label for="email" class="form-label">Email Address</label>
                                    <div class="input-group admin-input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                            id="email" name="email" value="{{ old('email') }}" 
                                            placeholder="Enter your email" required autofocus>
                                    </div>
                                    @error('email')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                
                                <div class="form-group mb-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <label for="password" class="form-label">Password</label>
                                        <a href="#" class="admin-forgot-link">Forgot password?</a>
                                    </div>
                                    <div class="input-group admin-input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                            id="password" name="password" placeholder="Enter your password" required>
                                        <button class="btn toggle-password" type="button">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                
                                <div class="form-group mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">
                                            Remember me
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <button type="submit" class="btn admin-login-btn w-100">
                                        <i class="fas fa-sign-in-alt me-2"></i> Sign In
                                    </button>
                                </div>
                            </form>
                            
                            <div class="admin-security-notice text-center mt-4">
                                <div class="d-flex align-items-center justify-content-center">
                                    <i class="fas fa-shield-alt me-2 text-muted"></i>
                                    <span class="text-muted small">Secure admin login</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-footer admin-card-footer text-center py-3">
                            <a href="{{ route('home') }}" class="admin-back-link">
                                <i class="fas fa-arrow-left me-1"></i> Back to Website
                            </a>
                        </div>
                    </div>
                    
                    <div class="admin-copyright text-center mt-3">
                        <p class="text-white small">&copy; {{ date('Y') }} Ayam Goreng Joss Gandos. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle password visibility
            const togglePassword = document.querySelector('.toggle-password');
            const passwordInput = document.querySelector('#password');
            
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                
                // Toggle eye icon
                this.querySelector('i').classList.toggle('fa-eye');
                this.querySelector('i').classList.toggle('fa-eye-slash');
            });
            
            // Add loading state to login button on form submit
            const loginForm = document.querySelector('.admin-login-form');
            const loginButton = document.querySelector('.admin-login-btn');
            
            loginForm.addEventListener('submit', function() {
                loginButton.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Signing in...';
                loginButton.disabled = true;
            });
            
            // Floating label effect
            const inputs = document.querySelectorAll('.form-control');
            
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('input-group-focus');
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('input-group-focus');
                });
            });
        });
    </script>
    
    <style>
        :root {
            --admin-primary: #4a6fa5;
            --admin-secondary: #6384b3;
            --admin-accent: #ff9a00;
            --admin-accent-hover: #ff7e00;
            --admin-light: #f8f9fa;
            --admin-dark: #495057;
            --admin-danger: #dc3545;
            --admin-success: #28a745;
            --admin-warning: #ffc107;
            --admin-info: #17a2b8;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #6384b3, #98b9eb);
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='100' viewBox='0 0 100 100'%3E%3Cg fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Cpath opacity='.5' d='M96 95h4v1h-4v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            height: 100vh;
            overflow-x: hidden;
        }
        
        .admin-login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .admin-login-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
            background-color: #fff;
            transition: all 0.3s ease;
        }
        
        .admin-login-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }
        
        .admin-card-header {
            position: relative;
            background: linear-gradient(135deg, #ff9a00, #ff7e00);
            color: white;
            padding: 2.5rem 1.5rem 1.5rem;
            text-align: center;
            border: none;
        }
        
        .admin-card-header::before {
            content: '';
            position: absolute;
            top: -50px;
            left: -50px;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
        }
        
        .admin-card-header::after {
            content: '';
            position: absolute;
            bottom: -30px;
            right: -30px;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
        }
        
        .admin-logo-container {
            position: relative;
            margin-bottom: 1rem;
        }
        
        .admin-logo-circle {
            width: 80px;
            height: 80px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 1;
        }
        
        .admin-logo-circle i {
            font-size: 2rem;
            color: var(--admin-accent);
        }
        
        .admin-logo-circle::before {
            content: '';
            position: absolute;
            width: 90px;
            height: 90px;
            border-radius: 50%;
            border: 2px solid rgba(255, 255, 255, 0.3);
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 1;
            }
            50% {
                transform: scale(1.1);
                opacity: 0.5;
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }
        
        .admin-card-footer {
            background-color: #f8f9fa;
            border-top: 1px solid #eee;
        }
        
        .admin-input-group {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }
        
        .admin-input-group.input-group-focus {
            box-shadow: 0 5px 15px rgba(255, 154, 0, 0.15);
        }
        
        .admin-input-group .input-group-text {
            background-color: white;
            border: none;
            border-right: 1px solid #eee;
            color: #aaa;
            padding-left: 15px;
        }
        
        .admin-input-group .form-control {
            border: none;
            padding: 12px 15px;
            font-size: 0.95rem;
        }
        
        .admin-input-group .form-control:focus {
            box-shadow: none;
        }
        
        .admin-input-group .toggle-password {
            background-color: white;
            border: none;
            border-left: 1px solid #eee;
            color: #aaa;
        }
        
        .admin-login-btn {
            background: linear-gradient(135deg, #ff9a00, #ff7e00);
            color: white;
            border: none;
            padding: 12px;
            font-weight: 500;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(255, 154, 0, 0.3);
            transition: all 0.3s ease;
        }
        
        .admin-login-btn:hover {
            background: linear-gradient(135deg, #ff7e00, #ff6a00);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 154, 0, 0.4);
        }
        
        .admin-login-btn:active, .admin-login-btn:focus {
            transform: translateY(0);
            box-shadow: 0 3px 10px rgba(255, 154, 0, 0.3);
            color: white;
        }
        
        .admin-forgot-link {
            color: var(--admin-accent);
            font-size: 0.85rem;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .admin-forgot-link:hover {
            color: var(--admin-accent-hover);
            text-decoration: underline;
        }
        
        .admin-back-link {
            color: var(--admin-dark);
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }
        
        .admin-back-link:hover {
            color: var(--admin-accent);
        }
        
        .admin-security-notice {
            color: #aaa;
            font-size: 0.85rem;
        }
        
        .admin-welcome-text h5 {
            color: var(--admin-dark);
        }
        
        .form-check-input:checked {
            background-color: var(--admin-accent);
            border-color: var(--admin-accent);
        }
        
        .form-label {
            font-weight: 500;
            color: var(--admin-dark);
            font-size: 0.9rem;
        }
        
        .invalid-feedback {
            font-size: 0.8rem;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .admin-login-card {
                margin: 1rem;
            }
            
            .admin-card-header {
                padding: 2rem 1rem 1rem;
            }
            
            .admin-logo-circle {
                width: 70px;
                height: 70px;
            }
            
            .admin-logo-circle i {
                font-size: 1.75rem;
            }
        }
        
        /* Light theme enhancements */
        .admin-login-card {
            background-color: #ffffff;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }
        
        .admin-card-header {
            background: linear-gradient(135deg, #ff9a00, #ff7e00);
        }
        
        .admin-logo-circle {
            background: white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .admin-logo-circle i {
            color: #ff9a00;
        }
        
        .admin-input-group .input-group-text,
        .admin-input-group .form-control,
        .admin-input-group .toggle-password {
            background-color: #ffffff;
            color: #495057;
            border-color: #f0f0f0;
        }
        
        .admin-input-group .form-control::placeholder {
            color: #adb5bd;
        }
        
        .admin-card-footer {
            background-color: #f8f9fa;
            border-top: 1px solid #f0f0f0;
        }
        
        .admin-welcome-text h5 {
            color: #495057;
        }
        
        .admin-welcome-text p,
        .form-label,
        .form-check-label {
            color: #6c757d;
        }
        
        .admin-back-link {
            color: #6c757d;
        }
        
        .admin-back-link:hover {
            color: #ff9a00;
        }
        
        /* Decorative elements */
        .admin-login-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.15'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            pointer-events: none;
        }
        
        /* Animation for the card */
        @keyframes float {
            0% {
                transform: translateY(0px);
                box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            }
            50% {
                transform: translateY(-10px);
                box-shadow: 0 25px 45px rgba(0, 0, 0, 0.15);
            }
            100% {
                transform: translateY(0px);
                box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            }
        }
        
        .admin-login-card {
            animation: float 6s ease-in-out infinite;
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #ff9a00;
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #ff7e00;
        }
    </style>
</body>
</html>
<!--  -->

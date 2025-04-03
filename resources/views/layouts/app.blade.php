<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ayam Goreng Joss Gandos - @yield('title')</title>
        <link rel="icon" href="{{ asset('gambar/logo-nav.png') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <!-- Bootstrap 5 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Animate.css -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
        <!-- AOS Library -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Montserrat:wght@700;800;900&display=swap" rel="stylesheet">
        <!-- Swiper CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/10.0.0/swiper-bundle.min.css" rel="stylesheet">
        <!-- Bootstrap Icons -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
        <!-- SweetAlert2 CSS -->
         <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        <!-- Custom CSS -->
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    </head>
<body>
    <!-- Preloader -->
    <div class="preloader">
        <div class="spinner"></div>
    </div>

    <!-- Custom Cursor (Desktop only) -->
    <div class="cursor"></div>
    <div class="cursor-follower"></div>

    <!-- Navbar -->
    <!-- Modified Navbar with Login/Profile Menu -->
    <!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}" style="opacity: 1 !important; top:40px;">
            <!-- Mengurangi ukuran gambar dan menambahkan margin -->
            <img src="{{ asset('gambar/logo-nav.png') }}" alt="Logo Ayam Goreng Joss Gandos" class="navbar-logo" style="opacity: 1 !important; visibility: visible !important; height: 80px;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item" data-aos="fade-down" data-aos-delay="100">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                        <i class="fas fa-home me-1"></i> Home
                    </a>
                </li>
                <li class="nav-item" data-aos="fade-down" data-aos-delay="200">
                    <a class="nav-link {{ request()->routeIs('menu.index') ? 'active' : '' }}" href="{{ route('menu.index') }}">
                        <i class="fas fa-utensils me-1"></i> Menu
                    </a>
                </li>
                <li class="nav-item" data-aos="fade-down" data-aos-delay="300">
                    <a class="nav-link {{ request()->routeIs('order.show') ? 'active' : '' }}" href="{{ route('order.show') }}">
                        <i class="fas fa-shopping-bag me-1"></i> Order
                    </a>
                </li>
                <li class="nav-item" data-aos="fade-down" data-aos-delay="400">
                    <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">
                        <i class="fas fa-envelope me-1"></i> Contact
                    </a>
                </li>
                <li class="nav-item" data-aos="fade-down" data-aos-delay="500">
                    <a class="nav-link {{ request()->routeIs('chat') ? 'active' : '' }}" href="{{ route('chat') }}">
                        <i class="fas fa-comments me-1"></i> Chat
                    </a>
                </li>
                <li class="nav-item ms-lg-3 mt-2 mt-lg-0" data-aos="fade-down" data-aos-delay="600">
                    <a class="btn btn-order" href="{{ route('cart.index') }}">
                        <i class="fas fa-shopping-cart me-2"></i>
                        <span class="notification-badge">{{ session('cart') ? count(session('cart')) : 0 }}</span>
                    </a>
                </li>

                <!-- Auth Navigation -->
                @if (Auth::guard('pelanggan')->check())
                <li class="nav-item dropdown ms-lg-3" data-aos="fade-down" data-aos-delay="700">
                    <a class="nav-link dropdown-toggle profile-dropdown" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="d-flex align-items-center">
                            <div class="profile-img">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::guard('pelanggan')->user()->pelanggan) }}&background=FF6B35&color=fff"
                                     alt="{{ Auth::guard('pelanggan')->user()->pelanggan }}">
                            </div>
                            <span class="ms-2 d-none d-lg-inline">{{ Auth::guard('pelanggan')->user()->pelanggan }}</span>
                        </div>
                    </a>
                    <ul class="dropdown-menu profile-dropdown-menu" aria-labelledby="profileDropdown">
                        <li class="dropdown-header">
                            <div class="d-flex align-items-center">
                                <div class="profile-img">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::guard('pelanggan')->user()->pelanggan) }}&background=FF6B35&color=fff"
                                         alt="{{ Auth::guard('pelanggan')->user()->pelanggan }}">
                                </div>
                                <div class="ms-3">
                                    <h6 class="mb-0">{{ Auth::guard('pelanggan')->user()->pelanggan }}</h6>
                                    <small class="text-white opacity-75">{{ Auth::guard('pelanggan')->user()->email }}</small>
                                </div>
                            </div>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('pelanggan.profile') }}">
                                <i class="fas fa-user me-2"></i> My Profile
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('order.history') }}">
                                <i class="fas fa-history me-2"></i> Order History
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-heart me-2"></i> Favorites
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('pelanggan.password.form') }}">
                                <i class="fas fa-lock me-2"></i> Change Password
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" id="logout-form" action="{{ route('logout') }}" style="display: inline;">
                                @csrf
                                <a class="dropdown-item logout-btn" href="#" onclick="event.preventDefault(); confirmLogout();">
                                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                                </a>
                            </form>
                        </li>
                    </ul>
                </li>
                @else
                <!-- Tampilkan tombol login dan register jika belum login -->
                <li class="nav-item ms-lg-3 mt-2 mt-lg-0" data-aos="fade-down" data-aos-delay="700">
                    <a class="btn btn-login" href="{{ route('login') }}" data-bs-toggle="modal" data-bs-target="#loginModal">
                        <i class="fas fa-user me-2"></i>Login
                    </a>
                </li>
                <li class="nav-item ms-lg-2 mt-2 mt-lg-0" data-aos="fade-down" data-aos-delay="800">
                    <a class="btn btn-register" href="{{ route('register') }}" data-bs-toggle="modal" data-bs-target="#registerModal">
                        <i class="fas fa-user-plus me-2"></i>Register
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
    <!-- Page Transition Effect -->
    <div class="page-transition"></div>

    <!-- Content -->
    <main class="mt-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="footer-widget">
                        <a class="footer-logo">
                            <i class="fas fa-drumstick-bite me-2"></i>Ayam Goreng Joss Gandos
                        </a>
                        <div class="footer-content">
                            <p>Sajian ayam goreng dengan racikan spesial yang membuat lidah anda bergoyang dan ketagihan untuk terus menikmati sensasi rasa yang tak terlupakan.</p>
                            <div class="social-icons">
                                <a href="#" data-aos="zoom-in" data-aos-delay="100"><i class="fab fa-facebook-f"></i></a>
                                <a href="#" data-aos="zoom-in" data-aos-delay="200"><i class="fab fa-instagram"></i></a>
                                <a href="#" data-aos="zoom-in" data-aos-delay="300"><i class="fab fa-twitter"></i></a>
                                <a href="#" data-aos="zoom-in" data-aos-delay="400"><i class="fab fa-whatsapp"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="footer-widget">
                        <h4 class="footer-heading">Quick Links</h4>
                        <ul class="footer-links">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('menu.index') }}">Menu</a></li>
                            <li><a href="{{ route('order.show') }}">Order</a></li>
                            <li><a href="{{ route('contact') }}">Contact</a></li>
                            <li><a href="{{ route('chat') }}">Chat</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="footer-widget">
                        <h4 class="footer-heading">Open Hours</h4>
                        <ul class="footer-links text-light">
                            <li>Monday - Friday: 9am - 10pm</li>
                            <li>Saturday - Sunday: 10am - 11pm</li>
                            <li>Holiday: 10am - 9pm</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="footer-widget">
                        <h4 class="footer-heading">Contact Info</h4>
                        <ul class="footer-links text-light">
                            <li><i class="fas fa-map-marker-alt me-2"></i> Jl. Makan Enak No. 123, Jakarta</li>
                            <li><i class="fas fa-phone-alt me-2"></i> +62 812 3456 7890</li>
                            <li><i class="fas fa-envelope me-2"></i> info@ayamjossgandos.id</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="text-center copyright" data-aos="fade-up">
                <p>© 2025 Ayam Goreng Joss Gandos. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button -->
    <div class="scroll-top">
        <i class="fas fa-arrow-up"></i>
    </div>

    <!-- Scripts -->
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <!-- Swiper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/10.0.0/swiper-bundle.min.js"></script>
    <!-- GSAP -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.4/gsap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <!-- Custom JS -->
    <script>
        $(document).ready(function() {
            // Initialize AOS
            AOS.init({
                duration: 1000,
                once: true,
                mirror: false
            });

            // Preloader
            setTimeout(function() {
                $('.preloader').fadeOut(500);
            }, 1500);

            // Navbar Scroll Effect
            $(window).scroll(function() {
                if ($(this).scrollTop() > 50) {
                    $('.navbar').addClass('scrolled');
                    $('.scroll-top').addClass('active');
                } else {
                    $('.navbar').removeClass('scrolled');
                    $('.scroll-top').removeClass('active');
                }
            });

            // Scroll to Top
            $('.scroll-top').click(function() {
                $('html, body').animate({
                    scrollTop: 0
                }, 800);
                return false;
            });

            // Page Transition Effect
            $('a').not('[href="#"]').not('[href="#0"]').not('[target="_blank"]').click(function(e) {
                var href = $(this).attr('href');

                if (href) {
                    e.preventDefault();
                    $('.page-transition').addClass('active');

                    setTimeout(function() {
                        window.location.href = href;
                    }, 500);
                }
            });

            // Custom Cursor Effect (Desktop only)
            if ($(window).width() > 991) {
                $(window).mousemove(function(e) {
                    $('.cursor').css({
                        left: e.clientX,
                        top: e.clientY
                    });

                    setTimeout(function() {
                        $('.cursor-follower').css({
                            left: e.clientX,
                            top: e.clientY
                        });
                    }, 100);
                });

                $('a, button').hover(
                    function() {
                        $('.cursor').css({
                            transform: 'translate(-50%, -50%) scale(1.5)',
                            opacity: 0.5
                        });
                        $('.cursor-follower').css({
                            transform: 'translate(-50%, -50%) scale(1.3)',
                            background: 'rgba(255, 107, 53, 0.1)'
                        });
                    },
                    function() {
                        $('.cursor').css({
                            transform: 'translate(-50%, -50%) scale(1)',
                            opacity: 1
                        });
                        $('.cursor-follower').css({
                            transform: 'translate(-50%, -50%) scale(1)',
                            background: 'transparent'
                        });
                    }
                );
            }

            // GSAP Animations
            gsap.from('.navbar-brand', {
                duration: 1,
                y: -50,
                opacity: 0,
                delay: 0.5
            });

            // Floating elements animation for images
            $('.floating-img').each(function() {
                gsap.to($(this), {
                    y: 20,
                    duration: 2,
                    repeat: -1,
                    yoyo: true,
                    ease: "power1.inOut"
                });
            });
        });
        $(document).ready(function() {
    // Login functionality
    $("#loginForm").submit(function(e) {
        e.preventDefault();

        const email = $("#email").val();
        const password = $("#password").val();

        // Show loading state
        $(".login-button").html('<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Logging in...');

        axios.post('{{ route('login') }}', {
            email: email,
            password: password
        })
        .then(function(response) {
            // Hide modal
            $("#loginModal").modal('hide');

            // Reset button
            $(".login-button").html('Masuk Sekarang');

            // Show success notification
            showNotification('Login successful!', 'Welcome back to Ayam Goreng Joss Gandos');

            // Reload page to show profile dropdown instead of login button
            location.reload();
        })
        .catch(function(error) {
            // Reset button
            $(".login-button").html('Masuk Sekarang');

            // Display error message
            if (error.response && error.response.data.errors) {
                showNotification('Login failed', error.response.data.errors.email[0]);
            } else {
                showNotification('Login failed', 'Email atau password salah!');
            }
        });
    });

    // Logout functionality
    $(document).on('click', '.logout-btn', function(e) {
        e.preventDefault();

        axios.post('{{ route('logout') }}')
            .then(function(response) {
                showNotification('Logged out successfully', 'See you again soon!');
                setTimeout(function() {
                    location.reload();
                }, 1500);
            })
            .catch(function(error) {
                showNotification('Logout failed', 'Gagal logout!');
            });
    });

    // Toggle password visibility
    $('.toggle-password').click(function() {
        const passwordField = $(this).closest('.input-group').find('input');
        const type = passwordField.attr('type') === 'password' ? 'text' : 'password';
        passwordField.attr('type', type);

        // Toggle icon
        $(this).find('i').toggleClass('fa-eye fa-eye-slash');
    });

    // Function to update navbar based on login state
    function updateNavbar() {
        if(window.isLoggedIn) {
            // Replace login button with profile dropdown
            $('.btn-login').parent().replaceWith(`
                <li class="nav-item dropdown ms-lg-3">
                    <a class="nav-link dropdown-toggle profile-dropdown" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="d-flex align-items-center">

                            <span class="ms-2 d-none d-lg-inline">User</span>
                        </div>
                    </a>
                    <ul class="dropdown-menu profile-dropdown-menu" aria-labelledby="profileDropdown">
                        <li class="dropdown-header">
                            <div class="d-flex align-items-center">
                                <div class="profile-img">
                                    <img src="${$('meta[name="asset-url"]').attr('content') || ''}gambar/default-avatar.png" alt="User Avatar" onerror="this.src='https://ui-avatars.com/api/?name=User&background=FF6B35&color=fff'">
                                </div>
                                <div class="ms-3">
                                    <h6 class="mb-0">Ahmad Husain</h6>
                                    <small class="text-muted">ahmad@example.com</small>
                                </div>
                            </div>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-user me-2"></i> My Profile
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-history me-2"></i> Order History
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-heart me-2"></i> Favorites
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-cog me-2"></i> Settings
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item logout-btn" href="#">
                                <i class="fas fa-sign-out-alt me-2"></i> Logout
                            </a>
                        </li>
                    </ul>
                </li>
            `);
        }
    }

    // Update the login modal to include a register link
    $(".register-link").click(function(e) {
        e.preventDefault();
        $("#loginModal").modal('hide');
        setTimeout(function() {
            $("#registerModal").modal('show');
        }, 500);
    });

    // And vice versa, switch from register to login
    $(".login-link").click(function(e) {
        e.preventDefault();
        $("#registerModal").modal('hide');
        setTimeout(function() {
            $("#loginModal").modal('show');
        }, 500);
    });

    // Password strength indicator
    $('#registerPassword').keyup(function() {
        const password = $(this).val();

        // If we don't already have the strength indicator, add it
        if (!$(this).next('.password-strength').length) {
            $(this).closest('.input-group').after('<div class="password-strength"></div>');
        }

        // Determine password strength
        const strength = calculatePasswordStrength(password);
        updatePasswordStrengthIndicator(strength);
    });

    // Form validation
    $('#registerForm').submit(function(e) {
        e.preventDefault();

        let isValid = true;

        // Validate all required fields
        if ($('#fullName').val().trim() === '') {
            markInvalid($('#fullName'), 'Full name is required');
            isValid = false;
        } else {
            markValid($('#fullName'));
        }

        const email = $('#registerEmail').val().trim();
        if (email === '') {
            markInvalid($('#registerEmail'), 'Email is required');
            isValid = false;
        } else if (!isValidEmail(email)) {
            markInvalid($('#registerEmail'), 'Please enter a valid email address');
            isValid = false;
        } else {
            markValid($('#registerEmail'));
        }

        if ($('#address').val().trim() === '') {
            markInvalid($('#address'), 'Address is required');
            isValid = false;
        } else {
            markValid($('#address'));
        }

        const phone = $('#phone').val().trim();
        if (phone === '') {
            markInvalid($('#phone'), 'Phone number is required');
            isValid = false;
        } else if (!isValidPhone(phone)) {
            markInvalid($('#phone'), 'Please enter a valid phone number');
            isValid = false;
        } else {
            markValid($('#phone'));
        }

        const password = $('#registerPassword').val();
        if (password === '') {
            markInvalid($('#registerPassword'), 'Password is required');
            isValid = false;
        } else if (password.length < 8) {
            markInvalid($('#registerPassword'), 'Password must be at least 8 characters');
            isValid = false;
        } else {
            markValid($('#registerPassword'));
        }

        if ($('#confirmPassword').val() !== password) {
            markInvalid($('#confirmPassword'), 'Passwords do not match');
            isValid = false;
        } else if ($('#confirmPassword').val() !== '') {
            markValid($('#confirmPassword'));
        }

        if (!$('#termsCheck').is(':checked')) {
            // Add a shake animation to the checkbox
            $('#termsCheck').closest('.form-check').addClass('animate__animated animate__headShake');
            setTimeout(function() {
                $('#termsCheck').closest('.form-check').removeClass('animate__animated animate__headShake');
            }, 1000);
            isValid = false;
        }

        // If all validations pass, submit the form
        if (isValid) {
            // Show loading state
            $(".register-button").html('<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Creating account...');

            // Simulate API call delay
            setTimeout(function() {
                // Hide modal
                $("#registerModal").modal('hide');

                // Reset button
                $(".register-button").html('Create Account');

                // Show success notification
                showNotification('Registration successful!', 'Welcome to Ayam Goreng Joss Gandos');

                // Set login state (in a real app, you'd store this in session/cookies)
                localStorage.setItem('isLoggedIn', 'true');

                // Reset form
                $('#registerForm')[0].reset();

                // Reload page to show profile dropdown instead of login button
                setTimeout(function() {
                    location.reload();
                }, 1500);
            }, 2000);
        }
    });

    // Helper functions
    function calculatePasswordStrength(password) {
        let strength = 0;

        // Length check
        if (password.length >= 8) strength += 1;
        if (password.length >= 12) strength += 1;

        // Complexity checks
        if (/[A-Z]/.test(password)) strength += 1;
        if (/[a-z]/.test(password)) strength += 1;
        if (/[0-9]/.test(password)) strength += 1;
        if (/[^A-Za-z0-9]/.test(password)) strength += 1;

        // Return strength level 0-4
        return Math.min(4, Math.floor(strength / 2));
    }

    function updatePasswordStrengthIndicator(strength) {
        const strengthBar = $('.password-strength');

        // Remove all previous classes
        strengthBar.removeClass('strength-weak strength-medium strength-strong strength-very-strong');

        // Add appropriate class based on strength
        switch(strength) {
            case 1:
                strengthBar.addClass('strength-weak');
                break;
            case 2:
                strengthBar.addClass('strength-medium');
                break;
            case 3:
                strengthBar.addClass('strength-strong');
                break;
            case 4:
                strengthBar.addClass('strength-very-strong');
                break;
            default:
                // No class for strength 0
                break;
        }
    }

    function isValidEmail(email) {
        const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }

    function isValidPhone(phone) {
        // Basic phone validation - can be adjusted for specific country formats
        const re = /^[+]?[(]?[0-9]{3}[)]?[-\s.]?[0-9]{3}[-\s.]?[0-9]{4,6}$/;
        return re.test(phone);
    }

    function markInvalid(element, message) {
        element.addClass('is-invalid').removeClass('is-valid');

        // Add invalid feedback if it doesn't exist
        if (!element.next('.invalid-feedback').length) {
            element.closest('.input-group').after('<div class="invalid-feedback">' + message + '</div>');
        } else {
            element.next('.invalid-feedback').text(message);
        }

        // Show the feedback
        element.next('.invalid-feedback').show();
    }

    function markValid(element) {
        element.addClass('is-valid').removeClass('is-invalid');
        element.next('.invalid-feedback').hide();
    }

    function showNotification(title, message, type = 'success') {
    // Check if notification container exists, if not create it
    if ($('#notification-container').length === 0) {
        $('body').append('<div id="notification-container" style="position: fixed; top: 20px; right: 20px; z-index: 9999;"></div>');
    }

    // Determine toast header color based on type
    let headerClass = '';
    let iconClass = '';
    switch (type) {
        case 'success':
            headerClass = 'bg-success text-white';
            iconClass = 'fas fa-check-circle text-white';
            break;
        case 'warning':
            headerClass = 'bg-warning text-dark';
            iconClass = 'fas fa-exclamation-triangle text-dark';
            break;
        case 'error':
            headerClass = 'bg-danger text-white';
            iconClass = 'fas fa-times-circle text-white';
            break;
        default:
            headerClass = 'bg-primary text-white';
            iconClass = 'fas fa-drumstick-bite text-white';
    }

    // Create toast notification
    const toastId = 'toast-' + Date.now();
    const toast = `
        <div id="${toastId}" class="toast shadow-lg border-0 animate__animated animate__fadeInRight" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="3000">
            <div class="toast-header ${headerClass}">
                <i class="${iconClass} me-2"></i>
                <strong class="me-auto">${title}</strong>
                <small>Just now</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                ${message}
            </div>
        </div>
    `;

    // Add toast to container
    $('#notification-container').append(toast);

        // Initialize and show toast
        const toastElement = new bootstrap.Toast(document.getElementById(toastId));
        toastElement.show();
    }
});


    </script>
</body>
</html>

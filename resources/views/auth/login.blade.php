@extends('layouts.app')

@section('content')
<div class="container" style="padding-top: 4rem;">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5 py-5">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden animate__animated animate__fadeIn">
                <div class="card-header bg-gradient-orange text-white border-0 p-4">
                    <h4 class="modal-title fw-bold mb-0">Selamat Datang Kembali!</h4>
                </div>
                <div class="card-body p-4">
                    <div class="text-center mb-4 animate__animated animate__fadeInDown">
                        <div class="bg-light p-3 rounded-circle d-inline-block mb-3 pulse-animation">
                            <i class="fas fa-drumstick-bite logo-icon fa-2x text-orange"></i>
                        </div>
                        <h4 class="mt-2 fw-bold text-orange">Ayam Goreng Joss Gandos</h4>
                        <p class="text-muted">Login untuk melanjutkan petualangan kuliner Anda</p>
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-4 animate__animated animate__fadeInUp" style="animation-delay: 0.1s">
                            <label for="email" class="form-label fw-medium">Email</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-envelope text-orange"></i></span>
                                <input type="email" class="form-control border-start-0 ps-0 @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email Anda" required autocomplete="email" autofocus>
                            </div>
                            @error('email')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4 animate__animated animate__fadeInUp" style="animation-delay: 0.2s">
                            <div class="d-flex justify-content-between">
                                <label for="password" class="form-label fw-medium">Password</label>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="forgot-password text-decoration-none small text-orange hover-link">Lupa password?</a>
                                @endif
                            </div>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-lock text-orange"></i></span>
                                <input type="password" class="form-control border-start-0 border-end-0 ps-0 @error('password') is-invalid @enderror" id="password" name="password" placeholder="Masukkan password Anda" required autocomplete="current-password">
                                <button class="btn btn-outline-light bg-light border-start-0 toggle-password" type="button">
                                    <i class="fas fa-eye text-muted"></i>
                                </button>
                            </div>
                            @error('password')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4 d-flex justify-content-start animate__animated animate__fadeInUp" style="animation-delay: 0.3s">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">Ingat saya</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-orange w-100 btn-lg login-button py-3 fw-bold shadow-btn animate__animated animate__fadeInUp" style="animation-delay: 0.4s">Masuk Sekarang</button>
                    </form>

                    <div class="text-center mt-4 animate__animated animate__fadeInUp" style="animation-delay: 0.5s">
                        <span>Belum punya akun?</span>
                        <a href="{{ route('register') }}" class="register-link text-decoration-none fw-bold text-orange hover-link">Daftar sekarang</a>
                    </div>

                    <div class="mt-4 social-login animate__animated animate__fadeInUp" style="animation-delay: 0.6s">
                        <div class="position-relative my-4">
                            <hr class="text-muted">
                            <span class="position-absolute top-50 start-50 translate-middle px-3 bg-white text-muted small">atau login dengan</span>
                        </div>
                        <div class="d-flex justify-content-center gap-3 mt-3">
                            <a href="#" class="social-btn google-btn rounded-circle p-2 shadow-sm hover-scale">
                                <i class="fab fa-google text-danger fa-lg"></i>
                            </a>
                            <a href="#" class="social-btn facebook-btn rounded-circle p-2 shadow-sm hover-scale">
                                <i class="fab fa-facebook-f text-primary fa-lg"></i>
                            </a>
                            <a href="#" class="social-btn twitter-btn rounded-circle p-2 shadow-sm hover-scale">
                                <i class="fab fa-twitter text-info fa-lg"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<style>
    body {
        background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
        background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ff9a00' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");
    }
    .container {
        padding-top: 2rem;
    }
    .bg-gradient-orange {
        background: linear-gradient(135deg, #ff9a00, #ff6a00);
    }
    .text-orange {
        color: #ff7e00;
    }
    .btn-orange {
        background: linear-gradient(135deg, #ff9a00, #ff6a00);
        color: white;
        border: none;
        transition: all 0.3s ease;
    }
    .btn-orange:hover {
        background: linear-gradient(135deg, #ff6a00, #ff5500);
        color: white;
        transform: translateY(-3px);
    }
    .shadow-btn {
        box-shadow: 0 4px 15px rgba(255, 126, 0, 0.3);
    }
    .hover-scale {
        transition: all 0.3s ease;
    }
    .hover-scale:hover {
        transform: scale(1.1);
    }
    .hover-link {
        transition: all 0.3s ease;
    }
    .hover-link:hover {
        color: #ff5500 !important;
        text-decoration: underline !important;
    }
    .pulse-animation {
        animation: pulse 2s infinite;
        box-shadow: 0 0 0 rgba(255, 126, 0, 0.4);
    }
    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(255, 126, 0, 0.4);
        }
        70% {
            box-shadow: 0 0 0 10px rgba(255, 126, 0, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(255, 126, 0, 0);
        }
    }
    .card {
        border-radius: 20px !important;
        backdrop-filter: blur(10px);
        background-color: rgba(255, 255, 255, 0.95);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }
    .card-header {
        position: relative;
        overflow: hidden;
        border-top-left-radius: 20px !important;
        border-top-right-radius: 20px !important;
    }
    .card-header:before {
        content: "";
        position: absolute;
        width: 150px;
        height: 150px;
        background: radial-gradient(circle, rgba(255,255,255,0.3) 0%, rgba(255,255,255,0) 70%);
        top: -75px;
        right: -75px;
        border-radius: 50%;
    }
    .card-header:after {
        content: "";
        position: absolute;
        width: 100px;
        height: 100px;
        background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0) 70%);
        bottom: -50px;
        left: -50px;
        border-radius: 50%;
    }
    .input-group-text {
        border-radius: 10px 0 0 10px !important;
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        border: none;
    }
    .form-control {
        border-radius: 0 10px 10px 0 !important;
        border: none;
        background-color: #f8f9fa;
        box-shadow: inset 0 1px 3px rgba(0,0,0,0.1);
    }
    .form-control:focus {
        box-shadow: 0 0 0 3px rgba(255, 126, 0, 0.2);
    }
    .social-btn {
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: white;
        border: 2px solid #f1f1f1;
        transition: all 0.3s ease;
    }
    .social-btn:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .google-btn:hover {
        border-color: #ea4335;
    }
    .facebook-btn:hover {
        border-color: #3b5998;
    }
    .twitter-btn:hover {
        border-color: #1da1f2;
    }
    .form-check-input:checked {
        background-color: #ff7e00;
        border-color: #ff7e00;
    }
    .login-button {
        position: relative;
        overflow: hidden;
        z-index: 1;
    }
    .login-button:before {
        content: "";
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, rgba(255,255,255,0.2), rgba(255,255,255,0));
        transition: all 0.6s ease;
        z-index: -1;
    }
    .login-button:hover:before {
        left: 100%;
    }
    .rounded-circle {
        box-shadow: 0 5px 15px rgba(255, 126, 0, 0.2);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const togglePasswordButtons = document.querySelectorAll('.toggle-password');

        togglePasswordButtons.forEach(button => {
            button.addEventListener('click', function() {
                const passwordInput = this.closest('.input-group').querySelector('input');
                const icon = this.querySelector('i');

                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });
    });
</script>
@endsection
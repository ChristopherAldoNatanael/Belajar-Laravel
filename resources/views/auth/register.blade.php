@extends('layouts.app')

@section('content')
<div class="container" style="padding-top: 4rem;">
    <div class="row justify-content-center">
        <div class="col-md-9 col-lg-8 py-5">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden animate__animated animate__fadeIn">
                <div class="card-header bg-gradient-orange text-white border-0 p-4">
                    <h4 class="modal-title fw-bold mb-0">Buat Akun Baru</h4>
                </div>
                <div class="card-body p-4">
                    <div class="text-center mb-4 animate__animated animate__fadeInDown">
                        <div class="bg-light p-3 rounded-circle d-inline-block mb-3 pulse-animation">
                            <i class="fas fa-drumstick-bite logo-icon fa-2x text-orange"></i>
                        </div>
                        <h4 class="mt-2 fw-bold text-orange">Ayam Goreng Joss Gandos</h4>
                        <p class="text-muted">Bergabunglah dengan komunitas kuliner kami</p>
                    </div>

                    <!-- Form remains the same, just adding animation classes -->
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4 animate__animated animate__fadeInUp" style="animation-delay: 0.1s">
                                    <label for="pelanggan" class="form-label fw-medium text-orange">Nama Lengkap</label>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text bg-light border-end-0"><i class="fas fa-user text-orange"></i></span>
                                        <input type="text" class="form-control border-start-0 ps-0 @error('pelanggan') is-invalid @enderror" 
                                               id="pelanggan" name="pelanggan" value="{{ old('pelanggan') }}" placeholder="Masukkan nama lengkap" required autofocus>
                                    </div>
                                    @error('pelanggan')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4 animate__animated animate__fadeInUp" style="animation-delay: 0.2s">
                                    <label for="email" class="form-label fw-medium text-orange">Email</label>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text bg-light border-end-0"><i class="fas fa-envelope text-orange"></i></span>
                                        <input type="email" class="form-control border-start-0 ps-0 @error('email') is-invalid @enderror" 
                                               id="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email" required>
                                    </div>
                                    @error('email')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-4 animate__animated animate__fadeInUp" style="animation-delay: 0.3s">
                            <label for="alamat" class="form-label fw-medium text-orange">Alamat</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-map-marker-alt text-orange"></i></span>
                                <input type="text" class="form-control border-start-0 ps-0 @error('alamat') is-invalid @enderror" 
                                       id="alamat" name="alamat" value="{{ old('alamat') }}" placeholder="Masukkan alamat lengkap" required>
                            </div>
                            @error('alamat')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4 animate__animated animate__fadeInUp" style="animation-delay: 0.4s">
                            <label for="telp" class="form-label fw-medium text-orange">Nomor Telepon</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-phone text-orange"></i></span>
                                <input type="tel" class="form-control border-start-0 ps-0 @error('telp') is-invalid @enderror" 
                                       id="telp" name="telp" value="{{ old('telp') }}" placeholder="Masukkan nomor telepon" required>
                            </div>
                            @error('telp')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4 animate__animated animate__fadeInUp" style="animation-delay: 0.5s">
                                    <label for="password" class="form-label fw-medium text-orange">Password</label>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text bg-light border-end-0"><i class="fas fa-lock text-orange"></i></span>
                                        <input type="password" class="form-control border-start-0 border-end-0 ps-0 @error('password') is-invalid @enderror" id="password" name="password" placeholder="Buat password" required autocomplete="new-password">
                                        <button class="btn btn-outline-light bg-light border-start-0 toggle-password" type="button">
                                            <i class="fas fa-eye text-orange"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4 animate__animated animate__fadeInUp" style="animation-delay: 0.6s">
                                    <label for="password-confirm" class="form-label fw-medium text-orange">Konfirmasi Password</label>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text bg-light border-end-0"><i class="fas fa-lock text-orange"></i></span>
                                        <input type="password" class="form-control border-start-0 border-end-0 ps-0" id="password-confirm" name="password_confirmation" placeholder="Konfirmasi password" required autocomplete="new-password">
                                        <button class="btn btn-outline-light bg-light border-start-0 toggle-password" type="button">
                                            <i class="fas fa-eye text-orange"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4 animate__animated animate__fadeInUp" style="animation-delay: 0.7s">
                            <div class="form-check">
                                <input class="form-check-input @error('terms') is-invalid @enderror" type="checkbox" id="terms" name="terms" required {{ old('terms') ? 'checked' : '' }}>
                                <label class="form-check-label" for="terms">
                                    Saya menyetujui <a href="#" class="terms-link text-decoration-none fw-medium text-orange hover-link">Syarat dan Ketentuan</a> serta <a href="#" class="privacy-link text-decoration-none fw-medium text-orange hover-link">Kebijakan Privasi</a>
                                </label>
                                @error('terms')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-orange w-100 btn-lg register-button py-3 fw-bold shadow-btn animate__animated animate__fadeInUp" style="animation-delay: 0.8s">Buat Akun Sekarang</button>
                    </form>

                    <div class="text-center mt-4 animate__animated animate__fadeInUp" style="animation-delay: 0.9s">
                        <span>Sudah punya akun?</span>
                        <a href="{{ route('login') }}" class="login-link text-decoration-none fw-bold text-orange hover-link">Login di sini</a>
                    </div>

                    <div class="mt-4 social-login animate__animated animate__fadeInUp" style="animation-delay: 1s">
                        <div class="position-relative my-4">
                            <hr class="text-muted">
                            <span class="position-absolute top-50 start-50 translate-middle px-3 bg-white text-muted small">atau daftar dengan</span>
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
        background: linear-gradient(135deg, #fff8f0 0%, #ffe8cc 100%);
        background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ff9a00' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
    }
    .container {
        padding-top: 2rem;
    }
    .bg-gradient-orange {
        background: linear-gradient(135deg, #ff9500, #ff5100);
    }
    .text-orange {
        color: #ff6a00;
    }
    .btn-orange {
        background: linear-gradient(135deg, #ff9500, #ff5100);
        color: white;
        border: none;
        transition: all 0.3s ease;
    }
    .btn-orange:hover {
        background: linear-gradient(135deg, #ff5100, #ff3c00);
        color: white;
        transform: translateY(-3px);
    }
    .shadow-btn {
        box-shadow: 0 4px 15px rgba(255, 106, 0, 0.4);
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
        color: #ff3c00 !important;
        text-decoration: underline !important;
    }
    .pulse-animation {
        animation: pulse 2s infinite;
        box-shadow: 0 0 0 rgba(255, 106, 0, 0.4);
        background: linear-gradient(135deg, #fff8f0, #ffe0b2);
    }
    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(255, 106, 0, 0.6);
        }
        70% {
            box-shadow: 0 0 0 15px rgba(255, 106, 0, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(255, 106, 0, 0);
        }
    }
    .card {
        border-radius: 20px !important;
        backdrop-filter: blur(10px);
        background-color: rgba(255, 255, 255, 0.95);
        border: 1px solid rgba(255, 165, 0, 0.1);
        box-shadow: 0 15px 35px rgba(255, 106, 0, 0.1), 0 5px 15px rgba(0, 0, 0, 0.07);
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
        background: linear-gradient(135deg, #fff8f0, #ffe0b2);
        border: none;
        color: #ff6a00;
    }
    .form-control {
        border-radius: 0 10px 10px 0 !important;
        border: none;
        background-color: #fff8f0;
        box-shadow: inset 0 1px 3px rgba(255, 106, 0, 0.1);
    }
    .form-control:focus {
        box-shadow: 0 0 0 3px rgba(255, 106, 0, 0.2);
        background-color: #ffffff;
    }
    .social-btn {
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: white;
        border: 2px solid #ffe0b2;
        transition: all 0.3s ease;
    }
    .social-btn:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(255, 106, 0, 0.2);
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
        background-color: #ff6a00;
        border-color: #ff6a00;
    }
    .login-button, .register-button {
        position: relative;
        overflow: hidden;
        z-index: 1;
    }
    .login-button:before, .register-button:before {
        content: "";
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, rgba(255,255,255,0.3), rgba(255,255,255,0));
        transition: all 0.6s ease;
        z-index: -1;
    }
    .login-button:hover:before, .register-button:hover:before {
        left: 100%;
    }
    .form-label {
        color: #ff6a00;
        font-weight: 600;
    }
    .form-check-label {
        color: #666;
    }
    hr {
        border-color: rgba(255, 106, 0, 0.1);
    }
    /* Floating animation for the logo */
    @keyframes float {
        0% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(-10px);
        }
        100% {
            transform: translateY(0px);
        }
    }
    .logo-icon {
        animation: float 3s ease-in-out infinite;
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


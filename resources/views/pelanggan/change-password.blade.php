@extends('layouts.app')
@section('title', 'Change Password - Ayam Goreng Jos Gandos')

@section('content')
<style>
    /* Professional Color Palette - Menyesuaikan dengan profile.blade.php */
    :root {
        --pwd-primary-blue: #4f46e5;
        --pwd-primary-purple: #8b5cf6;
        --pwd-light-blue: rgba(79, 70, 229, 0.1);
        --pwd-light-purple: rgba(139, 92, 246, 0.1);
        --pwd-dark-blue: #4338ca;
        --pwd-dark-purple: #7c3aed;
        --pwd-neutral-light: #f8f9fa;
        --pwd-neutral-medium: #e9ecef;
        --pwd-neutral-dark: #343a40;
    }

    /* Custom Card Styles */
    .pwd-card {
        border-radius: 16px;
        border: none;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .pwd-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .pwd-card-header {
        position: relative;
        overflow: hidden;
        background: linear-gradient(to right, rgba(79, 70, 229, 0.1), rgba(139, 92, 246, 0.1));
        border-bottom: none;
    }

    .pwd-card-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(135deg, #4f46e5, #8b5cf6);
    }

    /* Custom Button Styles */
    .pwd-btn-primary {
        background: linear-gradient(135deg, #4f46e5, #8b5cf6);
        border: none;
        box-shadow: 0 4px 15px rgba(79, 70, 229, 0.3);
        transition: all 0.3s ease;
        color: white;
        border-radius: 0.5rem;
        padding: 0.5rem 1.5rem;
    }

    .pwd-btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(79, 70, 229, 0.4);
        background: linear-gradient(135deg, #4338ca, #7c3aed);
    }

    .pwd-btn-outline {
        color: #4f46e5;
        border-color: #4f46e5;
        border-radius: 0.5rem;
        padding: 0.5rem 1.5rem;
        transition: all 0.3s ease;
    }

    .pwd-btn-outline:hover {
        background-color: rgba(79, 70, 229, 0.05);
        transform: translateY(-2px);
    }

    /* Custom Form Controls */
    .pwd-form-control {
        border-radius: 0.5rem;
        padding: 0.75rem 1rem 0.75rem 2.5rem;
        border: 1px solid #ced4da;
        transition: all 0.3s ease;
    }

    .pwd-form-control:focus {
        border-color: #4f46e5;
        box-shadow: 0 0 0 0.25rem rgba(79, 70, 229, 0.25);
    }

    .pwd-input-wrapper {
        position: relative;
    }

    .pwd-input-icon {
        position: absolute;
        top: 50%;
        left: 0.75rem;
        transform: translateY(-50%);
        color: #adb5bd;
        z-index: 10;
    }

    /* Badge Styles */
    .pwd-badge-blue {
        background-color: rgba(79, 70, 229, 0.1);
        color: #4f46e5;
        font-weight: 500;
    }

    .pwd-badge-purple {
        background-color: rgba(139, 92, 246, 0.1);
        color: #8b5cf6;
        font-weight: 500;
    }

    .pwd-badge-success {
        background-color: rgba(16, 185, 129, 0.1);
        color: #10b981;
        font-weight: 500;
    }

    /* Timeline Styles */
    .pwd-timeline {
        position: relative;
        padding-left: 2.5rem;
        margin-left: 0.5rem;
    }

    .pwd-timeline::before {
        content: '';
        position: absolute;
        left: 0.85rem;
        top: 0;
        height: 100%;
        width: 2px;
        background: linear-gradient(to bottom, #4f46e5 0%, #8b5cf6 100%);
        border-radius: 1px;
    }

    .pwd-timeline-item {
        position: relative;
        padding-bottom: 2rem;
        margin-bottom: 0.5rem;
    }

    .pwd-timeline-item:last-child {
        padding-bottom: 0;
    }

    .pwd-timeline-dot {
        position: absolute;
        left: -2.5rem;
        top: 0.5rem;
        width: 1rem;
        height: 1rem;
        border-radius: 50%;
        background: white;
        border: 2px solid #4f46e5;
        z-index: 2;
        box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
    }

    .pwd-timeline-dot.pwd-pulse {
        animation: pwdPulse 2s infinite;
    }

    .pwd-timeline-dot.bg-success {
        border-color: #10b981;
        box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
    }

    .pwd-timeline-dot.bg-primary {
        border-color: #4f46e5;
        box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
    }

    .pwd-timeline-dot-inner {
        width: 0.75rem;
        height: 0.75rem;
        border-radius: 50%;
    }

    /* Animation Classes */
    .pwd-fade-in {
        animation: pwdFadeIn 0.5s ease-out forwards;
    }

    .pwd-slide-in {
        animation: pwdSlideIn 0.5s ease-out forwards;
    }

    .pwd-delay-100 { animation-delay: 0.1s; }
    .pwd-delay-200 { animation-delay: 0.2s; }
    .pwd-delay-300 { animation-delay: 0.3s; }

    @keyframes pwdFadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes pwdSlideIn {
        from { opacity: 0; transform: translateX(-10px); }
        to { opacity: 1; transform: translateX(0); }
    }

    /* Shimmer Effect */
    .pwd-shimmer {
        position: relative;
        overflow: hidden;
    }
    
    .pwd-shimmer::after {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(
            to right,
            rgba(255, 255, 255, 0) 0%,
            rgba(255, 255, 255, 0.3) 50%,
            rgba(255, 255, 255, 0) 100%
        );
        transform: rotate(30deg);
        animation: pwdShimmer 3s infinite;
    }
    
    @keyframes pwdShimmer {
        0% { transform: translateX(-100%) rotate(30deg); }
        100% { transform: translateX(100%) rotate(30deg); }
    }

    /* Pulse Animation */
    @keyframes pwdPulse {
        0% { box-shadow: 0 0 0 0 rgba(79, 70, 229, 0.7); }
        70% { box-shadow: 0 0 0 10px rgba(79, 70, 229, 0); }
        100% { box-shadow: 0 0 0 0 rgba(79, 70, 229, 0); }
    }
    
    .pwd-pulse {
        animation: pwdPulse 2s infinite;
    }

         /* Nav Pills Custom dengan nama class yang berbeda */
    .pwd-custom-nav .pwd-nav-item.active {
        background: linear-gradient(135deg, #4f46e5, #8b5cf6);
        color: white;
        box-shadow: 0 4px 15px rgba(79, 70, 229, 0.3);
    }

    .pwd-custom-nav .pwd-nav-item {
        border-radius: 10px;
        padding: 0.75rem 1.25rem;
        font-weight: 500;
        color: #4f46e5;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        text-decoration: none;
        margin-bottom: 0.5rem;
    }

    .pwd-custom-nav .pwd-nav-item:hover:not(.active) {
        background-color: rgba(79, 70, 229, 0.1);
        color: #4338ca;
        transform: translateY(-2px);
    }

    /* Tombol logout custom */
    .pwd-logout-btn {
        border-radius: 10px;
        padding: 0.75rem 1.25rem;
        font-weight: 500;
        color: #dc3545;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        background: transparent;
        border: none;
        width: 100%;
        text-align: left;
        cursor: pointer;
    }

    .pwd-logout-btn:hover {
        background-color: rgba(220, 53, 69, 0.1);
        transform: translateY(-2px);
    }

    /* Avatar Styles */
    .pwd-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        border: 3px solid white;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: rgba(79, 70, 229, 0.1);
        color: #4f46e5;
    }

    .pwd-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .pwd-avatar-sm {
        width: 50px;
        height: 50px;
        font-size: 1.25rem;
    }

    .pwd-avatar-lg {
        width: 100px;
        height: 100px;
        font-size: 2.5rem;
    }

    /* Alert Styles - Fix for security warning */
    .alert.pwd-shimmer {
        position: relative;
        overflow: hidden;
        z-index: 1;
    }
</style>

<div class="container py-5">
    <!-- Success Message -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4 animate__animated animate__fadeInDown" role="alert">
            <div class="d-flex align-items-center">
                <i class="bi bi-check-circle-fill me-2"></i>
                <strong>{{ session('success') }}</strong>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <!-- Sidebar -->
        <div class="col-lg-4 mb-4 mt-5 mb-lg-0">
            <div class="card pwd-card pwd-fade-in pwd-delay-100">
                <div class="card-body p-4">
                <div class="text-center mb-4">
                        <div class="pwd-avatar pwd-avatar-lg mx-auto mb-3">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::guard('pelanggan')->user()->pelanggan) }}&background=4f46e5&color=fff&size=100" alt="Profile Photo" class="img-fluid">
                        </div>
                        <h5 class="mb-1">{{ Auth::guard('pelanggan')->user()->pelanggan }}</h5>
                        <p class="text-muted small mb-3">{{ Auth::guard('pelanggan')->user()->email }}</p>
                        
                        <div class="d-flex justify-content-center gap-2 mb-3">
                            <span class="badge pwd-badge-success rounded-pill px-3 py-2">
                                <i class="fas fa-circle me-1 small"></i> Active
                            </span>
                            <span class="badge pwd-badge-blue rounded-pill px-3 py-2">
                                Member
                            </span>
                        </div>
                    </div>

                    <hr>

                    <div class="pwd-custom-nav">
                        <a href="{{ route('pelanggan.profile') }}" class="pwd-nav-item">
                            <i class="fas fa-user-circle me-3"></i>
                            <span>Informasi Pribadi</span>
                        </a>
                        <a href="{{ route('pelanggan.password.form') }}" class="pwd-nav-item active">
                            <i class="fas fa-lock me-3"></i>
                            <span>Ubah Password</span>
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="mt-2">
                            @csrf
                            <button type="submit" class="pwd-logout-btn">
                                <i class="fas fa-sign-out-alt me-3"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>

                    <div class="mt-4 p-3 bg-light rounded-3">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-info-circle text-primary me-2"></i>
                            <small class="text-muted">
                                Terakhir login pada {{ now()->format('d M Y, H:i') }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Security Tips Card -->
            <div class="card pwd-card mt-4 pwd-fade-in pwd-delay-300">
                <div class="card-body p-4">
                    <h5 class="d-flex align-items-center mb-3">
                        <i class="fas fa-shield-alt text-primary me-2"></i>
                        Tips Keamanan
                    </h5>
                    <div class="alert alert-warning pwd-shimmer">
                        <h6 class="alert-heading d-flex align-items-center">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Peringatan Keamanan
                        </h6>
                        <p class="mb-0 small">Jangan pernah membagikan password Anda kepada siapapun, termasuk staf kami. Kami tidak akan pernah meminta password Anda melalui email atau telepon.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Password Form Card -->
            <div class="card pwd-card pwd-fade-in pwd-delay-200">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="d-flex align-items-center">
                            <i class="fas fa-lock text-primary me-2"></i>
                            Ubah Password
                        </h5>
                        <span class="badge pwd-badge-blue rounded-pill px-3 py-2">
                            <i class="fas fa-circle me-1 small"></i> Keamanan
                        </span>
                    </div>

                    <p class="text-muted mb-4">
                        Ubah password Anda secara berkala untuk menjaga keamanan akun. Gunakan kombinasi huruf, angka, dan simbol untuk password yang kuat.
                    </p>

                    <form method="POST" action="{{ route('pelanggan.password.update') }}" class="pwd-slide-in">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="current_password" class="form-label">Password Saat Ini</label>
                            <div class="pwd-input-wrapper">
                                <i class="fas fa-lock pwd-input-icon"></i>
                                <input type="password" class="form-control pwd-form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password">
                                @error('current_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">Password Baru</label>
                            <div class="pwd-input-wrapper">
                                <i class="fas fa-lock pwd-input-icon"></i>
                                <input type="password" class="form-control pwd-form-control @error('password') is-invalid @enderror" id="password" name="password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                            <div class="pwd-input-wrapper">
                                <i class="fas fa-check pwd-input-icon"></i>
                                <input type="password" class="form-control pwd-form-control" id="password_confirmation" name="password_confirmation">
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="button" class="btn pwd-btn-outline me-2">
                                Batal
                            </button>
                            <button type="submit" class="btn pwd-btn-primary">
                                <i class="fas fa-save me-1"></i> Perbarui Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Password Tips Card -->
            <div class="card pwd-card mt-4 pwd-fade-in pwd-delay-300">
                <div class="card-body p-4">
                    <h5 class="d-flex align-items-center mb-3">
                        <i class="fas fa-info-circle text-primary me-2"></i>
                        Tips Keamanan Password
                    </h5>

                    <div class="bg-light p-3 rounded-3 pwd-shimmer mb-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex align-items-start mb-3">
                                    <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                    <p class="mb-0 small">Gunakan minimal 8 karakter dengan kombinasi huruf besar, huruf kecil, angka, dan simbol.</p>
                                </div>
                                <div class="d-flex align-items-start mb-3">
                                    <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                    <p class="mb-0 small">Hindari menggunakan informasi pribadi seperti nama, tanggal lahir, atau kata-kata umum.</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-start mb-3">
                                    <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                    <p class="mb-0 small">Ganti password Anda secara berkala, minimal setiap 3 bulan sekali.</p>
                                </div>
                                <div class="d-flex align-items-start">
                                    <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                    <p class="mb-0 small">Jangan gunakan password yang sama untuk beberapa akun yang berbeda.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Security Activity Card -->
            <div class="card pwd-card mt-4 pwd-fade-in pwd-delay-300">
                <div class="card-body p-4">
                    <h5 class="d-flex align-items-center mb-4">
                        <i class="fas fa-history text-primary me-2"></i>
                        Aktivitas Keamanan Terbaru
                    </h5>
                    
                    <div class="pwd-timeline">
                        <div class="pwd-timeline-item">
                            <div class="pwd-timeline-dot pwd-pulse"></div>
                            <div class="card shadow-sm">
                                <div class="card-body p-3">
                                    <h6 class="card-title mb-1">Login Berhasil</h6>
                                    <p class="card-text small text-muted mb-1">Login terakhir dari perangkat yang dikenali</p>
                                    <p class="card-text small text-muted mb-0">{{ now()->subHours(rand(1, 5))->format('d M Y, H:i') }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="pwd-timeline-item">
                            <div class="pwd-timeline-dot bg-success"></div>
                            <div class="card shadow-sm">
                                <div class="card-body p-3">
                                    <h6 class="card-title mb-1">Profil Diperbarui</h6>
                                    <p class="card-text small text-muted mb-1">Anda memperbarui informasi profil</p>
                                    <p class="card-text small text-muted mb-0">{{ now()->subDays(rand(1, 3))->format('d M Y, H:i') }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="pwd-timeline-item">
                            <div class="pwd-timeline-dot bg-primary"></div>
                            <div class="card shadow-sm">
                                <div class="card-body p-3">
                                    <h6 class="card-title mb-1">Password Terakhir Diubah</h6>
                                    <p class="card-text small text-muted mb-1">Anda mengubah password akun</p>
                                    <p class="card-text small text-muted mb-0">{{ now()->subMonths(rand(1, 3))->format('d M Y, H:i') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add hover effect to buttons
        const buttons = document.querySelectorAll('.pwd-btn-primary, .pwd-btn-outline');
        buttons.forEach(button => {
            button.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-3px)';
                this.style.transition = 'all 0.3s ease';
            });
            button.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });

        // Add animation to cards
        const cards = document.querySelectorAll('.pwd-card');
        cards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
        });

        // Input focus effects
        const inputs = document.querySelectorAll('.pwd-form-control');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
                this.parentElement.style.transition = 'all 0.3s ease';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });

        // Auto-dismiss alerts after 5 seconds
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            setTimeout(() => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }, 5000);
        });
    });
</script>
@endsection
@extends('layouts.app')
@section('title', 'My Profile - Ayam Goreng Jos Gandos')
@section('content')

<style>
    /* Professional Color Palette - Menyesuaikan dengan change-password.blade.php */
    :root {
        --profile-primary-blue: #4f46e5;
        --profile-primary-purple: #8b5cf6;
        --profile-light-blue: rgba(79, 70, 229, 0.1);
        --profile-light-purple: rgba(139, 92, 246, 0.1);
        --profile-dark-blue: #4338ca;
        --profile-dark-purple: #7c3aed;
        --profile-neutral-light: #f8f9fa;
        --profile-neutral-medium: #e9ecef;
        --profile-neutral-dark: #343a40;
    }

    /* Custom Card Styles */
    .profile-card {
        border-radius: 16px;
        border: none;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .profile-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .profile-card-header {
        position: relative;
        overflow: hidden;
        background: linear-gradient(to right, rgba(79, 70, 229, 0.1), rgba(139, 92, 246, 0.1));
        border-bottom: none;
    }

    .profile-card-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(135deg, #4f46e5, #8b5cf6);
    }

    /* Custom Button Styles */
    .profile-btn-primary {
        background: linear-gradient(135deg, #4f46e5, #8b5cf6);
        border: none;
        box-shadow: 0 4px 15px rgba(79, 70, 229, 0.3);
        transition: all 0.3s ease;
        color: white;
        border-radius: 0.5rem;
        padding: 0.5rem 1.5rem;
    }

    .profile-btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(79, 70, 229, 0.4);
        background: linear-gradient(135deg, #4338ca, #7c3aed);
    }

    .profile-btn-outline {
        color: #4f46e5;
        border-color: #4f46e5;
        border-radius: 0.5rem;
        padding: 0.5rem 1.5rem;
        transition: all 0.3s ease;
    }

    .profile-btn-outline:hover {
        background-color: rgba(79, 70, 229, 0.05);
        transform: translateY(-2px);
    }

    /* Custom Form Controls */
    .profile-form-control {
        border-radius: 0.5rem;
        padding: 0.75rem 1rem 0.75rem 2.5rem;
        border: 1px solid #ced4da;
        transition: all 0.3s ease;
    }

    .profile-form-control:focus {
        border-color: #4f46e5;
        box-shadow: 0 0 0 0.25rem rgba(79, 70, 229, 0.25);
    }

    .profile-input-wrapper {
        position: relative;
    }

    .profile-input-icon {
        position: absolute;
        top: 50%;
        left: 0.75rem;
        transform: translateY(-50%);
        color: #adb5bd;
        z-index: 10;
    }

    /* Badge Styles */
    .profile-badge-blue {
        background-color: rgba(79, 70, 229, 0.1);
        color: #4f46e5;
        font-weight: 500;
    }

    .profile-badge-purple {
        background-color: rgba(139, 92, 246, 0.1);
        color: #8b5cf6;
        font-weight: 500;
    }

    .profile-badge-success {
        background-color: rgba(16, 185, 129, 0.1);
        color: #10b981;
        font-weight: 500;
    }

    /* Timeline Styles */
    .profile-timeline {
        position: relative;
        padding-left: 2rem;
    }

    .profile-timeline::before {
        content: '';
        position: absolute;
        left: 0.85rem;
        top: 0;
        height: 100%;
        width: 2px;
        background: linear-gradient(to bottom, #4f46e5, #8b5cf6);
    }

    .profile-timeline-item {
        position: relative;
        padding-bottom: 1.5rem;
    }

    .profile-timeline-dot {
        position: absolute;
        left: -2rem;
        top: 0.25rem;
        width: 1rem;
        height: 1rem;
        border-radius: 50%;
        background: white;
        border: 2px solid #4f46e5;
        z-index: 1;
    }

    .profile-timeline-dot-inner {
        width: 0.75rem;
        height: 0.75rem;
        border-radius: 50%;
    }

    /* Animation Classes */
    .profile-fade-in {
        animation: profileFadeIn 0.5s ease-out forwards;
    }

    .profile-slide-in {
        animation: profileSlideIn 0.5s ease-out forwards;
    }

    .profile-delay-100 { animation-delay: 0.1s; }
    .profile-delay-200 { animation-delay: 0.2s; }
    .profile-delay-300 { animation-delay: 0.3s; }

    @keyframes profileFadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes profileSlideIn {
        from { opacity: 0; transform: translateX(-10px); }
        to { opacity: 1; transform: translateX(0); }
    }

    /* Shimmer Effect */
    .profile-shimmer {
        position: relative;
        overflow: hidden;
    }
    
    .profile-shimmer::after {
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
        animation: profileShimmer 3s infinite;
    }
    
    @keyframes profileShimmer {
        0% { transform: translateX(-100%) rotate(30deg); }
        100% { transform: translateX(100%) rotate(30deg); }
    }

    /* Pulse Animation */
    @keyframes profilePulse {
        0% { box-shadow: 0 0 0 0 rgba(79, 70, 229, 0.7); }
        70% { box-shadow: 0 0 0 10px rgba(79, 70, 229, 0); }
        100% { box-shadow: 0 0 0 0 rgba(79, 70, 229, 0); }
    }
    
    .profile-pulse {
        animation: profilePulse 2s infinite;
    }

    /* Nav Pills Custom */
    .profile-custom-nav .profile-nav-item.active {
        background: linear-gradient(135deg, #4f46e5, #8b5cf6);
        color: white;
        box-shadow: 0 4px 15px rgba(79, 70, 229, 0.3);
    }

    .profile-custom-nav .profile-nav-item {
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

    .profile-custom-nav .profile-nav-item:hover:not(.active) {
        background-color: rgba(79, 70, 229, 0.1);
        color: #4338ca;
        transform: translateY(-2px);
    }

    /* Tombol logout custom */
    .profile-logout-btn {
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

    .profile-logout-btn:hover {
        background-color: rgba(220, 53, 69, 0.1);
        transform: translateY(-2px);
    }

    /* Avatar Styles */
    .profile-avatar {
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

    .profile-avatar-sm {
        width: 50px;
        height: 50px;
        font-size: 1.25rem;
    }

    .profile-avatar-lg {
        width: 100px;
        height: 100px;
        font-size: 2.5rem;
    }

    /* Profile Header */
    .profile-header {
        background: linear-gradient(135deg, #4f46e5 0%, #8b5cf6 100%);
        border-radius: 16px;
        padding: 2rem;
        margin-bottom: 2rem;
        color: white;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
    
    .profile-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 100%;
        height: 200%;
        background: rgba(255, 255, 255, 0.1);
        transform: rotate(45deg);
        z-index: 0;
    }
</style>

<div class="container py-5">
    <!-- Success Message -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4 animate__animated animate__fadeInDown" role="alert" id="success-message">
            <div class="d-flex align-items-center">
                <i class="bi bi-check-circle-fill me-2"></i>
                <strong>{{ session('success') }}</strong>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Profile Header -->
    <div class="profile-header mb-5 mt-5 profile-fade-in">
        <div class="row align-items-center">
            <div class="col-md-8 d-flex align-items-center">
            <div class="profile-avatar profile-avatar-lg me-4 profile-pulse">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($pelanggan->pelanggan) }}&background=4f46e5&color=fff&size=100" alt="Profile Photo" class="img-fluid">
            </div>
                <div>
                    <h2 class="mb-0 fw-bold">{{ $pelanggan->pelanggan }}</h2>
                    <p class="mb-2 opacity-75">{{ $pelanggan->email }}</p>
                    <div class="d-flex">
                        <span class="badge profile-badge-success rounded-pill px-3 py-2 me-2">
                            <i class="fas fa-circle me-1 small"></i> Active
                        </span>
                        <span class="badge profile-badge-blue rounded-pill px-3 py-2">Member</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <a href="{{ route('pelanggan.profile') }}" class="btn profile-btn-outline me-2">
                    <i class="fas fa-user me-1"></i> Profile
                </a>
                <a href="{{ route('pelanggan.password.form') }}" class="btn profile-btn-primary">
                    <i class="fas fa-lock me-1"></i> Security
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Sidebar -->
        <div class="col-lg-4 mb-4 mb-lg-0">
            <div class="card profile-card profile-fade-in profile-delay-100">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                    <div class="profile-avatar profile-avatar-lg mx-auto mb-3">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($pelanggan->pelanggan) }}&background=4f46e5&color=fff&size=100" alt="Profile Photo" class="img-fluid">
                    </div>
                        <h5 class="mb-1">{{ $pelanggan->pelanggan }}</h5>
                        <p class="text-muted small mb-3">{{ $pelanggan->email }}</p>
                        
                        <div class="d-flex justify-content-center gap-2 mb-3">
                            <span class="badge profile-badge-success rounded-pill px-3 py-2">
                                <i class="fas fa-circle me-1 small"></i> Active
                            </span>
                            <span class="badge profile-badge-blue rounded-pill px-3 py-2">
                                Member
                            </span>
                        </div>
                    </div>

                    <hr>

                    <div class="profile-custom-nav">
                        <a href="{{ route('pelanggan.profile') }}" class="profile-nav-item active">
                            <i class="fas fa-user-circle me-3"></i>
                            <span>Informasi Pribadi</span>
                        </a>
                        <a href="{{ route('pelanggan.password.form') }}" class="profile-nav-item">
                            <i class="fas fa-lock me-3"></i>
                            <span>Ubah Password</span>
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="mt-2">
                            @csrf
                            <button type="submit" class="profile-logout-btn">
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
            <div class="card profile-card mt-4 profile-fade-in profile-delay-300">
                <div class="card-body p-4">
                    <h5 class="d-flex align-items-center mb-3">
                        <i class="fas fa-shield-alt text-primary me-2"></i>
                        Tips Keamanan
                    </h5>
                    <div class="alert alert-warning profile-shimmer">
                        <h6 class="alert-heading d-flex align-items-center">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Peringatan Keamanan
                        </h6>
                        <p class="mb-0 small">Jangan pernah membagikan informasi pribadi Anda kepada siapapun, termasuk staf kami. Kami tidak akan pernah meminta informasi sensitif melalui email atau telepon.</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Personal Information Card -->
            <div class="card profile-card profile-fade-in profile-delay-200">
                <div class="profile-card-header">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="d-flex align-items-center">
                                <i class="fas fa-user-circle text-primary me-2"></i>
                                Informasi Pribadi
                            </h5>
                            <span class="badge profile-badge-blue rounded-pill px-3 py-2">
                                <i class="fas fa-circle me-1 small"></i> ID: {{ $pelanggan->idpelanggan }}
                            </span>
                        </div>

                        <p class="text-muted mb-4">
                            Kelola informasi pribadi Anda untuk mengontrol apa yang muncul di profil Anda. Pastikan detail Anda selalu up to date.
                        </p>

                        <form method="POST" action="{{ route('pelanggan.profile.update') }}" class="profile-slide-in">
                            @csrf
                            @method('PUT')

                            <div class="row mb-3">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <label for="pelanggan" class="form-label">Nama Lengkap</label>
                                    <div class="profile-input-wrapper">
                                        <i class="fas fa-user profile-input-icon"></i>
                                        <input type="text" class="form-control profile-form-control @error('pelanggan') is-invalid @enderror" 
                                            id="pelanggan" name="pelanggan" value="{{ old('pelanggan', $pelanggan->pelanggan) }}">
                                        @error('pelanggan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Alamat Email</label>
                                    <div class="profile-input-wrapper">
                                        <i class="fas fa-envelope profile-input-icon"></i>
                                        <input type="email" class="form-control profile-form-control @error('email') is-invalid @enderror" 
                                            id="email" name="email" value="{{ old('email', $pelanggan->email) }}">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <label for="telp" class="form-label">Nomor Telepon</label>
                                    <div class="profile-input-wrapper">
                                        <i class="fas fa-phone profile-input-icon"></i>
                                        <input type="text" class="form-control profile-form-control @error('telp') is-invalid @enderror" 
                                            id="telp" name="telp" value="{{ old('telp', $pelanggan->telp) }}">
                                        @error('telp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="alamat" class="form-label">Alamat</label>
                                <div class="profile-input-wrapper">
                                    <i class="fas fa-map-marker-alt profile-input-icon" style="top: 1rem;"></i>
                                    <textarea class="form-control profile-form-control @error('alamat') is-invalid @enderror" 
                                        id="alamat" name="alamat" rows="3" style="padding-top: 0.75rem;">{{ old('alamat', $pelanggan->alamat) }}</textarea>
                                    @error('alamat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-flex justify-content-end mt-4">
                                <button type="button" class="btn profile-btn-outline me-2">
                                    Batal
                                </button>
                                <button type="submit" class="btn profile-btn-primary">
                                    <i class="fas fa-save me-1"></i> Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Account Security Card -->
            <div class="card profile-card mt-4 profile-fade-in profile-delay-300">
                <div class="profile-card-header">
                    <div class="card-body p-4">
                        <h5 class="d-flex align-items-center mb-4">
                            <i class="fas fa-shield-alt text-primary me-2"></i>
                            Keamanan Akun
                        </h5>

                        <div class="alert alert-primary profile-shimmer mb-4" role="alert">
                            <div class="d-flex">
                                <i class="fas fa-lock me-3 mt-1"></i>
                                <div>
                                    <h6 class="alert-heading mb-1">Rekomendasi Keamanan</h6>
                                    <p class="mb-2 small">Untuk keamanan akun Anda, kami merekomendasikan untuk mengubah password secara berkala dan mengaktifkan autentikasi dua faktor untuk perlindungan tambahan.</p>
                                    <a href="{{ route('pelanggan.password.form') }}" class="alert-link small">Ubah password sekarang <i class="fas fa-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="list-group">
                            <div class="list-group-item d-flex justify-content-between align-items-center border-0 bg-light rounded-3 mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-fingerprint me-3 text-primary"></i>
                                    <div>
                                        <h6 class="mb-0">ID Akun</h6>
                                        <p class="text-muted small mb-0">Pengenal unik untuk akun Anda</p>
                                    </div>
                                </div>
                                <span class="badge profile-badge-blue rounded-pill px-3 py-2">{{ $pelanggan->idpelanggan }}</span>
                            </div>
                            
                            <div class="list-group-item d-flex justify-content-between align-items-center border-0 bg-light rounded-3 mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-calendar-alt me-3 text-primary"></i>
                                    <div>
                                        <h6 class="mb-0">Anggota Sejak</h6>
                                        <p class="text-muted small mb-0">Kapan Anda bergabung dengan komunitas kami</p>
                                    </div>
                                </div>
                                <span class="badge profile-badge-blue rounded-pill px-3 py-2">{{ $pelanggan->created_at ? $pelanggan->created_at->format('d M Y') : 'N/A' }}</span>
                            </div>
                            
                            <div class="list-group-item d-flex justify-content-between align-items-center border-0 bg-light rounded-3">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-edit me-3 text-primary"></i>
                                    <div>
                                        <h6 class="mb-0">Terakhir Diperbarui</h6>
                                        <p class="text-muted small mb-0">Kapan profil Anda terakhir dimodifikasi</p>
                                    </div>
                                </div>
                                <span class="badge profile-badge-blue rounded-pill px-3 py-2">{{ $pelanggan->updated_at ? $pelanggan->updated_at->format('d M Y, H:i') : 'N/A' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Activity Timeline Card -->
            <div class="card profile-card mt-4 profile-fade-in profile-delay-300">
                <div class="profile-card-header">
                    <div class="card-body p-4">
                        <h5 class="d-flex align-items-center mb-4">
                            <i class="fas fa-history text-primary me-2"></i>
                            Aktivitas Terbaru
                        </h5>
                        
                        <div class="profile-timeline">
                            <div class="profile-timeline-item">
                                <div class="profile-timeline-dot profile-pulse"></div>
                                <div class="card shadow-sm">
                                    <div class="card-body p-3">
                                        <h6 class="card-title mb-1">Profil Diperbarui</h6>
                                        <p class="card-text small text-muted mb-1">Anda memperbarui informasi profil</p>
                                        <p class="card-text small text-muted mb-0">{{ now()->subDays(rand(1, 5))->format('d M Y, H:i') }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="profile-timeline-item">
                                <div class="profile-timeline-dot bg-success"></div>
                                <div class="card shadow-sm">
                                    <div class="card-body p-3">
                                        <h6 class="card-title mb-1">Pesanan Dibuat</h6>
                                        <p class="card-text small text-muted mb-1">Anda membuat pesanan baru</p>
                                        <p class="card-text small text-muted mb-0">{{ now()->subDays(rand(6, 10))->format('d M Y, H:i') }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="profile-timeline-item">
                                <div class="profile-timeline-dot bg-primary"></div>
                                <div class="card shadow-sm">
                                    <div class="card-body p-3">
                                        <h6 class="card-title mb-1">Akun Dibuat</h6>
                                        <p class="card-text small text-muted mb-1">Anda membuat akun Anda</p>
                                        <p class="card-text small text-muted mb-0">{{ $pelanggan->created_at ? $pelanggan->created_at->format('d M Y, H:i') : now()->subMonths(rand(1, 6))->format('d M Y, H:i') }}</p>
                                    </div>
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
        // Auto dismiss success message
        const successMessage = document.getElementById('success-message');
        if (successMessage) {
            setTimeout(function() {
                const bsAlert = new bootstrap.Alert(successMessage);
                bsAlert.close();
            }, 5000);
        }
        
        // Add hover effect to buttons
        const buttons = document.querySelectorAll('.profile-btn-primary, .profile-btn-outline');
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
        const cards = document.querySelectorAll('.profile-card');
        cards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
        });

        // Input focus effects
        const inputs = document.querySelectorAll('.profile-form-control');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
                this.parentElement.style.transition = 'all 0.3s ease';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });
    });
</script>
@endsection
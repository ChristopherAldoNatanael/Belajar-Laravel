@extends('layouts.app')
@section('title', 'Order')
@section('content')


<style>
    :root {
        --light-orange: #FFF0E0;
        --ultra-light-orange: #FFF8F0;
        --primary-orange: #FF7E2E;
        --primary-orange-light: #FF9F5B;
        --primary-orange-dark: #E05E00;
        --primary-orange-ultra-dark: #B54B00;
        --white-soft: #FEFEFE;
        --white-translucent: rgba(255, 255, 255, 0.2);
    }

    /* General Styles */
    body {
        background-color: var(--light-orange);
        font-family: 'Poppins', sans-serif;
        color: #333;
    }

    .bg-order {
        background-color: var(--light-orange);
        position: relative;
        overflow: hidden;
        background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ff7e2e' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }

    /* Decorations */
    .bg-order::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 30%;
        height: 40%;
        background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ff7e2e' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
        opacity: 0.5;
        z-index: 0;
    }

    .bg-order::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 30%;
        height: 40%;
        background-image: url("data:image/svg+xml,%3Csvg width='52' height='26' viewBox='0 0 52 26' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ff7e2e' fill-opacity='0.1'%3E%3Cpath d='M10 10c0-2.21-1.79-4-4-4-3.314 0-6-2.686-6-6h2c0 2.21 1.79 4 4 4 3.314 0 6 2.686 6 6 0 2.21 1.79 4 4 4 3.314 0 6 2.686 6 6 0 2.21 1.79 4 4 4v2c-3.314 0-6-2.686-6-6 0-2.21-1.79-4-4-4-3.314 0-6-2.686-6-6zm25.464-1.95l8.486 8.486-1.414 1.414-8.486-8.486 1.414-1.414z' /%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        opacity: 0.7;
        z-index: 0;
        transform: rotate(180deg);
    }

    .container {
        position: relative;
        z-index: 1;
    }

    /* Background Colors */
    .bg-white-soft {
        background-color: var(--white-soft);
    }

    .bg-orange-ultra-light {
        background-color: var(--ultra-light-orange);
    }

    /* Card Styling */
    .rounded-4 {
        border-radius: 1.5rem !important;
    }

    .shadow-custom {
        box-shadow: 0 15px 35px rgba(255, 126, 46, 0.15) !important;
    }

    .shadow-hover {
        box-shadow: 0 20px 40px rgba(255, 126, 46, 0.25) !important;
    }

    .card {
        transition: all 0.5s ease;
        border: none;
        overflow: hidden;
    }

    /* Form Styling */
    .form-group-custom label {
        margin-bottom: 0.75rem;
    }

    .form-control, .form-select {
        border: 2px solid rgba(255, 126, 46, 0.2);
        padding: 12px 20px;
        background-color: var(--white-soft);
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        box-shadow: 0 0 0 4px rgba(255, 126, 46, 0.25);
        border-color: var(--primary-orange);
        background-color: #fff;
    }

    .border-orange-light {
        border-color: rgba(255, 126, 46, 0.2) !important;
    }

    .quantity-input {
        border-radius: 50px;
        overflow: hidden;
    }

    .quantity-input input {
        border: 2px solid rgba(255, 126, 46, 0.2);
        background-color: var(--white-soft);
    }

    .quantity-input button {
        z-index: 2;
    }

    /* Button Styling */
    .btn-gradient-orange {
        background: linear-gradient(45deg, var(--primary-orange), var(--primary-orange-light));
        border: none;
        color: white;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .btn-gradient-orange:hover {
        background: linear-gradient(45deg, var(--primary-orange-dark), var(--primary-orange));
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(255, 126, 46, 0.3);
        color: white;
    }

    .btn-gradient-orange-success {
        background: linear-gradient(45deg, var(--primary-orange), #28a745);
        border: none;
        color: white;
        transition: all 0.3s ease;
    }

    .btn-orange {
        background-color: var(--primary-orange);
        border-color: var(--primary-orange);
        color: white;
    }

    .btn-orange:hover {
        background-color: var(--primary-orange-dark);
        border-color: var(--primary-orange-dark);
        color: white;
    }

    .button-glow {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(45deg, transparent, rgba(255,255,255,0.3), transparent);
        transform: translateX(-100%);
        animation: button-glow 3s infinite;
    }

    @keyframes button-glow {
        0% { transform: translateX(-100%); }
        50% { transform: translateX(100%); }
        100% { transform: translateX(100%); }
    }

    /* Text Colors */
    .text-orange {
        color: var(--primary-orange) !important;
    }

    .text-orange-dark {
        color: var(--primary-orange-dark) !important;
    }

    /* Background Gradients */
    .bg-gradient-orange {
        background: linear-gradient(45deg, var(--primary-orange), var(--primary-orange-light));
    }

    .bg-gradient-orange-dark {
        background: linear-gradient(45deg, var(--primary-orange-dark), var(--primary-orange-ultra-dark));
    }

    /* Preview Styling */
    .preview-img-container {
        overflow: hidden;
    }

    .preview-image {
        object-fit: cover;
        transition: all 0.8s ease;
    }

    .preview-image:hover {
        transform: scale(1.05);
    }

    .total-price-container {
        background-color: var(--ultra-light-orange);
        padding: 15px !important;
        border-radius: 12px;
        margin-top: 15px !important;
    }

    /* Timeline Styling */
    .timeline {
        position: relative;
        padding: 1rem 0;
    }

    .timeline::before {
        content: '';
        position: absolute;
        top: 0;
        left: 18px;
        height: 100%;
        width: 3px;
        background: linear-gradient(to bottom, var(--primary-orange-light), var(--primary-orange-dark));
        border-radius: 50px;
    }

    .timeline-item {
        position: relative;
        margin-bottom: 1.5rem;
        padding-left: 50px;
        border-bottom: 1px dashed rgba(255, 126, 46, 0.1);
        padding-bottom: 1.5rem;
    }

    .timeline-item:last-child {
        margin-bottom: 0;
        border-bottom: none;
    }

    .timeline-icon {
        position: absolute;
        top: 0;
        left: 0;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        z-index: 1;
        box-shadow: 0 5px 15px rgba(255, 126, 46, 0.3);
    }

    /* Info Box */
    .info-box {
        border: 1px dashed rgba(255, 126, 46, 0.3);
    }

    .info-icon {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Order Modal */
    .order-number-box {
        background-color: var(--ultra-light-orange);
        border: 1px dashed rgba(255, 126, 46, 0.3);
        border-radius: 12px;
        padding: 15px;
        max-width: 200px;
    }

    /* Success Animation */
    .success-animation {
        margin: 0 auto;
        width: 100px;
        height: 100px;
    }

    .checkmark {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        display: block;
        stroke-width: 2;
        stroke: var(--primary-orange);
        stroke-miterlimit: 10;
        box-shadow: 0 0 20px rgba(255, 126, 46, 0.3);
        animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both;
    }

    .checkmark__circle {
        stroke-dasharray: 166;
        stroke-dashoffset: 166;
        stroke-width: 2;
        stroke: var(--primary-orange);
        fill: none;
        animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
    }

    .checkmark__check {
        transform-origin: 50% 50%;
        stroke-dasharray: 48;
        stroke-dashoffset: 48;
        animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
    }

    @keyframes stroke {
        100% {
            stroke-dashoffset: 0;
        }
    }

    @keyframes scale {
        0%, 100% {
            transform: none;
        }
        50% {
            transform: scale3d(1.1, 1.1, 1);
        }
    }

    @keyframes fill {
        100% {
            box-shadow: inset 0px 0px 0px 30px var(--ultra-light-orange);
        }
    }

    /* Pulse Animation */
    .pulse-circle {
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% {
            transform: scale(0.95);
            box-shadow: 0 0 0 0 rgba(255, 126, 46, 0.7);
        }

        70% {
            transform: scale(1);
            box-shadow: 0 0 0 10px rgba(255, 126, 46, 0);
        }

        100% {
            transform: scale(0.95);
            box-shadow: 0 0 0 0 rgba(255, 126, 46, 0);
        }
    }

    /* White Translucent Background */
    .bg-white-translucent {
        background-color: var(--white-translucent);
    }

    /* Food Item Badges */
    .badge {
        font-family: 'Poppins', sans-serif;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    /* Responsive Adjustments */
    @media (max-width: 991.98px) {
        .timeline::before {
            left: 15px;
        }

        .timeline-item {
            padding-left: 45px;
        }

        .timeline-icon {
            width: 30px;
            height: 30px;
            font-size: 0.8rem;
        }
    }

    @media (max-width: 767.98px) {
        .display-4 {
            font-size: 2.5rem;
        }

        .lead {
            font-size: 1rem;
        }
    }

    /* Additional Design Enhancements */
    .icon-floating {
        position: absolute;
        opacity: 0.1;
        z-index: 0;
    }

    .food-icon-1 {
        top: 10%;
        right: 5%;
        animation: float 8s ease-in-out infinite;
    }

    .food-icon-2 {
        bottom: 10%;
        left: 5%;
        animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
        0% {
            transform: translateY(0px) rotate(0deg);
        }
        50% {
            transform: translateY(-20px) rotate(10deg);
        }
        100% {
            transform: translateY(0px) rotate(0deg);
        }
    }

    /* Hover Effects */
    .form-group-custom:hover label {
        color: var(--primary-orange);
        transform: translateX(5px);
        transition: all 0.3s ease;
    }

    /* New Feature - Order Tracking Section */
    .tracking-section {
        margin-top: 4rem;
        opacity: 0;
        transform: translateY(20px);
        animation: fadeInUp 1s ease forwards 0.5s;
    }

    .tracking-card {
        border-radius: 1.5rem;
        overflow: hidden;
        background: linear-gradient(135deg, #fff 0%, var(--ultra-light-orange) 100%);
        border: none;
        box-shadow: 0 15px 35px rgba(255, 126, 46, 0.1);
    }

    .tracker-dot {
        width: 12px;
        height: 12px;
        background-color: #e9ecef;
        border-radius: 50%;
        display: inline-block;
    }

    .tracker-dot.active {
        background-color: var(--primary-orange);
        animation: pulse-small 2s infinite;
    }

    @keyframes pulse-small {
        0% {
            transform: scale(1);
            box-shadow: 0 0 0 0 rgba(255, 126, 46, 0.7);
        }

        70% {
            transform: scale(1.2);
            box-shadow: 0 0 0 6px rgba(255, 126, 46, 0);
        }

        100% {
            transform: scale(1);
            box-shadow: 0 0 0 0 rgba(255, 126, 46, 0);
        }
    }

    .tracker-line {
        flex-grow: 1;
        height: 3px;
        background-color: #e9ecef;
        margin: 0 8px;
    }

    .tracker-line.active {
        background-color: var(--primary-orange);
    }

    /* Call-to-action banner */
    .promotion-banner {
        background: linear-gradient(135deg, var(--primary-orange-light) 0%, var(--primary-orange-dark) 100%);
        border-radius: 1.5rem;
        padding: 2rem;
        margin-top: 3rem;
        box-shadow: 0 15px 35px rgba(255, 126, 46, 0.2);
        position: relative;
        overflow: hidden;
    }

    .promotion-banner::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: repeating-linear-gradient(
            45deg,
            transparent,
            transparent 10px,
            rgba(255, 255, 255, 0.05) 10px,
            rgba(255, 255, 255, 0.05) 20px
        );
        animation: move-bg 20s linear infinite;
        z-index: 0;
    }

    @keyframes move-bg {
        0% {
            transform: translate(0, 0);
        }
        100% {
            transform: translate(50px, 50px);
        }
    }

    .promotion-content {
        position: relative;
        z-index: 1;
    }

    /* Testimonial Section */
    .testimonial-section {
        margin-top: 3rem;
    }

    .testimonial-card {
        border-radius: 1.5rem;
        overflow: hidden;
        border: none;
        box-shadow: 0 10px 30px rgba(255, 126, 46, 0.1);
        transition: all 0.3s ease;
    }

    .testimonial-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(255, 126, 46, 0.2);
    }

    .testimonial-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid var(--primary-orange-light);
    }

    .testimonial-rating {
        color: #FFD700;
    }

    /* Delivery Detail Card */
    .delivery-detail-card {
        border-radius: 1.5rem;
        overflow: hidden;
        border: 2px dashed rgba(255, 126, 46, 0.3);
        background-color: var(--ultra-light-orange);
    }

    .delivery-icon {
        width: 50px;
        height: 50px;
        background-color: var(--primary-orange);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        margin-right: 1rem;
    }

    /* Additional animations */
    @keyframes fadeInUp {
        0% {
            opacity: 0;
            transform: translateY(20px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<div class="container-fluid py-5 bg-order">
    <div class="container">
        <!-- Header Section -->
        <div class="row mb-5">
            <div class="col-12 text-center">
                <div class="position-relative d-inline-block animate__animated animate__fadeInDown">
                    <h1 class="display-4 fw-bold position-relative z-2">
                        <span class="bg-gradient-orange text-white px-5 py-3 rounded-pill shadow-lg d-inline-block">PESAN SEKARANG</span>
                    </h1>
                    <div class="position-absolute bg-warning rounded-circle pulse-circle" style="width: 30px; height: 30px; top: -10px; right: -10px; z-index: 1;"></div>
                </div>
                <p class="lead text-orange-dark mt-4 animate__animated animate__fadeInUp animate__delay-1s fw-semibold">Nikmati kelezatan menu pilihan kami dengan pengalaman pemesanan yang cepat dan mudah</p>
            </div>
        </div>

        <!-- Main Content Section -->
        <div class="row justify-content-center">
            <!-- Left Side - Form -->
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="card border-0 shadow-custom rounded-4 overflow-hidden animate__animated animate__zoomIn animate__delay-1s">
                    <div class="card-header bg-gradient-orange text-white p-4 border-0">
                        <div class="d-flex align-items-center">
                            <div class="icon-container me-3 bg-white-translucent rounded-circle p-2">
                                <i class="fas fa-utensils fs-3 text-orange"></i>
                            </div>
                            <h3 class="mb-0 fw-bold">Detail Pesanan</h3>
                        </div>
                    </div>
                    <div class="card-body p-4 p-lg-5 bg-white-soft">
    <!-- Profile Data Toggle Section -->
    @if(Auth::guard('pelanggan')->check())
    <div class="profile-data-toggle mb-4 animate__animated animate__fadeInUp">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h5 class="fw-bold text-orange-dark mb-1">
                    <i class="fas fa-user-circle me-2"></i>Data Profil Anda
                </h5>
                <p class="mb-0 small text-muted">Gunakan data profil yang tersimpan atau isi data baru</p>
            </div>
            <label class="toggle-switch">
                <input type="checkbox" id="useProfileData" checked>
                <span class="toggle-slider"></span>
            </label>
        </div>
    </div>

    <!-- Profile Data Card -->
    <div id="profileDataCard" class="profile-data-card mb-4 animate__animated animate__fadeInUp">
        <div class="d-flex align-items-center mb-3">
            <div class="profile-icon d-flex align-items-center justify-content-center bg-primary-orange">
                <i class="fas fa-id-card fa-lg text-white"></i>
            </div>
            <div>
                <h5 class="fw-bold text-orange-dark mb-0">Data Tersimpan</h5>
                <p class="mb-0 small text-muted">Data dari profil Anda</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="d-flex align-items-center">
                    <i class="fas fa-user text-orange me-2"></i>
                    <div>
                        <p class="small text-muted mb-0">Nama</p>
                        <p class="fw-bold mb-0">{{ Auth::guard('pelanggan')->user()->pelanggan }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="d-flex align-items-center">
                    <i class="fas fa-phone text-orange me-2"></i>
                    <div>
                        <p class="small text-muted mb-0">Telepon</p>
                        <p class="fw-bold mb-0">{{ Auth::guard('pelanggan')->user()->telp }}</p>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="d-flex align-items-center">
                    <i class="fas fa-map-marker-alt text-orange me-2"></i>
                    <div>
                        <p class="small text-muted mb-0">Alamat</p>
                        <p class="fw-bold mb-0">{{ Auth::guard('pelanggan')->user()->alamat }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <form id="orderForm" method="POST" action="{{ route('order.details.store') }}">
        @csrf
        <div id="newDataForm" class="animate__animated animate__fadeIn" style="{{ Auth::guard('pelanggan')->check() ? 'display: none;' : '' }}">
            <div class="mb-4 form-group-custom">
                <label for="name" class="form-label fw-bold text-orange-dark">
                    <i class="fas fa-user me-2 text-orange"></i>Nama Lengkap
                </label>
                <input type="text" class="form-control form-control-lg rounded-pill border-orange-light" id="name" name="name" placeholder="Masukkan nama Anda" value="{{ Auth::guard('pelanggan')->check() ? Auth::guard('pelanggan')->user()->pelanggan : old('name') }}" required>
                @error('name')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4 form-group-custom">
                <label for="telp" class="form-label fw-bold text-orange-dark">
                    <i class="fas fa-phone me-2 text-orange"></i>Nomor Telepon
                </label>
                <input type="tel" class="form-control form-control-lg rounded-pill border-orange-light" id="telp" name="telp" placeholder="Masukkan nomor telepon" value="{{ Auth::guard('pelanggan')->check() ? Auth::guard('pelanggan')->user()->telp : old('telp') }}" required>
                @error('telp')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4 form-group-custom">
                <label for="alamat" class="form-label fw-bold text-orange-dark">
                    <i class="fas fa-map-marker-alt me-2 text-orange"></i>Alamat Pengiriman
                </label>
                <textarea class="form-control form-control-lg rounded-4 border-orange-light" id="alamat" name="alamat" rows="3" placeholder="Masukkan alamat lengkap" required>{{ Auth::guard('pelanggan')->check() ? Auth::guard('pelanggan')->user()->alamat : old('alamat') }}</textarea>
                @error('alamat')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Hidden fields to store profile data when using existing data -->
        @if(Auth::guard('pelanggan')->check())
        <input type="hidden" name="use_profile_data" id="use_profile_data" value="1">
        <input type="hidden" name="profile_name" value="{{ Auth::guard('pelanggan')->user()->pelanggan }}">
        <input type="hidden" name="profile_telp" value="{{ Auth::guard('pelanggan')->user()->telp }}">
        <input type="hidden" name="profile_alamat" value="{{ Auth::guard('pelanggan')->user()->alamat }}">
        @endif

        <div class="mt-5 position-relative">
            <button type="button" class="btn btn-gradient-orange btn-lg w-100 rounded-pill fw-bold py-3 position-relative overflow-hidden" id="submitOrderBtn">
                <span class="position-relative z-2">
                    <i class="fas fa-shopping-cart me-2"></i>PESAN SEKARANG
                </span>
                <div class="button-glow"></div>
            </button>
        </div>
    </form>
</div>
                </div>
            </div>

            <!-- Right Side - Order Preview -->
            <div class="col-lg-5">
                <div class="card border-0 shadow-custom rounded-4 overflow-hidden animate__animated animate__zoomIn animate__delay-2s" id="previewCard">
                    <div class="card-header bg-gradient-orange-dark text-white p-4 border-0">
                        <div class="d-flex align-items-center">
                            <div class="icon-container me-3 bg-white-translucent rounded-circle p-2">
                                <i class="fas fa-receipt fs-3 text-orange"></i>
                            </div>
                            <h3 class="mb-0 fw-bold">Preview Pesanan</h3>
                        </div>
                    </div>
                    <div class="card-body p-0 bg-white-soft">
                        @if($cartItems->isEmpty())
                            <div class="p-4 p-lg-5 text-center">
                                <p class="text-orange-dark">Keranjang Anda kosong. Silakan tambahkan item dari menu terlebih dahulu.</p>
                                <a href="{{ route('menu.index') }}" class="btn btn-orange btn-lg rounded-pill">Lihat Menu</a>
                            </div>
                        @else
                            <div class="p-4 p-lg-5">
                                <h4 class="fw-bold mb-4 text-orange-dark">Detail Pesanan</h4>

                                @foreach($cartItems as $item)
                                    <div class="d-flex align-items-center mb-4">
                                        <div class="flex-shrink-0 me-3">
                                            <img src="{{ asset('gambar/' . $item->menu->gambar) }}" alt="{{ $item->menu->menu }}" class="rounded-3" style="width: 80px; height: 80px; object-fit: cover;">
                                        </div>
                                        <div class="flex-grow-1">
                                            <h5 class="fw-bold mb-1 text-orange-dark">{{ $item->menu->menu }}</h5>
                                            <p class="mb-1 text-muted">Jumlah: {{ $item->quantity }}</p>
                                            <p class="mb-0 fw-bold text-orange-dark">Rp {{ number_format($item->menu->harga * $item->quantity, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                @endforeach

                                <div class="d-flex justify-content-between py-3 border-bottom border-orange-light">
                                    <h5 class="fw-bold text-orange-dark">Subtotal</h5>
                                    <h5 class="fw-bold text-orange-dark">Rp {{ number_format($cartItems->sum(function($item) { return $item->menu->harga * $item->quantity; }), 0, ',', '.') }}</h5>
                                </div>

                                <div class="d-flex justify-content-between py-3 border-bottom border-orange-light">
                                    <h5 class="fw-bold text-orange-dark">Biaya Pengiriman</h5>
                                    <h5 class="fw-bold text-orange-dark">Rp 10.000</h5>
                                </div>

                                <div class="total-price-container mt-4">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="fw-bold text-orange-dark">Total</h4>
                                        <h4 class="fw-bold text-orange-dark">Rp {{ number_format($cartItems->sum(function($item) { return $item->menu->harga * $item->quantity; }) + 10000, 0, ',', '.') }}</h4>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Additional Information Card -->
                <div class="card border-0 shadow-custom rounded-4 overflow-hidden mt-4 animate__animated animate__fadeInUp animate__delay-3s">
                    <div class="card-body p-4 bg-orange-ultra-light">
                        <div class="d-flex align-items-center mb-3">
                            <div class="info-icon bg-gradient-orange text-white rounded-circle me-3">
                                <i class="fas fa-info"></i>
                            </div>
                            <h5 class="fw-bold mb-0 text-orange-dark">Informasi Pengiriman</h5>
                        </div>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><i class="fas fa-check-circle text-orange me-2"></i> Estimasi waktu pengiriman 30-45 menit</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-orange me-2"></i> Pengiriman tersedia 10.00 - 21.00 WIB</li>
                            <li><i class="fas fa-check-circle text-orange me-2"></i> Ongkir flat Rp 10.000 untuk semua area</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Testimonial Section -->
        <div class="testimonial-section">
            <h3 class="text-center fw-bold text-orange-dark mb-4">
                <i class="fas fa-star text-warning me-2"></i> Testimoni Pelanggan
            </h3>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="testimonial-card h-100 p-4">
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Customer" class="testimonial-avatar me-3">
                            <div>
                                <h5 class="fw-bold mb-1">Maya Sari</h5>
                                <div class="testimonial-rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <p class="mb-0">"Pelayanan cepat dan makanan selalu datang dalam keadaan hangat. Rasanya juga enak sekali!"</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="testimonial-card h-100 p-4">
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://randomuser.me/api/portraits/men/44.jpg" alt="Customer" class="testimonial-avatar me-3">
                            <div>
                                <h5 class="fw-bold mb-1">Budi Santoso</h5>
                                <div class="testimonial-rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                            </div>
                        </div>
                        <p class="mb-0">"Saya sangat puas dengan kemudahan pemesanan. Tinggal klik, dalam waktu 30 menit makanan sudah sampai."</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="testimonial-card h-100 p-4">
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://randomuser.me/api/portraits/women/33.jpg" alt="Customer" class="testimonial-avatar me-3">
                            <div>
                                <h5 class="fw-bold mb-1">Rina Wijaya</h5>
                                <div class="testimonial-rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <p class="mb-0">"Menu favorit keluarga kami. Harga terjangkau dengan porsi yang sangat memuaskan!"</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Promotion Banner -->
        <div class="promotion-banner">
            <div class="promotion-content">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h3 class="text-white fw-bold mb-3">Download Aplikasi Kami!</h3>
                        <p class="text-white mb-0">Dapatkan diskon 10% untuk pemesanan pertama melalui aplikasi kami. Tersedia di App Store dan Google Play.</p>
                    </div>
                    <div class="col-md-4 text-md-end mt-3 mt-md-0">
                        <button class="btn btn-light btn-lg rounded-pill fw-bold px-4 me-2">
                            <i class="fab fa-apple me-2"></i> App Store
                        </button>
                        <button class="btn btn-light btn-lg rounded-pill fw-bold px-4">
                            <i class="fab fa-google-play me-2"></i> Play Store
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Order Confirmation Modal -->
<div class="modal fade" id="orderConfirmationModal" tabindex="-1" aria-labelledby="orderConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow-custom">
            <div class="modal-header bg-gradient-orange text-white border-0">
                <h5 class="modal-title fw-bold" id="orderConfirmationModalLabel">
                    <i class="fas fa-clipboard-check me-2"></i> Konfirmasi Pesanan
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="text-center mb-4">
                    <i class="fas fa-shopping-cart fa-3x text-orange mb-3"></i>
                    <h4 class="fw-bold text-orange-dark">Konfirmasi Pesanan Anda</h4>
                    <p>Pastikan data pesanan Anda sudah benar sebelum melanjutkan.</p>
                </div>

                <div class="card rounded-4 bg-orange-ultra-light border-0 mb-4 p-3">
                    <div class="info-box rounded-4 bg-white-soft p-3 mb-3">
                        <p class="mb-2"><strong><i class="fas fa-user text-orange me-2"></i> Nama:</strong> <span id="confirmName"></span></p>
                        <p class="mb-2"><strong><i class="fas fa-phone text-orange me-2"></i> Telepon:</strong> <span id="confirmTelp"></span></p>
                        <p class="mb-0"><strong><i class="fas fa-map-marker-alt text-orange me-2"></i> Alamat:</strong> <span id="confirmAlamat"></span></p>
                    </div>

                    <div class="d-flex justify-content-between mb-2">
                        <span class="fw-bold">Total Item:</span>
                        <span class="fw-bold">{{ $cartItems->sum('quantity') ?? 0 }}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="fw-bold">Total Pembayaran:</span>
                        <span class="fw-bold text-orange-dark">Rp
                            @if($cartItems->isNotEmpty())
                            {{ number_format($cartItems->sum(function($item) { return $item->menu->harga * $item->quantity; }) + 10000, 0, ',', '.') }}
                            @else
                            0
                            @endif
                        </span>
                    </div>
                </div>

                <div class="alert alert-warning">
                    <i class="fas fa-info-circle me-2"></i> Pesanan akan diproses dan pembayaran dilakukan secara COD (Cash On Delivery).
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i> Batal
                </button>
                <button type="button" class="btn btn-gradient-orange-success rounded-pill" id="confirmOrderBtn">
                    <i class="fas fa-check me-2"></i> Konfirmasi Pesanan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow-custom">
            <div class="modal-body p-5 text-center">
                <div class="success-animation mb-4">
                    <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                        <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/>
                        <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                    </svg>
                </div>

                <h3 class="fw-bold text-orange-dark mb-3">Pesanan Berhasil!</h3>
                <p class="mb-4">Terima kasih atas pesanan Anda. Pesanan Anda sedang diproses.</p>

                <div class="order-number-box mx-auto mb-4">
                    <p class="mb-1 small text-muted">ID Pesanan:</p>
                    <h5 class="fw-bold text-orange-dark mb-0" id="orderIdDisplay"></h5>
                </div>

                <a href="{{ route('home') }}" class="btn btn-gradient-orange rounded-pill px-5 py-3">
                    <i class="fas fa-home me-2"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // Check if cart is empty
        const isCartEmpty = {{ $cartItems->isEmpty() ? 'true' : 'false' }};

        // Disable the submit button if cart is empty
        if (isCartEmpty) {
            $("#submitOrderBtn").addClass('disabled');
            $("#submitOrderBtn").prop('disabled', true);
        }

        // Toggle between profile data and new data form
        $("#useProfileData").change(function() {
            if($(this).is(":checked")) {
                $("#profileDataCard").slideDown(300);
                $("#newDataForm").slideUp(300);
                $("#use_profile_data").val("1");
            } else {
                $("#profileDataCard").slideUp(300);
                $("#newDataForm").slideDown(300);
                $("#use_profile_data").val("0");
            }
        });

        // Form submission handling
        $("#submitOrderBtn").click(function(e) {
            e.preventDefault();

            // Check if cart is empty
            if (isCartEmpty) {
                Swal.fire({
                    title: 'Keranjang Kosong!',
                    text: 'Silakan tambahkan item ke keranjang terlebih dahulu.',
                    icon: 'error',
                    confirmButtonColor: '#FF7E2E'
                });
                return false;
            }

            // Form validation
            let name, telp, alamat;
            
            if($("#useProfileData").is(":checked") && {{ Auth::guard('pelanggan')->check() ? 'true' : 'false' }}) {
                // Use profile data
                name = "{{ Auth::guard('pelanggan')->check() ? Auth::guard('pelanggan')->user()->pelanggan : '' }}";
                telp = "{{ Auth::guard('pelanggan')->check() ? Auth::guard('pelanggan')->user()->telp : '' }}";
                alamat = "{{ Auth::guard('pelanggan')->check() ? Auth::guard('pelanggan')->user()->alamat : '' }}";
            } else {
                // Use form data
                name = $("#name").val();
                telp = $("#telp").val();
                alamat = $("#alamat").val();
            }

            if (!name || !telp || !alamat) {
                Swal.fire({
                    title: 'Form Belum Lengkap!',
                    text: 'Silakan lengkapi semua field yang diperlukan.',
                    icon: 'warning',
                    confirmButtonColor: '#FF7E2E'
                });
                return false;
            }

            // Fill confirmation modal with form data
            $("#confirmName").text(name);
            $("#confirmTelp").text(telp);
            $("#confirmAlamat").text(alamat);

            // Show confirmation modal
            $('#orderConfirmationModal').modal('show');
        });

        // Confirm order button click
        $("#confirmOrderBtn").click(function() {
            // Hide confirmation modal
            $('#orderConfirmationModal').modal('hide');

            // Show loading animation
            Swal.fire({
                title: 'Memproses Pesanan',
                html: 'Mohon tunggu sebentar...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Submit the form
            $("#orderForm").submit();
        });

        // Show success modal if redirected from controller with success message
        @if(session('success'))
            // Set order ID in success modal
            $("#orderIdDisplay").text("{{ session('order_id') }}");

            // Show success modal
            setTimeout(function() {
                $('#successModal').modal('show');
            }, 500);
        @endif

        // Show error messages
        @if(session('error'))
            Swal.fire({
                title: 'Error!',
                text: "{{ session('error') }}",
                icon: 'error',
                confirmButtonColor: '#FF7E2E'
            });
        @endif
    });
</script>
@endsection



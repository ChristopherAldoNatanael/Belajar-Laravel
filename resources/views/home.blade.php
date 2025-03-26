@extends('layouts.app')
@section('title', 'Home - Ayam Goreng Joss Gandos')
@section('content')
    <!-- CSS tambahan -->
    <style>
      :root {
            --primary-orange: #FF8A00;
            --secondary-orange: #FF5E00;
            --light-orange: #FFF0E0;
            --dark-orange: #CC4A00;
            --accent-yellow: #FFD600;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, var(--light-orange) 0%, #fff 100%);
            color: #333;
            padding: 120px 0;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 50%;
            height: 100%;
            background: url('{{ asset('gambar/pattern-dots.png') }}') repeat;
            opacity: 0.05;
            z-index: 0;
        }

        .hero-content h1 {
            color: var(--dark-orange);
            font-size: 3.5rem;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
        }

        .min-vh-80 {
            min-height: 80vh;
        }

        /* Animation Effects */
        .floating-image {
            animation: floating 4s ease-in-out infinite;
            filter: drop-shadow(0 10px 15px rgba(255, 94, 0, 0.2));
        }

        @keyframes floating {
            0% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-15px) rotate(2deg); }
            100% { transform: translateY(0px) rotate(0deg); }
        }

        /* Experience Badge */
        .experience-badge {
            width: 120px;
            height: 120px;
            bottom: -30px;
            right: 30px;
            background: var(--accent-yellow) !important;
            box-shadow: 0 5px 15px rgba(255, 138, 0, 0.3);
        }

        /* Cards Styling */
        .menu-card, .testimonial-card {
            transition: all 0.3s ease;
            border-radius: 15px;
            overflow: hidden;
        }

        .menu-card:hover, .testimonial-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(255, 94, 0, 0.15) !important;
        }

        .menu-card .card-img-top {
            height: 220px;
            object-fit: cover;
            transition: all 0.5s ease;
        }

        .menu-card:hover .card-img-top {
            transform: scale(1.05);
        }

        /* Buttons */
        .btn-primary-orange {
            background-color: var(--primary-orange);
            border-color: var(--primary-orange);
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary-orange:hover {
            background-color: var(--secondary-orange);
            border-color: var(--secondary-orange);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 94, 0, 0.3);
        }

        .btn-outline-orange {
            border: 2px solid var(--primary-orange);
            color: var(--primary-orange);
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-outline-orange:hover {
            background-color: var(--primary-orange);
            color: white;
            transform: translateY(-2px);
        }

        /* Section Headers */
        .section-title {
            position: relative;
            margin-bottom: 3rem;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: var(--primary-orange);
            border-radius: 10px;
        }

        /* Features Badge Section */
        .feature-badge {
            background-color: var(--light-orange);
            border-radius: 15px;
            padding: 1.5rem;
            height: 100%;
            transition: all 0.3s ease;
        }

        .feature-badge:hover {
            background-color: white;
            box-shadow: 0 10px 20px rgba(255, 94, 0, 0.1);
            transform: translateY(-5px);
        }

        .feature-icon {
            font-size: 2.5rem;
            color: var(--primary-orange);
            margin-bottom: 1rem;
        }

        /* Call to Action */
        .cta-section {
            background: linear-gradient(135deg, var(--secondary-orange) 0%, var(--primary-orange) 100%);
            padding: 5rem 0;
            position: relative;
            overflow: hidden;
        }

        .cta-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('{{ asset('gambar/pattern-dots.png') }}') repeat;
            opacity: 0.05;
            z-index: 0;
        }

        /* Custom Animation Delays */
        .delay-1 { animation-delay: 0.2s; }
        .delay-2 { animation-delay: 0.4s; }
        .delay-3 { animation-delay: 0.6s; }
    </style>
<!-- Hero Section with Background Image -->
<div class="hero-section">
    <div class="container position-relative">
        <div class="row min-vh-80 align-items-center">
            <div class="col-lg-7 text-center text-lg-start animate__animated animate__fadeInLeft hero-content">
                <span class="badge bg-warning text-dark fs-6 mb-3 animate__animated animate__fadeIn animate__delay-1s">Ayam Goreng Terenak di Kota</span>
                <h1 class="fw-bold mb-3">Ayam Goreng <span style="color: var(--primary-orange);">Joss Gandos</span></h1>
                <p class="lead mb-4 text-dark opacity-75">Sensasi cita rasa autentik ayam goreng dengan bumbu rahasia yang membuat lidah bergoyang!</p>
                <div class="d-flex flex-wrap gap-3 justify-content-center justify-content-lg-start">
                    <a href="{{ route('menu.index') }}" class="btn btn-primary-orange btn-lg fw-bold shadow-sm animate__animated animate__pulse animate__infinite animate__slower">
                        <i class="bi bi-menu-button-wide me-2"></i>Lihat Menu
                    </a>
                    <a href="{{ route('order.show') }}" class="btn btn-outline-orange btn-lg">
                        <i class="bi bi-bag-check me-2"></i>Order Sekarang
                    </a>
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-block animate__animated animate__fadeInRight">
                <img src="{{ asset('gambar/Ayam Goreng Krispy.png') }}" class="img-fluid floating-image" alt="Featured Menu">
            </div>
        </div>
    </div>
</div>

<!-- Badge Highlights Section -->
<div class="py-5" style="background-color: var(--light-orange);">
    <div class="container">
        <div class="row g-4">
            <div class="col-6 col-md-3 animate__animated animate__fadeInUp">
                <div class="feature-badge text-center">
                    <i class="bi bi-award feature-icon"></i>
                    <h5 class="fw-bold">Kualitas Premium</h5>
                    <p class="mb-0 small text-muted">Ayam berkualitas terbaik dan segar setiap hari</p>
                </div>
            </div>
            <div class="col-6 col-md-3 animate__animated animate__fadeInUp delay-1">
                <div class="feature-badge text-center">
                    <i class="bi bi-truck feature-icon"></i>
                    <h5 class="fw-bold">Pengiriman Cepat</h5>
                    <p class="mb-0 small text-muted">Tiba di tempat Anda dalam kondisi hangat</p>
                </div>
            </div>
            <div class="col-6 col-md-3 animate__animated animate__fadeInUp delay-2">
                <div class="feature-badge text-center">
                    <i class="bi bi-cash-coin feature-icon"></i>
                    <h5 class="fw-bold">Harga Terjangkau</h5>
                    <p class="mb-0 small text-muted">Nilai terbaik untuk kualitas premium</p>
                </div>
            </div>
            <div class="col-6 col-md-3 animate__animated animate__fadeInUp delay-3">
                <div class="feature-badge text-center">
                    <i class="bi bi-heart feature-icon"></i>
                    <h5 class="fw-bold">Pelanggan Puas</h5>
                    <p class="mb-0 small text-muted">Ribuan pelanggan setia dan bahagia</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- About Us Section -->
<div class="container py-5">
    <div class="row align-items-center">
        <div class="col-lg-6 mb-4 mb-lg-0 animate__animated animate__fadeInLeft">
            <div class="position-relative">
                <img src="{{ asset('gambar/logo-toko.jpg') }}" class="img-fluid rounded-4 shadow-lg" alt="Ayam Goreng">
                <div class="experience-badge position-absolute text-dark fw-bold rounded-circle d-flex flex-column align-items-center justify-content-center">
                    <span class="h2 mb-0">15</span>
                    <span class="small">Tahun</span>
                </div>
            </div>
        </div>
        <div class="col-lg-6 animate__animated animate__fadeInRight">
            <div class="about-content ps-lg-4">
                <span class="badge p-2" style="background-color: var(--light-orange); color: var(--primary-orange);">TENTANG KAMI</span>
                <h2 class="display-6 fw-bold mt-2 mb-4" style="color: var(--dark-orange);">Pengalaman Kuliner Ayam Goreng Terbaik di Kota</h2>
                <p class="lead" style="color: var(--primary-orange);">Ayam Goreng Joss Gandos hadir dengan tekad memberikan pengalaman kuliner terbaik dengan resep rahasia turun temurun.</p>
                <p>Sejak 2010, kami konsisten menyajikan ayam goreng dengan kualitas premium, menggunakan bahan-bahan segar pilihan dan bumbu rahasia yang meresap hingga ke tulang. Kerenyahan yang sempurna dan cita rasa autentik menjadi ciri khas yang membuat pelanggan kami selalu kembali.</p>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center mb-3">
                            <div class="p-2 rounded-circle me-3" style="background-color: var(--primary-orange);">
                                <i class="bi bi-check2-circle text-white"></i>
                            </div>
                            <span class="fw-bold">Bahan Pilihan Premium</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center mb-3">
                            <div class="p-2 rounded-circle me-3" style="background-color: var(--primary-orange);">
                                <i class="bi bi-check2-circle text-white"></i>
                            </div>
                            <span class="fw-bold">Resep Rahasia</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center mb-3">
                            <div class="p-2 rounded-circle me-3" style="background-color: var(--primary-orange);">
                                <i class="bi bi-check2-circle text-white"></i>
                            </div>
                            <span class="fw-bold">Chef Berpengalaman</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center mb-3">
                            <div class="p-2 rounded-circle me-3" style="background-color: var(--primary-orange);">
                                <i class="bi bi-check2-circle text-white"></i>
                            </div>
                            <span class="fw-bold">Cita Rasa Konsisten</span>
                        </div>
                    </div>
                </div>

                {{-- <a href="{{ route('about') }}" class="btn btn-primary-orange mt-4">Pelajari Lebih Lanjut <i class="bi bi-arrow-right ms-2"></i></a> --}}
            </div>
        </div>
    </div>
</div>

<!-- Featured Menu Section -->
<div class="py-5" style="background: linear-gradient(135deg, #fff8f0 0%, #fff 100%);">
    <div class="container">
        <div class="text-center mb-5 section-title">
            <span class="badge p-2" style="background-color: var(--light-orange); color: var(--primary-orange);">MENU FAVORIT</span>
            <h2 class="display-6 fw-bold mt-2" style="color: var(--dark-orange);">Hidangan Best Seller Kami</h2>
        </div>

        <div class="row g-4">
            <div class="col-md-4 animate__animated animate__fadeInUp">
                <div class="card border-0 shadow h-100 menu-card">
                    <div class="position-relative overflow-hidden">
                        <img src="{{ asset('gambar/ayam1.jpg') }}" class="card-img-top" alt="Ayam Crispy">
                        <span class="badge position-absolute top-0 end-0 m-3" style="background-color: var(--primary-orange);">Best Seller</span>
                    </div>
                    <div class="card-body text-center">
                        <h4 class="card-title fw-bold" style="color: var(--dark-orange);">Ayam Crispy</h4>
                        <div class="my-3">
                            <span style="color: var(--accent-yellow);">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                            </span>
                            <span class="ms-2 small text-muted">(132 ulasan)</span>
                        </div>
                        <p class="card-text">Ayam dengan kulit renyah dan daging juicy dalam setiap gigitannya.</p>
                        <h5 class="fw-bold mt-3" style="color: var(--primary-orange);">Rp 26.000</h5>
                    </div>
                    <div class="card-footer bg-transparent border-0 p-4 pt-0">
                        <a href="{{ route('menu.index') }}" class="btn btn-outline-orange w-100">Pesan Sekarang</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 animate__animated animate__fadeInUp delay-1">
                <div class="card border-0 shadow h-100 menu-card">
                    <div class="position-relative overflow-hidden">
                        <img src="{{ asset('gambar/kentang2.jpg') }}" class="card-img-top" alt="Kentang Goreng">
                        <span class="badge bg-success position-absolute top-0 end-0 m-3">Value</span>
                    </div>
                    <div class="card-body text-center">
                        <h4 class="card-title fw-bold" style="color: var(--dark-orange);">Kentang Goreng</h4>
                        <div class="my-3">
                            <span style="color: var(--accent-yellow);">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-half"></i>
                            </span>
                            <span class="ms-2 small text-muted">(105 ulasan)</span>
                        </div>
                        <p class="card-text">Kentang premium goreng garing dengan bumbu spesial yang menggugah selera.</p>
                        <h5 class="fw-bold mt-3" style="color: var(--primary-orange);">Rp 18.000</h5>
                    </div>
                    <div class="card-footer bg-transparent border-0 p-4 pt-0">
                        <a href="{{ route('menu.index') }}" class="btn btn-outline-orange w-100">Pesan Sekarang</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 animate__animated animate__fadeInUp delay-2">
                <div class="card border-0 shadow h-100 menu-card">
                    <div class="position-relative overflow-hidden">
                        <img src="{{ asset('gambar/burger1.jpg') }}" class="card-img-top" alt="Burger Deluxe">
                        <span class="badge bg-danger position-absolute top-0 end-0 m-3">New</span>
                    </div>
                    <div class="card-body text-center">
                        <h4 class="card-title fw-bold" style="color: var(--dark-orange);">Burger Deluxe</h4>
                        <div class="my-3">
                            <span style="color: var(--accent-yellow);">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                            </span>
                            <span class="ms-2 small text-muted">(87 ulasan)</span>
                        </div>
                        <p class="card-text">Burger dengan daging premium, keju melimpah, dan sayuran segar.</p>
                        <h5 class="fw-bold mt-3" style="color: var(--primary-orange);">Rp 32.000</h5>
                    </div>
                    <div class="card-footer bg-transparent border-0 p-4 pt-0">
                        <a href="{{ route('menu.index') }}" class="btn btn-outline-orange w-100">Pesan Sekarang</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('menu.index') }}" class="btn btn-primary-orange btn-lg">Lihat Seluruh Menu <i class="bi bi-arrow-right ms-2"></i></a>
        </div>
    </div>
</div>

<!-- Testimonial Section -->
<div class="container py-5">
    <div class="text-center mb-5 section-title">
        <span class="badge p-2" style="background-color: var(--light-orange); color: var(--primary-orange);">TESTIMONIAL</span>
        <h2 class="display-6 fw-bold mt-2" style="color: var(--dark-orange);">Apa Kata Pelanggan Kami</h2>
    </div>

    <div class="row g-4">
        <div class="col-md-4 animate__animated animate__fadeInUp">
            <div class="card border-0 shadow h-100 p-4 testimonial-card">
                <div class="position-absolute top-0 end-0 m-4" style="color: var(--light-orange);">
                    <i class="bi bi-quote fs-1"></i>
                </div>
                <div style="color: var(--accent-yellow);" class="mb-3">
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                </div>
                <p class="card-text fst-italic">"Ayam goreng terenak yang pernah saya coba! Bumbunya meresap sampai ke dalam dan kulitnya renyah sempurna. Saya sudah jadi pelanggan tetap di sini."</p>
                <div class="d-flex align-items-center mt-3">
                    <div class="flex-shrink-0">
                        <img src="" class="rounded-circle" width="60" height="60" alt="Customer"
                             style="border: 3px solid var(--primary-orange);">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-0 fw-bold" style="color: var(--dark-orange);">Budi Santoso</h6>
                        <p class="small mb-0" style="color: var(--primary-orange);">Jakarta</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 animate__animated animate__fadeInUp delay-1">
            <div class="card border-0 shadow h-100 p-4 testimonial-card">
                <div class="position-absolute top-0 end-0 m-4" style="color: var(--light-orange);">
                    <i class="bi bi-quote fs-1"></i>
                </div>
                <div style="color: var(--accent-yellow);" class="mb-3">
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                </div>
                <p class="card-text fst-italic">"Paket nasi ayam mereka adalah comfort food favorite saya. Porsinya pas, rasanya konsisten, dan harganya sangat terjangkau untuk kualitas sebagus ini."</p>
                <div class="d-flex align-items-center mt-3">
                    <div class="flex-shrink-0">
                        <img src="" class="rounded-circle" width="60" height="60" alt="Customer"
                             style="border: 3px solid var(--primary-orange);">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-0 fw-bold" style="color: var(--dark-orange);">Siti Nurhaliza</h6>
                        <p class="small mb-0" style="color: var(--primary-orange);">Bandung</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 animate__animated animate__fadeInUp delay-2">
            <div class="card border-0 shadow h-100 p-4 testimonial-card">
                <div class="position-absolute top-0 end-0 m-4" style="color: var(--light-orange);">
                    <i class="bi bi-quote fs-1"></i>
                </div>
                <div style="color: var(--accent-yellow);" class="mb-3">
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-half"></i>
                </div>
                <p class="card-text fst-italic">"Ayam Goreng Spicy mereka benar-benar pedas yang nikmat, tidak asal pedas! Sambalnya juga enak banget. Pengiriman selalu tepat waktu dan makanan masih hangat."</p>
                <div class="d-flex align-items-center mt-3">
                    <div class="flex-shrink-0">
                        <img src="" class="rounded-circle" width="60" height="60" alt="Customer"
                             style="border: 3px solid var(--primary-orange);">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-0 fw-bold" style="color: var(--dark-orange);">Agus Dermawan</h6>
                        <p class="small mb-0" style="color: var(--primary-orange);">Surabaya</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Call to Action -->
<div class="cta-section text-white">
    <div class="container position-relative">
        <div class="row align-items-center">
            <div class="col-lg-8 animate__animated animate__fadeInLeft">
                <span class="badge bg-white text-dark mb-3">PROMO SPESIAL</span>
                <h2 class="fw-bold mb-3">Pesan Sekarang dan Dapatkan Diskon 10%</h2>
                <p class="lead mb-0">Untuk pemesanan pertama Anda melalui aplikasi atau website kami.</p>
            </div>
            <div class="col-lg-4 text-lg-end mt-4 mt-lg-0 animate__animated animate__fadeInRight">
                <a href="{{ route('order.show') }}" class="btn btn-lg fw-bold bg-white" style="color: var(--primary-orange);">
                    <i class="bi bi-bag-check me-2"></i>Pesan Sekarang
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Additional Elements: Floating Food Icons -->
{{-- <div class="position-fixed d-none d-lg-block" style="bottom: 50px; right: 30px; z-index: 10;">
    <div class="bg-white rounded-circle shadow-lg p-3 animate__animated animate__pulse animate__infinite" style="border: 3px solid var(--primary-orange);">
        <a href="{{ route('order') }}" class="text-decoration-none">
            <i class="bi bi-cart-fill fs-4" style="color: var(--primary-orange);"></i>
        </a>
    </div>
</div> --}}

<!-- Improved Footer Link Animation -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add hover effect to menu items
    const menuCards = document.querySelectorAll('.menu-card');

    menuCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.querySelector('.btn-outline-orange').classList.add('animate__animated', 'animate__headShake');
        });

        card.addEventListener('mouseleave', function() {
            this.querySelector('.btn-outline-orange').classList.remove('animate__animated', 'animate__headShake');
        });
    });
});
</script>

@endsection

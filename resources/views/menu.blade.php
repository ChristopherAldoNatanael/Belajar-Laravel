@extends('layouts.app')
@section('title', 'Menu - Resto Ayam Goreng Premium')
@section('content')
<!-- CSS Files -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<style>
    /* Menerapkan warna dari root variables */
    :root {
        --primary-orange: #FF8A00;
        --secondary-orange: #FF5E00;
        --light-orange: #FFF0E0;
        --dark-orange: #CC4A00;
        --accent-yellow: #FFD600;
    }

    .circular-image-container {
        width: 180px;
        height: 100px;
        border-radius: 50%;
        border: 3px solid #f8971d; /* Orange border - matches your text-orange class */
        padding: 4px;
        margin: 0 auto;
        overflow: hidden;
    }

    .circular-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
        transition: transform 0.3s ease;
    }

    .circular-image-container:hover .circular-image {
        transform: scale(1.1);
    }

    /* Perbaikan warna pada halaman menu */
    .bg-menu {
        background: var(--light-orange);
        min-height: 100vh;
        width: 100vw;
        position: relative;
        margin: 0;
        padding: 0;
    }

    .hero-banner {
        background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('{{ asset('gambar/bg-toko.png') }}') no-repeat center center;
        background-size: cover;
    }

    .text-orange {
        color: var(--primary-orange) !important;
    }

    .bg-orange {
        background-color: var(--primary-orange) !important;
        border-color: var(--primary-orange) !important;
    }

    .btn-orange {
        background-color: var(--primary-orange);
        border-color: var(--primary-orange);
        color: white;
        transition: all 0.3s ease;
    }

    .btn-orange:hover {
        background-color: var(--secondary-orange);
        border-color: var(--secondary-orange);
        color: white;
    }

    /* Filter tabs */
    .filter-container {
        padding: 15px 0;
    }

    .filter-tabs {
        background-color: rgba(255, 255, 255, 0.7);
        border-radius: 50px;
        padding: 5px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
    }

    .filter-tabs .nav-link {
        color: var(--dark-orange);
        background-color: white;
        font-weight: 500;
        padding: 10px 20px;
        border-radius: 50px;
        transition: all 0.3s ease;
        border: none;
    }

    .filter-tabs .nav-link:hover {
        color: white !important;
        background-color: var(--secondary-orange) !important;
    }

    .filter-tabs .nav-link.active {
        color: white !important;
        background-color: var(--primary-orange) !important;
    }

    /* Menu cards */
    .menu-card {
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.4s ease;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        background-color: white;
    }

    .promo-banner {
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    .parallax-bg {
        filter: brightness(0.6);
    }

    .promo-badge {
        background-color: var(--primary-orange);
    }

    .featured-products {
        background-color: white;
        border-radius: 15px;
    }

    .section-title:after {
        background-color: var(--primary-orange);
    }

    .featured-item {
        background-color: white;
    }

    .featured-icon {
        background-color: var(--light-orange);
    }

    /* Modal styling */
    .modal-content {
        border-radius: 15px;
        overflow: hidden;
    }

    /* Countdown styling */
    .countdown-item {
        background-color: rgba(255,255,255,0.2);
    }
</style>

<div class="hero-banner position-relative overflow-hidden">
    <div class="overlay"></div>
    <div class="container position-relative z-3 py-5">
        <div class="row min-vh-50 align-items-center justify-content-center text-center">
            <div class="col-lg-8" data-aos="fade-up">
                <h1 class="display-3 fw-bold text-white text-shadow mb-3">Menu <span class="text-orange">Premium</span> Kami</h1>
                <p class="lead text-white mb-4">Nikmati hidangan ayam goreng berkualitas premium dengan racikan bumbu rahasia dan pilihan menu pelengkap yang menggugah selera</p>
            </div>
        </div>
    </div>
</div>

<div class="bg-menu py-5" id="menu-section">
    <!-- Filter Options with Improved Design -->
    <div class="filter-container" data-aos="fade-up">
        <div class="d-flex justify-content-center mb-5">
            <ul class="nav nav-pills filter-tabs">
                <li class="nav-item">
                    <button class="nav-link active" data-filter="all">Semua Menu</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-filter="ayam">Ayam</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-filter="burger">Burger</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-filter="kentang">Kentang</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-filter="nugget">Nugget</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-filter="paket">Paket Bundle</button>
                </li>
            </ul>
        </div>
    </div>

    <!-- Menu Section with Animation -->
    <div class="container" id="menu">
        <div class="row g-4">
            @foreach($menus as $menu)
                <div class="col-lg-4 col-md-6 mb-4 menu-item"
                     data-category="{{ $menu->kategori ? strtolower($menu->kategori->kategori) : 'unknown' }}"
                     data-aos="fade-up"
                     data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="card menu-card h-100 border-0 position-relative overflow-hidden">
                        @if($menu->menu == 'Ayam Goreng Dada' || $menu->menu == 'Burger Premium' || $menu->menu == 'Paket Hemat 1' || $menu->menu == 'Paket Keluarga')
                            <div class="badge-container">
                                <span class="badge bg-{{ $menu->menu == 'Ayam Goreng Dada' ? 'orange' : ($menu->menu == 'Burger Premium' ? 'orange' : ($menu->menu == 'Paket Hemat 1' ? 'success' : 'orange')) }} position-absolute">
                                    {{ $menu->menu == 'Ayam Goreng Dada' ? 'Bestseller' : ($menu->menu == 'Burger Premium' ? 'Premium' : ($menu->menu == 'Paket Hemat 1' ? 'Hemat' : 'Best Value')) }}
                                </span>
                            </div>
                        @endif
                        <div class="card-img-container">
                            <img src="{{ asset('gambar/' . $menu->gambar) }}" class="card-img-top" alt="{{ $menu->menu }}">
                            <div class="card-img-overlay gradient-overlay d-flex align-items-end">
                                <div class="quick-view">
                                    <button class="btn btn-sm btn-light rounded-circle" data-bs-toggle="modal" data-bs-target="#menuModal{{ $menu->idmenu }}">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="card-title fw-bold mb-0">{{ $menu->menu }}</h5>
                                <div class="price">
                                    <span class="fw-bold text-orange">Rp {{ number_format($menu->harga, 0, ',', '.') }}</span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div class="tags">
                                    <span class="badge bg-light text-dark rounded-pill">
                                        {{ $menu->kategori ? $menu->kategori->kategori : 'Tidak ada kategori' }}
                                    </span>
                                </div>
                            </div>
                            <p class="card-text small">{{ $menu->deskripsi }}</p>
                            <div class="d-flex align-items-center">
                                <button class="btn btn-sm btn-orange btn-hover-effect add-to-cart" data-id="{{ $menu->idmenu }}">
                                    <i class="bi bi-cart-plus"></i> Keranjang
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Promo Banner dengan Efek Parallax -->
    <div class="container mt-5" data-aos="fade-up">
        <div class="row">
            <div class="col-12">
                <div class="promo-banner position-relative overflow-hidden rounded-lg">
                    <div class="parallax-bg"></div>
                    <div class="promo-content p-5">
                        <div class="row align-items-center">
                            <div class="col-lg-7" data-aos="fade-right">
                                <h2 class="display-5 fw-bold mb-3 text-white">Promo Spesial Weekend!</h2>
                                <p class="lead mb-4 text-white">Dapatkan diskon 20% untuk semua paket keluarga setiap Sabtu & Minggu. Tambahan gratis 1 porsi kentang goreng untuk pembelian min. Rp 100.000</p>
                                <div class="promo-countdown d-flex gap-3 mb-4">
                                    <div class="countdown-item">
                                        <div class="countdown-number text-white" id="days">2</div>
                                        <div class="countdown-label text-white">Hari</div>
                                    </div>
                                    <div class="countdown-item">
                                        <div class="countdown-number text-white" id="hours">11</div>
                                        <div class="countdown-label text-white">Jam</div>
                                    </div>
                                    <div class="countdown-item">
                                        <div class="countdown-number text-white" id="minutes">45</div>
                                        <div class="countdown-label text-white">Menit</div>
                                    </div>
                                    <div class="countdown-item">
                                        <div class="countdown-number text-white" id="seconds">30</div>
                                        <div class="countdown-label text-white">Detik</div>
                                    </div>
                                </div>
                                <button class="btn btn-orange btn-lg px-4 py-2 rounded-pill btn-hover-effect">
                                    Pesan Sekarang <i class="bi bi-arrow-right ms-2"></i>
                                </button>
                            </div>
                            <div class="col-lg-5 text-center mt-4 mt-lg-0" data-aos="fade-left">
                                <div class="promo-badge">
                                    <div class="badge-content">
                                        <div class="badge-text text-white">DISKON</div>
                                        <div class="badge-number text-white">20%</div>
                                        <div class="badge-text text-white">OFF</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Products with Animation -->
    <div class="container">
        <div class="featured-products mt-5 py-5">
            <div class="text-center mb-4" data-aos="fade-up">
                <h2 class="section-title">Favorite <span class="text-orange">Pelanggan</span></h2>
                <p class="text-muted">Menu yang paling banyak disukai pelanggan kami</p>
            </div>

            <div class="row g-4 mt-2">
                <div class="col-md-3 col-6" data-aos="fade-up">
                    <div class="featured-item text-center">
                        <div class="featured-icon">
                            <div class="circular-image-container">
                                <img src="{{ asset('gambar/Ayam Goreng Krispy.png') }}" alt="Favorite 1" class="circular-image">
                            </div>
                        </div>
                        <h5 class="mt-3">Ayam Crispy</h5>
                        <div class="featured-rating">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-half text-warning"></i>
                            <span class="ms-2 small">(4.8)</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="featured-item text-center">
                        <div class="featured-icon">
                            <div class="circular-image-container">
                                <img src="{{ asset('gambar/paket2.jpg') }}" alt="Favorite 2" class="circular-image">
                            </div>
                        </div>
                        <h5 class="mt-3">Paket Keluarga</h5>
                        <div class="featured-rating">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-half text-warning"></i>
                            <span class="ms-2 small">(4.7)</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="featured-item text-center">
                        <div class="featured-icon">
                            <div class="circular-image-container">
                                <img src="{{ asset('gambar/burger1.jpg') }}" alt="Favorite 3" class="circular-image">
                            </div>
                        </div>
                        <h5 class="mt-3">Burger Premium</h5>
                        <div class="featured-rating">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star text-warning"></i>
                            <span class="ms-2 small">(4.5)</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="featured-item text-center">
                        <div class="featured-icon">
                            <div class="circular-image-container">
                                <img src="{{ asset('gambar/nugget.jpg') }}" alt="Favorite 4" class="circular-image">
                            </div>
                        </div>
                        <h5 class="mt-3">Nugget Ayam</h5>
                        <div class="featured-rating">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star text-warning"></i>
                            <span class="ms-2 small">(4.2)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Dynamic Menu Modals -->
    @foreach($menus as $menu)
        <div class="modal fade" id="menuModal{{ $menu->idmenu }}" tabindex="-1" aria-labelledby="menuModalLabel{{ $menu->idmenu }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <img src="{{ asset('gambar/' . $menu->gambar) }}" class="img-fluid rounded-3" alt="{{ $menu->menu }}">
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h3 class="fw-bold">{{ $menu->menu }}</h3>
                                    @if($menu->menu == 'Ayam Goreng Dada' || $menu->menu == 'Burger Premium' || $menu->menu == 'Paket Hemat 1' || $menu->menu == 'Paket Keluarga')
                                        <span class="badge bg-{{ $menu->menu == 'Ayam Goreng Dada' ? 'orange' : ($menu->menu == 'Burger Premium' ? 'orange' : ($menu->menu == 'Paket Hemat 1' ? 'success' : 'orange')) }}">
                                            {{ $menu->menu == 'Ayam Goreng Dada' ? 'Bestseller' : ($menu->menu == 'Burger Premium' ? 'Premium' : ($menu->menu == 'Paket Hemat 1' ? 'Hemat' : 'Best Value')) }}
                                        </span>
                                    @endif
                                </div>
                                <div class="product-rating mb-3">
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-half text-warning"></i>
                                    <span class="ms-2">(4.8/5)</span>
                                </div>
                                <h4 class="text-orange mb-3">Rp {{ number_format($menu->harga, 0, ',', '.') }}</h4>
                                <p class="mb-4">{{ $menu->deskripsi }}</p>

                                <!-- Informasi Nutrisi (Statis untuk semua menu, bisa disesuaikan jika ada kolom di database) -->
                                <div class="nutrition-info p-3 bg-light rounded-3 mb-4">
                                    <h5 class="fw-bold mb-3">Informasi Nutrisi:</h5>
                                    <div class="row g-3">
                                        <div class="col-6">
                                            <div class="d-flex align-items-center">
                                                <div class="nutrition-icon me-2">
                                                    <i class="bi bi-fire text-orange"></i>
                                                </div>
                                                <div>
                                                    <small class="text-muted">Kalori</small>
                                                    <p class="mb-0 fw-medium">320 kkal</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="d-flex align-items-center">
                                                <div class="nutrition-icon me-2">
                                                    <i class="bi bi-egg-fried text-orange"></i>
                                                </div>
                                                <div>
                                                    <small class="text-muted">Protein</small>
                                                    <p class="mb-0 fw-medium">28g</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="d-flex align-items-center">
                                                <div class="nutrition-icon me-2">
                                                    <i class="bi bi-droplet text-orange"></i>
                                                </div>
                                                <div>
                                                    <small class="text-muted">Lemak</small>
                                                    <p class="mb-0 fw-medium">18g</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="d-flex align-items-center">
                                                <div class="nutrition-icon me-2">
                                                    <i class="bi bi-basket text-orange"></i>
                                                </div>
                                                <div>
                                                    <small class="text-muted">Karbohidrat</small>
                                                    <p class="mb-0 fw-medium">12g</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="quantity-selector mb-4">
                                    <label class="form-label fw-medium">Jumlah:</label>
                                    <div class="input-group w-50">
                                        <button class="btn btn-outline-secondary decrease-qty" type="button">-</button>
                                        <input type="number" class="form-control text-center quantity" value="1" min="1" max="99" data-id="{{ $menu->idmenu }}">
                                        <button class="btn btn-outline-secondary increase-qty" type="button">+</button>
                                    </div>
                                </div>

                                <div class="modal-actions">
                                    <button class="btn btn-orange w-100 p-3 rounded-pill btn-hover-effect add-to-cart" data-id="{{ $menu->idmenu }}">
                                        <i class="bi bi-cart-plus me-2"></i> Tambahkan ke Keranjang
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- JavaScript untuk Filter Menu -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Status login dari Laravel
        const isLoggedIn = {{ Auth::guard('pelanggan')->check() ? 'true' : 'false' }};

        document.addEventListener('DOMContentLoaded', function () {
            // Inisialisasi AOS untuk animasi
            AOS.init({
                duration: 800,
                once: true,
                offset: 100
            });

            // Fungsi untuk menampilkan notifikasi menggunakan SweetAlert2
            function showNotification(title, text, icon, options = {}) {
                Swal.fire({
                    title: title,
                    text: text,
                    icon: icon,
                    timer: 3000,
                    showConfirmButton: false,
                    position: 'top-end',
                    toast: true,
                    background: '#fff',
                    customClass: {
                        popup: 'swal2-custom-toast',
                        title: 'swal2-custom-title',
                        content: 'swal2-custom-content'
                    },
                    ...options
                });
            }

            // Menu filtering
            const filterButtons = document.querySelectorAll('[data-filter]');
            const menuItems = document.querySelectorAll('.menu-item');

            filterButtons.forEach(button => {
                button.addEventListener('click', function () {
                    filterButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');
                    const filterValue = this.getAttribute('data-filter');

                    menuItems.forEach(item => {
                        if (filterValue === 'all' || item.getAttribute('data-category') === filterValue) {
                            item.style.display = 'block';
                            setTimeout(() => {
                                item.style.opacity = '1';
                                item.style.transform = 'translateY(0)';
                            }, 100);
                        } else {
                            item.style.opacity = '0';
                            item.style.transform = 'translateY(20px)';
                            setTimeout(() => {
                                item.style.display = 'none';
                            }, 300);
                        }
                    });
                });
            });

            // Handle Quantity Selector
            document.querySelectorAll('.quantity-selector').forEach(function (selector) {
                const decreaseBtn = selector.querySelector('.decrease-qty');
                const increaseBtn = selector.querySelector('.increase-qty');
                const input = selector.querySelector('.quantity');

                if (decreaseBtn && increaseBtn && input) {
                    decreaseBtn.addEventListener('click', function () {
                        let value = parseInt(input.value);
                        if (value > 1) input.value = value - 1;
                    });

                    increaseBtn.addEventListener('click', function () {
                        let value = parseInt(input.value);
                        if (value < 99) input.value = value + 1;
                    });

                    input.addEventListener('input', function () {
                        let value = parseInt(this.value);
                        if (isNaN(value) || value < 1) this.value = 1;
                        else if (value > 99) this.value = 99;
                    });
                }
            });

            // Countdown timer untuk promo
            function updateCountdown() {
                const now = new Date();
                const endDate = new Date();
                endDate.setDate(endDate.getDate() + (7 - endDate.getDay()) % 7);
                endDate.setHours(23, 59, 59, 0);

                const diff = endDate - now;

                if (diff > 0) {
                    const days = Math.floor(diff / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((diff % (1000 * 60)) / 1000);

                    const daysElement = document.getElementById('days');
                    const hoursElement = document.getElementById('hours');
                    const minutesElement = document.getElementById('minutes');
                    const secondsElement = document.getElementById('seconds');

                    if (daysElement) daysElement.textContent = days;
                    if (hoursElement) hoursElement.textContent = hours;
                    if (minutesElement) minutesElement.textContent = minutes;
                    if (secondsElement) secondsElement.textContent = seconds;
                }
            }

            updateCountdown();
            setInterval(updateCountdown, 1000);

            // Hover effects untuk menu cards
            const menuCards = document.querySelectorAll('.menu-card');
            menuCards.forEach(card => {
                card.addEventListener('mouseenter', function () {
                    this.style.transform = 'translateY(-10px)';
                    this.style.boxShadow = '0 15px 30px rgba(0,0,0,0.1)';
                    this.style.transition = 'all 0.3s ease';
                });

                card.addEventListener('mouseleave', function () {
                    this.style.transform = 'translateY(0)';
                    this.style.boxShadow = '0 5px 15px rgba(0,0,0,0.05)';
                });
            });

            // Cart functionality untuk tombol "Tambahkan ke Keranjang"
            const addToCartButtons = document.querySelectorAll('.add-to-cart');
            let cartCount = 0;
            const cartBadge = document.querySelector('.cart-count');
            if (cartBadge) cartCount = parseInt(cartBadge.textContent) || 0;

            addToCartButtons.forEach(button => {
                button.addEventListener('click', function (e) {
                    e.preventDefault();

                    if (!isLoggedIn) {
                        Swal.fire({
                            title: 'Oops!',
                            text: 'Produk gagal ditambahkan ke keranjang. Silahkan login terlebih dahulu',
                            icon: 'warning',
                            confirmButtonText: 'Login Sekarang',
                            confirmButtonColor: '#FF6B00',
                            showCancelButton: true,
                            cancelButtonText: 'Nanti Saja',
                            backdrop: `rgba(0,0,0,0.4)`,
                            customClass: {
                                popup: 'swal-wide',
                                title: 'swal-title',
                                confirmButton: 'swal-confirm'
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '{{ route("login") }}';
                            }
                        });
                        return;
                    }

                    const menuId = this.getAttribute('data-id');
                    let quantityInput;
                    if (this.closest('.modal-body')) {
                        quantityInput = this.closest('.modal-body').querySelector('.quantity');
                    } else if (this.closest('.card-body')) {
                        quantityInput = this.closest('.card-body').querySelector('.quantity');
                    } else if (this.closest('.d-flex')) {
                        quantityInput = this.closest('.d-flex').querySelector('.quantity');
                    }
                    const quantity = quantityInput ? parseInt(quantityInput.value) : 1;

                    this.disabled = true;
                    const originalText = this.innerHTML;
                    this.innerHTML = '<i class="bi bi-hourglass-split me-2"></i> Menambahkan...';

                    const formData = new FormData();
                    formData.append('menu_id', menuId);
                    formData.append('quantity', quantity);
                    formData.append('_token', '{{ csrf_token() }}');

                    fetch('{{ route("cart.add") }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                        },
                        body: formData,
                    })
                    .then(response => {
                        if (!response.ok) throw new Error('Network response was not ok');
                        return response.json();
                    })
                    .then(data => {
                        this.disabled = false;
                        this.innerHTML = originalText;

                        if (data.success) {
                            cartCount += quantity;
                            showNotification('Berhasil!', 'Produk berhasil ditambahkan ke keranjang', 'success', {
                                timer: 2000,
                                position: 'center'
                            });

                            if (cartBadge) {
                                cartBadge.textContent = cartCount;
                                cartBadge.classList.add('badge-pulse');
                                setTimeout(() => cartBadge.classList.remove('badge-pulse'), 1000);
                            }

                            if (this.closest('.modal')) {
                                const modal = this.closest('.modal');
                                const modalInstance = bootstrap.Modal.getInstance(modal);
                                if (modalInstance) {
                                    setTimeout(() => modalInstance.hide(), 1500);
                                }
                            }
                        } else {
                            showNotification('Gagal', data.message || 'Gagal menambahkan produk ke keranjang', 'error');
                        }
                    })
                    .catch(error => {
                        this.disabled = false;
                        this.innerHTML = originalText;
                        console.error('Error:', error);
                        showNotification('Terjadi Kesalahan', 'Tidak dapat menambahkan produk ke keranjang. Silakan coba lagi.', 'error');
                    });
                });
            });

            // Handle multiple quantity inputs
            document.querySelectorAll('.quantity').forEach(function (input) {
                input.addEventListener('input', function () {
                    let value = parseInt(this.value);
                    if (isNaN(value) || value < 1) this.value = 1;
                    else if (value > 99) this.value = 99;
                });
            });

            // "Pesan Sekarang" button in promo section
            const orderNowBtn = document.querySelector('.promo-content .btn-orange');
            if (orderNowBtn) {
                orderNowBtn.addEventListener('click', function () {
                    const menuSection = document.getElementById('menu-section');
                    if (menuSection) {
                        menuSection.scrollIntoView({ behavior: 'smooth' });
                        const paketFilterBtn = document.querySelector('[data-filter="paket"]');
                        if (paketFilterBtn) paketFilterBtn.click();
                    }
                });
            }

            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href');
                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        targetElement.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }
                });
            });
        });

        // CSS for badge pulse animation
        document.head.insertAdjacentHTML('beforeend', `
            <style>
                @keyframes badgePulse {
                    0% { transform: scale(1); }
                    50% { transform: scale(1.3); }
                    100% { transform: scale(1); }
                }

                .badge-pulse {
                    animation: badgePulse 0.5s ease-in-out;
                }

                @keyframes slideIn {
                    from { transform: translateX(100%); opacity: 0; }
                    to { transform: translateX(0); opacity: 1; }
                }

                @keyframes slideOut {
                    from { transform: translateX(0); opacity: 1; }
                    to { transform: translateX(100%); opacity: 0; }
                }

                .menu-item {
                    transition: opacity 0.3s ease, transform 0.3s ease;
                }

                .menu-card {
                    transition: transform 0.3s ease, box-shadow 0.3s ease;
                }

                .btn-hover-effect {
                    transition: all 0.3s ease;
                    overflow: hidden;
                    position: relative;
                    z-index: 1;
                }

                .btn-hover-effect:after {
                    content: '';
                    position: absolute;
                    bottom: 0;
                    left: 0;
                    width: 100%;
                    height: 0;
                    background-color: var(--dark-orange);
                    transition: all 0.3s ease;
                    z-index: -1;
                }

                .btn-hover-effect:hover:after {
                    height: 100%;
                }

                .promo-banner {
                    background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('{{ asset('images/promo-bg.jpg') }}') no-repeat center center;
                    background-size: cover;
                    background-attachment: fixed;
                    border-radius: 15px;
                    overflow: hidden;
                    position: relative;
                    padding: 3rem 0;
                }

                .promo-content {
                    position: relative;
                    z-index: 2;
                }

                .countdown-item {
                    display: flex;
                    flex-direction: column;
                    justify-content: center;
                    align-items: center;
                    min-width: 70px;
                    height: 70px;
                    border-radius: 10px;
                    padding: 0.5rem;
                }

                .countdown-number {
                    font-size: 1.5rem;
                    font-weight: bold;
                }

                .countdown-label {
                    font-size: 0.8rem;
                    text-transform: uppercase;
                }

                .featured-products {
                    box-shadow: 0 5px 20px rgba(0,0,0,0.05);
                    padding: 2rem;
                }

                .featured-icon {
                    width: 100px;
                    height: 100px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    border-radius: 50%;
                    margin: 0 auto;
                    transition: all 0.3s ease;
                }

                .featured-item:hover .featured-icon {
                    transform: translateY(-10px);
                    box-shadow: 0 10px 20px rgba(255, 138, 0, 0.15);
                }

                .section-title {
                    position: relative;
                    display: inline-block;
                    padding-bottom: 10px;
                    margin-bottom: 20px;
                }

                .section-title:after {
                    content: '';
                    position: absolute;
                    width: 50%;
                    height: 3px;
                    bottom: 0;
                    left: 25%;
                    border-radius: 10px;
                }

                .promo-badge {
                    width: 150px;
                    height: 150px;
                    background-color: var(--primary-orange);
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    box-shadow: 0 0 30px rgba(255, 138, 0, 0.5);
                    animation: pulse 2s infinite;
                }

                .badge-content {
                    text-align: center;
                }

                .badge-number {
                    font-size: 3rem;
                    font-weight: bold;
                    line-height: 1;
                }

                .badge-text {
                    font-size: 1rem;
                    text-transform: uppercase;
                    font-weight: bold;
                }

                @keyframes pulse {
                    0% {
                        transform: scale(1);
                        box-shadow: 0 0 0 0 rgba(255, 138, 0, 0.7);
                    }
                    70% {
                        transform: scale(1.05);
                        box-shadow: 0 0 0 10px rgba(255, 138, 0, 0);
                    }
                    100% {
                        transform: scale(1);
                        box-shadow: 0 0 0 0 rgba(255, 138, 0, 0);
                    }
                }

                .card-img-container {
                    position: relative;
                    overflow: hidden;
                }

                .card-img-container img {
                    transition: transform 0.5s ease;
                }

                .menu-card:hover .card-img-container img {
                    transform: scale(1.1);
                }

                .gradient-overlay {
                    background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0) 50%);
                    opacity: 0;
                    transition: opacity 0.3s ease;
                }

                .menu-card:hover .gradient-overlay {
                    opacity: 1;
                }

                .quick-view {
                    position: absolute;
                    bottom: 10px;
                    right: 10px;
                    transform: translateY(20px);
                    opacity: 0;
                    transition: all 0.3s ease;
                }

                .menu-card:hover .quick-view {
                    transform: translateY(0);
                    opacity: 1;
                }

                .badge-container {
                    position: absolute;
                    top: 10px;
                    left: 10px;
                    z-index: 2;
                }

                .hero-banner {
                    height: 60vh;
                    min-height: 400px;
                    position: relative;
                }

                .text-shadow {
                    text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
                }

                .min-vh-50 {
                    min-height: 50vh;
                }

                .nutrition-info {
                    background-color: var(--light-orange) !important;
                    border-left: 4px solid var(--primary-orange);
                }

                .nutrition-icon {
                    width: 30px;
                    height: 30px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    border-radius: 50%;
                    background-color: rgba(255, 138, 0, 0.1);
                }

                .modal-content {
                    overflow: hidden;
                }

                .modal-header {
                    background-color: transparent;
                }

                /* Enhanced user experience */
                ::selection {
                    background-color: var(--primary-orange);
                    color: white;
                }

                /* Custom scrollbar */
                ::-webkit-scrollbar {
                    width: 8px;
                }

                ::-webkit-scrollbar-track {
                    background: #f1f1f1;
                }

                ::-webkit-scrollbar-thumb {
                    background: var(--primary-orange);
                    border-radius: 10px;
                }

                ::-webkit-scrollbar-thumb:hover {
                    background: var(--secondary-orange);
                }

                /* Mobile optimizations */
                @media (max-width: 767px) {
                    .filter-tabs {
                        overflow-x: auto;
                        white-space: nowrap;
                        flex-wrap: nowrap;
                        padding-bottom: 10px;
                        margin-bottom: 10px;
                    }

                    .filter-tabs .nav-link {
                        padding: 8px 15px;
                        font-size: 0.9rem;
                    }

                    .countdown-item {
                        min-width: 60px;
                        height: 60px;
                    }

                    .countdown-number {
                        font-size: 1.2rem;
                    }

                    .promo-badge {
                        width: 120px;
                        height: 120px;
                        margin: 0 auto;
                    }

                    .badge-number {
                        font-size: 2.5rem;
                    }

                    .hero-banner {
                        height: 50vh;
                    }

                    .display-3 {
                        font-size: 2.5rem;
                    }

                    .lead {
                        font-size: 1rem;
                    }
                }
            </style>
        `);
    </script>
@endsection

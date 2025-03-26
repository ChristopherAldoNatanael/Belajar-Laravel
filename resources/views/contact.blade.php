@extends('layouts.app')
@section('title', 'Contact')

@section('content')
<style>
    body {
        color: #333333;
        background-color: #FFF0E0;
        font-family: 'Poppins', sans-serif;
    }

    .page-container {
        padding: 60px 0;
        background-color: #FFF0E0;
    }

    .contact-container {
        background-color: #FFFFFF;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        position: relative;
        margin-bottom: 60px;
    }

    /* Header */
    .contact-header {
        text-align: center;
        padding: 50px 0;
        background: linear-gradient(135deg, #FF7D00 0%, #FF5100 100%);
        position: relative;
        overflow: hidden;
    }

    .contact-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        opacity: 0.08;
    }

    .contact-title {
        color: #FFFFFF;
        font-size: 3rem;
        font-weight: 800;
        margin-bottom: 0;
        position: relative;
        display: inline-block;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .contact-subtitle {
        color: rgba(255, 255, 255, 0.9);
        font-size: 1.2rem;
        margin-top: 15px;
        font-weight: 300;
    }

    /* Content wrapper */
    .content-wrapper {
        height: 1400px;
        padding: 50px;
        position: relative;
    }

    /* Decorative elements */
    .decoration-element {
        position: absolute;
        z-index: 0;
    }

    .decoration-circle {
        border-radius: 50%;
        background: linear-gradient(45deg, #FF7D00, #FF5100);
        opacity: 0.05;
    }

    .decoration-circle-1 {
        width: 300px;
        height: 300px;
        top: -100px;
        right: -150px;
    }

    .decoration-circle-2 {
        width: 200px;
        height: 200px;
        bottom: -50px;
        left: -100px;
    }

    .decoration-dots {
        position: absolute;
        width: 180px;
        height: 180px;
        background-image: radial-gradient(#FF7D00 1px, transparent 1px);
        background-size: 15px 15px;
        opacity: 0.2;
    }

    .decoration-dots-1 {
        top: 20px;
        left: -50px;
    }

    .decoration-dots-2 {
        bottom: 40px;
        right: -30px;
    }

    /* Contact info section */
    .contact-info-section {
        background: linear-gradient(135deg, #FF7D00 0%, #FF5100 100%);
        border-radius: 16px;
        color: #FFFFFF;
        padding: 40px;
        height: 100%;
        box-shadow: 0 15px 35px rgba(255, 81, 0, 0.2);
        position: relative;
        overflow: hidden;
        transform: translateY(-50px);
    }

    .contact-info-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        opacity: 0.08;
    }

    .info-section-title {
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 30px;
        position: relative;
        padding-bottom: 15px;
    }

    .info-section-title::after {
        content: "";
        position: absolute;
        width: 60px;
        height: 3px;
        background-color: #FFFFFF;
        bottom: 0;
        left: 0;
        border-radius: 10px;
    }

    .contact-item {
        display: flex;
        align-items: flex-start;
        margin-bottom: 25px;
        transition: all 0.3s ease;
        padding: 18px;
        border-radius: 12px;
        background-color: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(5px);
    }

    .contact-item:hover {
        background-color: rgba(255, 255, 255, 0.2);
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
    }

    .contact-icon {
        margin-right: 18px;
        font-size: 20px;
        color: #FFFFFF;
        flex-shrink: 0;
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: rgba(255, 255, 255, 0.15);
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .contact-item:hover .contact-icon {
        background-color: #FFFFFF;
        color: #FF7D00;
    }

    .contact-content h3 {
        font-size: 1.1rem;
        margin-bottom: 8px;
        font-weight: 600;
        color: #FFFFFF;
    }

    .contact-text {
        font-size: 1rem;
        margin-bottom: 0;
        line-height: 1.5;
    }

    /* Office hours */
    .office-hours {
        margin-top: 35px;
        padding: 25px;
        border-radius: 12px;
        background-color: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(5px);
    }

    .hours-title {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 20px;
        color: #FFFFFF;
        text-align: center;
        position: relative;
        padding-bottom: 12px;
    }

    .hours-title::after {
        content: "";
        position: absolute;
        width: 40px;
        height: 2px;
        background-color: #FFFFFF;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        border-radius: 10px;
    }

    .hours-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 12px;
        padding-bottom: 12px;
        border-bottom: 1px dashed rgba(255, 255, 255, 0.2);
    }

    .hours-item:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .day {
        font-weight: 500;
    }

    .time {
        font-weight: 600;
    }

    /* Social media links */
    .social-links {
        margin-top: 35px;
        display: flex;
        gap: 12px;
        justify-content: center;
    }

    .social-link {
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background-color: rgba(255, 255, 255, 0.15);
        color: #FFFFFF;
        transition: all 0.3s ease;
    }

    .social-link:hover {
        background-color: #FFFFFF;
        color: #FF7D00;
        transform: translateY(-5px);
        box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
    }

    /* Form section */
    .form-section {
        background-color: #FFFFFF;
        border-radius: 16px;
        padding: 40px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.05);
        height: 100%;
        position: relative;
        z-index: 1;
    }

    .form-section-title {
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 30px;
        position: relative;
        padding-bottom: 15px;
        color: #333333;
    }

    .form-section-title::after {
        content: "";
        position: absolute;
        width: 60px;
        height: 3px;
        background: linear-gradient(135deg, #FF7D00 0%, #FF5100 100%);
        bottom: 0;
        left: 0;
        border-radius: 10px;
    }

    .form-control {
        border: 2px solid #F0F0F0;
        border-radius: 12px;
        padding: 15px 20px;
        height: auto;
        background-color: #FFFFFF;
        transition: all 0.3s ease;
        margin-bottom: 20px;
        font-size: 1rem;
    }

    .form-control:focus {
        border-color: #FF7D00;
        box-shadow: 0 0 0 0.2rem rgba(255, 125, 0, 0.1);
        background-color: #FFFFFF;
    }

    .form-control::placeholder {
        color: #ADB5BD;
        font-weight: 300;
    }

    .submit-btn {
        background: linear-gradient(135deg, #FF7D00 0%, #FF5100 100%);
        border: none;
        color: #FFFFFF;
        padding: 15px 35px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 1rem;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        box-shadow: 0 10px 20px rgba(255, 81, 0, 0.2);
        position: relative;
        overflow: hidden;
        z-index: 1;
    }

    .submit-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #FF5100 0%, #FF7D00 100%);
        transition: all 0.3s ease;
        z-index: -1;
    }

    .submit-btn:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(255, 81, 0, 0.3);
    }

    .submit-btn:hover::before {
        left: 0;
    }

   /* Map section - updated */
.map-section {
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.05);
    margin-top: 40px;
    position: relative;
    margin-left: auto;
    margin-right: auto;
    max-width: 100%;
    height: 450px; /* Fixed height */
}

.map-section iframe {
    width: 100%;
    height: 100%;
    border: none;
    border-radius: 16px;
    transition: all 0.3s ease;
}

/* Add a hover effect to make the map more interactive */
.map-section:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(255, 81, 0, 0.15);
}

/* Add a decorative gradient overlay at the bottom */
.map-section::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 80px;
    background: linear-gradient(to top, rgba(255, 240, 224, 0.8), transparent);
    pointer-events: none;
    border-bottom-left-radius: 16px;
    border-bottom-right-radius: 16px;
}

/* Add subtle animation to the map when it comes into view */
.map-animate {
    animation: mapFadeIn 0.8s ease-out forwards;
}

@keyframes mapFadeIn {
    from {
        opacity: 0;
        transform: scale(0.95);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

/* Add an attractive info badge on the map */
.map-badge {
    position: absolute;
    top: 20px;
    left: 20px;
    background: linear-gradient(135deg, #FF7D00 0%, #FF5100 100%);
    color: white;
    padding: 10px 20px;
    border-radius: 30px;
    font-weight: 600;
    font-size: 0.9rem;
    box-shadow: 0 5px 15px rgba(255, 81, 0, 0.2);
    z-index: 10;
    display: flex;
    align-items: center;
    animation: pulse 2s infinite;
}

.map-badge i {
    margin-right: 8px;
}

/* Custom content-wrapper height for better layout */
.content-wrapper {
    height: auto;
    min-height: 1600px;
    padding: 50px;
    position: relative;
}

/* More responsive adjustments */
@media (max-width: 992px) {
    .map-section {
        height: 350px;
    }
}

@media (max-width: 576px) {
    .map-section {
        height: 300px;
    }

    .map-badge {
        font-size: 0.8rem;
        padding: 8px 15px;
    }
}
    /* Floating contact button */
    .floating-contact {
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #FF7D00 0%, #FF5100 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #FFFFFF;
        font-size: 24px;
        box-shadow: 0 10px 20px rgba(255, 81, 0, 0.3);
        z-index: 100;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .floating-contact:hover {
        transform: scale(1.1) rotate(10deg);
    }

    /* Animations */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }

    .fade-in {
        opacity: 0;
        animation: fadeInUp 0.6s forwards;
    }

    .pulse {
        animation: pulse 2s infinite;
    }

    .delay-1 { animation-delay: 0.1s; }
    .delay-2 { animation-delay: 0.2s; }
    .delay-3 { animation-delay: 0.3s; }
    .delay-4 { animation-delay: 0.4s; }
    .delay-5 { animation-delay: 0.5s; }

    /* Form floating labels */
    .form-floating {
        position: relative;
        margin-bottom: 20px;
    }

    .form-floating > .form-control {
        padding: 25px 20px 10px;
    }

    .form-floating > label {
        position: absolute;
        top: 0;
        left: 0;
        padding: 15px 20px;
        pointer-events: none;
        transition: all 0.3s ease;
        color: #ADB5BD;
    }

    .form-floating > .form-control:focus ~ label,
    .form-floating > .form-control:not(:placeholder-shown) ~ label {
        transform: translateY(-8px) scale(0.8);
        padding: 8px 20px;
        color: #FF7D00;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .content-wrapper {
            padding: 30px;
        }

        .contact-info-section {
            transform: translateY(0);
            margin-bottom: 30px;
        }
    }

    @media (max-width: 768px) {
        .contact-title {
            font-size: 2.2rem;
        }

        .contact-header {
            padding: 30px 0;
        }

        .form-section, .contact-info-section {
            padding: 30px;
        }
    }

    @media (max-width: 576px) {
        .content-wrapper {
            padding: 20px;
        }

        .contact-item {
            padding: 15px;
        }

        .contact-icon {
            width: 40px;
            height: 40px;
            font-size: 18px;
        }
    }
</style>

<div class="page-container mt-5">
    <div class="container">
        <div class="contact-container">
            <!-- Decorative elements -->
            <div class="decoration-element decoration-circle decoration-circle-1"></div>
            <div class="decoration-element decoration-circle decoration-circle-2"></div>
            <div class="decoration-element decoration-dots decoration-dots-1"></div>
            <div class="decoration-element decoration-dots decoration-dots-2"></div>

            <!-- Header -->
            <div class="contact-header">
                <h1 class="contact-title fade-in">Hubungi Kami</h1>
                <p class="contact-subtitle fade-in delay-1">Kami siap membantu dan mendengarkan Anda</p>
            </div>

            <!-- Content -->
            <div class="content-wrapper">
                <div class="row g-4">
                    <!-- Contact Information -->
                    <div class="col-lg-5">
                        <div class="contact-info-section fade-in delay-2">
                            <h2 class="info-section-title">Informasi Kontak</h2>

                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-phone-alt"></i>
                                </div>
                                <div class="contact-content">
                                    <h3>Telepon</h3>
                                    <p class="contact-text">0812-3456-7890</p>
                                </div>
                            </div>

                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="contact-content">
                                    <h3>Email</h3>
                                    <p class="contact-text">info@jossgandos.com</p>
                                </div>
                            </div>

                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="contact-content">
                                    <h3>Alamat</h3>
                                    <p class="contact-text">Jl. Rasa No. 123, Jakarta</p>
                                </div>
                            </div>

                            <div class="office-hours">
                                <h3 class="hours-title">Jam Operasional</h3>
                                <div class="hours-item">
                                    <span class="day">Senin - Jumat:</span>
                                    <span class="time">08:00 - 17:00</span>
                                </div>
                                <div class="hours-item">
                                    <span class="day">Sabtu:</span>
                                    <span class="time">09:00 - 14:00</span>
                                </div>
                                <div class="hours-item">
                                    <span class="day">Minggu:</span>
                                    <span class="time">Tutup</span>
                                </div>
                            </div>

                            <div class="social-links">
                                <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                                <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                                <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                                <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#" class="social-link"><i class="fab fa-whatsapp"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Form -->
                    <div class="col-lg-7">
                        <div class="form-section fade-in delay-3">
                            <h2 class="form-section-title">Kirim Pesan</h2>
                            <form id="contactForm">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="name" placeholder=" " required>
                                            <label for="name">Nama Lengkap</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="email" class="form-control" id="email" placeholder=" " required>
                                            <label for="email">Email</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="phone" placeholder=" ">
                                            <label for="phone">Nomor Telepon</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <select class="form-control" id="subject">
                                                <option value="" selected disabled></option>
                                                <option value="general">Pertanyaan Umum</option>
                                                <option value="support">Dukungan Teknis</option>
                                                <option value="sales">Informasi Produk</option>
                                                <option value="other">Lainnya</option>
                                            </select>
                                            <label for="subject">Pilih Subjek</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-floating">
                                    <textarea class="form-control" id="message" rows="5" placeholder=" " style="height: 150px" required></textarea>
                                    <label for="message">Pesan Anda</label>
                                </div>
                                <div class="text-end mt-4">
                                    <button type="submit" class="submit-btn">
                                        <i class="fas fa-paper-plane me-2"></i>Kirim Pesan
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Map -->
                       <!-- Map -->
                        <div class="map-section fade-in delay-4 map-animate">
                           
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d253840.65638893528!2d106.66470218569141!3d-6.229379589617692!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3e945e34b9d%3A0x5371bf0fdad786a2!2sJakarta%2C%20Daerah%20Khusus%20Ibukota%20Jakarta!5e0!3m2!1sid!2sid!4v1742480092883!5m2!1sid!2sid" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Floating contact button -->
<div class="floating-contact pulse">
    <i class="fas fa-headset"></i>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animation on scroll
        function animateOnScroll() {
            const elements = document.querySelectorAll('.fade-in');
            elements.forEach(element => {
                const elementPosition = element.getBoundingClientRect().top;
                const windowHeight = window.innerHeight;
                if (elementPosition < windowHeight - 50) {
                    element.style.opacity = 1;
                    element.style.transform = 'translateY(0)';
                }
            });
        }

        // Call on page load
        animateOnScroll();

        // Call on scroll
        window.addEventListener('scroll', animateOnScroll);


        // Form validation and submission
        const contactForm = document.getElementById('contactForm');
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();

            // Get form values
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const phone = document.getElementById('phone').value;
            const subject = document.getElementById('subject').value;
            const message = document.getElementById('message').value;

            // Here you would normally send the data to your server
            // For demonstration, we'll just show an alert

            // Show loading animation
            const submitBtn = contactForm.querySelector('.submit-btn');
            const originalBtnText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Mengirim...';
            submitBtn.disabled = true;

            // Simulate form submission with delay
            setTimeout(function() {
                // Reset form
                contactForm.reset();

                // Show success message
                const formSection = document.querySelector('.form-section');
                const successAlert = document.createElement('div');
                successAlert.className = 'alert alert-success mt-4 fade-in';
                successAlert.innerHTML = '<i class="fas fa-check-circle me-2"></i>Pesan Anda telah berhasil dikirim. Kami akan menghubungi Anda segera.';
                formSection.appendChild(successAlert);

                // Reset button
                submitBtn.innerHTML = originalBtnText;
                submitBtn.disabled = false;

                // Remove success message after 5 seconds
                setTimeout(function() {
                    successAlert.remove();
                }, 5000);
            }, 1500);
        });

        // Floating contact button functionality
        const floatingContact = document.querySelector('.floating-contact');
        floatingContact.addEventListener('click', function() {
            // Scroll to contact form
            const formSection = document.querySelector('.form-section');
            formSection.scrollIntoView({ behavior: 'smooth' });

            // Focus on first input
            setTimeout(function() {
                document.getElementById('name').focus();
            }, 800);
        });
    });
</script>
@endsection

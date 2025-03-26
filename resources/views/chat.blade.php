@extends('layouts.app')
@section('title', 'Chat')
@section('content')
<div class="container py-5 mt-5 mb-5">
    <div class="mt-5 pt-4">
        <h1 class="text-center mb-5 fw-bold text-orange animate__animated animate__fadeInDown">Chat dengan Kami</h1>
    </div>
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden animate__animated animate__zoomIn">
                <div class="card-header bg-gradient-orange text-white py-3">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-white p-2 me-3 pulse-animation">
                            <i class="fas fa-headset text-orange"></i>
                        </div>
                        <div>
                            <h5 class="mb-0">Customer Support</h5>
                            <small><span class="badge bg-success animate__animated animate__pulse animate__infinite">Online</span></small>
                        </div>
                        <div class="ms-auto">
                            <span class="badge bg-light text-orange">24/7</span>
                        </div>
                    </div>
                </div>
                <div class="card-body chat-box p-4" id="chat-box" style="height: 400px; overflow-y: auto; background-color: #fef8f3;">
                    <div class="d-flex justify-content-center mb-4">
                        <div class="px-4 py-2 rounded-pill bg-light text-center animate__animated animate__fadeIn">
                            <p class="text-muted mb-0">Hari ini</p>
                        </div>
                    </div>
                    <div class="chat-message-left p-3 mb-3 rounded-3 shadow-sm bg-white animate__animated animate__fadeInLeft">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <div class="avatar avatar-sm me-2">
                                    <div class="avatar-title rounded-circle bg-orange">
                                        <i class="fas fa-user-tie text-white"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <div class="fw-bold mb-1">Customer Service</div>
                                <p class="mb-0 typing-animation">Halo! Selamat datang di layanan chat kami. Ada yang bisa kami bantu hari ini?</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer border-0 bg-white p-4">
                    <p class="text-center mb-3 fw-bold text-orange animate__animated animate__fadeIn">Pilih masalah yang Anda alami:</p>
                    <div id="options" class="d-grid gap-2">
                        <div class="row g-2">
                            <div class="col-md-6">
                                <button class="btn btn-orange btn-hover-effect rounded-pill py-2 shadow-sm w-100 animate__animated animate__fadeInUp" onclick="sendMessage('Order tidak sampai')" style="animation-delay: 0.1s">
                                    <i class="fas fa-truck me-2 icon-shake"></i>Order tidak sampai
                                </button>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-orange btn-hover-effect rounded-pill py-2 shadow-sm w-100 animate__animated animate__fadeInUp" onclick="sendMessage('Produk cacat')" style="animation-delay: 0.2s">
                                    <i class="fas fa-exclamation-triangle me-2 icon-shake"></i>Produk cacat
                                </button>
                            </div>
                        </div>
                        <div class="row g-2 mt-1">
                            <div class="col-md-6">
                                <button class="btn btn-orange btn-hover-effect rounded-pill py-2 shadow-sm w-100 animate__animated animate__fadeInUp" onclick="sendMessage('Pengembalian barang')" style="animation-delay: 0.3s">
                                    <i class="fas fa-undo me-2 icon-shake"></i>Pengembalian barang
                                </button>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-orange btn-hover-effect rounded-pill py-2 shadow-sm w-100 animate__animated animate__fadeInUp" onclick="sendMessage('Status pesanan')" style="animation-delay: 0.4s">
                                    <i class="fas fa-clock me-2 icon-shake"></i>Status pesanan
                                </button>
                            </div>
                        </div>
                        <div class="row g-2 mt-1">
                            <div class="col-md-6">
                                <button class="btn btn-orange btn-hover-effect rounded-pill py-2 shadow-sm w-100 animate__animated animate__fadeInUp" onclick="sendMessage('Pembayaran')" style="animation-delay: 0.5s">
                                    <i class="fas fa-credit-card me-2 icon-shake"></i>Masalah pembayaran
                                </button>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-orange btn-hover-effect rounded-pill py-2 shadow-sm w-100 animate__animated animate__fadeInUp" onclick="sendMessage('Voucher')" style="animation-delay: 0.6s">
                                    <i class="fas fa-ticket-alt me-2 icon-shake"></i>Voucher & promo
                                </button>
                            </div>
                        </div>
                        <button class="btn btn-outline-orange btn-hover-effect rounded-pill py-2 shadow-sm animate__animated animate__fadeInUp" onclick="toggleCustomInput()" style="animation-delay: 0.7s">
                            <i class="fas fa-keyboard me-2"></i>Tulis pesan lain
                        </button>
                        <div id="custom-input" class="input-group mt-2 d-none animate__animated animate__fadeIn">
                            <input type="text" id="message-input" class="form-control rounded-pill-start border-orange" placeholder="Ketik pesan Anda...">
                            <button class="btn btn-orange rounded-pill-end" type="button" onclick="sendCustomMessage()">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4 animate__animated animate__fadeIn">
                <div class="d-flex justify-content-center gap-3">
                    <a href="#" class="text-orange hover-scale">
                        <i class="fas fa-phone-alt"></i> Telepon
                    </a>
                    <a href="#" class="text-orange hover-scale">
                        <i class="fas fa-envelope"></i> Email
                    </a>
                    <a href="#" class="text-orange hover-scale">
                        <i class="fab fa-whatsapp"></i> WhatsApp
                    </a>
                </div>
                <small class="text-muted d-block mt-2">Perlu bantuan lebih lanjut? <a href="#" class="text-orange fw-bold">Hubungi kami</a></small>
            </div>
        </div>
    </div>
</div>

<!-- Include Animate.css -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

<script>
    const responses = {
        'Order tidak sampai': [
            'Kami mohon maaf atas ketidaknyamanan ini. Kami akan segera memeriksa status pesanan Anda.',
            'Bisa tolong berikan nomor pesanan Anda agar kami bisa melacak keberadaan paket?',
            'Biasanya keterlambatan terjadi karena kendala pengiriman. Kami akan segera menghubungi kurir terkait.'
        ],
        'Produk cacat': [
            'Kami sangat menyesal mendengar bahwa produk Anda cacat. Kami akan membantu proses pengembalian.',
            'Apakah Anda sudah memiliki foto dari produk yang cacat? Hal ini akan membantu proses klaim.',
            'Kami akan memprioritaskan kasus Anda. Kerusakan produk akan kami tangani dalam 24 jam kerja.'
        ],
        'Pengembalian barang': [
            'Untuk pengembalian barang, silakan isi formulir pengembalian di situs kami.',
            'Anda bisa melakukan pengembalian dalam waktu 14 hari setelah barang diterima.',
            'Apakah Anda ingin menukar dengan produk yang sama atau mengembalikan dana?'
        ],
        'Status pesanan': [
            'Kami akan membantu Anda melacak pesanan. Bisa tolong berikan nomor pesanan?',
            'Status pesanan dapat dilihat melalui halaman "Pesanan Saya" di akun Anda.',
            'Biasanya pembaruan status pesanan memerlukan waktu 1-2 jam setelah proses terjadi.'
        ],
        'Pembayaran': [
            'Kami menyediakan berbagai metode pembayaran seperti transfer bank, kartu kredit, dan e-wallet.',
            'Apakah Anda mengalami masalah saat melakukan pembayaran? Kami siap membantu.',
            'Konfirmasi pembayaran biasanya diproses dalam waktu 10-30 menit setelah pembayaran berhasil.'
        ],
        'Voucher': [
            'Voucher dapat digunakan saat checkout dengan memasukkan kode promo.',
            'Beberapa voucher memiliki ketentuan minimum pembelian atau kategori produk tertentu.',
            'Kami sedang memiliki promo spesial bulan ini! Gunakan kode HAPPY23 untuk diskon 15%.'
        ],
        'Lainnya': [
            'Silakan jelaskan lebih lanjut tentang masalah Anda, dan kami akan membantu Anda.',
            'Tim kami siap membantu Anda dengan masalah apa pun yang Anda hadapi.',
            'Terima kasih telah menghubungi kami. Kami akan berusaha memberikan solusi terbaik.'
        ]
    };

    document.addEventListener('DOMContentLoaded', function() {
        // Tambahkan efek pulsing pada elemen tertentu saat halaman dimuat
        const elements = document.querySelectorAll('.animate__fadeIn');
        elements.forEach((element, index) => {
            element.style.animationDelay = `${index * 0.1}s`;
        });
    });

    function getRandomResponse(option) {
        const optionResponses = responses[option] || responses['Lainnya'];
        return optionResponses[Math.floor(Math.random() * optionResponses.length)];
    }

    function toggleCustomInput() {
        const customInput = document.getElementById('custom-input');
        customInput.classList.toggle('d-none');
        if (!customInput.classList.contains('d-none')) {
            document.getElementById('message-input').focus();
        }
    }

    function sendCustomMessage() {
        const messageInput = document.getElementById('message-input');
        const message = messageInput.value.trim();
        if (message) {
            sendMessage(message);
            messageInput.value = '';
        }
    }

    function sendMessage(option) {
        const chatBox = document.getElementById('chat-box');

        // Create user message
        const userMessageDiv = document.createElement('div');
        userMessageDiv.className = 'chat-message-right p-3 mb-3 rounded-3 shadow-sm bg-orange text-white ms-auto animate__animated animate__fadeInRight';
        userMessageDiv.style.maxWidth = '75%';
        userMessageDiv.innerHTML = `
            <div class="d-flex justify-content-end">
                <div class="text-end">
                    <div class="fw-bold mb-1">Anda</div>
                    <p class="mb-0">${option}</p>
                </div>
                <div class="ms-2">
                    <div class="avatar avatar-sm">
                        <div class="avatar-title rounded-circle bg-white">
                            <i class="fas fa-user text-orange"></i>
                        </div>
                    </div>
                </div>
            </div>`;
        chatBox.appendChild(userMessageDiv);

        // Scroll to the bottom of the chat box
        chatBox.scrollTop = chatBox.scrollHeight;

        // Simulasi balasan dengan animasi mengetik
        setTimeout(() => {
            const typingIndicator = document.createElement('div');
            typingIndicator.className = 'chat-message-left p-3 mb-3 rounded-3 shadow-sm bg-light animate__animated animate__fadeIn';
            typingIndicator.innerHTML = `
                <div class="d-flex align-items-center">
                    <div class="avatar avatar-sm me-2">
                        <div class="avatar-title rounded-circle bg-orange">
                            <i class="fas fa-user-tie text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="typing">
                            <span class="dot"></span>
                            <span class="dot"></span>
                            <span class="dot"></span>
                        </div>
                    </div>
                </div>`;
            chatBox.appendChild(typingIndicator);
            chatBox.scrollTop = chatBox.scrollHeight;

            // Simulasi delay sebelum balasan muncul
            setTimeout(() => {
                chatBox.removeChild(typingIndicator); // Menghapus indikator mengetik

                // Pilih jawaban acak dari array respons
                const responseText = getRandomResponse(option);

                // Create response message
                const responseMessageDiv = document.createElement('div');
                responseMessageDiv.className = 'chat-message-left p-3 mb-3 rounded-3 shadow-sm bg-white animate__animated animate__fadeInLeft';
                responseMessageDiv.style.maxWidth = '75%';
                responseMessageDiv.innerHTML = `
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <div class="avatar avatar-sm me-2">
                                <div class="avatar-title rounded-circle bg-orange">
                                    <i class="fas fa-user-tie text-white"></i>
                                </div>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            <div class="fw-bold mb-1">Customer Service</div>
                            <p class="mb-0 typing-animation">${responseText}</p>
                        </div>
                    </div>`;
                chatBox.appendChild(responseMessageDiv);
                chatBox.scrollTop = chatBox.scrollHeight;

                // Tawaran bantuan tambahan setelah beberapa detik
                setTimeout(() => {
                    const followupMessageDiv = document.createElement('div');
                    followupMessageDiv.className = 'chat-message-left p-3 mb-3 rounded-3 shadow-sm bg-white animate__animated animate__fadeInLeft';
                    followupMessageDiv.style.maxWidth = '75%';
                    followupMessageDiv.innerHTML = `
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <div class="avatar avatar-sm me-2">
                                    <div class="avatar-title rounded-circle bg-orange">
                                        <i class="fas fa-user-tie text-white"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-2">
                                <div class="fw-bold mb-1">Customer Service</div>
                                <p class="mb-0 typing-animation">Ada hal lain yang bisa saya bantu?</p>
                            </div>
                        </div>`;
                    chatBox.appendChild(followupMessageDiv);
                    chatBox.scrollTop = chatBox.scrollHeight;
                }, 3000);
            }, 2000); // Delay 2 detik untuk simulasi balasan
        }, 1000); // Delay 1 detik untuk simulasi mengetik
    }

    // Press Enter to send
    document.getElementById('message-input')?.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            sendCustomMessage();
        }
    });

    // Add this to your JavaScript
    function removeTypingClass(element) {
        setTimeout(() => {
            element.classList.remove('typing-animation');
        }, 1000); // 1000ms matches your typing animation duration
    }

// Then call this function on each new message element after adding it to the DOM
</script>

<style>
    /* Warna oranye */
    :root {
        --orange-primary: #ff7a00;
        --orange-secondary: #ff9a40;
        --orange-light: #fff0e6;
        --orange-dark: #e56c00;
    }

    body {
        background-color: #fefaf7;
    }

    .text-orange {
        color: var(--orange-primary) !important;
    }

    .bg-orange {
        background-color: var(--orange-primary) !important;
    }

    .border-orange {
        border-color: var(--orange-primary) !important;
    }

    .btn-orange {
        background-color: var(--orange-primary);
        color: white;
        transition: all 0.3s ease;
    }

    .btn-orange:hover, .btn-orange:focus {
        background-color: var(--orange-dark);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 122, 0, 0.3);
    }

    .btn-outline-orange {
        color: var(--orange-primary);
        border-color: var(--orange-primary);
        transition: all 0.3s ease;
    }

    .btn-outline-orange:hover, .btn-outline-orange:focus {
        background-color: var(--orange-light);
        color: var(--orange-dark);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 122, 0, 0.1);
    }

    .bg-gradient-orange {
        background: linear-gradient(135deg, var(--orange-primary), var(--orange-dark));
    }

    .chat-message-left p,
    .chat-message-right p {
        word-wrap: break-word;
        white-space: normal !important;
        width: 100%;
    }

    .avatar-sm {
        width: 32px;
        height: 32px;
        line-height: 32px;
        text-align: center;
    }

    .rounded-4 {
        border-radius: 1rem !important;
    }

    .rounded-pill-start {
        border-top-left-radius: 50rem !important;
        border-bottom-left-radius: 50rem !important;
    }

    .rounded-pill-end {
        border-top-right-radius: 50rem !important;
        border-bottom-right-radius: 50rem !important;
    }

    .typing {
        display: flex;
        align-items: center;
    }

    .typing .dot {
        margin: 0 2px;
        animation: typingAnimation 1.5s infinite ease-in-out;
        background-color: var(--orange-primary);
        border-radius: 50%;
        display: inline-block;
        height: 7px;
        width: 7px;
    }

    .typing .dot:nth-child(1) {
        animation-delay: 0s;
    }

    .typing .dot:nth-child(2) {
        animation-delay: 0.2s;
    }

    .typing .dot:nth-child(3) {
        animation-delay: 0.4s;
    }

    /* Efek mengetik untuk pesan */
    @keyframes typing {
        from { width: 0 }
        to { width: 100% }
    }

    /* Removing the typing animation that forces nowrap */
    .typing-animation {
        overflow: visible;
        white-space: normal;
        animation: none;
    }

    @keyframes typingAnimation {
        0% {
            transform: translateY(0px);
            background-color: rgba(255, 122, 0, 0.7);
        }
        28% {
            transform: translateY(-5px);
            background-color: rgba(255, 122, 0, 1);
        }
        44% {
            transform: translateY(0px);
            background-color: rgba(255, 122, 0, 0.7);
        }
    }

    /* Pulse animation */
    .pulse-animation {
        animation: pulse 2s infinite;
        box-shadow: 0 0 0 rgba(255, 122, 0, 0.4);
    }

    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(255, 122, 0, 0.7);
        }
        70% {
            box-shadow: 0 0 0 10px rgba(255, 122, 0, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(255, 122, 0, 0);
        }
    }

    /* Hover scale effect */
    .hover-scale {
        transition: transform 0.3s ease;
    }

    .hover-scale:hover {
        transform: scale(1.1);
        text-decoration: none;
    }

    /* Button hover effect */
    .btn-hover-effect {
        position: relative;
        overflow: hidden;
        z-index: 1;
    }

    .btn-hover-effect::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.1);
        z-index: -2;
        transform: scaleX(0);
        transform-origin: right;
        transition: transform 0.5s ease;
    }

    .btn-hover-effect:hover::after {
        transform: scaleX(1);
        transform-origin: left;
    }

    /* Icon shake animation */
    .icon-shake {
        display: inline-block;
    }

    .btn:hover .icon-shake {
        animation: shake 0.5s ease-in-out;
    }

    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        20%, 60% { transform: translateX(-2px); }
        40%, 80% { transform: translateX(2px); }
    }
</style>

@endsection

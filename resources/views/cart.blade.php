@extends('layouts.app')
@section('title', 'Keranjang Belanja')
@section('content')

<link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/cart.css') }}">

<div class="cart-hero py-5">
    <div class="container">
        <div class="row mb-5 text-center" data-aos="fade-down" data-aos-duration="800">
            <div class="col-12">
                <h1 class="display-4 fw-bold">
                    <span class="badge-cart-title">KERANJANG BELANJA</span>
                </h1>
                <p class="lead mt-3" data-aos="fade-up" data-aos-delay="200">Lihat dan kelola pesanan Anda sebelum checkout</p>
            </div>
        </div>

        @if($cartItems->isEmpty())
            <div class="row justify-content-center" data-aos="zoom-in" data-aos-duration="1000">
                <div class="col-lg-6 text-center">
                    <div class="empty-cart-card">
                        <div class="empty-cart-icon">
                            <i class="bi bi-cart-x"></i>
                        </div>
                        <h3 class="fw-bold mt-4 mb-4">Keranjang Anda Kosong</h3>
                        <a href="{{ route('menu.index') }}" class="btn btn-primary btn-shop-now">
                            <i class="bi bi-menu-button-wide me-2"></i> Lihat Menu
                        </a>
                    </div>
                </div>
            </div>
        @else
            <div class="row" data-aos="fade-up" data-aos-duration="800">
                <div class="col-12">
                    <div class="cart-content-card">
                        <div class="card-header-custom">
                            <h3 class="fw-bold mb-0"><i class="bi bi-cart-check me-2"></i> Isi Keranjang Anda</h3>
                        </div>
                        <div class="card-body p-4">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle cart-table">
                                    <thead>
                                        <tr>
                                            <th style="width: 40%;">Produk</th>
                                            <th style="width: 15%;">Harga</th>
                                            <th style="width: 20%;">Jumlah</th>
                                            <th style="width: 15%;">Total</th>
                                            <th style="width: 10%;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($cartItems as $item)
                                            <tr data-aos="fade-left" data-aos-delay="{{ $loop->index * 100 }}" data-item-id="{{ $item->id }}">
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="product-img-wrapper me-3">
                                                            <img src="{{ asset('gambar/' . $item->menu->gambar) }}" alt="{{ $item->menu->menu }}" class="product-img">
                                                        </div>
                                                        <div class="product-info">
                                                            <span class="product-name">{{ $item->menu->menu }}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="price">Rp {{ number_format($item->menu->harga, 0, ',', '.') }}</td>
                                                <td>
                                                    <div class="quantity-selector">
                                                        <button class="btn-qty decrease-qty" data-id="{{ $item->id }}">
                                                            <i class="bi bi-dash"></i>
                                                        </button>
                                                        <input type="number" class="quantity-input" value="{{ $item->quantity }}" min="1" max="99" data-id="{{ $item->id }}" readonly>
                                                        <button class="btn-qty increase-qty" data-id="{{ $item->id }}">
                                                            <i class="bi bi-plus"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                                <td class="item-total">Rp {{ number_format($item->menu->harga * $item->quantity, 0, ',', '.') }}</td>
                                                <td>
                                                    <button class="btn-remove remove-item" data-id="{{ $item->id }}">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="cart-summary" data-aos="fade-up">
                                <div class="row align-items-center">
                                    <div class="col-md-8 col-lg-9">
                                        <div class="cart-total">
                                            <span>Total Keseluruhan:</span>
                                            <span id="cart-total">Rp {{ number_format($cartItems->sum(fn($item) => $item->menu->harga * $item->quantity), 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-3">
                                        <a href="{{ route('order.show') }}" class="btn-checkout">
                                            <span>Checkout</span>
                                            <i class="bi bi-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    AOS.init({
        once: true,
        duration: 800,
        easing: 'ease-out-cubic'
    });

    // Format Rupiah
    function formatRupiah(number) {
        return 'Rp ' + number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }

    // Update Total Harga Keranjang
    function updateCartTotal() {
        let total = 0;
        document.querySelectorAll('.item-total').forEach(item => {
            total += parseInt(item.textContent.replace(/\D/g, ''));
        });
        document.getElementById('cart-total').textContent = formatRupiah(total);
    }

    // Update Jumlah Item
    function updateItemQuantity(id, quantity) {
        fetch(`/cart/update/${id}`, {
            method: 'PUT',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ quantity: quantity })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const itemRow = document.querySelector(`tr[data-item-id="${id}"]`);
                const price = parseInt(itemRow.querySelector('.price').textContent.replace(/\D/g, ''));
                const newTotal = price * quantity;
                itemRow.querySelector('.item-total').textContent = formatRupiah(newTotal);
                updateCartTotal();

                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Jumlah item berhasil diperbarui',
                    icon: 'success',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 1500
                });
            } else {
                throw new Error(data.message || 'Gagal memperbarui jumlah item');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                title: 'Error!',
                text: 'Gagal memperbarui jumlah item',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        });
    }

    // Tombol Tambah Jumlah
    document.querySelectorAll('.increase-qty').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const inputEl = this.parentElement.querySelector('.quantity-input');
            let quantity = parseInt(inputEl.value);

            if (quantity < 99) {
                quantity += 1;
                inputEl.value = quantity;
                updateItemQuantity(id, quantity);
            }
        });
    });

    // Tombol Kurangi Jumlah
    document.querySelectorAll('.decrease-qty').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const inputEl = this.parentElement.querySelector('.quantity-input');
            let quantity = parseInt(inputEl.value);

            if (quantity > 1) {
                quantity -= 1;
                inputEl.value = quantity;
                updateItemQuantity(id, quantity);
            }
        });
    });

    // Tombol Hapus Item
    document.querySelectorAll('.remove-item').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const itemRow = this.closest('tr');

            Swal.fire({
                title: 'Hapus Item?',
                text: 'Apakah Anda yakin ingin menghapus item ini dari keranjang?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/cart/remove/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            itemRow.remove();
                            updateCartTotal();

                            Swal.fire({
                                title: 'Dihapus!',
                                text: 'Item berhasil dihapus dari keranjang',
                                icon: 'success',
                                timer: 1500,
                                showConfirmButton: false
                            });

                            // Jika keranjang kosong, reload halaman
                            if (document.querySelectorAll('.cart-table tbody tr').length === 0) {
                                window.location.reload();
                            }
                        } else {
                            throw new Error(data.message || 'Gagal menghapus item');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            title: 'Error!',
                            text: 'Gagal menghapus item dari keranjang',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    });
                }
            });
        });
    });
});
</script>
@endsection

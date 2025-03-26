@extends('layouts.app')
@section('title', 'Order History - Ayam Goreng Jos Gandos')
@section('content')

<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
    body {
        background-color: #f5f7fa;
        background-image: none; /* Removed background image for clarity */
    }
    .page-container {
        position: relative;
        margin-top: 7rem; /* Increased top margin for more space */
    }
    .page-container:before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 250px; /* Increased height for better coverage */
        background: linear-gradient(135deg, #334155 0%, #1e293b 100%);
        z-index: -1;
        border-bottom-left-radius: 30% 5%;
        border-bottom-right-radius: 30% 5%;
    }
    .order-card {
        background: white;
        border-radius: 12px;
        transition: all 0.3s ease;
        box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        overflow: hidden;
        border: 1px solid rgba(0,0,0,0.05);
        position: relative;
    }
    .order-card:hover {
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        transform: translateY(-5px);
    }
    .order-card:before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 6px;
        height: 100%;
    }
    .status-pending:before {
        background: linear-gradient(to bottom, #F59E0B, #D97706);
    }
    .status-processing:before {
        background: linear-gradient(to bottom, #3B82F6, #2563EB);
    }
    .status-completed:before {
        background: linear-gradient(to bottom, #10B981, #059669);
    }
    .status-cancelled:before {
        background: linear-gradient(to bottom, #EF4444, #DC2626);
    }
    .order-header {
        border-bottom: 1px solid #edf2f7;
        position: relative;
        overflow: hidden;
    }
    .order-header:after {
        content: "";
        position: absolute;
        bottom: -10px;
        right: -10px;
        width: 100px;
        height: 100px;
        background: radial-gradient(circle, rgba(243,244,246,0.8) 0%, rgba(243,244,246,0) 70%);
        z-index: 1;
    }
    .status-badge {
        padding: 0.4rem 1.2rem;
        border-radius: 30px;
        font-size: 0.75rem;
        font-weight: 600;
        letter-spacing: 0.03em;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        position: relative;
        overflow: hidden;
    }
    .status-badge:before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0) 100%);
    }
    .status-pending {
        background-color: #FEF3C7;
        color: #92400E;
    }
    .status-processing {
        background-color: #DBEAFE;
        color: #1E40AF;
    }
    .status-completed {
        background-color: #D1FAE5;
        color: #065F46;
    }
    .status-cancelled {
        background-color: #FEE2E2;
        color: #991B1B;
    }
    .action-button {
        border-radius: 8px;
        padding: 0.5rem 1.25rem;
        transition: all 0.2s ease;
        font-weight: 500;
        position: relative;
        overflow: hidden;
        z-index: 1;
    }
    .action-button:before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0) 100%);
        z-index: -1;
    }
    .action-button:hover {
        transform: translateY(-2px);
    }
    .empty-state {
        background: white;
        border-radius: 16px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        position: relative;
        overflow: hidden;
    }
    .empty-state:before {
        content: "";
        position: absolute;
        top: -50px;
        right: -50px;
        width: 150px;
        height: 150px;
        background: radial-gradient(circle, rgba(243,244,246,0.8) 0%, rgba(243,244,246,0) 70%);
        z-index: 1;
    }
    .empty-state:after {
        content: "";
        position: absolute;
        bottom: -50px;
        left: -50px;
        width: 150px;
        height: 150px;
        background: radial-gradient(circle, rgba(243,244,246,0.8) 0%, rgba(243,244,246,0) 70%);
        z-index: 1;
    }
    .price-highlight {
        color: #1F2937;
        font-weight: 600;
        position: relative;
    }
    .price-highlight:after {
        content: "";
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 100%;
        height: 1px;
        background-color: #E5E7EB;
    }
    .order-id {
        color: #1F2937;
        font-weight: 700;
        position: relative;
        display: inline-block;
    }
    .order-id:after {
        content: "";
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 100%;
        height: 2px;
        background: linear-gradient(90deg, #3B82F6 0%, rgba(59, 130, 246, 0) 100%);
    }
    .total-section {
        background-color: #F9FAFB;
        border-radius: 10px;
        border: 1px dashed #E5E7EB;
        position: relative;
    }
    .total-section:before {
        content: "";
        position: absolute;
        top: -5px;
        left: 20px;
        width: 10px;
        height: 10px;
        background-color: white;
        border: 1px solid #E5E7EB;
        border-radius: 50%;
    }
    .total-section:after {
        content: "";
        position: absolute;
        top: -5px;
        right: 20px;
        width: 10px;
        height: 10px;
        background-color: white;
        border: 1px solid #E5E7EB;
        border-radius: 50%;
    }
    .page-title {
        position: relative;
        display: inline-block;
        color: white;
    }
    .page-title:after {
        content: "";
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 4px;
        background: linear-gradient(90deg, #3B82F6 0%, rgba(59, 130, 246, 0.5) 100%);
        border-radius: 2px;
    }
    .menu-item-name {
        font-weight: 600;
        position: relative;
        display: inline-block;
    }
    .menu-item-name:hover:after {
        content: "";
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 100%;
        height: 2px;
        background-color: #E5E7EB;
    }
    .order-date {
        color: #6B7280;
        position: relative;
        padding-left: 20px;
    }
    .order-date:before {
        content: "\f017";
        font-family: "Font Awesome 6 Free";
        font-weight: 400;
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        color: #9CA3AF;
    }
    .total-price {
        color: #1F2937;
        font-weight: 700;
        position: relative;
        display: inline-block;
    }
    .total-price:after {
        content: "";
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 100%;
        height: 2px;
        background: linear-gradient(90deg, #3B82F6 0%, rgba(59, 130, 246, 0) 100%);
    }
    .item-icon {
        background: #F3F4F6;
        border-radius: 8px;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #4B5563;
    }
    .quantity-badge {
        background: #F3F4F6;
        border-radius: 4px;
        padding: 2px 6px;
        font-size: 0.75rem;
        color: #4B5563;
    }
    .flash-message {
        border-radius: 10px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
    .section-title {
        position: relative;
        display: inline-block;
        padding-left: 15px;
    }
    .section-title:before {
        content: "";
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 4px;
        height: 18px;
        background: linear-gradient(to bottom, #3B82F6, #2563EB);
        border-radius: 2px;
    }
    .order-footer {
        position: relative;
    }
    .order-footer:before {
        content: "";
        position: absolute;
        top: 0;
        left: 20px;
        right: 20px;
        height: 1px;
        background: linear-gradient(90deg, rgba(229,231,235,0) 0%, rgba(229,231,235,1) 50%, rgba(229,231,235,0) 100%);
    }
    .menu-item {
        transition: all 0.2s ease;
        border-radius: 8px;
    }
    .menu-item:hover {
        background-color: #F9FAFB;
    }
    .menu-item-details {
        display: flex;
        flex-direction: column;
    }
    .menu-item-id {
        font-size: 0.7rem;
        color: #9CA3AF;
        background-color: #F3F4F6;
        padding: 1px 5px;
        border-radius: 4px;
        display: inline-block;
    }
    .unit-price {
        font-size: 0.85rem;
        color: #6B7280;
    }
    .menu-item-description {
        font-size: 0.85rem;
        color: #6B7280;
        max-width: 300px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .menu-item-category {
        font-size: 0.7rem;
        color: #6B7280;
        background-color: #F3F4F6;
        padding: 1px 5px;
        border-radius: 4px;
        margin-right: 5px;
    }
    .calculation-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.9rem;
    }
    .calculation-result {
        font-weight: 600;
    }
    .menu-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 8px;
    }
    .menu-table th {
        padding: 10px;
        text-align: left;
        color: #6B7280;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    .menu-table td {
        padding: 12px 10px;
        background-color: #F9FAFB;
    }
    .menu-table tr td:first-child {
        border-top-left-radius: 8px;
        border-bottom-left-radius: 8px;
    }
    .menu-table tr td:last-child {
        border-top-right-radius: 8px;
        border-bottom-right-radius: 8px;
    }
    .menu-table tr:hover td {
        background-color: #F3F4F6;
    }
</style>

<div class="page-container">
    <div class="container mx-auto px-4 py-12">
        <div class="max-w-6xl mx-auto">
            <!-- Page Header -->
            <div class="mb-12 text-center">
                <h1 class="text-4xl font-bold page-title mb-4">
                    <i class="fas fa-history mr-3"></i>Order History
                </h1>
                <p class="text-gray-200 mt-6">Review your past orders and track current ones</p>
            </div>

            @if($orders->isEmpty())
                <!-- Empty State -->
                <div class="empty-state text-center py-16 px-8 animate__animated animate__fadeIn mt-8">
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-8 shadow-inner">
                        <i class="fas fa-shopping-basket text-blue-500 text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-semibold text-gray-800 mb-3">No orders yet</h3>
                    <p class="text-gray-600 mb-8 max-w-md mx-auto">Start your culinary journey with our delicious menu and experience the flavors of Ayam Goreng Jos Gandos</p>
                    <a href="{{ route('menu.index') }}" class="inline-block bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white action-button transition-colors shadow-lg">
                        Explore Menu <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            @else
                <!-- Order List -->
                <div class="space-y-8">
                    @foreach($orders as $orderId => $orderDetails)
                        <div class="order-card animate__animated animate__fadeInUp
                            @if($orderDetails->first()->status == 'Pending') status-pending
                            @elseif($orderDetails->first()->status == 'Processing') status-processing
                            @elseif($orderDetails->first()->status == 'Completed') status-completed
                            @else status-cancelled @endif">

                            <!-- Order Header -->
                            <div class="order-header px-8 py-6 bg-gradient-to-r from-gray-50 to-white">
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                                    <div class="mb-4 sm:mb-0">
                                        <span class="text-sm text-gray-500 block mb-1">Order ID</span>
                                        <h2 class="order-id text-xl">#{{ $orderId }}</h2>
                                    </div>
                                    <div class="flex flex-col sm:items-end">
                                        <span class="text-sm text-gray-500 block mb-1">Order Date</span>
                                        <span class="text-sm font-medium order-date">
                                            {{ $orderDetails->first()->created_at->format('d M Y, H:i') }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Order Items -->
                            <div class="px-8 py-6">
                                <h3 class="text-md font-semibold text-gray-800 mb-5 flex items-center section-title">
                                    Order Items
                                </h3>

                                <!-- Detailed Menu Table -->
                                <div class="overflow-x-auto">
                                    <table class="menu-table">
                                        <thead>
                                            <tr>
                                                <th>Menu ID</th>
                                                <th>Item</th>
                                                <th>Unit Price</th>
                                                <th>Quantity</th>
                                                <th class="text-right">Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($orderDetails as $item)
                                                <tr>
                                                    <td>
                                                        <span class="menu-item-id">#{{ $item->menu->idmenu }}</span>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <p class="menu-item-name">{{ $item->menu->menu }}</p>
                                                            @if(isset($item->menu->deskripsi))
                                                                <p class="menu-item-description">{{ $item->menu->deskripsi }}</p>
                                                            @endif
                                                            {{-- @if(isset($item->menu->kategori))
                                                                <span class="menu-item-category">{{ $item->menu->kategori }}</span>
                                                            @endif --}}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="unit-price">Rp {{ number_format($item->menu->harga, 0, ',', '.') }}</span>
                                                    </td>
                                                    <td>
                                                        <span class="quantity-badge">
                                                            <i class="fas fa-times text-xs mr-1"></i>{{ $item->quantity }}
                                                        </span>
                                                    </td>
                                                    <td class="text-right">
                                                        <span class="price-highlight">
                                                            Rp {{ number_format($item->menu->harga * $item->quantity, 0, ',', '.') }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Order Summary -->
                            <div class="total-section mx-8 px-6 py-5 mt-2 mb-6">
                                <div class="space-y-2">
                                    <div class="calculation-row">
                                        <span class="text-gray-600">Subtotal:</span>
                                        <span class="calculation-result">
                                            Rp {{ number_format($orderDetails->sum('total'), 0, ',', '.') }}
                                        </span>
                                    </div>
                                    <div class="calculation-row">
                                        <span class="text-gray-600">Delivery Fee:</span>
                                        <span class="calculation-result">Rp 10.000</span>
                                    </div>
                                    @if(isset($orderDetails->first()->tax) && $orderDetails->first()->tax > 0)
                                    <div class="calculation-row">
                                        <span class="text-gray-600">Tax (10%):</span>
                                        <span class="calculation-result">
                                            Rp {{ number_format($orderDetails->sum('total') * 0.1, 0, ',', '.') }}
                                        </span>
                                    </div>
                                    @endif
                                </div>
                                <div class="border-t border-dashed border-gray-200 pt-4 mt-3">
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-800 font-semibold">Total:</span>
                                        <span class="text-lg font-bold total-price">
                                            Rp {{ number_format($orderDetails->sum('total') + 10000, 0, ',', '.') }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Order Footer -->
                            <div class="order-footer px-8 py-5">
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                                    <div class="mb-4 sm:mb-0">
                                        <span class="status-badge
                                            @if($orderDetails->first()->status == 'Pending') status-pending
                                            @elseif($orderDetails->first()->status == 'Processing') status-processing
                                            @elseif($orderDetails->first()->status == 'Completed') status-completed
                                            @else status-cancelled @endif">
                                            <i class="fas fa-circle text-xs mr-2"></i>{{ $orderDetails->first()->status }}
                                        </span>
                                    </div>
                                    <div class="flex space-x-4">
                                        <button class="action-button bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 hover:from-gray-200 hover:to-gray-300 shadow">
                                            <i class="fas fa-print mr-2"></i>Print Receipt
                                        </button>
                                        @if($orderDetails->first()->status == 'Pending')
                                        <form action="{{ route('order.cancel', $orderId) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this order?');">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" class="action-button bg-gradient-to-r from-red-50 to-red-100 text-red-600 hover:from-red-100 hover:to-red-200 shadow">
                                                <i class="fas fa-times mr-2"></i>Cancel Order
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

@if(session('success'))
    <div class="fixed bottom-6 right-6 bg-gradient-to-r from-green-600 to-green-500 text-white px-6 py-3 rounded-xl shadow-xl animate__animated animate__fadeInUp animate__faster flash-message">
        <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="fixed bottom-6 right-6 bg-gradient-to-r from-red-600 to-red-500 text-white px-6 py-3 rounded-xl shadow-xl animate__animated animate__fadeInUp animate__faster flash-message">
        <i class="fas fa-exclamation-circle mr-2"></i> {{ session('error') }}
    </div>
@endif

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        // Auto-hide flash messages after 5 seconds
        setTimeout(function() {
            $('[role="alert"]').fadeOut('slow');
        }, 5000);

        // Add hover effect to table rows
        $('.menu-table tr').hover(
            function() {
                $(this).find('.menu-item-name').addClass('text-blue-600');
            },
            function() {
                $(this).find('.menu-item-name').removeClass('text-blue-600');
            }
        );
    });
</script>

@endsection

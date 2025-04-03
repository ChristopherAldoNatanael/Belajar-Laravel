@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container-fluid">
    <!-- Dashboard Header -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-download me-1"></i> Export
                </button>
                <button type="button" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-print me-1"></i> Print
                </button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <i class="fas fa-calendar me-1"></i> This week
            </button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-3 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                        <i class="fas fa-users fa-2x text-primary"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Total Users</h6>
                        <h3 class="mb-0">{{ \App\Models\Pelanggan::count() }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle bg-success bg-opacity-10 p-3 me-3">
                        <i class="fas fa-shopping-cart fa-2x text-success"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Total Orders</h6>
                        <h3 class="mb-0">{{ \App\Models\OrderDetail::count() }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle bg-info bg-opacity-10 p-3 me-3">
                        <i class="fas fa-utensils fa-2x text-info"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Menu Items</h6>
                        <h3 class="mb-0">{{ \App\Models\Menu::count() }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle bg-warning bg-opacity-10 p-3 me-3">
                        <i class="fas fa-truck fa-2x text-warning"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Pending Orders</h6>
                        <h3 class="mb-0">{{ \App\Models\OrderDetail::where('status', 'Pending')->count() }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert for status updates -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Recent Orders Section -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                    <h5 class="mb-0">Recent Orders</h5>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="orderFilterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-filter me-1"></i> 
                            {{ request('status') ? request('status') : 'Filter' }}
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="orderFilterDropdown">
                            <li>
                                <a class="dropdown-item {{ !request('status') ? 'active' : '' }}" 
                                   href="{{ route('admin.dashboard') }}">All Orders</a>
                            </li>
                            <li>
                                <a class="dropdown-item {{ request('status') == 'Pending' ? 'active' : '' }}" 
                                   href="{{ route('admin.dashboard', ['status' => 'Pending']) }}">Pending</a>
                            </li>
                            <li>
                                <a class="dropdown-item {{ request('status') == 'In Transit' ? 'active' : '' }}" 
                                   href="{{ route('admin.dashboard', ['status' => 'In Transit']) }}">In Transit</a>
                            </li>
                            <li>
                                <a class="dropdown-item {{ request('status') == 'Out for Delivery' ? 'active' : '' }}" 
                                   href="{{ route('admin.dashboard', ['status' => 'Out for Delivery']) }}">Out for Delivery</a>
                            </li>
                            <li>
                                <a class="dropdown-item {{ request('status') == 'Delivered' ? 'active' : '' }}" 
                                   href="{{ route('admin.dashboard', ['status' => 'Delivered']) }}">Delivered</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    @if($recentOrders->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Order ID</th>
                                        <th scope="col">Customer</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentOrders as $orderId => $orderItems)
                                    @php
                                        $firstOrder = $orderItems->first();
                                        $totalAmount = $orderItems->sum('total');
                                    @endphp
                                    <tr id="order-row-{{ $firstOrder->idorderdetail }}">
                                        <td>
                                            <span class="fw-medium text-secondary">{{ substr($orderId, 0, 8) }}...</span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar me-2 bg-light rounded-circle text-center" style="width: 32px; height: 32px; line-height: 32px;">
                                                    <span class="text-secondary">{{ substr($firstOrder->pelanggan, 0, 1) }}</span>
                                                </div>
                                                <span>{{ $firstOrder->pelanggan }}</span>
                                            </div>
                                        </td>
                                        <td>{{ $orderItems->count() }} item(s)</td>
                                        <td>Rp {{ number_format($totalAmount, 0, ',', '.') }}</td>
                                        <td>{{ $firstOrder->created_at ? $firstOrder->created_at->format('d M Y, H:i') : 'N/A' }}</td>
                                        <td>
                                            <span class="badge rounded-pill 
                                                @if($firstOrder->status == 'Pending') bg-warning
                                                @elseif($firstOrder->status == 'In Transit') bg-info
                                                @elseif($firstOrder->status == 'Out for Delivery') bg-primary
                                                @elseif($firstOrder->status == 'Delivered') bg-success
                                                @else bg-danger @endif">
                                                {{ $firstOrder->status }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <button type="button" class="btn btn-sm btn-outline-primary me-2 view-order-btn" 
                                                        data-bs-toggle="modal" data-bs-target="#orderDetailsModal" 
                                                        data-order-id="{{ $orderId }}">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle status-dropdown" 
                                                            type="button" id="statusDropdown{{ $firstOrder->idorderdetail }}" 
                                                            data-bs-toggle="dropdown" aria-expanded="false"
                                                            data-order-id="{{ $orderId }}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="statusDropdown{{ $firstOrder->idorderdetail }}">
                                                        <li><h6 class="dropdown-header">Update Status</h6></li>
                                                        <li>
                                                            <a class="dropdown-item status-item @if($firstOrder->status == 'Pending') active @endif" 
                                                               href="#" data-status="Pending" data-order-id="{{ $orderId }}">
                                                                <i class="fas fa-clock me-2 text-warning"></i> Pending
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item status-item @if($firstOrder->status == 'In Transit') active @endif" 
                                                               href="#" data-status="In Transit" data-order-id="{{ $orderId }}">
                                                                <i class="fas fa-truck me-2 text-info"></i> In Transit
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item status-item @if($firstOrder->status == 'Out for Delivery') active @endif" 
                                                               href="#" data-status="Out for Delivery" data-order-id="{{ $orderId }}">
                                                                <i class="fas fa-shipping-fast me-2 text-primary"></i> Out for Delivery
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item status-item @if($firstOrder->status == 'Delivered') active @endif" 
                                                               href="#" data-status="Delivered" data-order-id="{{ $orderId }}">
                                                                <i class="fas fa-check-circle me-2 text-success"></i> Delivered
                                                            </a>
                                                        </li>
                                                        <li><hr class="dropdown-divider"></li>
                                                        <li>
                                                            <a class="dropdown-item status-item @if($firstOrder->status == 'Cancelled') active @endif" 
                                                               href="#" data-status="Cancelled" data-order-id="{{ $orderId }}">
                                                                <i class="fas fa-times-circle me-2 text-danger"></i> Cancelled
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="mb-4">
                                <i class="fas fa-shopping-cart fa-4x text-muted"></i>
                            </div>
                            <h5 class="text-muted">No orders found</h5>
                            <p class="text-muted">There are no orders matching your filter criteria.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Order Details Modal -->
<div class="modal fade" id="orderDetailsModal" tabindex="-1" aria-labelledby="orderDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderDetailsModalLabel">Order Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="orderDetailsContent">
                    <div class="text-center py-5">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-3">Loading order details...</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Status Update Toast -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="statusToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-success text-white">
            <i class="fas fa-check-circle me-2"></i>
            <strong class="me-auto">Status Updated</strong>
            <small>Just now</small>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            Order status has been updated successfully.
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    // View Order Details
    $('.view-order-btn').on('click', function() {
        const orderId = $(this).data('order-id');
        $('#orderDetailsContent').html(`
            <div class="text-center py-5">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-3">Loading order details...</p>
            </div>
        `);
        
        // Fetch order details via AJAX
        $.ajax({
            url: `/admin/orders/${orderId}/details`,
            method: 'GET',
            success: function(response) {
                if (response.success) {
                    const data = response.data;
                    const order = data.order;
                    const items = data.items;
                    const totalAmount = data.totalAmount;
                    
                    let statusClass = '';
                    if (order.status === 'Pending') statusClass = 'bg-warning';
                    else if (order.status === 'In Transit') statusClass = 'bg-info';
                    else if (order.status === 'Out for Delivery') statusClass = 'bg-primary';
                    else if (order.status === 'Delivered') statusClass = 'bg-success';
                    else statusClass = 'bg-danger';
                    
                    let itemsHtml = '';
                    items.forEach(item => {
                        itemsHtml += `
                            <tr>
                                <td>${item.menu.menu}</td>
                                <td>Rp ${parseFloat(item.menu.harga).toLocaleString('id-ID')}</td>
                                <td>${item.quantity}</td>
                                <td>Rp ${parseFloat(item.total).toLocaleString('id-ID')}</td>
                            </tr>
                        `;
                    });
                    
                    const html = `
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h6 class="text-muted mb-2">Order Information</h6>
                                <p class="mb-1"><strong>Order ID:</strong> ${order.idorder}</p>
                                <p class="mb-1"><strong>Date:</strong> ${new Date(order.created_at).toLocaleString()}</p>
                                <p class="mb-1"><strong>Status:</strong> <span class="badge ${statusClass}">${order.status}</span></p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted mb-2">Customer Information</h6>
                                <p class="mb-1"><strong>Name:</strong> ${order.pelanggan}</p>
                                <p class="mb-1"><strong>Address:</strong> ${order.alamat}</p>
                            </div>
                        </div>
                        
                        <h6 class="text-muted mb-3">Order Items</h6>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>Item</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${itemsHtml}
                                </tbody>
                                <tfoot class="table-light">
                                    <tr>
                                        <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                        <td><strong>Rp ${parseFloat(totalAmount).toLocaleString('id-ID')}</strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    `;
                    
                    $('#orderDetailsContent').html(html);
                } else {
                    $('#orderDetailsContent').html(`
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-circle me-2"></i> ${response.message}
                        </div>
                    `);
                }
            },
            error: function() {
                $('#orderDetailsContent').html(`
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle me-2"></i> Failed to load order details. Please try again.
                    </div>
                `);
            }
        });
    });
    
    // Update Order Status
    $('.status-item').on('click', function(e) {
        e.preventDefault();
        
        const orderId = $(this).data('order-id');
        const newStatus = $(this).data('status');
        const statusText = $(this).text().trim();
        
        // Show loading state
        const dropdownButton = $(`.status-dropdown[data-order-id="${orderId}"]`);
        const originalContent = dropdownButton.html();
        dropdownButton.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
        dropdownButton.prop('disabled', true);
        
        // Send AJAX request to update status
        $.ajax({
            url: '/admin/orders/update-status',
            method: 'POST',
            data: {
                order_id: orderId,
                status: newStatus,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    // Update UI
                    const statusCell = dropdownButton.closest('tr').find('.badge');
                    
                    // Remove all existing classes and add new ones
                    statusCell.removeClass('bg-warning bg-info bg-primary bg-success bg-danger');
                    
                    if (newStatus === 'Pending') statusCell.addClass('bg-warning');
                    else if (newStatus === 'In Transit') statusCell.addClass('bg-info');
                    else if (newStatus === 'Out for Delivery') statusCell.addClass('bg-primary');
                    else if (newStatus === 'Delivered') statusCell.addClass('bg-success');
                    else statusCell.addClass('bg-danger');
                    
                    statusCell.text(newStatus);
                    
                    // Update dropdown active state
                    dropdownButton.closest('.dropdown').find('.status-item').removeClass('active');
                    dropdownButton.closest('.dropdown').find(`.status-item[data-status="${newStatus}"]`).addClass('active');
                    
                    // Show success toast
                    const toast = new bootstrap.Toast(document.getElementById('statusToast'));
                    toast.show();
                } else {
                    alert('Failed to update status: ' + response.message);
                }
            },
            error: function(xhr) {
                let errorMessage = 'Failed to update status';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage += ': ' + xhr.responseJSON.message;
                }
                alert(errorMessage);
            },
            complete: function() {
                // Restore button state
                dropdownButton.html(originalContent);
                dropdownButton.prop('disabled', false);
            }
        });
    });
</script>
@endsection


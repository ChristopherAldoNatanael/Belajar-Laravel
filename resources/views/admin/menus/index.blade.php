@extends('admin.layouts.app')

@section('title', 'Menu Management')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
        <h1 class="h2">Menu Management</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('admin.menu-management.create') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus me-1"></i> Add New Menu
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($menus as $menu)
                        <tr>
                            <td>{{ $menu->idmenu }}</td>
                            <td>
                                @if($menu->gambar)
                                <img src="{{ asset('gambar/' . $menu->gambar) }}" alt="{{ $menu->menu }}" width="50">
                                @else
                                <div class="bg-light rounded" style="width:50px;height:50px;"></div>
                                @endif
                            </td>
                            <td>{{ $menu->menu }}</td>
                            <td>
                                @if($menu->kategori)
                                    {{ $menu->kategori->kategori }}
                                @else
                                    <span class="text-muted">No Category</span>
                                @endif
                            </td>
                            <td>Rp {{ number_format($menu->harga, 0, ',', '.') }}</td>
                            <td>
                                <button class="btn btn-sm btn-outline-warning edit-menu-btn" 
                                    data-bs-toggle="modal" data-bs-target="#editMenuModal" 
                                    data-menu-id="{{ $menu->idmenu }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{ route('admin.menu-management.destroy', $menu->idmenu) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this menu?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Edit Menu Modal -->
<div class="modal fade" id="editMenuModal" tabindex="-1" aria-labelledby="editMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editMenuModalLabel">Edit Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="loading-spinner" class="text-center py-4">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <form id="editMenuForm" method="POST" enctype="multipart/form-data" style="display: none;">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="edit_menu_name" class="form-label">Menu Name</label>
                        <input type="text" class="form-control" id="edit_menu_name" name="menu" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_menu_category" class="form-label">Category</label>
                        <select class="form-select" id="edit_menu_category" name="idkategori" required>
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->idkategori }}">{{ $kategori->kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_menu_price" class="form-label">Price</label>
                        <input type="number" class="form-control" id="edit_menu_price" name="harga" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_menu_description" class="form-label">Description</label>
                        <textarea class="form-control" id="edit_menu_description" name="deskripsi" rows="3"></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_menu_image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="edit_menu_image" name="gambar">
                        <div id="currentImagePreview" class="mt-2"></div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Handle edit button click
    $('.edit-menu-btn').on('click', function() {
        const menuId = $(this).data('menu-id');
        const modal = $('#editMenuModal');
        
        // Show loading spinner, hide form
        $('#loading-spinner').show();
        $('#editMenuForm').hide();
        
        // Set the form action URL
        $('#editMenuForm').attr('action', `{{ url('admin/menu-management') }}/${menuId}`);
        
        // Fetch menu data
        $.ajax({
            url: `{{ url('admin/menu-management') }}/${menuId}/edit`,
            method: 'GET',
            success: function(response) {
                // Populate form fields
                $('#edit_menu_name').val(response.menu.menu);
                $('#edit_menu_price').val(response.menu.harga);
                $('#edit_menu_description').val(response.menu.deskripsi);
                
                // Set selected category
                $('#edit_menu_category').val(response.selected_kategori);
                
                // Show image preview if available
                if(response.menu.gambar) {
                    $('#currentImagePreview').html(`<img src="{{ asset('gambar') }}/${response.menu.gambar}" class="img-thumbnail" width="100">`);
                } else {
                    $('#currentImagePreview').html('<p class="text-muted">No image</p>');
                }
                
                // Hide spinner, show form
                $('#loading-spinner').hide();
                $('#editMenuForm').show();
            },
            error: function() {
                alert('Failed to load menu data. Please try again.');
                modal.modal('hide');
            }
        });
    });
});
</script>
@endsection
<div>
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center gap-3">
            <button wire:click="create" class="btn btn-success">
                <i class="fas fa-plus"></i> Add New Product
            </button>
            <h4 class="mb-0">Product List</h4>
        </div>
    </div>

    <!-- Products Table -->
    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>S#</th>
                            <th>Image</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $index => $product)
                            <tr>
                                <td>{{ $products->firstItem() + $index }}</td>
                                <td>
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" 
                                             alt="{{ $product->name }}"
                                             class="img-thumbnail"
                                             style="width: 60px; height: 60px; object-fit: cover;">
                                    @else
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                             style="width: 60px; height: 60px;">
                                            <i class="fas fa-image text-muted"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>{{ $product->product_code }}</td>
                                <td>{{ $product->name }}</td>
                                <td>
                                    <span class="badge bg-{{ $product->quantity > 10 ? 'success' : ($product->quantity > 0 ? 'warning' : 'danger') }}">
                                        {{ $product->quantity }}
                                    </span>
                                </td>
                                <td>${{ number_format($product->price, 2) }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <button wire:click="show({{ $product->id }})" class="btn btn-outline-info">
                                            <i class="fas fa-eye"></i> Show
                                        </button>
                                        <button wire:click="edit({{ $product->id }})" class="btn btn-outline-primary">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <button wire:click="delete({{ $product->id }})" 
                                                class="btn btn-outline-danger"
                                                onclick="return confirm('Are you sure you want to delete this product?')">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <div class="text-muted">
                                        <i class="fas fa-box-open fs-1 mb-3 d-block"></i>
                                        <h5>No products found</h5>
                                        <p>Start by adding your first product</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $products->links() }}
    </div>

    <!-- Add/Edit Modal -->
    @if($showModal)
        <div class="modal fade show" style="display: block;" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            {{ $isEdit ? 'Edit Product' : 'Add New Product' }}
                        </h5>
                        <button type="button" class="btn-close" wire:click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="product_code" class="form-label">Product Code</label>
                                        <input type="text" wire:model="product_code" class="form-control @error('product_code') is-invalid @enderror" id="product_code">
                                        @error('product_code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Product Name</label>
                                        <input type="text" wire:model="name" class="form-control @error('name') is-invalid @enderror" id="name">
                                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="quantity" class="form-label">Quantity</label>
                                        <input type="number" wire:model="quantity" class="form-control @error('quantity') is-invalid @enderror" id="quantity">
                                        @error('quantity') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Price ($)</label>
                                        <input type="number" step="0.01" wire:model="price" class="form-control @error('price') is-invalid @enderror" id="price">
                                        @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea wire:model="description" class="form-control @error('description') is-invalid @enderror" id="description" rows="3"></textarea>
                                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Product Image</label>
                                <input type="file" wire:model="image" class="form-control @error('image') is-invalid @enderror" id="image" accept="image/*">
                                @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                
                                @if ($image)
                                    <div class="mt-2">
                                        <img src="{{ $image->temporaryUrl() }}" class="img-thumbnail" style="max-width: 200px;">
                                    </div>
                                @elseif($isEdit && $currentImage)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $currentImage) }}" class="img-thumbnail" style="max-width: 200px;">
                                    </div>
                                @endif
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal">Cancel</button>
                        <button type="button" wire:click="{{ $isEdit ? 'update' : 'store' }}" class="btn btn-primary">
                            {{ $isEdit ? 'Update Product' : 'Save Product' }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade show"></div>
    @endif
</div>

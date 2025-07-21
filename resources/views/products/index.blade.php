@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1><i class="fas fa-box"></i> Products Management</h1>
                <span class="badge bg-primary">Livewire CRUD</span>
            </div>
            
            @livewire('product-manager')
        </div>
    </div>
@endsection

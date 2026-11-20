@extends('templates.layoutApp')

@section('content')

<div class="app-content-header">
    <div class="container-fluid">
        <h1 class="mb-0 fs-3">Edit Product</h1>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">

        <div class="card">

            <form method="POST"
                action="{{ route('products.update', $product->id) }}"
                enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="card-body">

                    <!-- Product Name -->
                    <div class="mb-3 row">
                        <label for="name" class="col-sm-2 col-form-label">
                            Product Name
                        </label>
                        <div class="col-sm-10">
                            <input type="text"
                                class="form-control"
                                id="name"
                                name="name"
                                value="{{ old('name', $product->name) }}"
                                required>
                        </div>
                    </div>

                    <!-- Price -->
                    <div class="mb-3 row">
                        <label for="price" class="col-sm-2 col-form-label">
                            Price
                        </label>
                        <div class="col-sm-10">
                            <input type="number"
                                class="form-control"
                                id="price"
                                name="price"
                                value="{{ old('price', $product->price) }}"
                                required>
                        </div>
                    </div>

                    <!-- Stock -->
                    <div class="mb-3 row">
                        <label for="stock" class="col-sm-2 col-form-label">
                            Stock
                        </label>
                        <div class="col-sm-10">
                            <input type="number"
                                class="form-control"
                                id="stock"
                                name="stock"
                                value="{{ old('stock', $product->stock) }}"
                                required>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-3 row">
                        <label for="description" class="col-sm-2 col-form-label">
                            Description
                        </label>
                        <div class="col-sm-10">
                            <textarea class="form-control"
                                name="description"
                                id="description"
                                rows="3">{{ old('description', $product->description) }}</textarea>
                        </div>
                    </div>

                    <!-- Image -->
                    
                    <div class="mb-3 row">
                        <label for="image" class="col-sm-2 col-form-label">
                            Image
                        </label>

                        <div class="col-sm-10">

                            {{-- Menampilkan gambar lama --}}
                            @if($product->image)
                                <div class="mb-3">
                                    <img
                                        src="{{ asset('storage/' . $product->image) }}"
                                        alt="Product Image"
                                        width="150"
                                        class="img-thumbnail"
                                    />
                                </div>
                            @else
                                <p class="text-muted">Belum ada gambar produk.</p>
                            @endif

                            {{-- Input gambar baru --}}
                            <input
                                type="file"
                                class="form-control"
                                id="image"
                                name="image"
                                accept="image/*"
                            />

                        </div>
                    </div>

                </div>

                <!-- Footer -->
                <div class="card-footer">
                    <a href="{{ route('products.index') }}"
                        class="btn btn-secondary">
                        Cancel
                    </a>

                    <button type="submit" class="btn btn-primary">
                        Edit Product
                    </button>
                </div>

            </form>
        </div>

    </div>
</div>

@endsection

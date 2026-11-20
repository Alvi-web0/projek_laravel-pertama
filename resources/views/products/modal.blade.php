
<!-- Create Product Modal -->
<div class="modal fade" id="createProductModal"
    tabindex="-1"
    aria-labelledby="createProductModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="createProductModalLabel">
                    Tambah Products
                </h5>

                <button type="button" class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                </button>
            </div>

            <!-- Form -->
            <form method="POST"
                action="{{ route('products.store') }}"
                enctype="multipart/form-data">

                @csrf

                <!-- Modal Body -->
                <div class="modal-body">

                    <!-- Product Name -->
                    <div class="row align-items-center mb-3">
                        <label for="name" class="col-4 col-form-label">
                            Product Name
                        </label>

                        <div class="col-8">
                            <input type="text"
                                class="form-control"
                                id="name"
                                name="name"
                                required>
                        </div>
                    </div>

                    <!-- Price -->
                    <div class="row align-items-center mb-3">
                        <label for="price" class="col-4 col-form-label">
                            Price
                        </label>

                        <div class="col-8">
                            <input type="number"
                                class="form-control"
                                id="price"
                                name="price"
                                required>
                        </div>
                    </div>

                    <!-- Stock -->
                    <div class="row align-items-center mb-3">
                        <label for="stock" class="col-4 col-form-label">
                            Stock
                        </label>

                        <div class="col-8">
                            <input type="number"
                                class="form-control"
                                id="stock"
                                name="stock"
                                required>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="row align-items-center mb-3">
                        <label for="description" class="col-4 col-form-label">
                            Description
                        </label>

                        <div class="col-8">
                            <textarea
                                class="form-control"    
                                id="description"
                                name="description"
                                rows="2" required></textarea>
                        </div>
                    </div>

                    <!-- Image -->
                    <div class="row align-items-center mb-2">
                        <label for="image" class="col-4 col-form-label">
                            Image
                        </label>

                        <div class="col-8">
                            <input type="file"
                                class="form-control"
                                id="image"
                                name="image" required>
                        </div>
                    </div>

                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">

                    <button type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">
                        Close
                    </button>

                    <button type="submit"
                        class="btn btn-primary">
                        Save changes
                    </button>

                </div>

            </form>

        </div>
    </div>
</div>

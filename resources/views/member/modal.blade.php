
<!-- Create Member Modal -->
<div class="modal fade" id="createMemberModal"
    tabindex="-1"
    aria-labelledby="createMemberModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="createMemberModalLabel">
                    Tambah Member
                </h5>

                <button type="button" class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                </button>
            </div>

            <!-- Form -->
            <form method="POST"
                action="{{ route('members.store') }}"
                enctype="multipart/form-data">

                @csrf

                <!-- Modal Body -->
                <div class="modal-body">

                    <!-- Nama -->
                    <div class="row align-items-center mb-3">
                        <label for="nama" class="col-4 col-form-label">
                            Nama
                        </label>

                        <div class="col-8">
                            <input type="text"
                                class="form-control"
                                id="nama"
                                name="nama"
                                required>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="row align-items-center mb-3">
                        <label for="email" class="col-4 col-form-label">
                            Email
                        </label>

                        <div class="col-8">
                            <input type="email"
                                class="form-control"
                                id="email"
                                name="email"
                                required>
                        </div>
                    </div>

                    <!-- No Telp -->
                    <div class="row align-items-center mb-3">
                        <label for="no_telp" class="col-4 col-form-label">
                            No. Telp
                        </label>

                        <div class="col-8">
                            <input type="text"
                                class="form-control"
                                id="no_telp"
                                name="no_telp"
                                required>
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div class="row align-items-center mb-3">
                        <label for="alamat" class="col-4 col-form-label">
                            Alamat
                        </label>

                        <div class="col-8">
                            <textarea
                                class="form-control"
                                id="alamat"
                                name="alamat"
                                rows="2"
                                required></textarea>
                        </div>
                    </div>

                    <!-- Foto -->
                    <div class="row align-items-center mb-2">
                        <label for="foto" class="col-4 col-form-label">
                            Foto
                        </label>

                        <div class="col-8">
                            <input type="file"
                                class="form-control"
                                id="foto"
                                name="foto"
                                accept="image/*"
                                required>
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

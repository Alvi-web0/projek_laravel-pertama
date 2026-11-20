
@extends('templates.layoutApp')

@section('content')

<div class="app-content-header">
    <div class="container-fluid">
        <h1 class="mb-0 fs-3">Edit Member</h1>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">

        <div class="card">

            <form method="POST"
                action="{{ route('members.update', $member->id) }}"
                enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="card-body">

                    <!-- Nama -->
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">
                            Nama
                        </label>

                        <div class="col-sm-10">
                            <input type="text"
                                class="form-control"
                                id="nama"
                                name="nama"
                                value="{{ old('nama', $member->nama) }}"
                                required>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="mb-3 row">
                        <label for="email" class="col-sm-2 col-form-label">
                            Email
                        </label>

                        <div class="col-sm-10">
                            <input type="email"
                                class="form-control"
                                id="email"
                                name="email"
                                value="{{ old('email', $member->email) }}"
                                required>
                        </div>
                    </div>

                    <!-- No Telp -->
                    <div class="mb-3 row">
                        <label for="no_telp" class="col-sm-2 col-form-label">
                            No. Telp
                        </label>

                        <div class="col-sm-10">
                            <input type="text"
                                class="form-control"
                                id="no_telp"
                                name="no_telp"
                                value="{{ old('no_telp', $member->no_telp) }}"
                                required>
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div class="mb-3 row">
                        <label for="alamat" class="col-sm-2 col-form-label">
                            Alamat
                        </label>

                        <div class="col-sm-10">
                            <textarea
                                class="form-control"
                                name="alamat"
                                id="alamat"
                                rows="3"
                                required>{{ old('alamat', $member->alamat) }}</textarea>
                        </div>
                    </div>

                    <!-- Foto -->
                    <div class="mb-3 row">
                        <label for="foto" class="col-sm-2 col-form-label">
                            Foto
                        </label>

                        <div class="col-sm-10">

                            {{-- Menampilkan foto lama --}}
                            @if($member->foto)
                                <div class="mb-3">
                                    <img
                                        src="{{ asset('storage/' . $member->foto) }}"
                                        alt="Foto Member"
                                        width="150"
                                        class="img-thumbnail"
                                    />
                                </div>
                            @else
                                <p class="text-muted">
                                    Belum ada foto member.
                                </p>
                            @endif

                            {{-- Input foto baru --}}
                            <input
                                type="file"
                                class="form-control"
                                id="foto"
                                name="foto"
                                accept="image/*"
                            />

                        </div>
                    </div>

                </div>

                <!-- Footer -->
                <div class="card-footer">

                    <a href="{{ route('members.index') }}"
                        class="btn btn-secondary">
                        Cancel
                    </a>

                    <button type="submit" class="btn btn-primary">
                        Edit Member
                    </button>

                </div>

            </form>
        </div>

    </div>
</div>

@endsection

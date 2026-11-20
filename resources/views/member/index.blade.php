@extends('templates.layoutApp')

@push('style')
    <link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/tabulator-tables@6.6.1/dist/css/tabulator_bootstrap5.min.css"
      crossorigin="anonymous">
@endpush

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <h1 class="mb-0 fs-1">Daftar Member</h1>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}

                <button type="button" class="btn-close"
                    data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card">

            <!-- Card Header -->
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">

                    <!-- Tombol Member -->
                   <button type="button" class="btn btn-primary"
                        data-bs-toggle="modal"
                        data-bs-target="#createMemberModal">

                        <i class="bi bi-plus-circle"></i>
                        Member

                    </button>

                    <!-- Search -->
                    <div class="input-group" style="width: 220px;">
                        <span class="input-group-text">
                            <i class="bi bi-search"></i>
                        </span>

                        <input type="text"
                            id="table-filter"
                            class="form-control"
                            placeholder="Filter rows...">
                    </div>

                </div>
            </div>

            <!-- Card Body -->
            <div class="card-body">

                <!-- Export Buttons -->
                <div class="d-flex gap-2 mb-3">

                    <button id="export-csv" type="button"
                        class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-filetype-csv me-1"></i>
                        Export CSV
                    </button>

                    <button id="export-json" type="button"
                        class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-filetype-json me-1"></i>
                        Export JSON
                    </button>

                    <button id="print-table" type="button"
                        class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-printer me-1"></i>
                        Print
                    </button>

                </div>

                <!-- Product Table -->
                <div id="member-table" aria-label="Member"></div>

                <!-- Pagination -->
                <div id="table-pagination"
                    class="d-flex flex-wrap gap-2 justify-content-end mt-2">
                </div>

            </div>
        </div>

    </div>
</div>
@include('member.modal')
@endsection

@push('script')

<script
    src="https://cdn.jsdelivr.net/npm/tabulator-tables@6.6.1/dist/js/tabulator.min.js"
    crossorigin="anonymous">
</script>

<script>
    document.addEventListener('DOMContentLoaded', () => {

        const table = new Tabulator('#member-table', {

            ajaxURL: "{{ route('members.api') }}",

            layout: 'fitColumns',

            filterMode: 'local',

            pagination: 'local',

            paginationElement: document.getElementById('table-pagination'),

            paginationSize: 10,

            paginationSizeSelector: [10, 25, 50, 100],

            movableColumns: true,

            columns: [

                {
                    title: 'ID',
                    field: 'id',
                    width: 80,
                    headerSort: true
                },

                {
                    title: 'Nama',
                    field: 'nama'
                },

                {
                    title: 'Email',
                    field: 'email'
                },

                {
                    title: 'No. Telp',
                    field: 'no_telp'
                },

                {
                    title: 'Alamat',
                    field: 'alamat'
                },

                {
                    title: 'Aksi',
                    field: 'id',

                    formatter: function(cell) {
                        var id = cell.getValue();

                        var editUrl = "{{ url('members') }}/" + id;
                        var deleteUrl = "{{ url('members') }}/" + id;

                        return `
                            <a href="${editUrl}/edit"
                                class="btn btn-success btn-sm">
                                Edit
                            </a>

                            <form action="${deleteUrl}"
                                method="POST"
                                class="d-inline"
                                onsubmit="return confirm('Yakin ingin menghapus member ini?')">

                                <input type="hidden"
                                    name="_token"
                                    value="{{ csrf_token() }}">

                                <input type="hidden"
                                    name="_method"
                                    value="DELETE">

                                <button type="submit"
                                    class="btn btn-danger btn-sm">
                                    Hapus
                                </button>

                            </form>
                        `;
                    },

                    headerSort: false,
                    width: 180,
                    hozAlign: 'center'
                }

            ],

        });

        // Mengatur tampilan tabel
        table.on('tableBuilt', () => {

            const grid = document.getElementById('member-table');

            grid.removeAttribute('aria-owns');

            const holder = grid.querySelector('.tabulator-tableholder');
            const tabulatorTable = grid.querySelector('.tabulator-table');

            if (holder) {
                holder.setAttribute('role', 'rowgroup');
            }

            if (tabulatorTable) {
                tabulatorTable.setAttribute('role', 'presentation');
            }

        });

        // Mengatur pagination
        table.on('renderComplete', () => {

            document.querySelectorAll('#table-pagination button')
                .forEach((button) => {

                    button.classList.add(
                        'btn',
                        'btn-sm',
                        'btn-outline-secondary'
                    );

                });

        });

        // Fitur pencarian
        document.getElementById('table-filter')
            .addEventListener('input', (e) => {

                const value = e.target.value;

                if (value) {

                    table.setFilter([
                        [
                            { field: 'nama', type: 'like', value: value },
                            { field: 'email', type: 'like', value: value },
                            { field: 'no_telp', type: 'like', value: value },
                            { field: 'alamat', type: 'like', value: value }
                        ]
                    ]);

                } else {

                    table.clearFilter();

                }

            });

        // Export CSV
        document.getElementById('export-csv')
            .addEventListener('click', () => {

                table.download('csv', 'data-member.csv');

            });

        // Export JSON
        document.getElementById('export-json')
            .addEventListener('click', () => {

                table.download('json', 'data-member.json');

            });

        // Print
        document.getElementById('print-table')
            .addEventListener('click', () => {

                table.print(false, true);

            });

    });
</script>

@endpush
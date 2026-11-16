@extends('templates.layoutApp')

@push('style')
    <link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/tabulator-tables@6.6.1/dist/css/tabulator_bootstrap5.min.css"
      crossorigin="anonymous">
@endpush

@section('content')
<div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-12">
                </div>
                <h1 class="mb-0 fs-3">List Products</h1>
                </div>
                <div class="card-body">
                  <div class="d-flex gap-2 mb-3">
                    <button id="export-csv" type="button" class="btn btn-sm btn-outline-secondary">
                      <i class="bi bi-filetype-csv me-1" aria-hidden="true"></i>
                        Export CSV
                      </button>
                      <button id="export-json" type="button" class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-filetype-json me-1" aria-hidden="true"></i>
                        Export JSON
                      </button>
                      <button id="print-table" type="button" class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-printer me-1" aria-hidden="true"></i>
                         Print
                      </button>
                      </div>
                      <div id="product-table" aria-label="Users"></div>
                      <div
                        id="table-pagination"
                        class="d-flex flex-wrap gap-2 justify-content-end mt-2"
                      ></div>
                  </div>
                </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->

      <!--end::App Content Header-->
@endsection

@push('script')

    <script
      src="https://cdn.jsdelivr.net/npm/tabulator-tables@6.6.1/dist/js/tabulator.min.js"
      crossorigin="anonymous">
    </script>
    <script>
      const statusBadge = (cell) => {
        const value = cell.getValue();
        const map = {
          Active: 'success',
          Invited: 'info',
          Suspended: 'secondary'
        };
        const color = map[value] || 'secondary';
        return `<span class="badge text-bg-${color}">${value}</span>`;
      
      };

      document.addEventListener('DOMContentLoaded', () => {
        
        const table = new Tabulator('#product-table', {
          ajaxURL: "{{ route('products.api') }}",
          layout: 'fitColumns',
          filterMode: "local",
          pagination: "local",
          paginationElement: document.getElementById('table-pagination'),
          paginationSize: 10,
          paginationSizeSelector: [10, 25, 50, 100],
          movebleColumns: true,
          columns: [{
            title: 'ID',
            field: 'id',
            width: 80,
            headerSort: true
          },
          {
            title: 'Product Name',
            field: 'name',
          },
          {
            title: 'Price',
            field: 'Price',
          },
          {
            title: 'Stock',
            field: 'stock',
            width: 120,
          },
          {
            title: 'aksi',
            field: 'id',
            formatter: function(cell) {
              var id = cell.getValue();
              var editUrl = "{{ url('products') }}/" + id + "/edit";

              //membuat tombol edit dan delete manual di dalam tabulor
              return`
              <a href="${editUrl}" class="btn btn-success">Edit</a>
              <button onclick="deleteProduct(${id})" class="btn btn-danger">hapus</button>`;
            },
            headerSort: false,
            borderless: true,

            width: 200,
            hozAlign: 'center',
          },
        ],
        });

        table.on('tableBuilt', () => {
          //
          //
          const grid = document.getElementById('product-table');
          grid.removeAttribute('aria-owns');
          grid.querySelector('.tabulator-tableholder').setAttribute('role', 'rowgroup');
          grid.querySelector('.tabulator-table').setAttribute('role', 'presentation');
        });

        table.on('renderComplete', () => {
          document.querySelectorAll('#table-pagination button').forEach((button) => {
            button.classList.add('btn', 'btn-sm', 'btn-outline-secondary');
          });
        });

        document.getElementById('table-filter').addEventListener('input', (e) => {
          const value = e.target.value;
          if (value) {
            table.setFilter(
              [{
                field: 'name',
                type: 'like',
                value: value
              },]);
          } else {
            table.clearFilter();
          }
        });

        document
          .getElementById('export-csv')
          .addEventListener('click', () => table.download('csv', 'users.csv'));
        document
          .getElementById('export-json')
          .addEventListener('click', () => table.download('json', 'users.json'));
        document
          .getElementById('print-table')
          .addEventListener('click', () => table.print(false, true));
      });
    </script>
@endpush
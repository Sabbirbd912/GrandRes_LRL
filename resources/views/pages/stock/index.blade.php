@extends("layouts.master")

@section("page")
<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="text-primary text-uppercase">🧾 Stock List</h3>
    <!-- <a class="btn btn-success" href="{{ url('raw_materials/create') }}">➕ New Stock</a> -->
  </div>

  <div class="card shadow">
    <div class="card-body table-responsive">
      <table class="table table-bordered align-middle text-center">
        <thead class="table-light">
          <tr>
            <th>ID</th>
            <th>Raw Material Id</th>
            <th>Quantity</th>
            <th>transaction_type_id</th>
            <th>Remark</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($stocks as $stock)
            <tr>
              <td>{{ $stock->id }}</td>
              <td>{{ $stock->raw_material_id }}</td>
              <td>{{ $stock->qty }}</td>
              <td>{{ $stock->transaction_type_id }}</td>
              <td>{{ $stock->remark }}</td>
              <td>
                <div class="btn-group mb-2">
                  <a href='{{ url("stocks/$stock->id/edit") }}' class="btn btn-sm btn-outline-primary" title="Edit">
                    <i class="bi bi-pencil-square"></i>
                  </a>
                  <a href='{{ url("stocks/$stock->id") }}' class="btn btn-sm btn-outline-success" title="View">
                    <i class="bi bi-eye"></i>
                  </a>
                  <a href='{{ url("stocks/$stock->id/delete") }}' class="btn btn-sm btn-outline-danger" title="Delete">
                    <i class="bi bi-trash"></i>
                  </a>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="text-center">No purchases found.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection

@push('styles')
<style>
  .btn:hover {
    transform: scale(1.05);
    transition: 0.3s ease;
  }

  .table td, .table th {
    vertical-align: middle !important;
    white-space: nowrap;
  }
</style>
@endpush

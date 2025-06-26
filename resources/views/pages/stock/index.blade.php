@extends("layouts.master")

@section("page")
<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="text-primary">🧾 Stock</h3>
    <a class="btn btn-success" href="{{ url('stock/create') }}">➕ New Stock</a>
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
                  <a href='{{ url("stocks/$stock->id/edit") }}' class="btn btn-primary btn-sm">Edit</a>
                  <a href='{{ url("stocks/$stock->id") }}' class="btn btn-success btn-sm">View</a>
                  <a href='{{ url("stocks/$stock->id/delete") }}' class="btn btn-danger btn-sm">Delete</a>
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
  .btn-icon {
    transition: 0.4s ease-in-out;
  }

  .btn-icon:hover {
    background-color: rgba(0, 255, 13, 0.24);
    transform: scale(1.2);
    border-radius: 5px;
  }

  .btn-icon i {
    font-size: 1.1rem;
  }

  .bg-light-blue {
    background-color: #e0f7fa !important;
  }
</style>
@endpush

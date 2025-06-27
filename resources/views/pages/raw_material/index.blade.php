@extends("layouts.master")

@section("title", "Raw-Material List")

@section("page")
<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="text-primary text-uppercase">🧾All Raw Material</h3>
    <a class="btn btn-success" href="{{ url('raw_materials/create') }}">➕ Add raw_material</a>
  </div>

  <div class="card shadow">
    <div class="card-body table-responsive">
      <table class="table table-bordered align-middle text-center w-100">
        <thead class="table-light">
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($raw_materials as $raw_material)
            <tr>
              <td>{{ $raw_material->id }}</td>
              <td>{{ $raw_material->name }}</td>
              <td>{{ $raw_material->qty }}</td>
              <td>{{ $raw_material->price }}</td>
              <td>
                <div class="btn-group" role="group">
                  <a href='{{ url("raw_materials/$raw_material->id/edit") }}' class="btn btn-sm btn-outline-primary" title="Edit">
                    <i class="bi bi-pencil-square"></i>
                  </a>
                  <a href='{{ url("raw_materials/$raw_material->id") }}' class="btn btn-sm btn-outline-success" title="View">
                    <i class="bi bi-eye"></i>
                  </a>
                  <a href='{{ url("raw_materials/$raw_material->id/delete") }}' class="btn btn-sm btn-outline-danger" title="Delete">
                    <i class="bi bi-trash"></i>
                  </a>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="text-center">No raw-material found.</td>
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

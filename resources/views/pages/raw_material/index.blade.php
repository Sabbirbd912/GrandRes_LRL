@extends("layouts.master")

@section("page")
<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="text-primary">🧾 Raw Material</h3>
    <a class="btn btn-success" href="{{ url('raw_material/create') }}">➕ New Rameteral</a>
  </div>

  <div class="card shadow">
    <div class="card-body table-responsive">
      <table class="table table-bordered align-middle text-center">
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
                <div class="btn-group mb-2">
                  <a href='{{ url("raw_materials/$raw_material->id/edit") }}' class="btn btn-primary btn-sm">Edit</a>
                  <a href='{{ url("raw_materials/$raw_material->id") }}' class="btn btn-success btn-sm">View</a>
                  <a href='{{ url("raw_materials/$raw_material->id/delete") }}' class="btn btn-danger btn-sm">Delete</a>
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

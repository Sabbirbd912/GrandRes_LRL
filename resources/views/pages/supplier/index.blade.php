@extends("layouts.master")

@section("page")
<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="text-primary">🚚 Supplier List</h3>
    <a class="btn btn-success" href="{{ url('suppliers/create') }}">➕ New Supplier</a>
  </div>

  <div class="card shadow">
    <div class="card-body table-responsive">
      <table class="table table-bordered align-middle text-center">
        <thead class="table-light">
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Mobile</th>
            <th>Email</th>
            <th>Photo</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($suppliers as $supplier)
            <tr>
              <td>{{ $supplier->id }}</td>
              <td>{{ $supplier->name }}</td>
              <td>{{ $supplier->mobile }}</td>
              <td>{{ $supplier->email }}</td>
              <td>
                <img src='{{ url("/img/$supplier->photo") }}' width="80" class="rounded shadow-sm" alt="Supplier Photo" />
              </td>
              <td>
                <div class="btn-group mb-2" role="group">
                  <a href='{{ url("suppliers/$supplier->id/edit") }}' class="btn btn-primary btn-sm">Edit</a>
                  <a href='{{ url("suppliers/$supplier->id") }}' class="btn btn-success btn-sm">View</a>
                  <a href='{{ url("suppliers/$supplier->id/delete") }}' class="btn btn-danger btn-sm">Delete</a>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="text-center">No suppliers found.</td>
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

@extends('layouts.master')

@section('title', 'Customer List')

@section('page')
<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="text-primary">👥 Customer List</h3>
    <a href="{{ url('customers/create') }}" class="btn btn-success">➕ New Customer</a>
  </div>

  <div class="card shadow-sm">
    <div class="card-body table-responsive">
      <table class="table table-bordered align-middle text-center w-100">
        <thead class="table-light">
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Mobile</th>
            <th>Address</th>
            <th>Photo</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($customers as $customer)
            <tr>
              <td>{{ $customer->id }}</td>
              <td>{{ $customer->name }}</td>
              <td>{{ $customer->mobile }}</td>
              <td>{{ $customer->address }}</td>
              <td>
                <img src="{{ url("/img/$customer->photo") }}" alt="Customer Photo" class="img-thumbnail" style="max-width: 60px;">
              </td>
              <td>
                <div class="btn-group" role="group">
                  <a href="{{ url("customers/$customer->id/edit") }}" class="btn btn-sm btn-outline-primary" title="Edit">
                    <i class="bi bi-pencil-square"></i>
                  </a>
                  <a href="{{ url("customers/$customer->id") }}" class="btn btn-sm btn-outline-success" title="View">
                    <i class="bi bi-eye"></i>
                  </a>
                  <a href="{{ url("customers/$customer->id/delete") }}" class="btn btn-sm btn-outline-danger" title="Delete">
                    <i class="bi bi-trash"></i>
                  </a>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="text-center">No customers found.</td>
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

  .img-thumbnail {
    border-radius: 8px;
    box-shadow: 0 0 4px rgba(0, 0, 0, 0.1);
  }
</style>
@endpush

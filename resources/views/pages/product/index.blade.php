@extends("layouts.master")

@section("title", "Product List")

@section("page")
<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="text-primary">🍛 Product List</h3>
    <a href="{{ url('products/create') }}" class="btn btn-success">➕ New Product</a>
  </div>

  <div class="card shadow-sm">
    <div class="card-body table-responsive">
      <table class="table table-bordered align-middle text-center w-100">
        <thead class="table-light">
          <tr>
            <th>ID</th>
            <th>Photo</th>
            <th>Name</th>
            <th>Price</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($products as $product)
            <tr>
              <td>{{ $product->id }}</td>
              <td>
                <img src="{{ url("/img/$product->photo") }}" width="70" class="img-thumbnail shadow-sm" />
              </td>
              <td>{{ $product->name }}</td>
              <td>{{ $product->offer_price }}</td>
              <td>
                <div class="btn-group" role="group">
                  <a href="{{ url("products/$product->id/edit") }}" class="btn btn-sm btn-outline-primary" title="Edit">
                    <i class="bi bi-pencil-square"></i>
                  </a>
                  <a href="{{ url("products/$product->id") }}" class="btn btn-sm btn-outline-success" title="View">
                    <i class="bi bi-eye"></i>
                  </a>
                  <a href="{{ url("products/$product->id/confirm") }}" class="btn btn-sm btn-outline-danger" title="Delete">
                    <i class="bi bi-trash"></i>
                  </a>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="text-center">No Products Found</td>
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

@extends("layouts.master")

@section("page")
<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="text-primary">🧾 Purchase List</h3>
    <a class="btn btn-success" href="{{ url('purchases/create') }}">➕ New Purchase</a>
  </div>

  <div class="card shadow">
    <div class="card-body table-responsive">
      <table class="table table-bordered align-middle text-center">
        <thead class="table-light">
          <tr>
            <th>ID</th>
            <th>Supplier</th>
            <th>Shipping Address</th>
            <th>Purchase Total</th>
            <th>Paid Amount</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($purchases as $purchase)
            <tr>
              <td>{{ $purchase->id }}</td>
              <td>{{ $purchase->supplier_name }}</td>
              <td>{{ $purchase->shipping_address }}</td>
              <td>{{ $purchase->purchase_total }}</td>
              <td>{{ $purchase->paid_amount }}</td>
              <td>
                <div class="btn-group mb-2">
                  <a href='{{ url("purchases/$purchase->id/edit") }}' class="btn btn-primary btn-sm">Edit</a>
                  <a href='{{ url("purchases/$purchase->id") }}' class="btn btn-success btn-sm">View</a>
                  <a href='{{ url("purchases/$purchase->id/delete") }}' class="btn btn-danger btn-sm">Delete</a>
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

  <div class="d-flex justify-content-center mt-3">
    {{ $purchases->links() }}
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

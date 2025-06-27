@extends("layouts.master")

@section("title", "Purchase List")

@section("page")
<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="text-primary">🧾 Purchase List</h3>
    <a class="btn btn-success" href="{{ url('purchases/create') }}">➕ New Purchase</a>
  </div>

  <div class="card shadow-sm">
    <div class="card-body table-responsive">
      <table class="table table-bordered align-middle text-center w-100">
        <thead class="table-light">
          <tr>
            <th>ID</th>
            <th>Supplier</th>
            <th>Total</th>
            <th>Paid</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($purchases as $purchase)
            <tr>
              <td>{{ $purchase->id }}</td>
              <td>{{ $purchase->supplier_name }}</td>
              <td>{{ number_format($purchase->purchase_total, 2) }}</td>
              <td>{{ number_format($purchase->paid_amount, 2) }}</td>
              <td>
                <div class="btn-group" role="group">
                  <a href='{{ url("purchases/$purchase->id/edit") }}' class="btn btn-sm btn-outline-primary" title="Edit">
                    <i class="bi bi-pencil-square"></i>
                  </a>
                  <a href='{{ url("purchases/$purchase->id") }}' class="btn btn-sm btn-outline-success" title="View">
                    <i class="bi bi-eye"></i>
                  </a>
                  <a href='{{ url("purchases/$purchase->id/delete") }}' class="btn btn-sm btn-outline-danger" title="Delete">
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

  <div class="d-flex justify-content-center mt-3">
    {{ $purchases->links() }}
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

@extends("layouts.master")

@section("title", "Money Receipt List")

@section("page")
<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="text-primary">💵 Money Receipt List</h3>
    <a href="{{ url('money_receipts/create') }}" class="btn btn-success">➕ New Receipt</a>
  </div>

  <div class="card shadow-sm">
    <div class="card-body table-responsive">
      <table class="table table-bordered align-middle text-center w-100">
        <thead class="table-light">
          <tr>
            <th>ID</th>
            <th>Customer</th>
            <th>Remark</th>
            <th>Total</th>
            <th>Discount</th>
            <th>VAT</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($money_receipts as $money_receipt)
            <tr>
              <td>{{ $money_receipt->id }}</td>
              <td>{{ $money_receipt->customer->name ?? 'No Customer' }}</td>
              <td>{{ $money_receipt->remark }}</td>
              <td>{{ $money_receipt->receipt_total }}</td>
              <td>{{ $money_receipt->discount }}</td>
              <td>{{ $money_receipt->vat }}</td>
              <td>
                <div class="btn-group" role="group">
                  <a href="{{ url("money_receipts/$money_receipt->id/edit") }}" class="btn btn-sm btn-outline-primary" title="Edit">
                    <i class="bi bi-pencil-square"></i>
                  </a>
                  <a href="{{ url("money_receipts/$money_receipt->id") }}" class="btn btn-sm btn-outline-success" title="View">
                    <i class="bi bi-eye"></i>
                  </a>
                  <a href="{{ url("money_receipts/$money_receipt->id/delete") }}" class="btn btn-sm btn-outline-danger" title="Delete">
                    <i class="bi bi-trash"></i>
                  </a>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="7" class="text-center">No receipts found.</td>
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

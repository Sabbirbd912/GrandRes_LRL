@extends('layouts.master')

@section('title', 'Stock Balance')

@section('page')
<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="text-uppercase text-primary">📦 Stock Balance</h3>
    <div>
      <a href="{{ route('stocks.index') }}" class="btn btn-info">📋 Manage Stocks</a>
    </div>
  </div>

  <div class="card shadow">
    <div class="card-body table-responsive">
      <table class="table table-bordered align-middle text-center">
        <thead class="table-light">
          <tr>
            <th>SL</th>
            <th>ID</th>
            <th>Product</th>
            <th>Quantity</th>
          </tr>
        </thead>
        <tbody>
          @php $sl = 1; @endphp
          @forelse($balances as $balance)
            <tr>
              <td>{{ $sl++ }}</td>
              <td>{{ $balance->id }}</td>
              <td>{{ $balance->raw_material }}</td>
              <td>{{ $balance->total }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="4" class="text-center">No stock records found.</td>
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

  th {
    text-transform: uppercase;
  }

  table td, table th {
    vertical-align: middle !important;
  }
</style>
@endpush

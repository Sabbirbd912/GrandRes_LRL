@extends("layouts.master")

@section("title", "Reservation List")

@section("page")
<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="text-primary">📋 Reservation List</h3>
    <a class="btn btn-success" href="{{ url('reservations/create') }}">➕ New Reservation</a>
  </div>

  <div class="card shadow-sm">
    <div class="card-body table-responsive">
      <table class="table table-bordered align-middle text-center w-100">
        <thead class="table-light">
          <tr>
            <th>ID</th>
            <th>Customer</th>
            <th>Table</th>
            <th>Date</th>
            <th>Time</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($reservations as $reservation)
            <tr>
              <td>{{ $reservation->id }}</td>
              <td>{{ $reservation->customer->name ?? 'Unknown' }}</td>
              <td>{{ $reservation->table->name ?? 'N/A' }}</td>
              <td>{{ $reservation->reservation_date }}</td>
              <td>{{ $reservation->reservation_time }}</td>
              <td>
                @php
                  $statusColors = [0 => 'warning', 1 => 'success', 2 => 'danger', 3 => 'secondary'];
                  $statusLabels = [0 => 'Pending', 1 => 'Confirmed', 2 => 'Cancelled', 3 => 'Checked Out'];
                @endphp
                <span class="badge bg-{{ $statusColors[$reservation->status] }}">
                  {{ $statusLabels[$reservation->status] ?? 'Unknown' }}
                </span>
              </td>
              <td>
                <div class="btn-group mb-2" role="group">
                  <a class="btn btn-sm btn-outline-primary" title="Edit" href="{{ url("reservations/$reservation->id/edit") }}">
                    <i class="bi bi-pencil-square"></i>
                  </a>
                  <a class="btn btn-sm btn-outline-success" title="View" href="{{ url("reservations/$reservation->id") }}">
                    <i class="bi bi-eye"></i>
                  </a>
                  <a class="btn btn-sm btn-outline-danger" title="Delete" href="{{ url("reservations/$reservation->id/delete") }}">
                    <i class="bi bi-trash"></i>
                  </a>
                </div>

                @if ($reservation->status == 0)
                  <div class="btn-group mt-1" role="group">
                    <a href="{{ url("reservations/$reservation->id/confirm") }}" class="btn btn-sm btn-outline-success" title="Confirm">
                      <i class="bi bi-check-circle"></i>
                    </a>
                    <a href="{{ url("reservations/$reservation->id/cancel") }}" class="btn btn-sm btn-outline-danger" title="Cancel">
                      <i class="bi bi-x-circle"></i>
                    </a>
                  </div>
                @elseif ($reservation->status == 1)
                  <div class="btn-group mt-1" role="group">
                    <a href="{{ url("reservations/$reservation->id/checkout") }}" class="btn btn-sm btn-outline-dark" title="Checkout">
                      <i class="bi bi-box-arrow-right"></i>
                    </a>
                  </div>
                @endif
              </td>
            </tr>
          @empty
            <tr><td colspan="7" class="text-center">No reservations found.</td></tr>
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

  .badge {
    font-size: 0.85rem;
    padding: 0.4em 0.6em;
  }
</style>
@endpush

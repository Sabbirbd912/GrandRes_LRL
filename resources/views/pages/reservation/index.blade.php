@extends("layouts.master")

@section("page")
<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="text-primary">📋 Reservation List</h3>
    <a class="btn btn-success" href="{{ url('reservations/create') }}">➕ New Reservation</a>
  </div>

  <div class="card shadow">
    <div class="card-body table-responsive">
      <table class="table table-bordered">
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
                  $statusColors = [
                    0 => 'warning', 1 => 'success', 2 => 'danger', 3 => 'secondary'
                  ];
                  $statusLabels = [
                    0 => 'Pending', 1 => 'Confirmed', 2 => 'Cancelled', 3 => 'Checked Out'
                  ];
                @endphp
                <span class="badge bg-{{ $statusColors[$reservation->status] }}">
                  {{ $statusLabels[$reservation->status] ?? 'Unknown' }}
                </span>
              </td>
              <td>
                <div class="btn-group mb-2">
                  <a class="btn btn-primary btn-sm" href="{{ url("reservations/$reservation->id/edit") }}">Edit</a>
                  <a class="btn btn-success btn-sm" href="{{ url("reservations/$reservation->id") }}">View</a>
                  <a class="btn btn-warning btn-sm" href="{{ url("reservations/$reservation->id/delete") }}">Delete</a>
                </div>
                @if ($reservation->status == 0)
                  <div class="btn-group">
                    <a href="{{ url("reservations/$reservation->id/confirm") }}" class="btn btn-success btn-sm">Confirm</a>
                    <a href="{{ url("reservations/$reservation->id/cancel") }}" class="btn btn-danger btn-sm">Cancel</a>
                  </div>
                @elseif ($reservation->status == 1)
                  <div class="btn-group">
                    <a href="{{ url("reservations/$reservation->id/checkout") }}" class="btn btn-dark btn-sm">Checkout</a>
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
  .input-light-green {
    background-color: #eaffea !important;
    border: 1px solid rgb(182, 201, 226);
  }

  .input-light-green:focus {
    background-color: #dfffe0 !important;
    border-color: #80d980;
    box-shadow: 0 0 0 0.2rem rgba(0, 255, 0, 0.25);
  }

  .bg-light-blue {
    background-color: #e0f7fa !important;
  }
</style>
@endpush

@extends("layouts.master")

@section("page")

<div class="container mt-4">
  <a class="btn btn-success mb-3" href="{{ url('reservations') }}">⬅ Back to Reservations</a>

  <div class="card shadow w-100" style="max-width: 600px; margin: auto;">
    <div class="card-header bg-light-blue text-black">
      <h5 class="mb-0">📄 Reservation Details</h5>
    </div>

    <div class="card-body">
      <table class="table table-bordered mb-0">
        <tr>
          <th>ID</th>
          <td>{{ $reservation->id }}</td>
        </tr>
        <tr>
          <th>Customer</th>
          <td>{{ $reservation->customer->name ?? 'Unknown' }}</td>
        </tr>
        <tr>
          <th>Table</th>
          <td>{{ $reservation->table->name ?? 'N/A' }}</td>
        </tr>
        <tr>
          <th>Seats</th>
          <td>{{ $reservation->table->seats ?? '-' }}</td>
        </tr>
        <tr>
          <th>Date</th>
          <td>{{ $reservation->reservation_date }}</td>
        </tr>
        <tr>
          <th>Time</th>
          <td>{{ \Carbon\Carbon::parse($reservation->reservation_time)->format('h:i A') }}</td>
        </tr>
        <tr>
          <th>Status</th>
          <td>
            @php
              $statusColors = [0 => 'warning', 1 => 'success', 2 => 'danger', 3 => 'secondary'];
              $statusLabels = [0 => 'Pending', 1 => 'Confirmed', 2 => 'Cancelled', 3 => 'Checked Out'];
            @endphp
            <span class="badge bg-{{ $statusColors[$reservation->status] }}">
              {{ $statusLabels[$reservation->status] ?? 'Unknown' }}
            </span>
          </td>
        </tr>
      </table>
    </div>
  </div>
</div>

@endsection

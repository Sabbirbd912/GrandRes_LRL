@extends("layouts.master")

@section("page")

<div class="container mt-5 d-flex justify-content-center">
  <div class="card border-danger shadow-sm w-100" style="max-width: 420px;">
    <div class="card-header bg-danger text-white text-center">
      <h5 class="mb-0">⚠️ Confirm Delete</h5>
    </div>

    <div class="card-body text-center">
      <p class="text-muted mb-2">Are you sure you want to delete the reservation for:</p>

      <ul class="list-unstyled mb-4">
        <li><strong>Customer:</strong> {{ $reservation->customer->name ?? 'Unknown' }}</li>
        <li><strong>Date:</strong> {{ $reservation->reservation_date }}</li>
        <li><strong>Time:</strong> {{ \Carbon\Carbon::parse($reservation->reservation_time)->format('h:i A') }}</li>
        <li><strong>Table:</strong> {{ $reservation->table->name ?? 'N/A' }}</li>
      </ul>

      <form action="{{ url('reservations/' . $reservation->id) }}" method="POST" class="d-inline-block me-2">
        @csrf
        @method("DELETE")
        <button type="submit" class="btn btn-sm btn-danger px-3">
          <i class="fas fa-trash-alt me-1"></i> Confirm
        </button>
      </form>

      <a href="{{ url('reservations') }}" class="btn btn-sm btn-secondary px-3">
        <i class="fas fa-times me-1"></i> Cancel
      </a>
    </div>
  </div>
</div>

@endsection

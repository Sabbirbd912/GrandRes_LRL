{{-- resources/views/reservations/edit.blade.php --}}
@extends("layouts.master")

@section("page")
<div class="container mt-2">
  <a class="btn btn-success mb-3" href="{{ url('reservations') }}">Back</a>

  <div class="card shadow">
    <div class="card-header bg-light-blue text-white">
      <h5 class="mb-0">✏️ Edit Reservation</h5>
    </div>

    <div class="card-body">
      <form action="{{ url('reservations/' . $reservation->id) }}" method="POST">
        @csrf
        @method("PUT")

        <div class="mb-3">
          <label for="customer_id" class="form-label">Customer ID</label>
          <input type="number" name="customer_id" value="{{ $reservation->customer_id }}" class="form-control input-light-green" required>
        </div>

        <div class="mb-3">
          <label for="table_id" class="form-label">Table ID</label>
          <input type="number" name="table_id" value="{{ $reservation->table_id }}" class="form-control input-light-green" required>
        </div>

        <div class="mb-3">
          <label for="reservation_date" class="form-label">Reservation Date</label>
          <input type="date" name="reservation_date" value="{{ $reservation->reservation_date }}" class="form-control input-light-green" required>
        </div>

        <div class="mb-3">
          <label for="reservation_time" class="form-label">Reservation Time</label>
          <input type="time" name="reservation_time" value="{{ \Carbon\Carbon::parse($reservation->reservation_time)->format('H:i') }}" class="form-control input-light-green" required>
        </div>

        <div class="text-end">
          <button type="submit" class="btn btn-primary">✅ Update</button>
        </div>
      </form>
    </div>
  </div>
</div>

<style>
  .input-light-green {
    background-color: #eaffea !important;
    border: 1px solid #b6e2b6;
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
@endsection

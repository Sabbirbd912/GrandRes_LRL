@extends("layouts.master")

@section("page")

<div class="container mt-2">
  <a class="btn btn-success mb-3" href="{{ url('reservations') }}">⬅ Back to Reservations</a>

  <div class="card shadow">
    <div class="card-header bg-light-blue text-black">
      <h5 class="mb-0">➕🧾 New Reservation</h5>
    </div>

    <div class="card-body">
      <form action="{{ url('reservations') }}" method="POST">
        @csrf

        {{-- Customer Dropdown --}}
        <div class="mb-3">
          <label for="customer_id" class="form-label">Customer</label>
          <select name="customer_id" id="customer_id" class="form-control input-light-green" required>
            <option value="">Select Customer</option>
            @foreach ($customers as $customer)
              <option value="{{ $customer->id }}">{{ $customer->name }}</option>
            @endforeach
          </select>
        </div>

        {{-- Table Dropdown --}}
        <div class="mb-3">
          <label for="table_id" class="form-label">Table</label>
          <select name="table_id" id="table_id" class="form-control input-light-green" required>
            <option value="">Select Table</option>
            @foreach ($tables as $table)
              <option value="{{ $table->id }}">{{ $table->name }} (Seats: {{ $table->seats }})</option>
            @endforeach
          </select>
        </div>

        {{-- Date --}}
        <div class="mb-3">
          <label for="reservation_date" class="form-label">Date</label>
          <input type="date" name="reservation_date" id="reservation_date" class="form-control input-light-green" required>
        </div>

        {{-- Time --}}
        <div class="mb-3">
          <label for="reservation_time" class="form-label">Time</label>
          <input type="time" name="reservation_time" id="reservation_time" class="form-control input-light-green" required>
        </div>

        <div class="text-end">
          <button type="submit" class="btn btn-success px-4">
            💾 Save
          </button>
        </div>
      </form>
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

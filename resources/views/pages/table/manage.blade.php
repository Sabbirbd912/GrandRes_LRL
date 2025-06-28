@extends("layouts.master")

@section("page")
<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="text-primary">🍽️ Table List</h3>
    <a class="btn btn-success" href="{{ url('tables/create') }}">➕ New Table</a>
  </div>

  <div class="card shadow">
    <div class="card-body table-responsive">
      <table class="table table-bordered align-middle text-center">
        <thead class="table-light">
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Status</th>
            <th>Photo</th>
            <th>Seats</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($tables as $table)
            <tr>
              <td>{{ $table->id }}</td>
              <td>{{ $table->name }}</td>
              <td>
                @if ($table->status == 1)
                  <span class="badge bg-danger">Booked</span>
                @else
                  <span class="badge bg-success">Available</span>
                @endif
              </td>
              <td>
                <img src="{{ url('/img/' . $table->photo) }}" width="80" class="rounded shadow-sm" alt="Table Photo">
              </td>
              <td>{{ $table->seats }}</td>
              <td>
                <div class="btn-group mb-2">
                  <a class="btn btn-primary btn-sm" href="{{ url("tables/$table->id/edit") }}">Edit</a>
                  <a class="btn btn-success btn-sm" href="{{ url("tables/$table->id") }}">View</a>
                  <a class="btn btn-warning btn-sm" href="{{ url("tables/$table->id/confirm") }}">Delete</a>
                </div>

                @if (isset($table->reservation) && $table->reservation->status == 0)
                  <div class="d-flex flex-column gap-1 mt-2">
                    <a href="{{ url("reservations/{$table->reservation->id}/confirm") }}" class="btn btn-success btn-sm">Confirm</a>
                    <a href="{{ url("reservations/{$table->reservation->id}/cancel") }}" class="btn btn-danger btn-sm">Cancel</a>

                    <form action="{{ url('reservations/' . $table->reservation->id . '/checkout') }}" method="POST">
                      @csrf
                      <button type="submit" class="btn btn-primary btn-sm">Checkout</button>
                    </form>
                  </div>
                @endif
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="text-center">No tables found.</td>
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
  .bg-light-blue {
    background-color: #e0f7fa !important;
  }
</style>
@endpush

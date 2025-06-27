@extends("layouts.master")

@section("page")
<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="text-primary">🍽️ Table List</h3>
    <a class="btn btn-success" href="{{ url('tables/create') }}">➕ New Table</a>
  </div>

  <div class="row">
    @forelse($tables as $table)
      <div class="col-md-4 mb-4">
        <div class="card shadow border-0 h-100">
          <div class="card-header bg-dark text-white d-flex justify-content-between">
            <span>{{ $table->name }}</span>
            <span>Seats: {{ $table->seats }}</span>
          </div>
          <img src="{{ url('/img/' . $table->photo) }}" class="card-img-top" style="height: 180px; object-fit: cover;" alt="Table Photo">
          <div class="card-body text-center">
            @if ($table->status == 1)
              <span class="badge bg-danger mb-2">Booked</span>
            @else
              <span class="badge bg-success mb-2">Available</span>
            @endif
            <div class="d-grid">
              <a href="{{ url('tables/' . $table->id . '/book') }}" class="btn btn-purple text-white"
                onclick="return confirm('Are you sure you want to place order and book this table?')">
                Place Order
              </a>
            </div>


          </div>
        </div>
      </div>
    @empty
      <div class="col-12">
        <div class="alert alert-warning text-center">
          No tables found.
        </div>
      </div>
    @endforelse
  </div>
</div>
@endsection

@push('styles')
<style>
  .btn-purple {
    background-color: #9c27b0;
  }
  .btn-purple:hover {
    background-color: #7b1fa2;
  }
</style>
@endpush

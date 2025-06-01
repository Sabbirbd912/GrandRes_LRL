@extends("layouts.master")

@section("page")

<div class="container mt-2">
  <a class="btn btn-success mb-3" href="{{ url('tables') }}">⬅ Back to Tables</a>

  <div class="card shadow">
    <div class="card-header bg-light-blue text-black">
      <h5 class="mb-0">➕🪑 Add Table Info</h5>
    </div>

    <div class="card-body">
      <form action="{{ url('tables') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Name --}}
        <div class="mb-3">
          <label for="name" class="form-label">Table Name</label>
          <input type="text" name="name" id="name" class="form-control input-light-green" required>
        </div>

        {{-- Status --}}
        <div class="mb-3">
          <label for="status" class="form-label">Status</label>
          <select name="status" id="status" class="form-control input-light-green" required>
            <option value="0">Available</option>
            <option value="1">Booked</option>
          </select>
        </div>

        {{-- Seats --}}
        <div class="mb-3">
          <label for="seats" class="form-label">Seats</label>
          <input type="number" name="seats" id="seats" class="form-control input-light-green" required>
        </div>

        {{-- Photo --}}
        <div class="mb-3">
          <label for="photo" class="form-label">Photo</label>
          <input type="file" name="photo" id="photo" class="form-control input-light-green">
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

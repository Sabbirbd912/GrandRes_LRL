@extends("layouts.master")

@section("page")

<div class="container mt-2">
  <a class="btn btn-success mb-3" href="{{ url('suppliers') }}">Back</a>

  <div class="card shadow">
    <div class="card-header bg-light-blue text-black">
      <h5 class="mb-0">➕ Add Supplier</h5>
    </div>

    <div class="card-body">
      <form action="{{ url('suppliers') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" name="name" id="name" class="form-control input-light-green" required>
        </div>

        <div class="mb-3">
          <label for="mobile" class="form-label">Mobile</label>
          <input type="number" name="mobile" id="mobile" class="form-control input-light-green" required>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="text" name="email" id="email" class="form-control input-light-green" required>
        </div>
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

{{-- Custom styling for light green input --}}
<style>
  .input-light-green {
    background-color: #eaffea !important;
    border: 1px solidrgb(182, 201, 226);
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

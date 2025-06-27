@extends("layouts.master")

@section("page")

<div class="container mt-2">
  <a class="btn btn-success mb-3" href="{{ url('raw_materials') }}">Back</a>

  <div class="card shadow">
    <div class="card-header bg-light-blue text-black">
      <h5 class="mb-0">➕🧾 Add Raw Material</h5>
    </div>

    <div class="card-body">
      <form action="{{ url('raw_materials') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" name="name" id="name" class="form-control input-light-green" required>
        </div>


        <div class="mb-3">
          <label for="qty" class="form-label">Quantity</label>
          <input type="number" name="qty" id="qty" class="form-control input-light-green" required>
        </div>

        <div class="mb-3">
          <label for="price" class="form-label">Price</label>
          <input type="number" name="price" id="price" class="form-control input-light-green" required>
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

@extends("layouts.master")
@section("page")
<div class="container mt-2">
  <a class="btn btn-success mb-3" href="{{ url('customers') }}">Back</a>

  <div class="card shadow">
    <div class="card-header bg-light-blue text-white">
      <h5 class="mb-0">✏️ Edit Infomations</h5>
    </div>

    <div class="card-body">
      <form action="{{ url('customers/' . $customer->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method("PUT")

        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" name="name" id="name" value="{{ $customer->name }}" class="form-control input-light-green" required>
        </div>

        <div class="mb-3">
          <label for="name" class="form-label">Mobile</label>
          <input type="number" name="mobile" id="name" value="{{ $customer->mobile }}" class="form-control input-light-green" required>
        </div>

        <div class="mb-3">
          <label for="name" class="form-label">Email</label>
          <input type="text" name="email" id="email" value="{{ $customer->email }}" class="form-control input-light-green" required>
        </div>

        <div class="mb-3">
          <label for="name" class="form-label">Address</label>
          <input type="text" name="address" id="address" value="{{ $customer->address }}" class="form-control input-light-green" required>
        </div>

        <div class="mb-3">
          <label for="photo" class="form-label">Photo</label>
          <input type="file" name="photo" id="photo" class="form-control input-light-green">
          @if($customer->photo)
            <img src="{{ url('img/' . $customer->photo) }}" width="120" class="mt-2 rounded shadow-sm" />
          @endif
        </div>
        <div class="text-end">
          <button type="submit" class="btn btn-primary px-4">✅ Update</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- Custom styling for light green input --}}
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

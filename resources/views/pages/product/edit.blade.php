@extends("layouts.master")

@section("page")

<div class="container mt-2">
  <a class="btn btn-success mb-3" href="{{ url('products') }}">Back</a>

  <div class="card shadow">
    <div class="card-header bg-light-blue text-white">
      <h5 class="mb-0">✏️ Edit Items</h5>
    </div>

    <div class="card-body">
      <form action="{{ url('products/' . $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method("PUT")

        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" name="name" id="name" value="{{ $product->name }}" class="form-control input-light-green" required>
        </div>

        <div class="mb-3">
          <label for="offer_price" class="form-label">Price</label>
          <input type="number" name="offer_price" id="offer_price" value="{{ $product->offer_price }}" class="form-control input-light-green" required>
        </div>

        <div class="mb-3">
          <label for="photo" class="form-label">Photo</label>
          <input type="file" name="photo" id="photo" class="form-control input-light-green">

          {{-- Show existing photo if available --}}
          @if(!empty($product->photo))
            <div class="mt-2">
              <img src="{{ asset('img/' . $product->photo) }}" width="120" class="rounded shadow-sm border" alt="Product Photo">
            </div>
          @endif
        </div>


        <div class="mb-3">
          <label for="product_section_id" class="form-label">Section</label>
          <select name="product_section_id" id="product_section_id" class="form-select" required>
            @foreach($sections as $section)
              <option value="{{ $section->id }}" {{ $section->id == $product->product_section_id ? 'selected' : '' }}>
                {{ $section->name }}
            </option>
            @endforeach
          </select>
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

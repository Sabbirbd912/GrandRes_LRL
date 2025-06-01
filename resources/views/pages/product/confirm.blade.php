@extends("layouts.master")

@section("page")

<div class="container mt-5 d-flex justify-content-center">
  <div class="card border-danger shadow-sm w-100" style="max-width: 420px;">
    <div class="card-header bg-danger text-white text-center">
      <h5 class="mb-0">⚠️ Confirm Delete</h5>
    </div>

    <div class="card-body text-center">
      <p class="text-muted mb-2">Are you sure you want to delete:</p>
      <h5 class="text-danger fw-bold">{{ $product->name }}</h5>

      <form action="{{ url('products/' . $product->id) }}" method="POST" class="mt-4 d-inline-block me-2">
        @csrf
        @method("DELETE")
        <button type="submit" class="btn btn-sm btn-danger px-3">
          <i class="fas fa-trash-alt me-1"></i> Confirm
        </button>
      </form>

      <a href="{{ url('products') }}" class="btn btn-sm btn-secondary px-3">
        <i class="fas fa-times me-1"></i> Cancel
      </a>
    </div>
  </div>
</div>

@endsection

@extends("layouts.master")

@section("page")

<div class="container mt-2">
  <div class="card">
        <div class="card-header bg-light-blue text-black">
        <h5 class="mb-0">🍛 Edit Product</h5>
        </div>
    <div class="card-body ">
      <!-- <table class="table table-bordered table-striped table-hover align-middle text-center"> -->
      <table class="table table-bordered align-middle text-center">
        <thead class="table">
          <tr>
            <th>ID</th>
            <th>Photo</th>
            <th>Name</th>
            <th>Price</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($products as $product)
          <tr>
            <td>{{ $product->id }}</td>
            <td>
              <img src='{{ url("/img/$product->photo") }}' width="100" class="rounded shadow-sm" />
            </td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->offer_price }}</td>
            <td>
              <div class="btn-group" role="group">
                <a href='{{ url("products/$product->id/edit") }}' class="btn btn-lg btn-icon text-primary" title="Edit">
                  <i class="fas fa-edit"></i>
                </a>
                <a href='{{ url("products/$product->id") }}' class="btn btn-lg btn-icon text-success" title="View">
                  <i class="fas fa-eye"></i>
                </a>
                <a href='{{ url("products/$product->id/confirm") }}' class="btn btn-lg btn-icon text-danger" title="Delete">
                  <i class="fas fa-trash-alt"></i>
                </a>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="5">No Foods Found</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>

<style>
  .btn-icon {
    transition: 0.4s ease-in-out;
  }

  .btn-icon:hover {
    background-color: rgba(0, 255, 13, 0.24);
    transform: scale(1.2);
    border-radius: 5px;
  }

  .btn-icon i {
    font-size: 1.1rem;
  }

  .bg-light-blue {
    background-color: #e0f7fa !important;
  }
</style>

@endsection

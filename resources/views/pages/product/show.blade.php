@extends("layouts.master")

@section("page")

<div class="container mt-2">
  <a class="btn btn-success mb-3" href="{{ url('products') }}">Back</a>

    <div class="card shadow-sm">
        <div class="card-header bg-light-blue text-white">
        <h5 class="mb-0">🔍Items Details</h5>
        </div>
        <div class="card-body">
        <table class="table table-bordered align-middle text-center">
            <tbody>
            <tr>
                <th>ID</th>
                <td>{{ $product->id }}</td>
            </tr>
            <tr>
                <th>Name</th>
                <td>{{ $product->name }}</td>
            </tr>
            <tr>
                <th>Photo</th>
                <td>
                <img src='{{ url("img/$product->photo") }}' width="200" class="rounded shadow-sm" />
                </td>
            </tr>
            </tbody>
        </table>
        </div>
    </div>
</div>
<style>
    .bg-light-blue {
    background-color: #e0f7fa !important;
  }
</style>
@endsection

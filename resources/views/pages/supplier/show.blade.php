@extends("layouts.master")

@section("page")

<div class="container mt-2">
  <a class="btn btn-success mb-3" href="{{ url('suppliers') }}">Back</a>

    <div class="card shadow-sm">
        <div class="card-header bg-light-blue text-white">
        <h5 class="mb-0">🔍Supplier Details</h5>
        </div>
        <div class="card-body">
        <table class="table table-bordered align-middle text-center">
            <tbody>
            <tr>
                <th>ID</th>
                <td>{{ $supplier->id }}</td>
            </tr>
            <tr>
                <th>Name</th>
                <td>{{ $supplier->name }}</td>
            </tr>
                        <tr>
                <th>Mobile</th>
                <td>{{ $supplier->mobile }}</td>
            </tr>
            <tr>
                <th>E-mail</th>
                <td>{{ $supplier->email }}</td>
            </tr>
            <tr>
                <th>Photo</th>
                <td>
                <img src='{{ url("img/$supplier->photo") }}' width="200" class="rounded shadow-sm" />
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

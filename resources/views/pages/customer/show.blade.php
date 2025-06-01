@extends("layouts.master")

@section("page")

<div class="container mt-2">
  <a class="btn btn-success mb-3" href="{{ url('customers') }}">Back</a>

    <div class="card shadow-sm">
        <div class="card-header bg-light-blue text-white">
        <h5 class="mb-0">👥 Customer Details</h5>
        </div>
        <div class="card-body">
        <table class="table table-bordered align-middle text-center">
            <tbody>
            <tr>
                <th>ID</th>
                <td>{{ $customer->id }}</td>
            </tr>
            <tr>
                <th>Name</th>
                <td>{{ $customer->name }}</td>
            </tr>
            <tr>
                <th>Email Address</th>
                <td>{{ $customer->email }}</td>
            </tr>
            <tr>
                <th>Address</th>
                <td>{{ $customer->address }}</td>
            </tr>
            <tr>
                <th>Photo</th>
                <td>
                <img src='{{ url("img/$customer->photo") }}' width="200" class="rounded shadow-sm" />
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

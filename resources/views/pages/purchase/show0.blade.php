@extends("layouts.master")

@section("page")

<div class="container mt-2">
  <a class="btn btn-success mb-3" href="{{ url('purchases') }}">Back</a>

    <div class="card shadow-sm">
        <div class="card-header bg-light-blue text-white">
        <h5 class="mb-0">🔍Items Details</h5>
        </div>
        <div class="card-body">
        <table class="table table-bordered table-striped align-middle text-start">
            <tbody>
                <tr>
                    <th>ID</th>
                    <td>{{ $purchase->id }}</td>
                </tr>

                <tr>
                    <th>Name</th>
                    <td>{{ $purchase->supplier->name ?? 'N/A' }}</td>
                </tr>

                <tr>
                    <th>Purchase Date</th>
                    <td>{{ $purchase->purchase_date }}</td>
                </tr>

                <tr>
                    <th>Delivery Date</th>
                    <td>{{ $purchase->delivery_date }}</td>
                </tr>

                <tr>
                    <th>Shipping Address</th>
                    <td>{{ $purchase->shipping_address }}</td>
                </tr>

                <tr>
                    <th>Parchase Total</th>
                    <td>{{ $purchase->purchase_total }}</td>
                </tr>

                 <tr>
                    <th>Paid Amount</th>
                    <td>{{ $purchase->paid_amount }}</td>
                </tr>

                <tr>
                    <th>Status</th>
                    <td>{{ $purchase->status_id }}</td>
                </tr>

                <tr>
                    <th>Discount</th>
                    <td>{{ $purchase->discount }}</td>
                </tr>

                <tr>
                    <th>Vat</th>
                    <td>{{ $purchase->vat }}</td>
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
@php
use App\Models\Sales\Customer;
use App\Models\Product;
use App\Models\Company;
use App\Models\OrderDetail;

$customers = Customer::find($order->customer_id);
$company = Company::find(1);
$details = OrderDetail::where('order_id', $order->id)->get();
$sub_total = 0;
@endphp

@extends("layouts.master")
@section("page")

<a class="btn btn-success mb-3" href="{{ url('orders') }}">Back</a>

<div class="card mb-3">
    <div class="card-body">

        <!-- Header -->
        <div class="row align-items-center mb-3">
            <div class="col-auto">
                <img src="{{ asset('img/' . $company->logo) }}" width="100" />
            </div>
            <div class="col text-end">
                <h2 class="mb-3">Order Invoice</h2>
                <h5>{{ $company->name }}</h5>
                <p class="fs--1 mb-0">
                    {{ $company->street_address }}<br />
                    {{ $company->area }}, {{ $company->city }}
                </p>
            </div>
        </div>
        <hr>

        <!-- Customer & Order Info -->
        <div class="row align-items-center">
            <div class="col">
                <h6 class="text-500">Order to</h6>
                <h5>{{ $customers->name }}</h5>
                <p class="fs--1">91/4 Us Street West<br />Sydny ON, M6P 3K9<br />Canada</p>
                <p class="fs--1">
                    <a href="mailto:example@gmail.com">example@gmail.com</a><br />
                    <a href="tel:444466667777">+4444-6666-7777</a>
                </p>
            </div>
            <div class="col-sm-auto ms-auto">
                <table class="table table-sm table-borderless fs--1">
                    <tbody>
                        <tr>
                            <th class="text-sm-end">Order No:</th>
                            <td>{{ $order->id }}</td>
                        </tr>
                        <tr>
                            <th class="text-sm-end">Order Date:</th>
                            <td>{{ $order->order_date }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Order Details Table -->
        <div class="table-responsive scrollbar mt-4 fs--1">
            <table class="table table-striped border-bottom">
                <thead class="light">
                    <tr class="bg-secondary bg-opacity-25 text-white dark__bg-1000">
                        <th class="border-0">Product Name</th>
                        <th class="border-0 text-center">Quantity</th>
                        <th class="border-0 text-end">Rate</th>
                        <th class="border-0 text-end">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($details as $detail)
                        @php
                            $product = Product::find($detail->product_id);
                            $line_total = $detail->qty * $detail->price;
                            $sub_total += $line_total;
                        @endphp
                        <tr class="text-black dark__bg-1000">
                            <td class="border-0">{{ $product ? $product->name : 'No Product Found' }}</td>
                            <td class="border-0 text-center">{{ $detail->qty }}</td>
                            <td class="border-0 text-end">{{ number_format($detail->price, 2) }}</td>
                            <td class="border-0 text-end">{{ number_format($line_total, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-danger">No rows found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Calculation Summary -->
        @php
            $discount = $sub_total * 0.05;
            $tax = ($sub_total - $discount) * 0.03;
            $total = $sub_total - $discount + $tax;
        @endphp

        <div class="row justify-content-end">
            <div class="col-md-4">
                <table class="table table-borderless text-end">
                    <tr>
                        <th class="text-muted">Subtotal:</th>
                        <td class="fw-bold">{{ number_format($sub_total, 2) }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Discount (5%):</th>
                        <td class="fw-bold">{{ number_format($discount, 2) }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Tax (3%):</th>
                        <td class="fw-bold">{{ number_format($tax, 2) }}</td>
                    </tr>
                    <tr class="border-top">
                        <th class="text-dark">Total:</th>
                        <td class="fw-bold text-dark">{{ number_format($total, 2) }}</td>
                    </tr>
                    <tr class="border-top fw-bold">
                        <th class="text-danger">Amount Due:</th>
                        <td class="text-danger">{{ number_format($total, 2) }}</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="button" class="btn btn-secondary w-100 mt-2" onclick="CreatePayment()" value="🧾 Create Payments" />
                        </td>
                    </tr>
                </table>
            </div>
        </div>

    </div>

    <div class="card-footer bg-light">
        <p class="fs--1 mb-0"><strong>Notes:</strong> We really appreciate your business. If there’s anything else we can do, please let us know!</p>
    </div>
</div>

<script>
    let base_url = "http://localhost/intellect8/api";
    function CreatePayment() {
        alert('Payment module coming soon!');
    }
</script>

@endsection
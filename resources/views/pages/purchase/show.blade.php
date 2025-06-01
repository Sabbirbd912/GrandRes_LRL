<?php
use App\Models\Supplier;
use App\Models\Product;
use App\Models\Company;
use App\Models\PurchaseDetail;

$suppliers = Supplier::find($purchase->supplier_id);
$products = Product::all();
$company = Company::find(1);
$details = PurchaseDetail::where('purchase_id', $purchase->id)->get();
$grand_total = 0;
?>

@extends("layouts.master")
@section("page")
<a class="btn btn-success" href="{{ url('purchases') }}">Back</a>

<div class="card mb-3">
    <div class="card-body">
        <div class="row align-items-center mb-3">
            <div class="col-auto">
                <img src="{{ asset('/img/' . $company->logo) }}" width="100" />
            </div>
            <div class="col text-end">
                <h2 class="mb-3">Purchase Invoice</h2>
                <h5>{{ $company->name }}</h5>
                <p class="fs--1 mb-0">
                    {{ $company->street_address }}<br />
                    {{ $company->area }}, {{ $company->city }}
                </p>
            </div>
        </div>

        <hr />

        <div class="row align-items-center">
            <div class="col">
                <h6 class="text-500">Purchase From</h6>
                <h5>{{ $suppliers->name }}</h5>
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
                            <th class="text-sm-end">Purchase No:</th>
                            <td>{{ $purchase->id }}</td>
                        </tr>
                        <tr>
                            <th class="text-sm-end">Purchase Date:</th>
                            <td id="date">{{ $purchase->purchase_date }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="table-responsive scrollbar mt-4 fs--1">
            <table class="table table-striped border-bottom">
                <thead class="light">
                    <tr class="bg-secondary bg-opacity-25 text-white dark__bg-1000">
                        <th class="border-0">Product</th>
                        <th class="border-0 text-center">Quantity</th>
                        <th class="border-0 text-end">Rate</th>
                        <th class="border-0 text-end">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($details as $detail)
                        <?php 
                            $item = Product::find($detail->product_id);
                            $lineTotal = $detail->qty * $detail->price;
                            $grand_total += $lineTotal;
                        ?>
                        <tr class="text-black dark__bg-1000">
                            <td class="border-0">
                                {{ $item ? $item->name : 'No Product Found' }}
                            </td>
                            <td class="border-0 text-center">{{ $detail->qty }}</td>
                            <td class="border-0 text-end">{{ number_format($detail->price, 2) }}</td>
                            <td class="border-0 text-end">{{ number_format($lineTotal, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-danger">No rows found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Totals --}}
        <div class="row justify-content-end">
            <div class="col-md-4">
                <table class="table table-borderless text-end">
                    <tr>
                        <th class="text-muted">Total:</th>
                        <td id="subTotal" class="fw-bold">{{ number_format($grand_total, 2) }}</td>
                    </tr>
{{--
                    <tr>
                        <th class="text-muted">Tax (3%):</th>
                        <td id="tax" class="fw-bold">{{ number_format($grand_total * 0.03, 2) }}</td>
                    </tr>
                    <tr class="border-top">
                        <th class="text-dark">Total:</th>
                        <td id="netTotal" class="fw-bold text-dark">{{ number_format($grand_total * 1.03, 2) }}</td>
                    </tr>
                    <tr class="border-top fw-bold">
                        <th class="text-danger">Amount Due:</th>
                        <td id="due" class="text-danger">{{ number_format($grand_total * 1.03, 2) }}</td>
                    </tr>
    --}}
                </table>
            </div>
        </div>
    </div>

    <div class="card-footer bg-light">
        <p class="fs--1 mb-0">
            <strong>Notes: </strong>We really appreciate your business and if there’s anything else we can do, please let us know!
        </p>
    </div>
</div>
@endsection

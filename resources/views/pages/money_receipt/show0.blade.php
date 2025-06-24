<?php
   use App\Models\Sales\Customer;
   use App\Models\Product;
   use App\Models\Company;
   use App\Models\MoneyReceipt;
   use App\Models\MoneyReceiptDetail;


   $Receipt_last=MoneyReceipt::max('id');
   $customers=Customer::all();
   $products=Product::all();
   $details=MoneyReceiptDetail::where('money_receipt_id', $moneyreceipt->id)->get();
   $company=Company::find(1);
   $sub_total = 0;
?>

@extends("layouts.master")

@section("page")

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 4px;
            background-color: #f9f9f9;
            color: #333;
        }
        .receipt-box {
            max-width: 100%;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        }
        .receipt-box h2 {
            text-align: center;
            margin-bottom: 5px;
        }
        .receipt-box p.center {
            text-align: center;
            margin-top: 0;
            font-size: 14px;
        }
        .info, .info div {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }
        table th {
            background-color: #f2f2f2;
        }
        .total {
            text-align: right;
            margin-top: 15px;
            font-size: 16px;
            font-weight: bold;
        }
        .logo {
            text-align: center;
            margin-bottom: 10px;
        }
        .logo img {
            max-height: 60px;
        }
    </style>

<div class="receipt-box">
    <div class="logo">
        <img src="https://via.placeholder.com/150x50?text=Your+Logo" alt="Logo">
    </div>

    <h2>{{ $company->name }}</h2>
    <p class="center">
        {{ $company->street_address }}<br>
        {{ $company->area }}, {{ $company->city }}
    </p>

    <h3 style="text-align:center; margin-top: 30px;">Money Receipt</h3>

    <div class="info">
        <div>
            <strong>Receipt No:</strong> MR-{{ $money_receipt->id }}
        </div>
        <div>
            <strong>Date:</strong> {{ date('Y-m-d') }}
        </div>
    </div>
    <div class="info">
        <div>
            <strong>Customer Name: </strong> {{ $moneyreceipt->customer->name ?? 'Unknown Customer' }}
        </div>
        <div>
            <strong>Payment Method:</strong> Cash
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Description</th>
                <th>Unit</th>
                <th>Price</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($details as $detail)
                @php
                    $product = Product::find($detail->product_id);
                    $line_total = $detail->qty * $detail->price;
                    $sub_total += $line_total;
                @endphp
                <tr>
                    <td>{{ $product ? $product->name : 'No Product Found' }}</td>
                    <td>{{ $detail->qty }}</td>
                    <td>{{ number_format($detail->price, 2) }}</td>
                    <td>{{ number_format($line_total, 2) }}</td>
                </tr>
            @empty
                <tr>
                    <td>No rows Found</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="total">
        Total: {{$sub_total}}
    </div>
</div>

    
@endsection
@extends("layouts.master")

@section("page")

<style>

    .receipt-box {
        font-family: Arial, sans-serif;
        color: #333;
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
        @media print {
        .no-print, .no-print * {
            display: none !important;
        }
    }
</style>

<div class="receipt-box">
    <div class="logo">
        <img src="{{ asset('img/' . $company->logo) }}" width="100" />
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
            <strong>Date:</strong> {{ $money_receipt->created_at->format('Y-m-d') }}
        </div>
    </div>
    <div class="info">
        <div>
            <strong>Customer Name:</strong> {{ $money_receipt->customer->name ?? 'Unknown Customer' }}
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
            @php $sub_total = 0; @endphp
            @forelse ($details as $detail)
                @php
                    $line_total = $detail->qty * $detail->price;
                    $sub_total += $line_total;
                @endphp
                <tr>
                    <td>{{ $detail->product->name ?? 'No Product' }}</td>
                    <td>{{ $detail->qty }}</td>
                    <td>{{ number_format($detail->price, 2) }}</td>
                    <td>{{ number_format($line_total, 2) }}</td>
                </tr>
            @empty
                <tr><td colspan="4">No rows Found</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="total">
        Total: {{ number_format($sub_total, 2) }}
    </div>
</div>
<div class="no-print" style="text-align: left; margin-bottom: 20px;">
    <button onclick="window.print()" class="btn btn-primary">🖨️ Print</button>
</div>

@endsection


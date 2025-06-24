<?php
   use App\Models\Sales\Customer;
   use App\Models\Product;
   use App\Models\Company;

   $customers = Customer::all();
   $products = Product::all();
   $company = Company::find(1);
?>
@extends("layouts.master")
@section("page")

<div class="card mb-3 shadow-sm">
    <div class="card-body">
        {{-- Header with Logo and Company Info --}}
        <div class="row align-items-center mb-4">
            <div class="col-md-6 text-start">
                <img src='{{ asset("/img/{$company->logo}") }}' alt="Logo" width='100' class="img-fluid rounded" />
            </div>
            <div class="col-md-6 text-end">
                <h2 class="mb-1">🧾 Create Money Receipt</h2>
                <h5 class="fw-bold mx-2">{{ $company->name }}</h5>
                <p class="mb-0 text-muted">
                    {{ $company->street_address }}<br>
                    {{ $company->area }}, {{ $company->city }}
                </p>
            </div>
        </div>

        <hr />

        {{-- Customer Info --}}
        <div class="row align-items-start mb-4">
            <div class="col-md-6">
                <h6 class="text-secondary fw-semibold">Customer</h6>
                <select id="customer_id" class="form-select mb-2">
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                    @endforeach
                </select>
                <p class="mb-0 text-muted">91/4 Us Street West<br>Sydney ON, M6P 3K9<br>Canada</p>
                <p class="mb-0">
                    <a id="email" href="mailto:example@gmail.com">example@gmail.com</a><br>
                    <a id="mob" href="tel:+444466667777">+4444-6666-7777</a>
                </p>
            </div>
            <div class="col-md-6 text-end">
                <table class="table table-borderless table-sm mb-0">
                    <tr>
                        <th class="text-end">Receipt No:</th>
                        <td>{{ $Receipt_last + 1 }}</td>
                    </tr>
                    <tr>
                        <th class="text-end">Table No:</th>
                        <td><input type="number" name="table" id="table" class="form-control" /></td>
                    </tr>
                    <tr>
                        <th class="text-end">Order Date:</th>
                        <td id="date">{{ date('Y-m-d') }}</td>
                    </tr>
                </table>
            </div>
        </div>

        {{-- Product Entry --}}
        <div class="table-responsive mb-4">
            <table class="table table-bordered align-middle">
                <thead>
                    <tr class="bg-secondary text-white">
                        <th>Foods</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-end">Rate</th>
                        <th class="text-end">Amount</th>
                        <th class="text-end">Action</th>
                    </tr>
                    <tr>
                        <td>
                            <select id="product_id" class="form-select">
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="text-center"><input type="text" id="unit" name="unit" value="1" class="form-control text-center" /></td>
                        <td class="text-end"><input type="text" id="price" name="price" class="form-control text-end" /></td>
                        <td class="text-end" id="amount">0.00</td>
                        <td class="text-end"><input type="button" value="➕" id="btnAdd" class="btn btn-success w-100" /></td>
                    </tr>
                </thead>
                <tbody id="tbody">
                    {{-- Dynamic rows will be added here --}}
                </tbody>
            </table>
        </div>

        {{-- Totals --}}
        <div class="row justify-content-end">
            <div class="col-md-4">
                <table class="table table-borderless text-end">
                    <tr>
                        <th class="text-muted">Subtotal:</th>
                        <td id="subTotal" class="fw-bold">0.00</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Tax (3%):</th>
                        <td id="tax" class="fw-bold">0.00</td>
                    </tr>
                    <tr class="border-top">
                        <th class="text-dark">Total:</th>
                        <td id="netTotal" class="fw-bold text-dark">0.00</td>
                    </tr>
                    <tr class="border-top fw-bold">
                        <th class="text-danger">Amount Due:</th>
                        <td id="due" class="text-danger">0.00</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="button" class="btn btn-primary w-100 mt-2" onclick="CreateInvoice()" value="🧾 Create Invoice" />
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="card-footer bg-light">
        <p class="fs-sm text-muted mb-0">
            <strong>Note:</strong> We really appreciate your business. If there's anything else we can do, please let us know!
        </p>
    </div>
</div>

{{-- JavaScript --}}
<script>
    let base_url = "http://127.0.0.1:8000/api";
    let cart = [];

    document.querySelector("#btnAdd").addEventListener("click", () => {
        let unit = parseFloat(document.querySelector("#unit").value) || 1;
        let price = parseFloat(document.querySelector("#price").value) || 0;
        let product_id = document.querySelector("#product_id").value;
        let product_name = document.querySelector("#product_id").selectedOptions[0].text;
        let vat = 0;
        let discount = 0;
        let lineTotal = (unit * price) - discount + vat;

        let json = {
            id: cart.length + 1,
            desc: product_name,
            product_id: product_id,
            qty: unit,
            price: price,
            discount: discount,
            vat: vat,
            lineTotal: lineTotal
        };

        cart.push(json);
        printCart();
    });

    function printCart() {
        let html = "";
        let total = 0;

        cart.forEach(item => {
            html += `<tr>
                        <td class="align-middle"><h6 class="mb-0 text-nowrap">${item.desc}</h6></td>
                        <td class="align-middle text-center">${item.qty}</td>
                        <td class="align-middle text-end">${item.price}</td>
                        <td class="align-middle text-end">${item.lineTotal.toFixed(2)}</td>
                        <td class="align-middle text-end">
                            <input type="button" onclick="del(${item.id})" value="🗑" class="btn btn-sm btn-danger" />
                        </td>
                    </tr>`;
            total += item.lineTotal;
        });

        let tax = total * 0.03;
        let netTotal = total + tax;

        document.querySelector("#tbody").innerHTML = html;
        document.querySelector("#subTotal").innerHTML = total.toFixed(2);
        document.querySelector("#tax").innerHTML = tax.toFixed(2);
        document.querySelector("#netTotal").innerHTML = netTotal.toFixed(2);
        document.querySelector("#due").innerHTML = netTotal.toFixed(2);
    }

    function del(id) {
        let index = cart.findIndex(item => item.id === id);
        if (index !== -1) {
            cart.splice(index, 1);
        }
        printCart();
    }

    async function CreateInvoice() {
        if (!cart.length) {
            alert("Please add at least one item.");
            return;
        }

        if (confirm("Are you sure to create this invoice?")) {
            let date = document.querySelector("#date").innerHTML;
            let customer_id = document.querySelector("#customer_id").value;
            let total = parseFloat(document.querySelector("#netTotal").innerHTML);
            let table = document.querySelector("#table")?.value || null;

            let jsonData = {
                created_at: date,
                updated_at: date,
                customer_id: customer_id,
                remark: "Na",
                receipt_total: total,
                paid_amount: total,
                payment_term: "CASH",
                previous_due: 0,
                status_id: 1,
                table_id: table,
                discount: 0,
                vat: 0,
                items: cart
            };

            try {
                let response = await fetch(`${base_url}/money_receipts`, {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify(jsonData)
                });

                if (!response.ok) throw new Error("Failed to save invoice");

                let result = await response.json();
                alert("Money receipt saved successfully!");
                cart = [];
                printCart();

            } catch (error) {
                console.error(error);
                alert("Saving failed. Please check console or server.");
            }
        }
    }
</script>
@endsection

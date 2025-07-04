<?php
   use App\Models\Supplier;
   use App\Models\RawMaterial;
   use App\Models\Company;

   $Suppliers = Supplier::all();
   $raw_materials = RawMaterial::all();
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
                <h2 class="mb-1">🧾 Create Purchase</h2>
                <h5 class="fw-bold mx-2">{{ $company->name }}</h5>
                <p class="mb-0 text-muted">
                    {{ $company->street_address }}<br>
                    {{ $company->area }}, {{ $company->city }}
                </p>
            </div>
        </div>

        <hr />

        {{-- Supplier Info and Order Details --}}
        <div class="row align-items-start mb-4">
            <div class="col-md-6">
                <h6 class="text-secondary fw-semibold">Supplier Name</h6>
                <select id="supplier_id" class="form-select mb-2">
                    @foreach($Suppliers as $Supplier)
                        <option value="{{ $Supplier->id }}">{{ $Supplier->name }}</option>
                    @endforeach
                </select>
                <p class="mb-0 text-muted">
                    91/4 Us Street West<br>
                    Sydney ON, M6P 3K9<br>
                    Canada
                </p>
                <p class="mb-0">
                    <a href="mailto:example@gmail.com">example@gmail.com</a><br>
                    <a href="tel:+444466667777">+4444-6666-7777</a>
                </p>
            </div>
            <div class="col-md-6 text-end">
                <table class="table table-borderless table-sm mb-0">
                    <tr>
                        <th class="text-end">Purchase No:</th>
                        <td>002</td>
                    </tr>
                    <tr>
                        <th class="text-end">Purchase Date:</th>
                        <td>{{ date('d-M-Y') }}</td>
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
                            <select id="raw_material_id" class="form-select">
                                @foreach($raw_materials as $raw_material)
                                    <option value="{{ $raw_material->id }}">{{ $raw_material->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="text-center"><input type="text" id="unit" name="unit" value="1" class="form-control text-center" /></td>
                        <td class="text-end"><input type="text" id="price" name="price" class="form-control text-end" /></td>
                        <td class="text-end"></td>
                        <td class="text-end"><input type="button" value="➕" id="btnAdd" class="btn btn-success w-100" /></td>
                    </tr>
                </thead>
                <tbody id="tbody">
                    {{-- Dynamic rows will be appended here --}}
                </tbody>
            </table>
        </div>

        {{-- Totals --}}
        <div class="row justify-content-end">
            <div class="col-md-4">
                <table class="table table-borderless text-end">
                    <tr>
                        <th class="text-muted">Subtotal:</th>
                        <td id="subTotal" class="fw-bold">$00.00</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Tax (3%):</th>
                        <td id="tax" class="fw-bold">$00.00</td>
                    </tr>
                    <tr class="border-top">
                        <th class="text-dark">Total:</th>
                        <td id="netTotal" class="fw-bold text-dark">$00.00</td>
                    </tr>
                    <tr class="border-top fw-bold">
                        <th class="text-danger">Amount Due:</th>
                        <td id="due" class="text-danger">$00.00</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="button" class="btn btn-primary w-100 mt-2" onclick="CreatePurchase()" value="🧾 Create Purchase" />
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    {{-- Footer --}}
    <div class="card-footer bg-light">
        <p class="fs-sm text-muted mb-0">
            <strong>Note:</strong> We really appreciate your business. If there's anything else we can do, please let us know!
        </p>
    </div>
</div>

<script>
    let base_url = "http://localhost/Code_Resources/LARAVEL/GrandRes_LRL/public/api";
    let cart = [];

    document.querySelector("#btnAdd").addEventListener("click", () => {
        let unit = document.querySelector("#unit").value;
        let price = document.querySelector("#price").value;
        let raw_material_id = document.querySelector("#raw_material_id").value;
        let product_name = document.querySelector("#raw_material_id").options[document.querySelector("#raw_material_id").selectedIndex].text;
        let vat = 0;
        let discount = 0;
        let lineTotal = (unit * price - discount + vat);
        let json = {
            id: cart.length + 1,
            desc: product_name,
            raw_material_id: raw_material_id,
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
        cart.forEach((item) => {
            html += "<tr>";
            html += `<td class="align-middle"><h6 class="mb-0 text-nowrap">${item.desc}</h6><p class="mb-0">${item.id}</p></td>`;
            html += `<td class="align-middle text-center">${item.qty}</td>`;
            html += `<td class="align-middle text-end">${item.price}</td>`;
            html += `<td class="align-middle text-end">${item.lineTotal.toFixed(2)}</td>`;
            html += `<td><input type="button" onclick="del(${item.id})" value="del" class="btn btn-sm btn-danger" /></td>`;
            html += "</tr>";
            total += parseFloat(item.lineTotal);
        });

        document.querySelector("#tbody").innerHTML = html;
        document.querySelector("#subTotal").innerHTML = "$" + total.toFixed(2);
        document.querySelector("#netTotal").innerHTML = "$" + total.toFixed(2);
        document.querySelector("#due").innerHTML = "$" + total.toFixed(2);
    }

    function del(id) {
        let index = cart.findIndex((item) => item.id == id);
        cart.splice(index, 1);
        printCart();
    }

    async function CreatePurchase() {
        if (confirm("Are you sure?")) {
            let supplier_id = parseInt(document.querySelector("#supplier_id").value);
            let total = parseFloat(document.querySelector("#netTotal").innerHTML.replace("$", "")) || 0;

            let items = cart.map(item => ({
                raw_material_id: parseInt(item.raw_material_id),
                qty: parseFloat(item.qty),
                price: parseFloat(item.price),
                vat: parseFloat(item.vat) || 0,
                discount: parseFloat(item.discount) || 0
            }));

            let jsonData = {
                supplier_id: supplier_id,
                remark: "Na",
                purchase_total: total,
                paid_amount: total,
                items: items
            };

            let response = await fetch(`${base_url}/purchases`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json"
                },
                body: JSON.stringify(jsonData)
            });

            let result = await response.json();
            if (response.ok) {
                alert("✅ Purchase created successfully!");
                cart = [];
                printCart();
            } else {
                alert("❌ Failed to create purchase. See console for error.");
                console.error("Server error:", result);
            }
        }
    }
</script>

@endsection
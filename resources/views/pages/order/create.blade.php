<?php
   use App\Models\Sales\Customer;
   use App\Models\Product;
   use App\Models\Company;
   use App\Models\Order;
   use App\Models\OrderDetail;

   $Order_last=Order::max('id');
   $customers=Customer::all();
   $products=Product::all();
   $company=Company::find(1);
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
                <h2 class="mb-1">🧾 Create Order</h2>
                <h5 class="fw-bold mx-2">{{ $company->name }}</h5>
                <p class="mb-0 text-muted">
                    {{ $company->street_address }}<br>
                    {{ $company->area }}, {{ $company->city }}
                </p>
            </div>
        </div>

        <hr />

        {{-- Customer Info and Order Details --}}
        <div class="row align-items-start mb-4">
            <div class="col-md-6">
                <h6 class="text-secondary fw-semibold">Order by</h6>
                <select id="customer_id" class="form-select mb-2">
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                    @endforeach
                </select>
                <p id="location" class="mb-0 text-muted">
                    91/4 Us Street West<br>
                    Sydney ON, M6P 3K9<br>
                    Canada
                </p>
                <p class="mb-0">
                    <a id="email" href="mailto:example@gmail.com">example@gmail.com</a><br>
                    <a id="mobile" href="tel:+444466667777">+4444-6666-7777</a>
                </p>
            </div>
            <div class="col-md-6 text-end">
                <table class="table table-borderless table-sm mb-0">
                    <tr>
                        <th class="text-end">Order No:</th>
                        <td>{{$Order_last+1}}</td>
                    </tr>
                    <tr>
                        <th class="text-end">Table No:</th>
                         <td id="table">
                            {{ $table_id ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th class="text-end">Order Date:</th>
                        <td id="date">{{ date('d-M-Y') }}</td>
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
                            <input type="button" class="btn btn-primary w-100 mt-2" onclick="OrderProcess()" value="🧾 Order Process" />
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
   let base_url="http://localhost/Code_Resources/LARAVEL/GrandRes_LRL/public/api";
   let cart=[];

document.getElementById('customer_id').addEventListener('change', async function(){
    var selected_customer=this.value;
    console.log(selected_customer);
    let response =await fetch(`${base_url}/customers/find/${selected_customer}`,{
        method:"GET",
        headers:{"Content-Type":"application/json"}
    });
    if(response.ok){
        let data = await response.json();
        console.log(data);
        document.getElementById('location').textContent=data.customer.address;
        document.getElementById('email').textContent=data.customer.email;
        document.getElementById('mobile').textContent=data.customer.mobile;
    }

})

// adding prodcut to cart ---------------------------
   document.querySelector("#btnAdd").addEventListener("click",(e)=>{
       
       // let desc=document.querySelector("#description").value;
        let unit=document.querySelector("#unit").value;
        let price=document.querySelector("#price").value;
        let product_id=document.querySelector("#product_id").value;
        let product_name= document.querySelector("#product_id").options[document.querySelector("#product_id").selectedIndex].text;
        let vat=0;
        let discount=0;
        let lineTotal=unit*price-discount+vat;
        let json={id:cart.length+1,desc:product_name,product_id:product_id,qty:unit,price:price,discount:discount,vat:vat,lineTotal:lineTotal};

        cart.push(json);        
        console.log(cart);
        printCart();
    });

// Print card------------------
    function printCart(){
        let html="";
        let total=0;
        cart.forEach((item)=>{
            html+="<tr>";
            html+=`<td class="align-middle"><h6 class="mb-0 text-nowrap">${item.desc}</h6><p class="mb-0">${item.id}</p></td>`;
            html+=`<td class="align-middle text-center">${item.qty}</td>`;
            html+=`<td class="align-middle text-end">${item.price}</td>`;
            html+=`<td class="align-middle text-end">${item.lineTotal}</td>`;
            html+=`<td><input type="button" onclick="del(${item.id})" value="del" /></td>`;
            html+="</tr>";
            total+=item.lineTotal;
        });

      document.querySelector("#tbody").innerHTML=html;
      document.querySelector("#subTotal").innerHTML=total;
      document.querySelector("#netTotal").innerHTML=total;

    }


    function del(id){
      let index=cart.findIndex((item)=>{
        return item.id==id;
      });
       cart.splice(index,1);
       printCart();
    }
// Processing Order ------------------
    async function OrderProcess(){        

      if(confirm("Are you sure?")){
        let date=document.querySelector("#date").innerHTML;
        let customer_id=document.querySelector("#customer_id").value;
        let total=document.querySelector("#netTotal").innerHTML;
        let table_id=document.querySelector("#table").innerHTML;
        
        // ✅ STEP: Auto Reserve Table & Confirm
        await fetch(`${base_url}/auto-reserve`, {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ table_id: table_id, customer_id: customer_id })
        });

        let jsonData={
            customer_id:customer_id,
            shipping_address:"N/A",
            order_total:total,
            paid_amount:total,
            remark:"Na",
            payment_term:"CASH",
            previous_due:0,
            status_id:1,
            table_id:table_id,
            created_at:date,
            updated_at:date,
            discount:0,
            vat:0,
            items:cart
        }

        console.log(jsonData);

        let response=await fetch(`${base_url}/orders`,{
        method:"POST",
        headers:{"Content-Type":"application/json"},
        body:JSON.stringify(jsonData)
      });

      let json=response.json();
      console.log(json);

      cart=[];
      printCart();

      }

}

</script>

@endsection
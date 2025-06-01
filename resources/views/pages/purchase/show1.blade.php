<?php
   use App\Models\Supplier;
   use App\Models\Product;
   use App\Models\Company;
   use App\Models\PurchaseDetail;

   $customers=Supplier::find($purchase->supplier_id);
   $products=Product::all();
   $company=Company::find(1);
   $details = PurchaseDetail::where('purchase_id', $purchase->id)->get();
   //print_r($details);
?>

@extends("layouts.master")
@section("page")
        <a class="btn btn-success" href="{{url('purchases')}}">Back</a>
         
<div class="card mb-3">
    <div class="card-body">
        <div class="row align-items-center mb-3">
            <div class="col-auto">
                <img src='<?=asset("/img")?>/<?=$company->logo?>' width='100' />
            </div>
            <div class="col text-end">
                <h2 class="mb-3">Purchase Invoice</h2>
                <h5><?=$company->name?></h5>
                <p class="fs--1 mb-0"><br /><?=$company->street_address?><br /><?=$company->area?>, <?=$company->city?></p>
            </div>
        </div>
        <div class="col-12">
            <hr />
        </div>

        <div class="row align-items-center">
            <div class="col">
                <h6 class="text-500">Purchase From</h6>
                <h5>
                 {{ $customers->name}}
                </h5>
                <p class="fs--1">91/4 Us Street West<br />Sydny ON, M6P 3K9<br />Canada</p>
                <p class="fs--1"><a href="mailto:example@gmail.com">example@gmail.com</a><br /><a
                        href="tel:444466667777">+4444-6666-7777</a></p>
            </div>
            <div class="col-sm-auto ms-auto">
                <div class="table-responsive">
                    <table class="table table-sm table-borderless fs--1">
                        <tbody>
                            <tr>
                                <th class="text-sm-end">Purchase No:</th>
                                <td>{{ $purchase->id }}</td>
                            </tr>                          
                            <tr>
                                <th class="text-sm-end">Purchase Date:</th>
                                <td id="date">{{ $purchase->purchase_date }} </td>
                            </tr>
                                                      
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="table-responsive scrollbar mt-4 fs--1">
            <table class="table table-striped border-bottom">
                <thead class="light">
                    <tr class="bg-secondary bg-opacity-25 text-white dark__bg-1000">
                        <th class="border-0">Product_Id</th>
                        <th class="border-0 text-center">Quantity</th>
                        <th class="border-0 text-end">Rate</th>
                        <th class="border-0 text-end">Amount</th>
                        <th class="border-0 text-end">Total</th>

                    </tr>
                </thead>
                <tbody>
                    @forelse ($details as $detail)
                        <tr class="text-black dark__bg-1000">
                            <td class="border-0">
                                <?php $item=Product::find($detail->product_id);
                                    if($item){
                                        echo $item->name; 
                                    }else{
                                        echo "No Product Found";
                                    }
                                    
                                ?>
                             </td>
                            <td class="border-0 text-center">{{ $detail->qty }}</td>
                            <td class="border-0 text-end">{{ number_format($detail->price, 2) }}</td>
                            <td class="border-0 text-end">{{$lines=number_format($detail->qty * $detail->price, 2) }}</td>
                            <td class="border-0 text-end">{{$total+=lines }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-danger">No rows found</td>
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
                            <input type="button" class="btn btn-primary w-100 mt-2" onclick="CreateInvoice()" value="🧾 Create Invoice" />
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="card-footer bg-light">
        <p class="fs--1 mb-0"><strong>Notes: </strong>We really appreciate your business and if there’s anything
            else we can do, please let us know!</p>
    </div>
</div>

<script>
   let base_url="http://localhost/intellect8/api";
   let cart=[];


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

    async function CreateInvoice(){        

      if(confirm("Are you sure?")){
        let date=document.querySelector("#date").innerHTML;
        let customer_id=document.querySelector("#customer_id").value;
        let total=document.querySelector("#netTotal").innerHTML;
        
        
        let jsonData={
            created_at:date,
            updated_at:date,
            customer_id:customer_id,
            remark:"Na",
            payment_term:"CASH",
            invoice_total:total,
            paid_total:total,
            previous_due:0,
            items:cart
        }

        console.log(jsonData);

        let response=await fetch(`${base_url}/invoice/save`,{
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
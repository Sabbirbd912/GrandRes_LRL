@extends("layouts.master")
    @section("page")
        <?php
            use App\Libraries\Core\File;
        ?>

        <div class="container">

            <!-- <a class="btn btn-info" href="{{url('orders/create')}}">New Order</a> -->
            <table class="table">
                <tr>
                    <th>Id</th>
                    <th>Customer Id</th>
                    <th>Remark</th>
                    <th>Receipt_total</th>
                    <th>Discount</th>
                    <th>Vat</th>
                    <th>Action</th>
                </tr>
            @forelse ($money_receipts as $money_receipt)
                <tr>
                    <td>{{$money_receipt->id}}</td>
                    <td>{{ $money_receipt->customer->name ?? 'No Customer' }}</td>
                    <td>{{$money_receipt->remark}}</td>
                    <td>{{$money_receipt->receipt_total}}</td>
                    <td>{{$money_receipt->discount}}</td>
                    <td>{{$money_receipt->vat}}</td>
                    <td>
                        <div class="btn-group">
                            <a class="btn btn-primary" href='{{url("money_receipts/$money_receipt->id/edit")}}'>Edit</a>
                            <a class="btn btn-success" href='{{url("money_receipts/$money_receipt->id")}}'>View</a>
                            <a class="btn btn-warning" href='{{url("money_receipts/$money_receipt->id/delete")}}'>Delete</a>

                        </div>
                    </td>
                </tr>
                
            @empty
                <tr><td>No Receipt</td></tr>
            @endforelse
        </div>




    @endsection
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
                    <th>Order Date</th>
                    <th>Delivery Date</th>
                    <th>Address</th>
                    <th>Status</th>
                </tr>
            @forelse ($orders as $order)
                <tr>
                    <td>{{$order->id}}</td>
                    <td>{{ $order->customer->name ?? 'No Customer' }}</td>
                    <td>{{$order->order_date}}</td>
                    <td>{{$order->delivery_date}}</td>
                    <td>{{$order->shipping_address}}</td>
                    <td>{{$order->status_id}}</td>
                    <td>
                        <div class="btn-group">
                            <a class="btn btn-primary" href='{{url("orders/$order->id/edit")}}'>Edit</a>
                            <a class="btn btn-success" href='{{url("orders/$order->id")}}'>View</a>
                            <a class="btn btn-warning" href='{{url("orders/$order->id/delete")}}'>Delete</a>
                        </div>
                    </td>
                </tr>
                
            @empty
                <tr><td>No Order</td></tr>
            @endforelse
        </div>




    @endsection
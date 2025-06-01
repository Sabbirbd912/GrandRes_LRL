@extends("layouts.master")

@section("page")

<?php
  use App\Libraries\Core\File;
?>

<div class="container">


<!-- <a class="btn btn-info" href="{{url('customers/create')}}">New Customer</a> -->
<table class="table">
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Mobile</th>
        <th>Email</th>
        <th>Address</th>
        <th>Photo</th>
    </tr>
    @forelse ($customers as $customer)
        <tr>
            <td>{{$customer->id}}</td>
            <td>{{$customer->name}}</td>
            <td>{{$customer->mobile}}</td>
            <td>{{$customer->email}}</td>
            <td>{{$customer->address}}</td>
            <td><img src='{{url("/img/$customer->photo")}}' width="100" /> </td>

            <td>
                <div class="btn-group">
                    <a class="btn btn-primary" href='{{url("customers/$customer->id/edit")}}'>Edit</a>
                    <a class="btn btn-success" href='{{url("customers/$customer->id")}}'>View</a>
                    <a class="btn btn-warning" href='{{url("customers/$customer->id/delete")}}'>Delete</a>
                </div>
            </td>
        </tr>
        
    @empty
        <tr><td>No Customer</td></tr>
    @endforelse
</div>

@endsection
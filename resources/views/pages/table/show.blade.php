@extends("layouts.master")

@section("page")
<a class="btn btn-success" href="{{url('tables')}}">Back</a>
<table class="table">
<tr>  
 <td>Id</td><td>{{$table->id}}</td>
</tr>
<tr>  
 <td>Name</td><td>{{$table->name}}</td>
</tr>
<tr>  
 <td>Photo</td><td><img src='{{url("img/$table->photo")}}' /></td>
</tr>
</table>
@endsection
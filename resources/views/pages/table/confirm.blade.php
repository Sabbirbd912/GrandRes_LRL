@extends("layouts.master")

@section("page")
<a class="btn btn-success" href="{{url('tables')}}">Back</a>
<br>
Are  you sure?
<br>
<h2>{{$table->name}}</h2>

<form action="{{url('tables/'.$table->id)}}" method="post">
  @csrf
  @method("DELETE")
  <input class="btn btn-danger" type="submit" value="Confirm" />
</form>
@endsection
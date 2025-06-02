@extends("layouts.master")

@section("page")
<form action="{{url('orders')}}" method="post" enctype="multipart/form-data">
  @csrf
  Customer ID<br>
  <input type="number" placeholder="id number" name="customer_id" />
  <br>
  Ordate Date <br>
  <input type="date" name="order_date"/>
  <br>
  Delivery Date<br>
  <input type="date" name="delivery_date" />
  <br>
  Shopping Address <br>
    <input type="text" placeholder="Text" name="shipping_address"/>
  <br>
  Order Total <br>
    <input type="number" placeholder="Number" name="order_total"/>
  <br>
  Paid Amount <br>
    <input type="number" placeholder="Number" name="paid_amount"/>
  <br>
  Remark <br>
    <input type="text" placeholder="Text" name="remark"/>
  <br>
    Status ID <br>
    <input type="number" placeholder="Number" name="status_id"/>
  <br>
    Discount <br>
    <input type="number" placeholder="Number" name="discount"/>
  <br>
      VAT <br>
    <input type="number" placeholder="Number" name="vat"/>
  <br>
  <input type="submit" value="Save" />
</form>
@endsection
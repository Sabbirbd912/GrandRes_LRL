@extends("layouts.master")

@section("page")

<div class="container mt-2">
  <a class="btn btn-success mb-3" href="{{ url('orders') }}">Back</a>

  <div class="card shadow">
    <div class="card-header bg-light-blue text-white">
      <h5 class="mb-0">✏️ Edit Orders</h5>
    </div>

    <div class="card-body">
      <form action="{{ url('orders/' . $order->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method("PUT")

        <div class="mb-3">
          <label for="customer_id" class="form-label">Customer_ID</label>
          <input type="number" name="customer_id" id="customer_id" value="{{ $order->customer_id }}" class="form-control input-light-green" required>
        </div>

        <div class="mb-3">
          <label for="order_date" class="form-label">Order_Date</label>
          <input type="number" name="order_date" id="order_date" value="{{ $order->order_date }}" class="form-control input-light-green" required>
        </div>
        <div class="mb-3">
          <label for="delivery_date" class="form-label">Delivery_Date</label>
          <input type="number" name="delivery_date" id="delivery_date" value="{{ $order->delivery_date }}" class="form-control input-light-green" required>
        </div>

        <div class="mb-3">
          <label for="shipping_address" class="form-label">shipping_Address</label>
          <input type="number" name="shipping_address" id="shipping_address" value="{{ $order->shipping_address }}" class="form-control input-light-green" required>
        </div>

        <div class="mb-3">
          <label for="order_total" class="form-label">Order_Total</label>
          <input type="number" name="order_total" id="order_total" value="{{ $order->order_total }}" class="form-control input-light-green" required>
        </div>

        <div class="mb-3">
          <label for="paid_amount" class="form-label">Paid_Amount</label>
          <input type="number" name="paid_amount" id="paid_amount" value="{{ $order->paid_amount }}" class="form-control input-light-green" required>
        </div>

        <div class="mb-3">
          <label for="remark" class="form-label">Remark</label>
          <input type="number" name="remark" id="remark" value="{{ $order->remark }}" class="form-control input-light-green" required>
        </div>
        <div class="mb-3">
          <label for="status_id" class="form-label">Status_Id</label>
          <input type="number" name="status_id" id="status_id" value="{{ $order->status_id }}" class="form-control input-light-green" required>
        </div>
        <div class="mb-3">
          <label for="discount" class="form-label">Discount</label>
          <input type="number" name="discount" id="discount" value="{{ $order->discount }}" class="form-control input-light-green" required>
        </div>
        <div class="mb-3">
          <label for="vat" class="form-label">Vat</label>
          <input type="number" name="vat" id="vat" value="{{ $order->vat }}" class="form-control input-light-green" required>
        </div>
        <div class="text-end">
          <button type="submit" class="btn btn-primary px-4">✅ Update</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- Custom styling for light green input --}}
<style>
  .input-light-green {
    background-color: #eaffea !important;
    border: 1px solid #b6e2b6;
  }

  .input-light-green:focus {
    background-color: #dfffe0 !important;
    border-color: #80d980;
    box-shadow: 0 0 0 0.2rem rgba(0, 255, 0, 0.25);
  }
      .bg-light-blue {
    background-color: #e0f7fa !important;
  }
</style>

@endsection

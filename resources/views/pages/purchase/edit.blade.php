@extends("layouts.master")

@section("page")

<div class="container mt-2">
  <a class="btn btn-success mb-3" href="{{ url('purchases') }}">Back</a>

  <div class="card shadow">
    <div class="card-header bg-light-blue text-white">
      <h5 class="mb-0">✏️ Edit Purchase</h5>
    </div>

    <div class="card-body">
      <form action="{{ url('purchases/' . $purchase->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method("PUT")

        <div class="mb-3">
          <label for="supplier_id" class="form-label">Supplier_id</label>
          <input type="number" name="supplier_id" id="supplier_id" value="{{ $purchase->supplier_id }}" class="form-control input-light-green" required>
        </div>

        <div class="mb-3">
          <label for="purchase_date" class="form-label">Purchase Date</label>
          <input type="date" name="purchase_date" id="purchase_date" value="{{ $purchase->purchase_date }}" class="form-control input-light-green" required>
        </div>

        <div class="mb-3">
          <label for="delivery_date" class="form-label">Delivery Date</label>
          <input type="date" name="delivery_date" id="delivery_date" value="{{ $purchase->delivery_date }}" class="form-control input-light-green" required>
        </div>

        <div class="mb-3">
          <label for="shipping_address" class="form-label">Shipping Address</label>
          <input type="text" name="shipping_address" id="shipping_address" value="{{ $purchase->shipping_address }}" class="form-control input-light-green" required>
        </div>
        <div class="mb-3">
          <label for="purchase_total" class="form-label">Purchase Total</label>
          <input type="number" name="purchase_total" id="purchase_total" value="{{ $purchase->purchase_total }}" class="form-control input-light-green" required>
        </div>
        <div class="mb-3">
          <label for="paid_amount" class="form-label">paid_amount</label>
          <input type="number" name="paid_amount" id="paid_amount" value="{{ $purchase->paid_amount }}" class="form-control input-light-green" required>
        </div>        <div class="mb-3">
          <label for="remark" class="form-label">remark</label>
          <input type="text" name="remark" id="remark" value="{{ $purchase->remark }}" class="form-control input-light-green" required>
        </div>        <div class="mb-3">
          <label for="status_id" class="form-label">status_id</label>
          <input type="number" name="status_id" id="status_id" value="{{ $purchase->status_id }}" class="form-control input-light-green" required>
        </div>
        <div class="mb-3">
          <label for="discount" class="form-label">discount</label>
          <input type="number" name="discount" id="discount" value="{{ $purchase->discount }}" class="form-control input-light-green" required>
        </div>
        <div class="mb-3">
          <label for="vat" class="form-label">Vat</label>
          <input type="number" name="vat" id="vat" value="{{ $purchase->vat }}" class="form-control input-light-green" required>
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

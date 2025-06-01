@extends("layouts.master")

@section("page")

<div class="container mt-2">
  <a class="btn btn-success mb-3" href="{{ url('purchases') }}">Back</a>

  <div class="card shadow">
    <div class="card-header bg-light-blue text-black">
      <h5 class="mb-0">➕🧾 Add Purchase</h5>
    </div>

    <div class="card-body">
      <form action="{{ url('purchases') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
          <label for="supplier_id" class="form-label">Supplier</label>
          <select name="supplier_id" id="supplier_id" class="form-select" required>
            @foreach($suppliers as $supplier)
              <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                {{ $supplier->name }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="mb-3">
          <label for="purchase_date" class="form-label">Purchase Date</label>
          <input type="date" name="purchase_date" id="purchase_date" class="form-control input-light-green" value="{{ old('purchase_date') }}" required>
        </div>

        <div class="mb-3">
          <label for="delivery_date" class="form-label">Delivery Date</label>
          <input type="date" name="delivery_date" id="delivery_date" class="form-control input-light-green" value="{{ old('delivery_date') }}" required>
        </div>

        <div class="mb-3">
          <label for="shipping_address" class="form-label">Shipping Address</label>
          <input type="text" name="shipping_address" id="shipping_address" class="form-control input-light-green" value="{{ old('shipping_address') }}" required>
        </div>

        <div class="mb-3">
          <label for="purchase_total" class="form-label">Purchase Total</label>
          <input type="number" name="purchase_total" id="purchase_total" class="form-control input-light-green" value="{{ old('purchase_total') }}" required>
        </div>

        <div class="mb-3">
          <label for="paid_amount" class="form-label">Paid Amount</label>
          <input type="number" name="paid_amount" id="paid_amount" class="form-control input-light-green" value="{{ old('paid_amount') }}" required>
        </div>

        <div class="mb-3">
          <label for="remark" class="form-label">Remark</label>
          <input type="text" name="remark" id="remark" class="form-control input-light-green" value="{{ old('remark') }}">
        </div>

        <div class="mb-3">
          <label for="status_id" class="form-label">Status</label>
          <input type="number" name="status_id" id="status_id" class="form-control input-light-green" value="{{ old('status_id') }}">
        </div>

        <div class="mb-3">
          <label for="discount" class="form-label">Discount</label>
          <input type="number" name="discount" id="discount" class="form-control input-light-green" value="{{ old('discount') }}">
        </div>

        <div class="mb-3">
          <label for="vat" class="form-label">Vat</label>
          <input type="number" name="vat" id="vat" class="form-control input-light-green" value="{{ old('vat') }}">
        </div>

        <div class="text-end">
          <button type="submit" class="btn btn-success px-4">
            💾 Save
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- Custom styling --}}
<style>
  .input-light-green {
    background-color: #eaffea !important;
    border: 1px solid rgb(182, 201, 226);
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

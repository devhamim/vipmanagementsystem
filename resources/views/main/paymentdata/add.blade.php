@extends('main.layout.app')
@section('content')
<div class="col-md-12">
    <div class="card mb-4">
        <h5 class="card-header">Data Entry</h5>
        <form action="{{ route('paymentdata.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body row">
                <div class="mb-3 col-lg-6">
                    <label for="exampleFormControlInput1" class="form-label">Name</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Name" value="{{ old('name') }}" name="name" required />
                    @error('name')
                        <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3 col-lg-6">
                    <label for="exampleFormControlInput2" class="form-label">Email</label>
                    <input type="email" class="form-control" id="exampleFormControlInput2" placeholder="name@example.com" value="{{ old('email') }}" name="email" required />
                    @error('email')
                        <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3 col-lg-6">
                    <label for="exampleFormControlInput3" class="form-label">Number</label>
                    <input type="number" class="form-control" id="exampleFormControlInput3" placeholder="Number" value="{{ old('number') }}" name="number" />
                    @error('number')
                    <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3 col-lg-6">
                    <label for="online_offline" class="form-label">Online Offline</label>
                    <input type="text" class="form-control" id="online_offline" placeholder="Online Offline" value="{{ old('online_offline') }}" name="online_offline" />
                    @error('online_offline')
                    <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3 col-lg-6">
                    <label for="payment_method" class="form-label">Payment Method</label>
                    <input type="text" class="form-control" id="payment_method" placeholder="Payment Method" value="{{ old('payment_method') }}" name="payment_method" />
                    @error('payment_method')
                    <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3 col-lg-6">
                    <label for="pay" class="form-label">Pay</label>
                    <input type="text" class="form-control" id="pay" placeholder="Pay" value="{{ old('pay') }}" name="pay" />
                    @error('pay')
                    <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3 col-lg-6">
                    <label for="total" class="form-label">Total</label>
                    <input type="text" class="form-control" id="total" placeholder="Total" value="{{ old('total') }}" name="total" />
                    @error('total')
                    <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>

                <div class="mb-3 col-lg-6">
                    <label for="status" class="form-label">Status</label>
                    <select id="status" name="status" class="form-select">
                      <option value="1">Active</option>
                      <option value="0">Deactive</option>
                    </select>
                </div>
                <div class="mb-3 col-lg-12">
                    <label for="note" class="form-label">note</label>
                    <textarea class="form-control" id="note" rows="3" name="note">{{ old('note') }}</textarea>
                    @error('note')
                        <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-lg-6">
                    <button class="btn btn-primary btn-lg" type="submit">Button</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection


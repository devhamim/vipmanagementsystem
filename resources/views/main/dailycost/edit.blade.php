@extends('main.layout.app')
@section('content')
<div class="col-md-12">
    <div class="card mb-4">
        <h5 class="card-header">Daily Cost</h5>
        <form action="{{ route('dailycost.update', $dailycosts->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body row">
                <div class="mb-3 col-lg-6">
                    <label for="exampleFormControlInput1" class="form-label">Name</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Name" value="{{ $dailycosts->name }}" name="name" required />
                    @error('name')
                        <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3 col-lg-6">
                    <label for="exampleFormControlInput2" class="form-label">For Who</label>
                    <input type="text" class="form-control" id="exampleFormControlInput2" placeholder="For Who" value="{{ $dailycosts->forwho }}" name="forwho" required />
                    @error('forwho')
                        <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                {{-- <div class="mb-3 col-lg-6">
                    <label for="pay" class="form-label">Pay</label>
                    <input type="text" class="form-control" id="pay" placeholder="Pay" value="{{ $dailycosts->pay }}" name="pay" />
                    @error('pay')
                    <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div> --}}
                <div class="mb-3 col-lg-6">
                    <label for="total" class="form-label">Total</label>
                    <input type="text" class="form-control" id="total" placeholder="Total" value="{{ $dailycosts->total }}" name="total" />
                    @error('total')
                    <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3 col-lg-12">
                    <label for="note" class="form-label">note</label>
                    <textarea class="form-control" id="note" rows="3" name="note">{{ $dailycosts->note }}</textarea>
                    @error('note')
                        <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>

                <div class="mb-3 col-lg-6">
                    <button class="btn btn-primary btn-lg" type="submit">Button</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection


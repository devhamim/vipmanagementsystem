@extends('main.layout.app')
@section('content')
<div class="col-md-12">
    <div class="card mb-4">
        <h5 class="card-header">Data Entry</h5>
        <form action="{{ route('dataentry.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body row">
                <div class="mb-3 col-lg-6">
                    <label for="formFile" class="form-label">Default file input example</label>
                    <input class="form-control" name="image" value="{{ old('image') }}" type="file" id="formFile">
                    @error('image')
                        <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3 col-lg-6">
                    <label for="exampleFormControlInput1" class="form-label">Name</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Name" value="{{ old('name') }}" name="name" required />
                    @error('name')
                        <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3 col-lg-6">
                    <label for="exampleFormControlInput2" class="form-label">Email</label>
                    <input type="email" class="form-control" id="exampleFormControlInput2" placeholder="name@example.com" value="{{ old('email') }}" name="email" />
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
                    <label for="position" class="form-label">Position</label>
                    <input type="text" class="form-control" id="position" placeholder="Position" value="{{ old('position') }}" name="position" />
                    @error('position')
                    <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3 col-lg-6">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" placeholder="Address" value="{{ old('address') }}" name="address" />
                    @error('address')
                        <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>

                <div class="mb-3 col-lg-6">
                    <label for="age" class="form-label">Age</label>
                    <input type="text" class="form-control" id="age" placeholder="Age" value="{{ old('age') }}" name="age" />
                    @error('age')
                        <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3 col-lg-6">
                    <label for="required" class="form-label">Required</label>
                    <input type="text" class="form-control" id="required" placeholder="Required" value="{{ old('required') }}" name="required" />
                    @error('required')
                        <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3 col-lg-6">
                    <label for="lead" class="form-label">Lead</label>
                    <input type="text" class="form-control" id="lead" placeholder="Lead" value="{{ old('lead') }}" name="lead" />
                    @error('lead')
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
                <div class="col-md">
                    <small class="text-light fw-semibold d-block">Gender</small>
                    <div class="form-check form-check-inline mt-3">
                      <input class="form-check-input" type="radio" id="inlineRadio1" value="Male" name="gender">
                      <label class="form-check-label" for="inlineRadio1">Male</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="inlineRadio2" value="Female" name="gender">
                      <label class="form-check-label" for="inlineRadio2">Female</label>
                    </div>
                    @error('gender')
                        <strong class="text-danger">{{ $message }}</strong>
                    @enderror
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


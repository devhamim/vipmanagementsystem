@extends('main.layout.app')
@section('content')
<div class="col-md-12">
    <div class="card mb-4">
        <h5 class="card-header">Setting</h5>
        <form action="{{ route('setting.update', $setting->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body row">
                <div class="mb-3 col-lg-6">
                    <label for="formFile" class="form-label">Logo</label>
                    <input class="form-control" name="logo" value="{{ $setting->logo }}" type="file" id="formFile">
                    @error('logo')
                        <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3 col-lg-6">
                    <label for="formFile" class="form-label">Favicon</label>
                    <input class="form-control" name="favicon" value="{{ $setting->favicon }}" type="file" id="formFile">
                    @error('favicon')
                        <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3 col-lg-6">
                    <label for="exampleFormControlInput1" class="form-label">Name</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Name" value="{{ $setting->name }}" name="name" required />
                    @error('name')
                        <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3 col-lg-6">
                    <label for="exampleFormControlInput2" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="exampleFormControlInput2" placeholder="name@example.com" value="{{ $setting->email }}" name="email" required />
                    @error('email')
                        <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3 col-lg-6">
                    <label for="exampleFormControlInput3" class="form-label">Number</label>
                    <input type="number" class="form-control" id="exampleFormControlInput3" placeholder="Number" value="{{ $setting->number }}" name="number" />
                    @error('number')
                    <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3 col-lg-6">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" placeholder="Title" value="{{ $setting->title }}" name="title" />
                    @error('title')
                        <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3 col-lg-6">
                    <label for="footer" class="form-label">Footer</label>
                    <input type="text" class="form-control" id="footer" placeholder="Footer" value="{{ $setting->footer }}" name="footer" />
                    @error('footer')
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


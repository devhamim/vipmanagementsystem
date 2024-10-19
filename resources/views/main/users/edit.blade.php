@extends('main.layout.app')
@section('content')
<div class="col-md-12">
    <div class="card mb-4">
        <h5 class="card-header">User Edit</h5>
        <form action="{{ route('user.update', $users->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body row">
                <div class="mb-3 col-lg-6">
                    <label for="formFile" class="form-label">Default file input example</label>
                    <input class="form-control" name="image" value="{{ $users->image }}" type="file" id="formFile">
                    @error('image')
                        <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3 col-lg-6">
                    <label for="exampleFormControlInput1" class="form-label">Name</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Name" value="{{ $users->name }}" name="name" required />
                    @error('name')
                        <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3 col-lg-6">
                    <label for="exampleFormControlInput2" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="exampleFormControlInput2" placeholder="name@example.com" value="{{ $users->email }}" name="email" required />
                    @error('email')
                        <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3 col-lg-6">
                    <label for="exampleFormControlInput3" class="form-label">Number</label>
                    <input type="number" class="form-control" id="exampleFormControlInput3" placeholder="Number" value="{{ $users->number }}" name="number" />
                    @error('number')
                    <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3 col-lg-6">
                    <label for="salary" class="form-label">Salary</label>
                    <input type="number" class="form-control" id="salary" placeholder="Salary" value="{{ $users->salary }}" name="salary" />
                    @error('salary')
                    <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3 col-lg-6">
                    <label for="exampleFormControlInput4" class="form-label">password</label>
                    <input type="password" class="form-control" id="exampleFormControlInput4" placeholder="password" name="password"  />
                    @error('password')
                        <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3 col-lg-6">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="password_confirmation" placeholder="Confirm password" name="password_confirmation"  />
                </div>
                <div class="mb-3 col-lg-6">
                    <label for="role" class="form-label">Role</label>
                    <select id="role" name="role" class="form-select">
                      <option value="0" {{ $users->role == 0?'selected':'' }}>User</option>
                      <option value="2" {{ $users->role == 2?'selected':'' }}>Moderator</option>
                      <option value="1" {{ $users->role == 1?'selected':'' }}>Admin</option>
                    </select>
                </div>
                <div class="mb-3 col-lg-6">
                    <label for="status" class="form-label">Status</label>
                    <select id="status" name="status" class="form-select">
                      <option value="1" {{ $users->status == 1?'selected':'' }}>Active</option>
                      <option value="0" {{ $users->status == 0?'selected':'' }}>Deactive</option>
                    </select>
                </div>
                <div class="mb-3 col-lg-6">
                    <button class="btn btn-primary btn-lg" type="submit">Button</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection


@extends('main.layout.app')
@section('content')
<div class="col-md-12">
    <div class="card mb-4">
        <h5 class="card-header">Matchmaking</h5>
        <form action="{{ route('matchmaking.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body row">
                <div class="mb-3 col-lg-6">
                    <label for="exampleFormControlInput1" class="form-label">Groom Name</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Groom Name" value="{{ old('groom_name') }}" name="groom_name" required />
                    @error('groom_name')
                        <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3 col-lg-6">
                    <label for="exampleFormControlInput2" class="form-label">Groom Number</label>
                    <input type="text" class="form-control" id="exampleFormControlInput2" placeholder="Groom Number" value="{{ old('groom_number') }}" name="groom_number" />
                    @error('groom_number')
                        <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3 col-lg-6">
                    <label for="exampleFormControlInput3" class="form-label">Bride Name</label>
                    <input type="text" class="form-control" id="exampleFormControlInput3" placeholder="Bride Name" value="{{ old('bride_name') }}" name="bride_name" />
                    @error('bride_name')
                    <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3 col-lg-6">
                    <label for="bride_number" class="form-label">Bride Number</label>
                    <input type="text" class="form-control" id="bride_number" placeholder="Bride Number" value="{{ old('bride_number') }}" name="bride_number" />
                    @error('bride_number')
                    <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3 col-lg-6">
                    <label for="meeting_date" class="form-label">Meeting Date</label>
                    <input type="date" class="form-control" id="meeting_date" placeholder="Meeting Date" value="{{ old('meeting_date') }}" name="meeting_date" />
                    @error('meeting_date')
                        <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>

                <div class="mb-3 col-lg-6">
                    <label for="progress_report" class="form-label">Progress Report</label>
                    <input type="text" class="form-control" id="progress_report" placeholder="Progress Report" value="{{ old('progress_report') }}" name="progress_report" />
                    @error('progress_report')
                        <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3 col-lg-6">
                    <label for="marrage_date" class="form-label">Marrage Date</label>
                    <input type="date" class="form-control" id="marrage_date" placeholder="Marrage Date" value="{{ old('marrage_date') }}" name="marrage_date" />
                    @error('marrage_date')
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


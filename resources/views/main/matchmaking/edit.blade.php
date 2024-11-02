@extends('main.layout.app')
@section('content')
<div class="col-md-12">
    <div class="card mb-4">
        <h5 class="card-header">Matchmaking Edit</h5>
        <form action="{{ route('matchmaking.update', $matchmaking->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body row">
                <div class="mb-3 col-lg-6">
                    <label for="exampleFormControlInput1" class="form-label">Groom Name</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Groom Name" value="{{ $matchmaking->groom_name }}" name="groom_name" required />
                    @error('groom_name')
                        <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3 col-lg-6">
                    <label for="exampleFormControlInput2" class="form-label">Groom Number</label>
                    <input type="text" class="form-control" id="exampleFormControlInput2" placeholder="Groom Number" value="{{ $matchmaking->groom_number }}" name="groom_number" />
                    @error('groom_number')
                        <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3 col-lg-6">
                    <label for="exampleFormControlInput3" class="form-label">Bride Name</label>
                    <input type="text" class="form-control" id="exampleFormControlInput3" placeholder="Bride Name" value="{{ $matchmaking->bride_name }}" name="bride_name" />
                    @error('bride_name')
                    <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3 col-lg-6">
                    <label for="bride_number" class="form-label">Bride Number</label>
                    <input type="text" class="form-control" id="bride_number" placeholder="Bride Number" value="{{ $matchmaking->bride_number }}" name="bride_number" />
                    @error('bride_number')
                        <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3 col-lg-6">
                    <label for="meeting_date" class="form-label">Meeting Date</label>
                    <input type="date" class="form-control" id="meeting_date" placeholder="Meeting Date" value="{{ $matchmaking->meeting_date }}" name="meeting_date" />
                    @error('meeting_date')
                        <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3 col-lg-6">
                    <label for="progress_report" class="form-label">Progress Report</label>
                    <input type="text" class="form-control" id="progress_report" placeholder="Progress Report" value="{{$matchmaking->progress_report }}" name="progress_report" />
                    @error('progress_report')
                        <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3 col-lg-6">
                    <label for="marrage_date" class="form-label">Marrage Date</label>
                    <input type="date" class="form-control" id="marrage_date" placeholder="Marrage Date" value="{{ $matchmaking->marrage_date }}" name="marrage_date" />
                    @error('marrage_date')
                        <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3 col-lg-12">
                    <label for="note" class="form-label">note</label>
                    <textarea class="form-control" id="note" rows="3" name="note">{{ $matchmaking->note }}</textarea>
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


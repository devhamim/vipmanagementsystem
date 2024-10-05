@extends('main.layout.app')
@section('content')
<div class="card">
    <div class="d-flex justify-content-between">
        <h5 class="card-header">Data Entry</h5>
        <div class="add-btn card-header me-5">
            <a class="btn btn-primary" href="{{ route('dataentry.create') }}">Add</a>
        </div>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead class="table-light">
                <tr>
                    <th>Sl</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Position</th>
                    <th>Address</th>
                    <th>Gender</th>
                    <th>Age</th>
                    <th>Added By</th>
                    <th>Lead</th>
                    <th>Note</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach($dataentrys as $key => $dataentry)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $dataentry->name }}</strong></td>
                        <td>{{ $dataentry->email }}</td>
                        <td> {{ $dataentry->phone?$dataentry->phone:'Null' }}</td>
                        <td> {{ $dataentry->position?$dataentry->position:'Null' }}</td>
                        <td> {{ $dataentry->address?$dataentry->address:'Null' }}</td>
                        <td> {{ $dataentry->gender?$dataentry->gender:'Null' }}</td>
                        <td> {{ $dataentry->age?$dataentry->age:'Null' }}</td>
                        <td> {{ $dataentry->added_by?$dataentry->added_by:'Null' }}</td>
                        <td> {{ $dataentry->lead?$dataentry->lead:'Null' }}</td>
                        <td> {{ $dataentry->note?$dataentry->note:'Null' }}</td>
                        <td>
                            @if($dataentry->status == 0)
                                <span class="badge bg-label-primary me-1">Deactive</span>
                            @elseif($dataentry->status == 1)
                                <span class="badge bg-label-success me-1">Active</span>
                            @endif
                        </td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('dataentry.edit', $dataentry->id) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>


                                    <form action="{{ route('dataentry.destroy',  $dataentry->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this item?')">
                                            <a class="dropdown-item"><i class="bx bx-trash me-1"></i> Delete</a>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection


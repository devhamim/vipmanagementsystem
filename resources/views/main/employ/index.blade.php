@extends('main.layout.app')
@section('content')
<div class="card">
    <div class="d-flex justify-content-between">
        <h5 class="card-header">Employe</h5>
        {{-- <div class="add-btn card-header me-5">
            <a class="btn btn-primary" href="{{ route('employe.create') }}">Add</a>
        </div> --}}
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead class="table-light">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Salary</th>
                    <th>Final Salary</th>
                    {{-- <th>commission</th> --}}
                    {{-- <th>Status</th> --}}
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach($employes as $key => $employe)
                    <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $employe->name }}</strong></td>
                        <td>{{ $employe->email }}</td>
                        <td>
                            {{ $employe->phone?$employe->phone:'Null' }}
                        </td>
                        <td>
                            {{ $employe->salary?$employe->salary:'Null' }}
                        </td>
                        <td>
                            {{ $employe->havetopay?$employe->havetopay:'Null' }}
                        </td>
                        {{-- <td>
                            {{ $employe->commission?$employe->commission:'Null' }}
                        </td> --}}
                        <td>
                            <a href="{{route('employe.home.view', $employe->id)}}" class="btn btn-warning btn-sm">View</i>&nbsp;</a>
                        </td>

                        {{-- <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('employe.edit', $employe->id) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                    <form action="{{ route('user.destroy',  $employe->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this item?')">
                                            <a class="dropdown-item"><i class="bx bx-trash me-1"></i> Delete</a>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection


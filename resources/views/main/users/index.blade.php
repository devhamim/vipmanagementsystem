@extends('main.layout.app')
@section('content')
<div class="card">
    <div class="d-flex justify-content-between">
        <h5 class="card-header">User</h5>
        <div class="add-btn card-header me-5">
            <a class="btn btn-primary" href="{{ route('user.create') }}">Add</a>
        </div>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead class="table-light">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach($users as $key => $user)
                    <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $user->name }}</strong></td>
                        <td>{{ $user->email }}</td>
                        <td>
                            {{ $user->phone?$user->phone:'Null' }}
                        </td>
                        <td>
                            @if($user->role == 0)
                                <span class="badge bg-label-primary me-1">User</span>
                            @elseif($user->role == 1)
                                <span class="badge bg-label-success me-1">Admin</span>
                            @endif
                        </td>
                        <td>
                            @if($user->status == 0)
                                <span class="badge bg-label-primary me-1">Deactive</span>
                            @elseif($user->status == 1)
                                <span class="badge bg-label-success me-1">Active</span>
                            @endif
                        </td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('user.edit', $user->id) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>


                                    <form action="{{ route('user.destroy',  $user->id) }}" method="POST">
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


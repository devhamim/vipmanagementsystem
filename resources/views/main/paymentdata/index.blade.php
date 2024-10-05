@extends('main.layout.app')
@section('content')
<div class="card">
    <div class="d-flex justify-content-between">
        <h5 class="card-header">Data Entry</h5>
        <div class="add-btn card-header me-5">
            <a class="btn btn-primary" href="{{ route('paymentdata.create') }}">Add</a>
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
                    <th>Online Offline</th>
                    <th>Payment Method</th>
                    <th>Pay</th>
                    <th>Due</th>
                    <th>Total</th>
                    <th>Added By</th>
                    <th>Note</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach($paymentdatas as $key => $paymentdata)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $paymentdata->name }}</strong></td>
                        <td>{{ $paymentdata->email }}</td>
                        <td> {{ $paymentdata->phone?$paymentdata->phone:'Null' }}</td>
                        <td> {{ $paymentdata->online_offline?$paymentdata->online_offline:'Null' }}</td>
                        <td> {{ $paymentdata->payment_method?$paymentdata->payment_method:'Null' }}</td>
                        <td> {{ $paymentdata->pay?$paymentdata->pay:'Null' }}</td>
                        <td> {{ $paymentdata->due?$paymentdata->due:'Null' }}</td>
                        <td> {{ $paymentdata->total?$paymentdata->total:'Null' }}</td>
                        <td> {{ $paymentdata->note?$paymentdata->note:'Null' }}</td>

                        <td>
                            @if($paymentdata->status == 0)
                                <span class="badge bg-label-primary me-1">Deactive</span>
                            @elseif($paymentdata->status == 1)
                                <span class="badge bg-label-success me-1">Active</span>
                            @endif
                        </td>
                        {{-- <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('paymentdata.edit', $paymentdata->id) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>


                                    <form action="{{ route('paymentdata.destroy',  $paymentdata->id) }}" method="POST">
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


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
        <td> {{ $paymentdata->added_by?$paymentdata->added_by:'Null' }}</td>
        <td> {{ $paymentdata->created_at->format('d M Y') }}</td>
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

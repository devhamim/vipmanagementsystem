@foreach($paymentdatas as $key => $paymentdata)
    <tr>
        <td>{{ $key+1 }}</td>
        <td><strong>{{ $paymentdata->name }}</strong></td>
        <td>{{ $paymentdata->email }}</td>
        <td>{{ $paymentdata->number ?? 'Null' }}</td>
        <td>{{ $paymentdata->pay ?? 'Null' }}</td>
        <td>{{ $paymentdata->due ?? 'Null' }}</td>
        <td>{{ $paymentdata->total ?? 'Null' }}</td>
        <td>{{ $paymentdata->rel_to_user->name ?? 'Null' }}</td>
        <td>{{ $paymentdata->verify_by ?? 'Null' }}</td>
        <td>{{ $paymentdata->created_at->format('d M Y') }}</td>
        <td>{{ $paymentdata->online_offline ?? 'Null' }}</td>
        <td>{{ $paymentdata->payment_method ?? 'Null' }}</td>
        <td>
            @if(Auth::user()->role == 1 || Auth::user()->role == 2)
                @if($paymentdata->status == 0)
                    <span class="badge bg-label-primary me-1">Deactive</span>
                @elseif($paymentdata->status == 1)
                    <span class="badge bg-label-success me-1">Active</span>
                @endif

            @endif
        </td>
        <td>{{ $paymentdata->note ?? 'Null' }}</td>
        <td>
            @if(Auth::user()->role == 1 || Auth::user()->role == 2)
                <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('paymentdata.edit', $paymentdata->id) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                        <form action="{{ route('paymentdata.destroy', $paymentdata->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this item?')">
                                <i class="bx bx-trash me-1"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            @endif

        </td>
    </tr>
@endforeach

@foreach($dataentrys as $key => $dataentry)
<tr>
    <td>{{ $key+1 }}</td>
    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $dataentry->name }}</strong></td>
    <td>{{ $dataentry->email }}</td>
    <td> {{ $dataentry->number?$dataentry->number:'Null' }}</td>
    <td> {{ $dataentry->position?$dataentry->position:'Null' }}</td>
    <td> {{ $dataentry->address?$dataentry->address:'Null' }}</td>
    <td> {{ $dataentry->gender?$dataentry->gender:'Null' }}</td>
    <td> {{ $dataentry->age?$dataentry->age:'Null' }}</td>
    <td> {{ $dataentry->required?$dataentry->required:'Null' }}</td>
    <td> {{ $dataentry->added_by?$dataentry->rel_to_user->name:'Null' }}</td>
    <td> {{ $dataentry->lead?$dataentry->lead:'Null' }}</td>
    <td> {{ $dataentry->created_at->format('d M Y') }}</td>
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

@foreach($matchmakings as $key => $matchmaking)
<tr>
    <td>{{ $key+1 }}</td>
    <td>{{ $matchmaking->groom_name }}</td>
    <td>{{ $matchmaking->groom_number }}</td>
    <td> {{ $matchmaking->bride_name ?? 'Null' }}</td>
    <td> {{ $matchmaking->bride_number ?? 'Null' }}</td>
    <td> {{ $matchmaking->meeting_date ?? 'Null' }}</td>
    <td> {{ $matchmaking->progress_report ?? 'Null' }}</td>
    <td> {{ $matchmaking->marrage_date ?? 'Null' }}</td>
    <td> {{ $matchmaking->rel_to_user->name ?? 'Null' }}</td>
    <td> {{ $matchmaking->created_at->format('d M Y') }}</td>

    <td>
        <div class="dropdown">
            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                <i class="bx bx-dots-vertical-rounded"></i>
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('matchmaking.edit', $matchmaking->id) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>


                <form action="{{ route('matchmaking.destroy',  $matchmaking->id) }}" method="POST">
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

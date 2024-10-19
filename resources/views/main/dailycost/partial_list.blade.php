@foreach($dailycosts as $key => $dailycost)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $dailycost->name }}</strong></td>
                        <td> {{ $dailycost->forwho?$dailycost->forwho:'Null' }}</td>
                        <td> {{ $dailycost->added_by?$dailycost->rel_to_user->name:'Null' }}</td>
                        <td> {{ $dailycost->total?$dailycost->total:'Null' }}</td>
                        <td> {{ $dailycost->created_at->format('d M Y') }}</td>
                        <td> {{ $dailycost->note?$dailycost->note:'Null' }}</td>

                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('dailycost.edit', $dailycost->id) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>


                                    {{-- <form action="{{ route('dailycost.destroy',  $dailycost->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this item?')">
                                            <a class="dropdown-item"><i class="bx bx-trash me-1"></i> Delete</a>
                                        </button>
                                    </form> --}}
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach

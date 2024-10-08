@extends('main.layout.app')
@section('content')

<div class="card">
    <div class="d-flex justify-content-between">
        <h5 class="card-header">Daily Cost</h5>
        <div class="add-btn card-header me-5">
            <a class="btn btn-primary" href="{{ route('dailycost.create') }}">Add</a>
        </div>
    </div>

    <!-- Live Search Input -->
    <div class="card-header">
        <input type="text" id="search" class="form-control" placeholder="Search by Name, Added By, etc...">
    </div>

    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead class="table-light">
                <tr>
                    <th>Sl</th>
                    <th>Name</th>
                    <th>For Who</th>
                    <th>Added By</th>
                    <th>Total</th>
                    <th>Date</th>
                    <th>Note</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0" id="dailycost-list">
                @include('main.dailycost.partial_list', ['dailycosts' => $dailycosts])
            </tbody>
        </table>

        <!-- Pagination Links -->
        <div id="pagination-links">
            {{ $dailycosts->links() }}
        </div>
    </div>
</div>

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        $('#search').on('keyup', function(){
            let query = $(this).val();
            fetchDailyCosts(query);
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function fetchDailyCosts(query = ''){
            $.ajax({
                url: "{{ route('dailycost.search') }}",
                method: 'GET',
                data: {query: query},
                success: function(response){
                    $('#dailycost-list').html(response.dailycosts);
                    $('#pagination-links').html(response.pagination);
                },
                error: function(xhr, status, error){
                    console.log('AJAX Error: ', error);
                }
            });
        }
    });
</script>

@endsection

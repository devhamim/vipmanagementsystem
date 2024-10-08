@extends('main.layout.app')

@section('content')
<div class="card">
    <div class="d-flex justify-content-between">
        <h5 class="card-header">Data Entry</h5>
        <div class="add-btn card-header me-5">
            <a class="btn btn-primary" href="{{ route('dataentry.create') }}">Add</a>
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
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Position</th>
                    <th>Address</th>
                    <th>Gender</th>
                    <th>Age</th>
                    <th>Added By</th>
                    <th>Lead</th>
                    <th>Date</th>
                    <th>Note</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="dataentry-list">
                @include('main.dataentry.partial_list', ['dataentrys' => $dataentrys])
            </tbody>
        </table>

        <div id="pagination-links">
            {{ $dataentrys->links() }}
        </div>
    </div>
</div>

<meta name="csrf-token" content="{{ csrf_token() }}">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
    $('#search').on('keyup', function() {
        let query = $(this).val();
        fetchDataEntrys(query);
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function fetchDataEntrys(query = '') {
        $.ajax({
            url: "{{ route('dataentry.search') }}",
            method: 'GET',
            data: { query: query },
            success: function(response) {
                $('#dataentry-list').html(response.dataentrys);
                $('#pagination-links').html(response.pagination);
            },
            error: function(xhr, status, error) {
                console.log('AJAX Error: ', error);
            }
        });
    }
});

</script>
@endsection

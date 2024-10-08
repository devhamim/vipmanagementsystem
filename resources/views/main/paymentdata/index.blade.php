@extends('main.layout.app')

@section('content')

<div class="card">
    <div class="d-flex justify-content-between">
        <h5 class="card-header">Payment Data</h5>
        <div class="add-btn card-header me-5">
            <a class="btn btn-primary" href="{{ route('paymentdata.create') }}">Add</a>
        </div>
    </div>

    <!-- Live Search Input -->
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

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
                    <th>Online Offline</th>
                    <th>Payment Method</th>
                    <th>Pay</th>
                    <th>Due</th>
                    <th>Total</th>
                    <th>Added By</th>
                    <th>Date</th>
                    <th>Note</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0" id="paymentdata-list">
                @include('main.paymentdata.partial_list', ['paymentdatas' => $paymentdatas])
            </tbody>
        </table>

        <div id="pagination-links">
            {{ $paymentdatas->links() }}
        </div>
    </div>
</div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#search').on('keyup', function() {
            let query = $(this).val();  // Capture the input value
            fetchPaymentData(query);
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function fetchPaymentData(query = '') {
            $.ajax({
                url: "{{ route('paymentdata.search') }}",  // Ensure this route is correct
                method: 'GET',
                data: { query: query },  // Sending the search query
                success: function(response) {
                    $('#paymentdata-list').html(response.paymentdatas);
                    $('#pagination-links').html(response.pagination);
                },
                error: function(xhr, status, error) {
                    console.log('AJAX Error: ', error);  // Log AJAX errors for debugging
                }
            });
        }
    });
</script>

@endsection

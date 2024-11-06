
@extends('main.layout.app')

@section('content')
<style>
    .bold {
        font-weight: bold;
        background-color: white; /* Background for new notifications */
    }

    .normal {
        font-weight: normal;
        background-color: #f0f0f0; /* Darker background for seen notifications */
    }

    .preview-item {
        padding: 10px;
    }

    .preview-item:hover {
        background-color: #e5caca;
    }

    .unseen {
        font-weight: bold !important;
        background-color: white !important;
    }

    .seen {
        font-weight: normal !important;
        background-color: #e0e0e0 !important;
        
    }
</style>
<div class="card">
    <div class="d-flex justify-content-between">
        <h5 class="card-header">All Notifications</h5>
        {{-- <div class="filter row">
            <div class="col-lg-10">
                <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                    <i class="fa fa-calendar"></i>&nbsp;
                    <span></span> <i class="fa fa-caret-down"></i>
                    </div>
            </div>
            <div class="col-lg-2">
                <form action="{{ route('paymentdata.index') }}" method="GET">
                    <!-- ... (other form fields) -->
                    <input type="hidden" name="start_date" id="start_date" value="{{ $defaultStartDate }}">
                    <input type="hidden" name="end_date" id="end_date" value="{{ $defaultEndDate }}">
                    <button type="submit">Filter</button>
                </form>
            </div>
        </div> --}}
    </div>

    <div class="table-responsive text-nowrap">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
        <table id="myTable" class="display table">
            <thead class="table-light">
                <tr>
                    <th>Sl</th>
                    <th>Notification</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0" id="paymentdata-list">
                @foreach($notifications as $key => $notification)
                    <tr class="{{ $notification->read_at ? 'seen' : 'unseen' }}">
                        <td>{{ $key+1 }}</td>
                        <td>
                            <a href="{{ route('notifications.read', $notification->id) }}"
                            class="dropdown-item preview-item ">
                                <div class="preview-item-content">
                                    <h6 class="preview-subject">{{ $notification->data['message'] }}</h6>
                                    <p class="font-weight-light small-text mb-0 text-muted">
                                        {{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}
                                    </p>
                                </div>
                            </a>
                        </td>

                        <td>
                            <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link text-danger" onclick="return confirm('Are you sure you want to delete this notification?');">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

        {{-- <div id="pagination-links">
            {{ $paymentdatas->links() }}
        </div> --}}
    </div>
</div>

@endsection


{{-- @section('footer_content')
<script type="text/javascript">
    $(document).ready(function () {
        var start_date = '{{ $defaultStartDate }}';
        var end_date = '{{ $defaultEndDate }}';

        if (start_date && end_date) {
            start_date = moment(start_date, 'YYYY-MM-DD');
            end_date = moment(end_date, 'YYYY-MM-DD');
        } else {
            start_date = moment().subtract(6, 'days');
            end_date = moment();
        }

        function cb(start, end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            $('#start_date').val(start.format('YYYY-MM-DD'));
            $('#end_date').val(end.format('YYYY-MM-DD'));
        }

        $('#reportrange').daterangepicker({
            startDate: start_date,
            endDate: end_date,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);
        cb(start_date, end_date);
    });
    </script>
@endsection --}}


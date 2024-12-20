@extends('main.layout.app')

@section('content')
<div class="card">
    <div class="d-flex justify-content-between">
        <h5 class="card-header">Matchmaking</h5>
        <div class="filter row">
            <div class="col-lg-10">
                <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                    <i class="fa fa-calendar"></i>&nbsp;
                    <span></span> <i class="fa fa-caret-down"></i>
                    </div>
            </div>
            <div class="col-lg-2">
                <form action="{{ route('matchmaking.index') }}" method="GET">
                    <!-- ... (other form fields) -->
                    <input type="hidden" name="start_date" id="start_date" value="{{ $defaultStartDate }}">
                    <input type="hidden" name="end_date" id="end_date" value="{{ $defaultEndDate }}">
                    <button type="submit">Filter</button>
                </form>
            </div>
        </div>
        <div class="add-btn card-header me-5">
            <a class="btn btn-primary" href="{{ route('matchmaking.create') }}">Add</a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <span class="fw-semibold d-block mb-1">Cliend</span>
                    <h3 class="card-title mb-2">{{ $matchmaking_count }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive text-nowrap">
        <table id="myTable" class="display table">
            <thead class="table-light">
                <tr>
                    <th>Sl</th>
                    <th>Groom Name</th>
                    <th>Groom Number</th>
                    <th>Bride Name</th>
                    <th>Bride Number</th>
                    <th>Meeting Date</th>
                    <th>Progress Report</th>
                    <th>Marrage Date</th>
                    <th>Added By</th>
                    <th>Date</th>
                    <th>Note</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="matchmaking-list">
                @include('main.matchmaking.partial_list', ['matchmakings' => $matchmakings])
            </tbody>
        </table>
    </div>
</div>

@endsection

@section('footer_content')
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
@endsection

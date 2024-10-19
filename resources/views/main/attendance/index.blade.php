@extends('main.layout.app')
@section('content')
<div class="card">
    <div class="d-flex justify-content-between">
        <h5 class="card-header">Attendance</h5>
        <form method="GET" action="{{ route('attendance.index') }}">
            <label for="month">Select Month:</label>
            <input type="month" id="month" name="month" value="{{ request('month', \Carbon\Carbon::now()->format('Y-m')) }}">
            <button type="submit">Filter</button>
        </form>
        <div class="add-btn card-header me-5">
            <a class="btn btn-primary" href="{{ route('attendance.create') }}">Add</a>
        </div>
    </div>
    <div class="table-responsive text-nowrap">
        <div class="container">
            <h2>Attendance for {{ \Carbon\Carbon::now()->format('F Y') }}</h2>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Employee</th>
                        @foreach($dates as $date)
                            <th>{{ $date }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($employees as $employee)
                        <tr>
                            <td>{{ $employee->name }}</td>
                            @foreach($dates as $date)
                                @php
                                    $attendanceRecord = $attendance->where('employee_id', $employee->id)->where('date', \Carbon\Carbon::createFromFormat('d/m', $date)->format('Y-m-d'))->first();
                                @endphp
                                <td>
                                    @if($attendanceRecord)
                                        @if($attendanceRecord->status === 'absent')
                                            <span style="color: rgb(5, 38, 255);">Absent</span>
                                        @elseif($attendanceRecord->status === 'off-day')
                                            <span style="color: gray;">d.off</span>
                                        @else
                                            <span style="color: {{ $attendanceRecord->status === 'late' ? 'red' : 'green' }}">
                                                {{ $attendanceRecord->in_time }}
                                            </span>
                                        @endif
                                    @else
                                        d.off
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection




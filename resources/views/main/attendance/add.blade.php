@extends('main.layout.app')
@section('content')
<div class="col-md-12">
    <div class="card mb-4">
        <h5 class="card-header">Attendance Add</h5>
        <form action="{{ route('attendance.store') }}" method="POST">
            @csrf

            <table class="table">
                <thead>
                    <tr>
                        <th>Employee Name</th>
                        <th>In Time</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($employees as $employee)
                        <tr>
                            <td>{{ $employee->name }}</td>
                            <td><input type="time" name="attendance[{{ $employee->id }}][in_time]" class="form-control"></td>
                            <td>
                                <select name="attendance[{{ $employee->id }}][status]" class="form-control">
                                    <option value="">-- Select --</option>
                                    <option value="present">Present</option>
                                    <option value="absent">Absent</option>
                                    <option value="late">Late</option>
                                    <option value="off-day">Off Day</option>
                                </select>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <button type="submit" class="btn btn-primary">Save Attendance</button>
        </form>
    </div>
</div>
@endsection


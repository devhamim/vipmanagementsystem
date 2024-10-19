<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{

        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
{
    $selectedMonth = $request->input('month', Carbon::now()->format('Y-m'));
    $carbonMonth = Carbon::createFromFormat('Y-m', $selectedMonth);
    $employees = Employee::where('status', 1)->get();
    $dates = $this->getDatesForMonth($carbonMonth);

    $attendance = Attendance::whereMonth('date', $carbonMonth->month)
                            ->whereYear('date', $carbonMonth->year)
                            ->get();

    return view('main.attendance.index', [
        'employees' => $employees,
        'dates' => $dates,
        'attendance' => $attendance,
        'selectedMonth' => $carbonMonth, // Pass the selected month to the view
    ]);
}

// Helper method to get dates for the selected month
private function getDatesForMonth(Carbon $month)
{
    $start = $month->copy()->startOfMonth();
    $end = $month->copy()->endOfMonth();

    $dates = [];
    for ($date = $start; $date->lte($end); $date->addDay()) {
        $dates[] = $date->format('d/m');
    }

    return $dates;
}
    /**
     * Display a listing of the resource.
     */
    // public function index(Request $request)
    // {
    //     $employees = Employee::where('status', 1)->get();
    //     $dates = $this->getDatesForCurrentMonth();
    //     $attendance = Attendance::whereMonth('date', Carbon::now()->month)->get();

    //     return view('main.attendance.index', [
    //         'employees'=>$employees,
    //         'dates'=>$dates,
    //         'attendance'=>$attendance,
    //     ]);
    // }

    private function getDatesForCurrentMonth()
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $daysInMonth = Carbon::now()->daysInMonth;

        $dates = [];
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $dates[] = Carbon::create($currentYear, $currentMonth, $day)->format('d/m');
        }

        return $dates;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::where('status', 1)->get();
        $dates = $this->getDatesForCurrentMonth();

        return view('main.attendance.add', [
            'employees'=>$employees,
            'dates'=>$dates,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'attendance.*.status' => 'required|in:present,late,absent,off-day',
        // ]);

        $attendanceData = $request->input('attendance');
        $date = Carbon::now()->format('Y-m-d');

        foreach ($attendanceData as $employeeId => $data) {
            $existingAttendance = Attendance::where('employee_id', $employeeId)
                ->where('date', $date)
                ->first();

            if (!$existingAttendance) {
                Attendance::create([
                    'employee_id' => $employeeId,
                    'date' => $date,
                    'in_time' => $data['in_time'],
                    'status' => $data['status'],
                ]);
            } else {
                $existingAttendance->update([
                    'in_time' => $data['in_time'] ?? $existingAttendance->in_time,
                    'status' => $data['status'] ?? $existingAttendance->status,
                ]);
            }
        }

        $this->calculateSalaryDeductions();

        return redirect()->route('attendance.index')->with('success', 'Attendance saved successfully.');

    }

    public function calculateSalaryDeductions()
{
    $employees = Employee::all();
    $currentMonth = Carbon::now()->month;
    $currentYear = Carbon::now()->year;

    foreach ($employees as $employee) {
        $attendanceRecords = Attendance::where('employee_id', $employee->id)
            ->whereMonth('date', $currentMonth)
            ->whereYear('date', $currentYear)
            ->get();

        $absentDays = 0;
        $lateDays = 0;

        foreach ($attendanceRecords as $record) {
            if ($record->status === 'absent') {
                $absentDays++;
            } elseif ($record->status === 'late') {
                $lateDays++;
            }
        }

        $totalLatePenalties = floor($lateDays / 3);
        $totalSalaryCutDays = $absentDays + $totalLatePenalties;

        $dailySalary = $employee->salary / 30;

        $totalSalaryCut = round($totalSalaryCutDays * $dailySalary);

        $employee->havetopay = max(0, $employee->salary - $totalSalaryCut);
        $employee->save();
    }

    return redirect()->back()->with('success', 'Salary deductions calculated and applied.');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

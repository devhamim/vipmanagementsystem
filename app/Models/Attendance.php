<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;


    protected $guarded = ['id'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    // Method to check if the employee is active
    public function isActive()
    {
        return $this->status === 'active';
    }

    // Method to get attendance status for a specific date
    public function attendanceForDate($date)
    {
        return $this->attendances()->where('date', $date)->first()->status ?? 'absent';
    }
}

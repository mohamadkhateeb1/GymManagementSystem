<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmployeeAttendanceLog extends Model
{
    use HasFactory;

    protected $table = 'employee_attendance_logs';

    protected $fillable = [
        'employee_id',
        'attendance_date',
        'recorded_at',
        'status',
    ];

    protected $casts = [
        'attendance_date' => 'date',
        'recorded_at'      => 'datetime',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}

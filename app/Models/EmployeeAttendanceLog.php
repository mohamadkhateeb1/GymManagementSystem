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
        'check_in_time',
        'check_out_time',
        'status',
    ];

    // حماية التواريخ لكي يتعامل معها لارافيل كـ Carbon Objects فوراً
    protected $casts = [
        'attendance_date' => 'date',
        'check_in_time'   => 'datetime',
        'check_out_time'  => 'datetime',
    ];

    // 🔗 العلاقة: السجل ينتمي لموظف واحد محدد
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}

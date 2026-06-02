<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Player;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // بجيب الموظفين كلهم
       $employees = Employee::with('roles')->latest()->get();
       $employeesCount = $employees->count();
       $playersCount = Player::count();

        return view('Admin.Dashboard', [
            'employees' => $employees,
            'employeesCount' => $employeesCount,
            'playersCount' => $playersCount,
        ]);
    }
}

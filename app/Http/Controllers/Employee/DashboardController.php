<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // المدرب الحالي (الموظف)
        $employee = Auth::guard('employee')->user();

        $myPlayers = Player::where('coach_id', $employee->id)
            ->with('subscription')
            ->get();

        $myPlayersCount = $myPlayers->count();

        return view('Employee.dashboard', compact('myPlayers', 'myPlayersCount'));
    }
}

<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlayerMonitorController extends Controller
{
    public function index()
    {
        $players = Player::where('coach_id', Auth::guard('employee')->id())
            ->with('subscription')
            ->get();

        return view('Employee.monitoring.index', compact('players'));
    }
    public function addTrainingPlan($playerId)
    {
        $player = Player::findOrFail($playerId);

        return view('Employee.Training.create', compact('player'));
    }

    public function storeTrainingPlan(Request $request, $playerId)
    {
        $request->validate([
            'plan_details' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $player = Player::findOrFail($playerId);

        $player->trainingPlans()->create([
            'coach_id' => Auth::guard('employee')->id(),
            'plan_details' => $request->plan_details,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return redirect()->route('employee.monitoring')->with('success', 'Training plan added successfully.');
    }
    public function show($id)
    {
        // جلب اللاعب مع خططه التدريبية مرتبة حسب التاريخ
        $player = Player::with(['subscription', 'trainingPlans' => function ($query) {
            $query->latest();
        }])->findOrFail($id);

        return view('Employee.monitoring.show', compact('player'));
    }
}

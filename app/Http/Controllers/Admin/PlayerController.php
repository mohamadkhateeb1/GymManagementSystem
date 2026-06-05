<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Player;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PlayerController extends Controller
{
    public function index()
    {
        $players = Player::all();
        $players = Player::with('subscription')->get(); // إضافة with('subscription') هنا ضروري جداً
        return view('Admin.Players.index', compact('players'));
    }

    public function create()
    {
        $coaches = Employee::all();
        return view('Admin.Players.create', [
            'coaches' => $coaches
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:players,email',
            'password'      => 'required|min:6',
            'date_of_birth' => 'nullable|date',
            'height'        => 'nullable|numeric',
            'weight'        => 'nullable|numeric',
            'phone'         => 'nullable|string|max:20',
            'coach_id'      => 'nullable|exists:employees,id',
            'plan_name'     => 'required|string',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $player = Player::create($validated);

        $duration = 1;
        if ($request->plan_name == 'اشتراك ربع سنوي') {
            $duration = 3;
        } elseif ($request->plan_name == 'اشتراك سنوي') {
            $duration = 12;
        }

        $player->subscription()->create([
            'plan_name'  => $request->plan_name,
            'start_date' => Carbon::now(),
            'end_date'   => Carbon::now()->addMonths($duration),
            'status'     => 'active',
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'تم إضافة اللاعب بنجاح');
    }

    public function edit($id)
    {
        $coaches = Employee::all();
        $player = Player::with('subscription')->findOrFail($id);

        return view('Admin.Players.edit', [
            'coaches' => $coaches,
            'player' => $player
        ]);
    }

    public function update(Request $request, $id)
    {
        $player = Player::findOrFail($id);

        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:players,email,' . $player->id,
            'password'      => 'nullable|min:6',
            'date_of_birth' => 'nullable|date',
            'height'        => 'nullable|numeric',
            'weight'        => 'nullable|numeric',
            'phone'         => 'nullable|string|max:20',
            'coach_id'      => 'nullable|exists:employees,id',
            'plan_name'     => 'required|string',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']);
        }
        $player->update($validated);

        $duration = 1;
        if ($request->plan_name == 'اشتراك ربع سنوي') {
            $duration = 3;
        } elseif ($request->plan_name == 'اشتراك سنوي') {
            $duration = 12;
        }

        // تم إضافة 'start_date' هنا لحل خطأ قاعدة البيانات 1364
        $player->subscription()->updateOrCreate(
            ['player_id' => $player->id],
            [
                'plan_name'  => $request->plan_name,
                'start_date' => Carbon::now(),
                'end_date'   => Carbon::now()->addMonths($duration),
                'status'     => 'active',
            ]
        );

        return redirect()->route('admin.dashboard')->with('success', 'تم تحديث بيانات اللاعب واشتراكه بنجاح.');
    }

    public function show($id)
    {
        $player = Player::findOrFail($id);
        $player->load('coach');
        return view('Admin.Players.show', compact('player'));
    }

    public function destroy(Player $player)
    {
        $player->delete();
        return redirect()->route('players.index')->with('success', 'Player deleted successfully.');
    }

    public function destroy_all()
    {
        $players = Player::all();
        if ($players->isEmpty()) {
            return redirect()->route('players.index')->with('success', 'No players to delete.');
        }
        foreach ($players as $player) {
            $player->delete();
        }
        return redirect()->route('players.index')->with('success', 'All players deleted successfully.');
    }
}

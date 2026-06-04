<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Player;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function index()
    {
        $players = Player::all();
        return view('Admin.Players.index', compact('players'));
    }
    public function create()
    {
        return view('Admin.Players.create');
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
        ]);

        // تشفير كلمة المرور قبل الحفظ
        $validated['password'] = bcrypt($validated['password']);

        Player::create($validated);

        return redirect()->route('players.index')->with('success', 'Player created successfully.'); 
    }
    //edi fun
    public function edit($id)
    {
        $player = Player::findOrFail($id);
        return view('Admin.Players.edit', compact('player'));
    }
    //update fun
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
        ]);
        $player->update($validated);
        return redirect()->route('players.index')->with('success', 'Player updated successfully.');
    }
    //show fun
    public function show($id)
    {
        $player=Player::findOrFail($id);
        return view('Admin.Players.show', compact('player'));
    }

    //delete fun
    public function destroy(Player $player)
    {
        $player->delete();
        return redirect()->route('players.index')->with('success', 'Player deleted successfully.');
    }
    //deleteall fun
  public function destroy_all()
    {
        $player = Player::all();
        if ($player->isEmpty()) {
            return redirect()->route('players.index')->with('success', 'No players to delete.');
        }
        foreach ($player as $player) {
            $player->delete();
        }
        return redirect()->route('players.index')->with('success', 'All players deleted successfully.');
    }    
}

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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:players,email',
            'phone' => 'required|string|max:20',
        ]);

        Player::create($request->all());

        return redirect()->route('players.index')->with('success', 'Player created successfully.');
    }
    public function edit(Player $player)
    {        return view('Admin.Players.edit', compact('player'));
    }
    public function update(Request $request, Player $player)
    {        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:players,email,' . $player->id,
            'phone' => 'required|string|max:20',
        ]);
        $player->update($request->all());
        return redirect()->route('players.index')->with('success', 'Player updated successfully.');
    }
}

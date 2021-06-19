<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Projet;
use App\Models\tache;

class Admin extends Controller
{

    public function add($id)
    {
        $user = User::find($id);
        if ($user->admin != null) {
            return redirect()->route('home')->with('fail', 'Already an admin account');
        }
        $user->admin()->create();
        if ($user->role == 2) {
            $user->commercial()->delete();
        } else if ($user->role == 3) {
            $user->client()->delete();
        }
        $user->role = 1;
        $user->save();
        return redirect()->route('home')->with('success', 'Admin Account made');
    }
    public function dashboard()
    {
        $projets = Projet::latest()->get();
        $tasks = tache::latest()->get();
        $nbr = Projet::all()->count();
        $nbri = tache::all()->count();
        $client = User::where('role', 3)->count();
        $perso = User::where('role', '<>', 3)->count();
        return view('dashboard', [
            'projet' => $projets,
            'tasks' => $tasks,
            'nbrcl' => $client,
            'nbreperso' => $perso,
            'nbr' => $nbr,
            'nbri' => $nbri
        ]);
    }
}

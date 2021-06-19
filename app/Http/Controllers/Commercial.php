<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class Commercial extends Controller
{
  public function add($id)
  {
    $user = User::find($id);
    if ($user->commercial != null) {
      return redirect()->route('home')->with('fail', 'Already a commercial agent');
    }
    $user->commercial()->create();
    if ($user->role == 1) {
      $user->admin()->delete();
    } else if ($user->role == 3) {
      $user->client()->delete();
    }
    $user->role = 2;
    $user->save();
    return redirect()->route('home')->with('success', 'Commercial account made');
  }
}

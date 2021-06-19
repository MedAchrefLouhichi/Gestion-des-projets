<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\PersonalMail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;

class Personnel extends Controller
{
    function store(Request $request)
    {
        // validatin user
        $validatedData = $request->validate([
            'email' => 'required|email|unique:users',
            'name' => 'required',
            'username' => 'required|unique:users',
            'phone' => 'unique:users|required|max:8|min:8',
            'adress' => 'required|max:100',
            'birthday' => 'required',
            'job' => 'required',
        ]);

        // saving user
        $user = new User();

        $user->name = $validatedData['name'];
        $user->username = $validatedData['username'];
        $user->email = $validatedData['email'];
        $pass = Str::random(8) . 'silver';
        $user->password = Hash::make($pass);
        $user->phone = $validatedData['phone'];
        $user->daten =  $validatedData['birthday'];
        $user->adress = $validatedData['adress'];
        $user->role = 4;
        if ($request->hasFile('image')) {
            $file = $request->image;
            $ext = $request->image->extension();
            $filename = Str::random(20) . '.' . $ext;
            $file->storeAs('photos', $filename);
            $user->image = $filename;
        }
        $user->save();
        $user->personnel()->create(['job' => $validatedData['job']]);
        event(new Registered($user));
        Mail::to(User::find($user->id))->send(new PersonalMail($pass));
        return redirect()->route('manageusers')->with('success', 'Personnel has been created');
    }
    public function action(Request $request)
    {
        $output = '';
        if (!empty($request->get('query'))) {
            $users = User::where('role', 4)
                ->where('name', 'like', '%' . $request->get('query') . '%')
                ->orwhere('adress', 'like', '%' . $request->get('query') . '%')
                ->orderBy('id')
                ->get();
        } else {
            $users =  User::where('role', 4);
        }



        foreach ($users as $user) {
            $output .= '
                              <tr>
                              <td class="text-center">
                              <img style="height:100px; width:100px" src="' . asset('photos/' . $user->image) . '"
                               class="img-circle">
                              </td>
                              <td>' . $user->name . '</td>
                              <td> <input type="checkbox" name="personnel" value="' . $user->personnel->id . '">
                              </td>
                              </tr>
                               ';
            return array(
                'table_data'  => $output,
            );
        }
    }
}

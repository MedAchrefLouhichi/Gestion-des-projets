<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\User as Users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use function PHPUnit\Framework\isEmpty;
use App\Models\Message;
use App\Models\tache;

class User extends Controller
{
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'), $request->remember_me ? true : false)) {
            return back()->with('fail', 'Oops! Incorrect credentials.');
        }
        return redirect()->route('home');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    function create(Request $request)
    {
        // validatin user
        $validatedData = $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|max:255',
            'name' => 'required',
            'username' => 'required|unique:users',
            'phone' => 'unique:users|required|max:8|min:8',
            'adress' => 'required|max:100',
            'birthday' => 'required',
        ]);

        // saving user
        $user = new Users();

        $user->name = $validatedData['name'];
        $user->username = $validatedData['username'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
        $user->phone = $validatedData['phone'];
        $user->daten =  $validatedData['birthday'];
        $user->adress = $validatedData['adress'];
        $user->role = 3;
        if ($request->hasFile('image')) {
            $file = $request->image;
            $ext = $request->image->extension();
            $filename = Str::random(20) . '.' . $ext;
            $file->storeAs('photos', $filename);
            $user->image = $filename;
        }
        $user->save();
        $user->client()->create();
        event(new Registered($user));
        return redirect()->route('login')->with('success', 'Verifcation link sent');
    }

    public function list()
    {
        if (Auth::user()->role == 1) {
            return view('usermanagment1', ['users' => Users::all()]);
        }
        return back();
    }


    function delete($id)
    {

        $user = Users::find($id);
        if ($user->role == 4) {
            if ($user->personnel->taches->where('statut', false) != null) {
            }
            Message::where('idrec', $user->id)->delete();
            if ($user->image !== 'default.png') {
                File::delete(public_path('photos/' . $user->image));
            }
            $user->delete();
            return redirect()->route('manageusers')->with('success', 'The account has been deleted');
        }
    }


    function index($id)
    {


        $user = Users::find($id);

        if ($user) {
            return view('update', [
                'user' => $user,
            ]);
        }
        return redirect()->route('home');
    }


    public function update(Request $request, $id)
    {

        $request->validate([
            'email' => 'required|email',
            'name' => 'required',
            'phone' => 'required|max:8|min:8',
            'adress' => 'required|max:100',
            'birthday' => 'required'
        ]);

        $user = Users::find($id);
        if (!isEmpty($request->password)) {
            if (strlen($request->password < 8) && strlen($request->password > 100)) {
                return back()->withErrors('password', 'Password must between 8 and 100');
            }
            $user->password = Hash::make($request->password);
        }

        $user->email = $request->email;
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->adress = $request->adress;
        $user->daten = $request->birthday;
        if ($request->hasFile('image')) {
            if ($user->image !== 'default.png') {
                File::delete(public_path('photos/' . $user->image));
            }
            $file = $request->image;
            $ext = $request->image->extension();
            $filename = Str::random(20) . '.' . $ext;
            $file->storeAs('photos', $filename);
            $user->image = $filename;
        }
        if ($user->role == 4) {
            $user->personnel->job = $request->job;
        }
        $user->save();
        return back()->with('success', 'The account has been updated');
    }



    public function search(Request $request)
    {
        if ($request->searchbar != null) {
            $user = Users::where('name', 'like', '%' . $request->searchbar . '%')->get();

            if ($user == null) {
                return back();
            } else {
                return view('searchbar', ['users' => $user]);
            }
        }
        return  view('index');
    }



    public function profile($id)
    {
        $user = Users::find($id);

        return view('profile', ['user' => $user]);
    }




    public function action(Request $request)
    {
        $output = '';
        if (!empty($request->get('query'))) {
            $users = Users::where('name', 'like', '%' . $request->get('query') . '%')
                ->orWhere('username', 'like', '%' . $request->get('query') . '%')
                ->orWhere('phone', 'like', '%' . $request->get('query') . '%')
                ->orWhere('adress', 'like', '%' . $request->get('query') . '%')
                ->orWhere('email', 'like', '%' . $request->get('query') . '%')
                ->orderBy('id', 'desc')
                ->get();
        } else {
            $users = Users::all();
        }
        if (count($users) <= 0) {

            $output .= '
                <tr>
               <td align="center" colspan="5">No Data Found</td>
                </tr>
               ';
        } else {

            foreach ($users as $user) {

                if ($user->role == 1) {
                    $html = '<button type="button" class="btn btn-xs btn-primary">Admin</button>';
                } else if ($user->role == 2) {
                    $html = '<button type="button" class="btn btn-xs btn-primary">Commercial</button>';
                } else if ($user->role == 3) {
                    $html = '<button type="button" class="btn btn-xs btn-primary">Client</button>';
                } else {
                    $html = '<button type="button" class="btn btn-xs btn-primary">Employe</button>';
                }
                $output .= '
                            <tr>
                            <td class="text-center">
                            <img style="height:100px; width:100px" src="' . asset('photos/' . $user->image) . '"
                             class="img-circle">
                            </td>
                            <td> <a href="' . Route('profile', ['id' => $user->id]) . '">' . $user->name . '</td>
                            <td>' . $user->username . '</td>
                            <td>' . $user->email . '</td>
                            <td>' . $html . '</td>
                            <td>' . $user->phone . '</td>
                            <td class=text-center>
                            <div class="btn-group btn-group-s">
                            <a href="' . Route('update', ['id' => $user->id]) . '" data-toggle="tooltip"
                            title="Edit" class="btn btn-default"><i class="fa fa-pencil"></i></a>
                            <a href="' . Route('delete', ['id' => $user->id]) . '" data-toggle="tooltip"
                            title="Delete" class="btn btn-danger"
                            onclick="return confirm(' . 'Are you sure you want to delete this project ?' . ')">
                            <i class="fa fa-times"></i></a>
                            </div> </td>
                            </tr>
                             ';
                return array(
                    'table_data'  => $output,
                );
            }
        }
    }


    public function destinataire(Request $request)
    {
        $output = '';
        if (!empty($request->get('query'))) {
            $users = Users::where('role', '<>', 3)
                ->where('name', 'like', '%' . $request->get('query') . '%')
                ->where('adress', 'like', '%' . $request->get('query') . '%')
                ->orWhere('email', 'like', '%' . $request->get('query') . '%')
                ->orderBy('id', 'desc')
                ->get();
        } else {
            $users = Users::where('role', '<>', 3)->get();
        }
        if (count($users) <= 0) {

            $output .= '
                <tr>
               <td align="center" colspan="5">No Data Found</td>
                </tr>
               ';
        } else {

            foreach ($users as $user) {

                if ($user->role == 1) {
                    $html = '<button type="button" class="btn btn-xs btn-primary">Admin</button>';
                } else if ($user->role == 2) {
                    $html = '<button type="button" class="btn btn-xs btn-primary">Commercial</button>';
                } else {
                    $html = '<button type="button" class="btn btn-xs btn-primary">Employe</button>';
                }
                $output .= '
                            <tr>
                            <td class="text-center">
                            <img style="height:100px; width:100px" src="' . asset('photos/' . $user->image) . '"
                             class="img-circle">
                            </td>
                            <td> <a href="' . Route('profile', ['id' => $user->id]) . '">' . $user->name . '</td>
                            <td>' . $user->username . '</td>
                            <td>' . $user->email . '</td>
                            <td>' . $html . '</td>
                            <td>' . $user->phone . '</td>
                            <td class=text-center>
                            <div class="btn-group btn-group-s">
                            <a href="' . route('composemsg', ['id' => $user->id]) . '" data-toggle="tooltip"
                            title="Edit" class="btn btn-default"><i class="fa fa-pencil"></i></a>
                            </div> </td>
                            </tr>
                             ';
                return array(
                    'table_data'  => $output,
                );
            }
        }
    }
}

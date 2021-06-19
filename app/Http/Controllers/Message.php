<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Message as Messages;
use Illuminate\Support\Facades\Auth;

class Message extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'contenu' => 'required',
            'object' => 'required',
        ]);
        $recepteur = User::where('email', $validatedData['email'])->first();
        Auth::user()->messages()->create([
            'idrec' => $recepteur->id,
            'contenu' => $validatedData['contenu'], 'objet' => $validatedData['object']
        ]);
        return redirect()->route('sentmsg')->with('success', 'Message Sent to ' . $recepteur->name);
    }
    public function listsent()
    {
        $messages = Auth::user()->messages;
        return view('sentmessages', [
            'messages' => $messages, 'nbr' => Messages::where('idrec', Auth::user()->id)->count(),
            'nbri' => Auth::user()->messages->count()
        ]);
    }
    public function listrecieved()
    {
        $messages = Messages::where('idrec', Auth::user()->id)->get();
        return view('inbox', [
            'messages' => $messages, 'nbr' => Auth::user()->messages->count(),
            'nbri' => Messages::where('idrec', Auth::user()->id)->count()
        ]);
    }
    public function composee($id)
    {
        if ($id !== null) {
            $user = User::find($id);
            if (Auth::user() !== $user) {
                return view('NewMsg', ['user' => $user]);
            }
        }
        return back()->with('fail', 'Action not allowed');
        return back()->with('fail', 'Pick a valid User');
    }

    public function deleted($id)
    {
        $msg = Messages::find($id);
        $msg->delete();
        return back()->with('Success', 'Message deleted');
    }
    public function viewmsg($id)
    {
        $message = Messages::find($id);
        if (Auth::user()->id == $message->idrec || Auth::user()->id == $message->idem) {
            if (Auth::user()->id == $message->idrec) {
                $user = User::find($message->idem);
            } else $user = User::find($message->idrec);
            return view('messageview', [
                'message' => $message,
                'nbr' => Auth::user()->messages->count(),
                'nbri' => Messages::where('idrec', Auth::user()->id)->count(),
                'user' => $user
            ]);
        }
        return back()->with('fail', 'you are not allowed');
    }
}

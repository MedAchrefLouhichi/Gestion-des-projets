<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Projet;
use Illuminate\Http\Request;
use App\Models\Tache as taches;
use Illuminate\Support\Facades\Auth;

class Tache extends Controller
{
    public function taskaddview($id)
    {
        $projet = Projet::find($id);
        return view('taskadd', ['project' => $projet]);
    }

    public function store($id, Request $request)
    {
        $datedeb = Carbon::parse($request->datedeb);
        $datefin = Carbon::parse($request->datefin);
        $projet = Projet::find($id);
        $datedebp = Carbon::parse($projet->datedeb);
        $datefinp = Carbon::parse($projet->datefin);
        if ($datefin->gt($datedeb) && $datedebp->lte($datedeb) && $datefin->lte($datefinp)) {
            $projet->taches()->create([
                'name' => $request->name, 'description' => $request->Description,
                'datedeb' => $request->datedeb, 'datefin' => $request->datefin,
                'idpers' => $request->personnel,
            ]);
            $projet->avance = false;
            $projet->save();
            return redirect()->route('projectprofile', ['id' => $projet->id]);
        }
        return redirect()->route('taskadd', ['id' => $projet->id])->with('fail', 'Data wrong');
    }

    public function deleted($id)
    {
        $tache = taches::find($id);
        $projet = Projet::where('id', $tache->idpr)->first();
        $tache->delete();
        if ($projet->taches->where('statut', false)->count() == 0) {
            $projet->avance = true;
            $projet->save();
        }
        return back()->with('success', 'Task Deleted');
    }
    public function persotask()
    {

        if (Auth::user()->role == 4) {
            $tache = Auth::user()->personnel->taches;
            $inprog = $tache->where('statut', false)->count();
            $finish = $tache->count() - $inprog;
            return view('persotaskmanagement', [
                'tasks' => $tache,
                'inprog' => $inprog,
                'finish' => $finish,
                'sum' => $tache->count()
            ]);
        }
        return back()->with('fail', 'You are not allowed');
    }


    public function statut($id)
    {
        $task = taches::find($id);

        $task->statut = true;
        $task->save();
        $projet = Projet::find($task->idpr);
        if ($projet->taches->where('statut', false)->count() == 0) {
            $projet->avance = true;
            $projet->save();
        }
        return back()->with('success', 'task updated');
    }

    public function profiletask($id)
    {
        $task = taches::find($id);
        $projet = Projet::find($task->idpr);
        return view('taskprofile', ['task' => $task, 'project' => $projet]);
    }
}

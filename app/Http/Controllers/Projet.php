<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Client;
use App\Models\Commercial;
use App\Models\User as User;
use Illuminate\Http\Request;
use App\Models\projet as Projets;
use Illuminate\Support\Facades\Auth;

class Projet extends Controller
{
    public function store(request $request)
    {
        $validatedData = $request->validate([
            'titre' => 'required|unique:projets',
            'clientcheck' => 'required',
            'type' => 'required',
            'datedeb' => 'required',
            'datefin' => 'required',
            'Description' => 'required|min:20|max:300',
        ]);
        $datedeb = Carbon::parse($validatedData['datedeb']);
        $datefin = Carbon::parse($validatedData['datefin']);

        if ($datefin->gt($datedeb)) {
            Auth::user()->commercial->projets()->create([
                'titre' => $validatedData['titre'],
                'idcl' => $validatedData['clientcheck'],
                'type' => $validatedData['type'],
                'datedeb' => $validatedData['datedeb'],
                'descrtiption' => $validatedData['Description'],
                'datefin' => $validatedData['datefin']
            ]);

            return redirect()->route('projectmanage');
        }

        return redirect()->route('ajouterproject')->with('fail', 'Data wrong');
    }
    public function action(Request $request)
    {
        $output = '';
        if (!empty($request->get('query'))) {
            $projets = Projets::where('titre', 'like', '%' . $request->get('query') . '%')
                ->where('idcomm', Auth::user()->commercial->id)
                ->orWhere('type', 'like', '%' . $request->get('query') . '%')
                ->orWhere('datedeb', 'like', '%' . $request->get('query') . '%')
                ->orWhere('description', 'like', '%' . $request->get('query') . '%')
                ->orderBy('id')
                ->get();
        } else {
            $projets = Projets::all()->orderBy('id')->get();
        }
        if (count($projets) <= 0) {
            $msg = 'no users found';
            return response()->json(array('msg' => $msg), 200);
        }

        foreach ($projets as $projet) {

            if ($projet->role == 1) {
                $html = '<button type="button" class="btn btn-xs btn-primary">Admin</button>';
            } else if ($projet->type == 'E-commerce') {
                $html = '<button type="button" class="btn btn-xs btn-primary">E-commerce</button>';
            } else if ($projet->type == 'Vitrine') {
                $html = '<button type="button" class="btn btn-xs btn-primary">Vitrine</button>';
            } else {
                $html = '<button type="button" class="btn btn-xs btn-primary">Appication Web</button>';
            }
            $output .= '
                            <tr>
                            <td>' . $projet->id . '<td>
                            <td>' . $projet->titre . '</td>
                            <td>' . $html . '</td>
                            <td>' . $projet->datedeb . '</td>
                            <td>' . $projet->datefin . '</td>
                            <td class=text-center>
                            <div class="btn-group btn-group-s">
                            <a href="' . Route('updateprojet', ['id' => $projet->id]) . '" data-toggle="tooltip"
                            title="Edit" class="btn btn-default"><i class="fa fa-pencil"></i></a>
                            <a href="' . Route('deleteprojet', ['id' => $projet->id]) . '" data-toggle="tooltip"
                            title="Delete" class="btn btn-danger" onclick="return confirm(' . 'Are you sure you want to delete this project ?' . ')">
                            <i class="fa fa-times"></i></a>
                            </div> </td>
                            </tr>
                             ';
            return array(
                'table_data'  => $output,
            );
        }
    }




    public function list()
    {
        if (Auth::user()->commercial) {
            $inprog = Auth::user()->commercial->projets->where('avance', false)->count();
            $done = Auth::user()->commercial->projets->where('avance', true)->count();
            $sum = Auth::user()->commercial->projets->count();

            return view('projectmanagement', [
                'projects' => Auth::user()->commercial->projets()->get(),
                'sum' => $sum, 'done' => $done, 'inprog' => $inprog
            ]);
        } else if (Auth::user()->client) {
            $inprog = Auth::user()->client->projets->where('avance', false)->count();
            $done = Auth::user()->client->projets->where('avance', true)->count();
            $sum = Auth::user()->client->projets->count();
            return view('projectmanagement', [
                'projects' => Auth::user()->client->projets()->get(),
                'sum' => $sum, 'done' => $done, 'inprog' => $inprog
            ]);
        } else if (Auth::user()->admin) {
            $inprog = Projets::where('avance', false)->count();
            $done = Projets::where('avance', true)->count();
            $sum = Projets::count();
            return view('projectmanagement', [
                'projects' => Projets::all(),
                'sum' => $sum, 'done' => $done, 'inprog' => $inprog
            ]);
        }
        return back()->with('fail', 'You don\'t have permission');
    }

    public function delete($id)
    {

        $project = projets::find($id);
        if (
            $project->taches->where('statut', false)->count() == $project->taches->count()
            || $project->taches->where('statut', true)->count() == $project->taches->count()
            || $project->taches->count() == 0
        ) {
            $project->delete();
            return back()->with('success', 'Project deleted');
        }
        return back()->with('fail', 'Sorry Project still in progress');
    }
    public function projectprofile($id)
    {
        $projet = projets::find($id);
        $client = Client::find($projet->idcl);
        $comm = Commercial::find($projet->idcomm);
        $usercl = User::find($client->iduser);
        $usercomm = User::find($comm->iduser);
        if ($projet->taches->count() == 0) {
            $avancement = 0;
        } else {
            $avancement = ($projet->taches->where('statut', true)->count() / $projet->taches->count()) * 100;
        }

        return view('projectprofile', [
            'project' => $projet, 'client' => $usercl,
            'commercial' => $usercomm, 'tasks' => $projet->taches->all(),
            'avancement' => number_format((float)$avancement, 2, '.', '')
        ]);
    }
}

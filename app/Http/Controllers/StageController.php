<?php

namespace App\Http\Controllers;

use App\Models\Historique;

use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Stage;
use App\Models\Stagiaire;
use App\Models\Statut;
use App\Models\Sujet;

class StageController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:afficher stage|créer stage|modifier stage', ['only' => ['index','store']]);
        $this->middleware('permission:créer stage', ['only' => ['create','store']]);
        $this->middleware('permission:modifier stage', ['only' => ['edit','update']]); 
    }

    /* Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {     
        $stages = Stage::orderBy('id','ASC')->simplePaginate(5);
        $users = User::get();
        $stagiaires = Stagiaire::get();
        $status = Statut::get();
        $services = Service::get();
        $sujets = Sujet::get();
        return view('stages.index',[
            'stages'=> $stages,
            'sujets' => $sujets,
            'users' => $users,
            'status' => $status,
            'services' => $services,
            'stagiaires' => $stagiaires
        ])->with('i', ($request->input('page', 1) - 1) * 5);
    }
    
    public function create()
    {
        $stages = Stage::get();
        $users = User::get();
        $status = Statut::get();
        $stagiaires = Stagiaire::get();
        $services = Service::get();
        $sujets = Sujet::get();
        return view('stages.create',[
            'stages'=> $stages,
            'sujets' => $sujets,
            'status' => $status,
            'users' => $users,
            'services' => $services,
            'stagiaires' => $stagiaires
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'date_debut' => 'required',
            'date_fin' => 'required | after:date_debut',
        ]);
            Stage::create([
                'user_id' => $request->encadrant,
                'prenom_ajoute_par' => auth()->user()->prenom,
                'nom_ajoute_par' => auth()->user()->nom,
                'service_id' => $request->service,
                'statut_id' => $request->statut,
                'stagiaire_id' =>$request->stagiaire ,
                'sujet_id' => $request->sujet,
                'date_debut' => $request->date_debut,
                'date_fin' => $request->date_fin,
            ]);
        return  redirect()->route('stages.index');
    }
    
    public function search(Request $request){ 
        // Get the search value from the request
        $search = $request->input('search');
        // dd($search);
        // Search in the title and body columns from the posts table
        $stages = Stage::Where('id', 'LIKE', "%{$search}%")
            ->get();
        return view('stages.search', compact('stages'));
        // return redirect('/stages')->with(['stages' => $stages]);
    }

    public function edit($id)
    {
        $stage = Stage::find($id);
        $users = User::get();
        $stagiaires = Stagiaire::get();
        $services = Service::get();    
        $status = Statut::get();
        $sujets = Sujet::get();
        return view('stages.edit',[
            'stage'=> $stage,
            'sujets' => $sujets,
            'status' => $status,
            'users' => $users,
            'services' => $services,
            'stagiaires' => $stagiaires
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'date_fin' => 'required',
            'date_debut' => 'required',
        ]);
        $stages = Stage::find($id);
        $stages->update([
            'user_id' => $request->encadrant,
            'prenom_ajoute_par' => auth()->user()->prenom,
            'nom_ajoute_par' => auth()->user()->nom,
            'service_id' => $request->service,
            'statut_id' => $request->statut,
            'stagiaire_id' =>$request->stagiaire ,
            'sujet_id' => $request->sujet,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
        ]);

        $stages->save();

        return redirect()->route('stages.index')
            ->with('success','Stage modifié avec succès');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stage = Stage::find($id);
        $users = User::get();
        $stagiaires = Stagiaire::get();
        $status = Statut::get();
        $services = Service::get();
        $sujets = Sujet::get();
        return view('stages.show',[
            'stage'=> $stage,
            'sujets' => $sujets,
            'users' => $users,
            'status' => $status,
            'services' => $services,
            'stagiaires' => $stagiaires,
            ]);
    }
}
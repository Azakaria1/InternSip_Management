<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\Stagiaire;
use Illuminate\Http\Request;

class StagiaireController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:afficher stagiaire|créer stagiaire|modifier stagiaire', ['only' => ['index','store']]);
        $this->middleware('permission:créer stagiaire', ['only' => ['create','store']]);
        $this->middleware('permission:modifier stagiaire', ['only' => ['edit','update']]);
    }

    public function index(Request $request)
    {
        $stagiaires= Stagiaire::orderBy('id','ASC')->simplePaginate(5);
        return view('stagiaires.index', [
            'stagiaires' => $stagiaires
        ])            ->with('i', ($request->input('page', 1) - 1) * 5);
        ;
    }

    public function create()
    {
        $stagiaires = Stagiaire::all();
        return view('stagiaires.create', [
            'stagiaires' =>  $stagiaires ,
        ]);
    }
    public function store(Request $request)
    {
        $this->validate( $request, [
            'nom' => 'required',
            'prenom' => 'required',
            'date_naissance' => 'required',
            'tel' => 'required',
            'email' => 'required',
            'etablissement' => 'required',
            'niveau' => 'required',
        ]);
        $request->user()->stagiaires()->create([
            'nom'=>$request->nom,
            'prenom'=>$request->prenom,
            'date_naissance' => $request->date_naissance ,
            'tel' => $request->tel,
            'email'=>$request->email,
            'etablissement'=>$request->etablissement,
            'niveau'=>$request->niveau,
        ]);
        return redirect()->route('stagiaires.index');
    }

    public function show($id)
    {
        $stagiaire = Stagiaire::find($id);
        return view('stagiaires.show', [
            'stagiaire' => $stagiaire ,
        ]);
    }
    public function search(Request $request){
        // Get the search value from the request
        $search = $request->input('search');

        // Search in the title and body columns from the posts table
        $stagiaires = Stagiaire::query()
            ->where('nom', 'LIKE', "%{$search}%")
            ->orWhere('prenom', 'LIKE', "%{$search}%")
            ->get();

        // Return the search view with the resluts compacted
        return view('stagiaires.search', compact('stagiaires'));
    }

    public function edit($id)
    {
        $stagiaire = Stagiaire::find($id);

        return view('stagiaires.edit',compact('stagiaire'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'tel' => 'required',
            'email' => 'required',
            'etablissement' => 'required',
            'niveau' => 'required',
        ]);

        $stagiaire = Stagiaire::find($id);
        $stagiaire->tel = $request->input('tel');
        $stagiaire->email = $request->input('email');
        $stagiaire->etablissement = $request->input('etablissement');
        $stagiaire->niveau = $request->input('niveau');
        $stagiaire->save();

        return redirect()->route('stagiaires.index') ->with('success','Stagiaire modifié avec succès');
    }

}

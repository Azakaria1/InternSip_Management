<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use Illuminate\Http\Request;
use \App\Models\Sujet;

class SujetController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:afficher sujet|créer sujet|modifier sujet', ['only' => ['index','store']]);
        $this->middleware('permission:créer sujet', ['only' => ['create','store']]);
        $this->middleware('permission:modifier sujet', ['only' => ['edit','update']]);    }

    public function create()
    {
        $sujets = Sujet::all();
        return view('sujets.create', [
            'sujets' =>  $sujets ,
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sujets = Sujet::orderBy('id','ASC')->simplePaginate(5);
        return view('sujets.index', [
            'sujets' => $sujets
        ])
        ->with('i', ($request->input('page', 1) - 1) * 5);
        ;
    }

    /*
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'titre'=> 'required',
            'description' => 'required'
        ]);
        $request->user()->sujets()->create([
            'titre' => $request->titre,
            'description' => $request->description
        ]);
        return redirect()->route('sujets.index');
    }

    public function search(Request $request){
        // Get the search value from the request
        $search = $request->input('search');

        // Search in the title and body columns from the posts table
        $sujets= Sujet::query()
            ->where('titre', 'LIKE', "%{$search}%")
            ->get();

        // Return the search view with the resluts compacted
        return view('sujets.search', compact('sujets'));
    }

      
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $sujet = Sujet::find($id);
        return view('sujets.show',[
            'sujet' => $sujet,
            ]);
    }
    public function edit($id)
    {
        $sujet = Sujet::find($id);

        return view('sujets.edit',compact('sujet'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'titre' => 'required',
            'description' => 'required',
        ]);

        $sujet = Sujet::find($id);
        $sujet->titre = $request->input('titre');
        $sujet->description = $request->input('description');
        $sujet->save();

        return redirect()->route('sujets.index') ->with('success','Sujet modifié avec succès');
    }
}

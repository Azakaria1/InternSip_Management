<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\Sujet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class DepartementController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:afficher département|créer département|modifier département', ['only' => ['index','store']]);
        $this->middleware('permission:créer département', ['only' => ['create','store']]);
        $this->middleware('permission:modifier département', ['only' => ['edit','update']]);
    }

    public function index(Request $request)
    {
        $departements = Departement::orderBy('id','ASC')->simplePaginate(5);   // collection
        return view('departements.index', [
            'departements' => $departements
        ])            ->with('i', ($request->input('page', 1) - 1) * 5);
        ;
    }
    public function create()
    {
        $departements = Departement::all();
        return view('departements.create', [
            'departements' =>  $departements ,
        ]);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'nom' => 'required'
        ]);
        $request->user()->departements()->create([
            'nom' => $request->nom
        ]);
        return redirect()->route('departements.index');
    }
    
    public function search(Request $request){
        // Get the search value from the request
        $search = $request->input('search');
        // dd($search);
        // Search in the title and body columns from the posts table
        $departements = Departement::Where('nom', 'LIKE', "%{$search}%")
            ->get();
        return view('departements.search', compact('departements'));
        // return redirect('/departements')->with(['departements' => $departements]);
    }

    public function edit($id)
    {
        $departement = Departement::find($id);

        return view('departements.edit',compact('departement'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nom' => 'required',
        ]);

        $departement = Departement::find($id);
        $departement->nom = $request->input('nom');
        $departement->save();

        return redirect()->route('departements.index') ->with('success','Département modifié avec succès');
    }
}

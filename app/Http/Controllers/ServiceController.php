<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\Encadrant;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:afficher service|créer service|modifier service', ['only' => ['index','store']]);
        $this->middleware('permission:créer service', ['only' => ['create','store']]);
        $this->middleware('permission:modifier service', ['only' => ['edit','update']]);    
    }

    public function index(Request $request)
    {
        $services = Service::orderBy('id','ASC')->simplePaginate(5);
        $departements = Departement::get();
        return view('services.index', [
            'services' => $services,
            'departements' => $departements
        ])   ->with('i', ($request->input('page', 1) - 1) * 5);

    }   
    
    public function create()
    {
        $departements = Departement::get();
        $services = Service::get();
        return view('services.create', [
            'services' =>  $services ,
            'departements' => $departements
        ]);
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'nom' => 'required'
        ]);
        $request->user()->services()->create([
            'departement_id' => $request->departement ,
            'nom'=>$request->nom
        ]);
        return redirect()->route('services.index');
    }

    public function search(Request $request){
        // Get the search value from the request
        $search = $request->input('search');
        // dd($search);
        // Search in the title and body columns from the posts table
        $services = Service::Where('nom', 'LIKE', "%{$search}%")
            ->get();
        return view('services.search', compact('services'));
        // return redirect('/services')->with(['services' => $services]);
    }
    
    public function edit($id)
    {
        $service = Service::find($id);
        $departements = Departement::get();

        return view('services.edit',[
            'service' => $service ,
            'departements' => $departements,
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nom' => 'required',
        ]);

        $services = Service::find($id);
        $services->update([
            'nom' => $request->nom,
            'departement_id' => $request->departement,
        ]);        $services->save();

        return redirect()->route('services.index')
            ->with('success','Service modifié avec succès');
    }
}

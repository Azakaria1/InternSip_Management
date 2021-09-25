<?php

namespace App\Traits;
use Illuminate\Http\Request;
use App\Models\Historique;
use App\Models\Stage;
use App\Models\Statut;
use Illuminate\Support\Facades\Date;

trait HistoriqueTrait {

    public function create()
    {
        $status = Statut::get();
        $stages = Stage::get();
        $historiques = Historique::get();
        return view('historiques.create', [
            'historiques' =>  $historiques ,
            'stages' => $stages,
            'status' => $status,
        ]);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'nom' => 'required'
        ]);
        Historique::create([
            'stage_id' => $request->stage ,
            'statut_id' => $request->statut ,
            'date_modification'=>Date::now(),
        ]);
        return back();
    }

    public function edit($id)
    {
        $historique = historique::find($id);

        return view('historiques.edit',compact('historique'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'date_modification' => 'required',
        ]);

        $historiques = Historique::find($id);
        $historiques->date_modification = $request->input('date_modification');
        $historiques->save();

        return redirect()->route('historiques.index')
            ->with('success','Historique modifié avec succès');
        ;
    }
}
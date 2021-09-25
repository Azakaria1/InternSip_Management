<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    use HasFactory;

    protected $fillable= [
        'user_id',
        'date_debut',
        'date_fin',
        'prenom_ajoute_par',
        'nom_ajoute_par',
        'departement_id',
        'stagiaire_id',
        'service_id',
        'statut_id',
        'sujet_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function stagiaire()
    {
        return $this->belongsTo(Stagiaire::class);
    }

    public function sujet()
    {
        return $this->belongsTo(Sujet::class);
    }

    public function statut()
    {
        return $this->belongsTo(Statut::class);
    }

    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}


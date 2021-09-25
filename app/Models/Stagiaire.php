<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stagiaire extends Model
{
    use HasFactory;

    protected  $fillable =  [
        'nom',
        'prenom',
        'date_naissance',
        'tel',
        'email',
        'etablissement',
        'niveau',
        'user_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

//    public function stages()
//    {
//        return $this->hasMany(Stage::class);
//    }
}

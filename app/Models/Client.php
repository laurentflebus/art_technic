<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// La classe "Client" hérite de la classe Model => classe Eloquent contenant les méthodes d'intération avec la BD
class Client extends Model
{
    use HasFactory;
    // Colonnes remplissables (évite l'erreur Mass Assignement)
    protected $fillable = ['civilite', 'nom', 'prenom', 'email', 'telephone', 'mobile', 'rue', 'nrue', 'pays', 'assujetti_id', 'localite_id'];

    public function assujetti()
    {
        return $this->belongsTo(Assujetti::class);
    }

    public function localite()
    {
        return $this->belongsTo(Localite::class);
    }

    public function ventes()
    {
        return $this->hasMany(Vente::class);
    }
}

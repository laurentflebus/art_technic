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
    // relation n Client à 1 Assujetti
    public function assujetti()
    {
        return $this->belongsTo(Assujetti::class);
    }
    // relation n Client à 1 Localite
    public function localite()
    {
        return $this->belongsTo(Localite::class);
    }
    // relation 1 Client à n Ventes
    public function ventes()
    {
        return $this->hasMany(Vente::class);
    }
}

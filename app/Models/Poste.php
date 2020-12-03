<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poste extends Model
{
    use HasFactory;

    protected $fillable = ['numero', 'intitule', 'code_barre', 'quantite', 'prix_unitaire', 'tva_id'];

    // Un poste determiné a au min/max 1 tva
    public function tva()
    {
        return $this->belongsTo(Tva::class);
    }

    // Relation many to many avec la table "ventes" avec trois colonnes supplémentaires (quantite, prix_unitaire, detail)
    public function ventes()
    {
        return $this->belongsToMany(Vente::class)->withPivot('quantite', 'prix_unitaire', 'detail');
    }
}

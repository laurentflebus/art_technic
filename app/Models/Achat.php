<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achat extends Model
{
    use HasFactory;
    // colonnes remplissables (évite l'erreur Mass Assignement)
    protected $fillable = ['numero', 'date', 'date_a_payer', 'est_paye', 'fournisseur_id'];

    // Relation many to many avec la table "postes" avec trois colonnes supplémentaires (quantite, prix_unitaire, détail)
    public function postes()
    {
        return $this->belongsToMany(Poste::class)->withPivot('quantite', 'prix_unitaire', 'detail');
    }
    // Relation N Achats vers 1 Fournisseur
    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }
}

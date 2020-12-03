<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// La classe "Vente" hérite de la classe Model => classe Eloquent contenant les méthodes d'intération avec la BD
class Vente extends Model
{
    use HasFactory;
    // colonnes remplissables (évite l'erreur Mass Assignement)
    protected $fillable = ['a_facturer', 'est_paye', 'a_un_bon_commande', 'client_id', 'modereglement_id', 'facture_id'];

    public function modereglement()
    {
        return $this->belongsTo(Modereglement::class);
    }
    
    public function facture()
    {
        return $this->belongsTo(Facture::class);
    }
    // Relation many to many avec la table "postes" avec trois colonnes supplémentaires (quantite, prix_unitaire, détail)
    public function postes()
    {
        return $this->belongsToMany(Poste::class)->withPivot('quantite', 'prix_unitaire', 'detail');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    use HasFactory;

    protected $fillable = ['civilite', 'nom', 'prenom', 'email', 'telephone', 'mobile', 'num_compte', 'delai_paiement', 'reference_personnel', 'remarque', 'rue', 'nrue', 'pays', 'assujetti_id', 'localite_id'];

    // relation n Fournisseur à 1 Assujetti
    public function assujetti()
    {
        return $this->belongsTo(Assujetti::class);
    }
    // relation n Fournisseur à 1 Localite
    public function localite()
    {
        return $this->belongsTo(Localite::class);
    }
    // relation 1 Fournisseur à n Achats
    public function achats()
    {
        return $this->hasMany(Achat::class);
    }
}

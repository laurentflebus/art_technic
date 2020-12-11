<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;

    protected $fillable = ['numero', 'vente_id'];

    public function vente()
    {
        return $this->belongsTo(Vente::class);
    }
}

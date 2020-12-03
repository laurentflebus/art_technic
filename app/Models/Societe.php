<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Societe extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'num_tva', 'registre', 'num_compte', 'telephone', 'rue', 'nrue', 'pays', 'remarque', 'localite_id'];

    public function localite()
    {
        return $this->belongsTo(Localite::class);
    }
}

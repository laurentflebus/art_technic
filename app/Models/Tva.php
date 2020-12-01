<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tva extends Model
{
    use HasFactory;

    protected $fillable = ['intitule', 'taux'];

    // Relation 1 n (une tva determinée est appliquée au max à plusieurs postes)
    public function postes()
    {
        return $this->hasMany(Poste::class);
    }
}

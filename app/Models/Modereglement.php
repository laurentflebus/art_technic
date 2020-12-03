<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modereglement extends Model
{
    use HasFactory;

    protected $fillable = ['intitule'];

    public function ventes()
    {
        return $this->hasMany(Vente::class);
    }
}

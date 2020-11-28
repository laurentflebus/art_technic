<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = ['civilite', 'nom', 'prenom', 'email', 'telephone', 'mobile', 'rue', 'nrue', 'pays', 'assujetti_id', 'localite_id'];

    public function assujetti()
    {
        return $this->belongsTo(Assujetti::class);
    }

    public function localite()
    {
        return $this->belongsTo(Localite::class);
    }
}

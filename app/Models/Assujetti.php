<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assujetti extends Model
{
    use HasFactory;

    protected $fillable = ['intitule', 'num_tva'];

    public function clients()
    {
        return $this->hasMany(Client::class);
    }
}

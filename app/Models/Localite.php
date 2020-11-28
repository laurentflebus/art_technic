<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Localite extends Model
{
    use HasFactory;

    protected $fillable = ['intitule', 'code_postal'];

    public function clients()
    {
        $this->hasMany(Client::class);
    }
}

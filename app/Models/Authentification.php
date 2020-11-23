<?php
// namespace App\Models car dossier app et sous dossier Models
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// hérite de la classe Model => classe Eloquent
class Authentification extends Model {
    protected $fillable = ['user', 'password'];
}



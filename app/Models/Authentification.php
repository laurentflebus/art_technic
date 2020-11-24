<?php
// namespace App\Models car dossier app et sous dossier Models
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as BasicAuthenticatable;

// hérite de la classe Model => classe Eloquent
class Authentification extends Model implements Authenticatable // classe authorisée à être authentifiée
{
    // classe basique pour implémenter plus facilement les 6 méthodes abstraites
    use BasicAuthenticatable;

    protected $fillable = ['user', 'password'];
}



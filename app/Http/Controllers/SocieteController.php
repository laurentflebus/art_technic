<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Societe;

class SocieteController extends Controller
{
    public function afficher()
    {
        $societe = Societe::get()->first();
        return view('parametres', ['societe', $societe]);
    }

    public function gerer()
    {
        request()->validate([

        ]);

        $societe = Societe::create([

        ]);
    }
}

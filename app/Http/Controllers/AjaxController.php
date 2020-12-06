<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poste;

class AjaxController extends Controller
{
    public function ajaxRequestPost()
    {
        $poste = Poste::where('code_barre', request('codebarre'))->first();        
        return Response($poste);
    }
}

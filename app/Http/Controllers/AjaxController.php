<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poste;
use App\Models\Tva;

class AjaxController extends Controller
{
    public function ajaxRequest()
    {
        $poste = Poste::where('code_barre', request('codebarre'))->first();
        $tva = Tva::where('id', $poste->tva_id)->first();  
        return Response([$poste, $tva]);
    }
}

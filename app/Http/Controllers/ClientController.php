<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Localite;
use App\Models\Assujetti;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();

        return view('clients.index', [
            'clients' => $clients,
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        // on récupère toute la requête de l'utilisateur et on appelle la fonction validate pour valider les données
        request()->validate([
            // tableau de règles
            'civilite' => ['required'],
            'nom' => ['required'],
            'prenom' => ['required'],
            'email' => ['required', 'email'],
            'telephone' => ['required', 'numeric', 'min:9'],
            'mobile' => ['required', 'numeric', 'min:10'],
            'rue' => ['required'],
            'nrue' => ['required'],
            'codepostal' => ['required'],
            'localite' => ['required'],
            'pays' => ['required'],
            'assujetti' => ['required'],
        ]);
        
        
        $localite = Localite::where('intitule', request('localite'))->first();
        $assujetti = Assujetti::where('intitule', request('assujetti'))->first();

        $assujetti = Assujetti::create([
            'intitule' => request('assujetti'),
            'num_tva' => request('numtva'),
          ]);
        $localite = Localite::create([
            'intitule' => request('localite'),
            'code_postal' => request('codepostal'),
        ]);
        
        $client = Client::create([
            'civilite' => request('civilite'),
            'nom' => request('nom'),
            'prenom' => request('prenom'),
            'email' => request('email'),
            'telephone' => request('telephone'),
            'mobile' => request('mobile'),
            'rue' => request('rue'),
            'nrue' => request('nrue'),
            'pays' => request('pays'),
            'localite_id' => $localite->id,
            'assujetti_id' => $assujetti->id,
       ]);




    //     // Si la localité existe déjà et l'assujetti aussi
    //     if ($localite && $assujetti) {
    //         //Insertion du client en base de données
    //          $client = Client::create([
    //             'civilite' => request('civilite'),
    //             'nom' => request('nom'),
    //             'prenom' => request('prenom'),
    //             'email' => request('email'),
    //             'telephone' => request('telephone'),
    //             'mobile' => request('mobile'),
    //             'rue' => request('rue'),
    //             'nrue' => request('nrue'),
    //             'pays' => request('pays'),
    //             'localite_id' => $localite->id,
    //             'assujetti_id' => $assujetti->id,
    //        ]);
    //    } elseif (!$assujetti) {
    //          // Insertion du type d'assujettis en base de données
    //          $assujetti = Assujetti::create([
    //            'intitule' => request('assujetti'),
    //            'num_tva' => request('numtva'),
    //          ]);
 
    //      // Insertion du client en base de données
    //          $client = Client::create([
    //             'civilite' => request('civilite'),
    //             'nom' => request('nom'),
    //             'prenom' => request('prenom'),
    //             'email' => request('email'),
    //             'telephone' => request('telephone'),
    //             'mobile' => request('mobile'),
    //             'rue' => request('rue'),
    //             'nrue' => request('nrue'),
    //             'pays' => request('pays'),
    //             'localite_id' => $localite->id,
    //             'assujetti_id' => $assujetti->id,
    //          ]);
    //    } else {
    //     // Insertion de la localité en base de données
    //     $localite = Localite::create([
    //       'intitule' => request('assujetti'),
    //       'code_postal' => request('codepostal'),
    //     ]);

    // // Insertion du client en base de données
    //     $client = Client::create([
    //        'civilite' => request('civilite'),
    //        'nom' => request('nom'),
    //        'prenom' => request('prenom'),
    //        'email' => request('email'),
    //        'telephone' => request('telephone'),
    //        'mobile' => request('mobile'),
    //        'rue' => request('rue'),
    //        'nrue' => request('nrue'),
    //        'pays' => request('pays'),
    //        'localite_id' => $localite->id,
    //        'assujetti_id' => $assujetti->id,
    //     ]);
    //    }
        
         flash('Le nouveau client a bien été enregistré.')->success();
         return redirect('/clients');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Localite;
use App\Models\Assujetti;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    /**
     * 
     * Affihe la liste des clients
     *
     */
    public function index()
    {
        $clients = Client::all();

        return view('clients.index', [
            'clients' => $clients,
        ]);
        
    }

    /**
     * Affiche le formulaire pour créer une nouvelle ressource.
     *
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * 
     * Enregistre un nouveau client.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation des champs du formulaire d'inscription (client)
        $request->validate([
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
        
        // Récupère la localité et l'assujettissement en bd
        $localite = Localite::where('intitule', request('localite'))->first();
        $assujetti = Assujetti::where('intitule', request('assujetti'))->first();
        
        // Vérifie si le client existe
        $client = Client::where([
                ['nom', request('nom')],
                ['prenom', request('prenom')],
                ['email', request('email')],
            ])->first();


        if($client) {
            flash('Le client existe déjà.')->error();
            return back();
        }

        
        // Si la localité et l'assujetissement existe déjà
       if (!$localite && !$assujetti) {
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
           
        // Si l'assujetissement n'existe pas
       } elseif (!$assujetti) {
           // Insertion de l'assujetissement en bd
            $assujetti = Assujetti::create([
               'intitule' => request('assujetti'),
               'num_tva' => request('numtva'),
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
        // Si la localite n'existe pas
       } elseif (!$localite) {
           // Insertion de la localité en bd
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
       } else {
            //Insertion du client en base de données
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
       }
        
         flash('Le nouveau client a bien été enregistré.')->success();
         return redirect('/clients');
    }

    /**
     * 
     * Afficher un client
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // récupérer le client
        $client = Client::find($id);

        //afficher la vue et passer la variable $client
        return view('clients.show', [
            'client' => $client,
        ]);

    }

    /**
     * Afficher le formulaire pour modifier un client.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $assujettis = DB::table('assujettis')->select('intitule')->distinct()->get();
        $localites = DB::table('localites')->select('intitule', 'code_postal')->distinct()->get();
        $pays = DB::table('clients')->select('pays')->distinct()->get();
        $civilites = DB::table('clients')->select('civilite')->distinct()->get();
        $client = Client::find($id);

        return view('clients.edit', [
            'client' => $client,
            'localites' => $localites,
            'pays' => $pays,
            'assujettis' => $assujettis,
            'civilites' => $civilites,
        ]);
    }

    /**
     * Modifier le client spécifié.
     * 
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validation des champs du formulaire d'inscription (client)
        $request->validate([
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

        $client = Client::find($id);

        $localite = Localite::where('intitule', request('localite'))->first();
        
        $assujetti = Assujetti::where('intitule', request('assujetti'))->first();


        $client->assujetti->update([
            'intitule' => request('assujetti'),
            'num_tva' => request('numtva'),
        ]);
        $client->localite->update([
            'intitule' => request('localite'),
            'code_postal' => request('codepostal'),
        ]);
        $client->update([
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
        flash('Le nouveau client a bien été mis à jour.')->success();
        return redirect('/clients');
    }

    /**
     * Supprimer un client
     * 
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::find($id);
        $client->delete();

        flash("Le client $client->nom $client->prenom a bien été supprimé.")->success();
        return redirect('/clients');
    }
}

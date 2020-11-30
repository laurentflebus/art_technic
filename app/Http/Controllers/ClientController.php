<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Localite;
use App\Models\Assujetti;
use Illuminate\Support\Facades\Crypt;
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
        
        // Vérifie si la localite existe déjà en bd       
        $localites = DB::table('localites')->get();
         
        foreach ($localites as $item) {
            if (Crypt::decrypt($item->intitule) == request('localite') &&
                Crypt::decrypt($item->code_postal) == request('codepostal')) {
                $localite = $item;
            } 
        }

        // Vérifie si le type d'assujetissement existe déjà
        $assujettis = DB::table('assujettis')->get();   
        foreach ($assujettis as $item) {
            if (Crypt::decrypt($item->intitule) == request('assujetti') &&
                Crypt::decrypt($item->num_tva) == request('numtva')) {
                $assujetti = $item;
            }  
        }

        //$localite = Localite::where('intitule', Crypt::encrypt(request('localite')))->first();
        //$assujetti = Assujetti::where('intitule', Crypt::encrypt(request('assujetti')))->first();
        // $cli = Client::where([
            //     [Crypt::decrypt($client->nom), request('nom')],
            //     [Crypt::decrypt($client->prenom), request('prenom')],
            //     [Crypt::decrypt($client->email), request('email')],
            //])->first();

        // Vérifie si le client existe déjà
        $clients = Client::all();       
        foreach($clients as $client) {           
            if ( Crypt::decrypt($client->nom) == request('nom') &&
                 Crypt::decrypt($client->prenom) == request('prenom') &&
                 Crypt::decrypt($client->email) == request('email') ) {
                    flash('Le client existe déjà.')->error();
                    return back();
             }
        }

        // Si la localité et l'assujetissement n'existe pas
       if (!$localite && !$assujetti) {
            $assujetti = Assujetti::create([
                'intitule' => Crypt::encrypt(request('assujetti')),
                'num_tva' => Crypt::encrypt(request('numtva')),
            ]);
            $localite = Localite::create([
                'intitule' => Crypt::encrypt(request('localite')),
                'code_postal' => Crypt::encrypt(request('codepostal')),
            ]);
            
            $client = Client::create([
                'civilite' => Crypt::encrypt(request('civilite')),
                'nom' => Crypt::encrypt(request('nom')),
                'prenom' => Crypt::encrypt(request('prenom')),
                'email' => Crypt::encrypt(request('email')),
                'telephone' => Crypt::encrypt(request('telephone')),
                'mobile' => Crypt::encrypt(request('mobile')),
                'rue' => Crypt::encrypt(request('rue')),
                'nrue' => Crypt::encrypt(request('nrue')),
                'pays' => Crypt::encrypt(request('pays')),
                'localite_id' => $localite->id,
                'assujetti_id' => $assujetti->id,
            ]);
           
        // Si l'assujetissement n'existe pas
       } elseif (!$assujetti) {
           // Insertion l'assujetissement en bd
            $assujetti = Assujetti::create([
               'intitule' => Crypt::encrypt(request('assujetti')),
               'num_tva' => Crypt::encrypt(request('numtva')),
            ]);
            $client = Client::create([
                'civilite' => Crypt::encrypt(request('civilite')),
                'nom' => Crypt::encrypt(request('nom')),
                'prenom' => Crypt::encrypt(request('prenom')),
                'email' => Crypt::encrypt(request('email')),
                'telephone' => Crypt::encrypt(request('telephone')),
                'mobile' => Crypt::encrypt(request('mobile')),
                'rue' => Crypt::encrypt(request('rue')),
                'nrue' => Crypt::encrypt(request('nrue')),
                'pays' => Crypt::encrypt(request('pays')),
                'localite_id' => $localite->id,
                'assujetti_id' => $assujetti->id,
            ]);
        // Si la localite n'existe pas
       } elseif (!$localite) {
           // Insertion de la localité en bd
            $localite = Localite::create([
                'intitule' => Crypt::encrypt(request('localite')),
                'code_postal' => Crypt::encrypt(request('codepostal')),
            ]);
            $client = Client::create([
                'civilite' => Crypt::encrypt(request('civilite')),
                'nom' => Crypt::encrypt(request('nom')),
                'prenom' => Crypt::encrypt(request('prenom')),
                'email' => Crypt::encrypt(request('email')),
                'telephone' => Crypt::encrypt(request('telephone')),
                'mobile' => Crypt::encrypt(request('mobile')),
                'rue' => Crypt::encrypt(request('rue')),
                'nrue' => Crypt::encrypt(request('nrue')),
                'pays' => Crypt::encrypt(request('pays')),
                'localite_id' => $localite->id,
                'assujetti_id' => $assujetti->id,
            ]);
       } else {
            //Insertion du client en base de données
            $client = Client::create([
                'civilite' => Crypt::encrypt(request('civilite')),
                'nom' => Crypt::encrypt(request('nom')),
                'prenom' => Crypt::encrypt(request('prenom')),
                'email' => Crypt::encrypt(request('email')),
                'telephone' => Crypt::encrypt(request('telephone')),
                'mobile' => Crypt::encrypt(request('mobile')),
                'rue' => Crypt::encrypt(request('rue')),
                'nrue' => Crypt::encrypt(request('nrue')),
                'pays' => Crypt::encrypt(request('pays')),
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Localite;
use App\Models\Assujetti;
use App\Models\Vente;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    /**
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
     * Affiche le formulaire pour créer un nouveau client
     *
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
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
            'nom' => ['required', 'regex:/^[a-z éèàùç\'-]+$/i'],
            'prenom' => ['required', 'regex:/^[a-z éèàùç\'-]+$/i'],
            'email' => ['required', 'regex:/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/' ,'email'],
            'telephone' => ['required', 'numeric', 'min:8'],
            'mobile' => ['required', 'numeric', 'min:8'],
            'rue' => ['required', 'regex:/^[a-z éèàùç.,\'-]+$/i'],
            'nrue' => ['required', 'alpha_num'],
            'codepostal' => ['required', 'regex:/^([0-9]{4,5})$/'],
            'localite' => ['required', 'regex:/^[a-z éèàùç.,\'-]+$/i'],
            'pays' => ['required', 'regex:/^[a-z éèàùç.,\'-]+$/i'],
            'assujetti' => ['required', 'regex:/^[a-z ]+$/i'],
        ]);
        
        // Vérifie si la localite existe déjà en bd
        $localite = "";       
        $localites = DB::table('localites')->get();
         
        foreach ($localites as $item) {
            if (Crypt::decrypt($item->intitule) == request('localite') &&
                Crypt::decrypt($item->code_postal) == request('codepostal')) {
                $localite = $item;
            } 
        }

        // Vérifie si le type d'assujetissement existe déjà
        $assujetti = "";
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
            DB::transaction(function() {
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
            });   
        // Si l'assujetissement n'existe pas
       } elseif (!$assujetti) {
            DB::transaction(function() use($localite) {
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
            });
        // Si la localite n'existe pas
       } elseif (!$localite) {
            DB::transaction(function() use($assujetti) {
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
            });
       } else {
            DB::transaction(function() use($localite, $assujetti) {
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
            });   
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
        // selectionne toutes les valeurs de la colonne intitule de la table assujettis 
        $assujettis = DB::table('assujettis')->select('intitule')->get();
        // boucle car même si les valeurs sont égales décryptées elles ne le sont pas dans la table
        $compare = null;
        foreach ($assujettis as $assujetti) {      
            if ($compare == Crypt::decrypt($assujetti->intitule)) {
                $assujettis->forget($assujettis->search($assujetti));
            }
            $compare = Crypt::decrypt($assujetti->intitule);
        }

        $client = Client::find($id);

        return view('clients.edit', [
            'client' => $client,
            'assujettis' => $assujettis,
        ]);
    }

    /**
     * Modifier le client spécifié.
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
            'nom' => ['required', 'regex:/^[a-z ,.\'-]+$/i'],
            'prenom' => ['required', 'regex:/^[a-z ,.\'-]+$/i'],
            'email' => ['required', 'regex:/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/' ,'email'],
            'telephone' => ['required', 'numeric', 'min:8'],
            'mobile' => ['required', 'numeric', 'min:8'],
            'rue' => ['required', 'regex:/^[a-z ,\'-]+$/i'],
            'nrue' => ['required', 'alpha_num'],
            'codepostal' => ['required', 'regex:/^([0-9]{4,5})$/'],
            'localite' => ['required', 'regex:/^[a-z ,\'-]+$/i'],
            'pays' => ['required', 'regex:/^[a-z ,\'-]+$/i'],
            'assujetti' => ['required', 'regex:/^[a-z ]+$/i'],
        ]);
        // récupère le client grâce à son id
        $client = Client::find($id);
        
        // Vérifie si la localite existe déjà en bd
        $localite="";       
        $localites = DB::table('localites')->get();        
        foreach ($localites as $item) {
            if (Crypt::decrypt($item->intitule) == request('localite') &&
                Crypt::decrypt($item->code_postal) == request('codepostal')) {
                $localite = $item;
            } 
        }

        // Vérifie si le type d'assujetissement existe déjà
        $assujetti = "";
        $assujettis = DB::table('assujettis')->get();   
        foreach ($assujettis as $item) {
            if (Crypt::decrypt($item->intitule) == request('assujetti') &&
                Crypt::decrypt($item->num_tva) == request('numtva')) {
                $assujetti = $item;
            }  
        }

        DB::transaction(function() use($localite, $assujetti, $client) {
            // si la localité n'existe pas
            if (!$localite) {
                $localite = Localite::create([
                    'intitule' => Crypt::encrypt(request('localite')),
                    'code_postal' => Crypt::encrypt(request('codepostal')),
                ]);
            }

            if (!$assujetti) {
                $assujetti = Assujetti::create([
                    'intitule' => Crypt::encrypt(request('assujetti')),
                    'num_tva' => Crypt::encrypt(request('numtva')),
                ]);
            }
            // $localite = Localite::where('intitule', request('localite'))->first();
            // $assujetti = Assujetti::where('intitule', request('assujetti'))->first();

            $client->update([
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
        });
        
        flash('Le client a bien été mis à jour.')->success();
        return redirect('/clients');
    }

    /**
     * Supprimer un client
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::find($id);
        // modifie les ventes de ce client à aucun client
        foreach ($client->ventes as $vente) {
            $vente->update([
                'client_id' => null,
            ]);
        }
        $client->delete();

        // modifier le client, appliquer sur tous les champs l'id du client et pas le supprimer
        // $client->update([
        //     'nom' => $client->id,
        // ]);

        flash('Le client ' . Crypt::decrypt($client->nom) . ' ' . Crypt::decrypt($client->prenom) . ' a bien été supprimé.')->success();
        return redirect('/clients');
    }
}

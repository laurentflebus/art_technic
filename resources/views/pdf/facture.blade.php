<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="Flebus Laurent">
  </head>
  <body>
      <p>
        Binche le , {{ date('d M Y') }}  <br>              
        Facture n° {{ $vente->facture->numero }} <br>
        Date : {{ $vente->facture->date }}
      </p>              
      <p>
        {{ Crypt::decrypt($vente->client->nom) }} {{ Crypt::decrypt($vente->client->prenom) }} <br>
        {{ Crypt::decrypt($vente->client->rue) }},{{ Crypt::decrypt($vente->client->nrue) }} <br>
        {{ Crypt::decrypt($vente->client->localite->code_postal) }} {{ Crypt::decrypt($vente->client->localite->intitule) }} <br>
        {{ Crypt::decrypt($vente->client->pays) }} <br>
        {{ Crypt::decrypt($vente->client->assujetti->num_tva) ?? "" }}
    </p>
                                 
    <p>
        {{ Crypt::decrypt($societe->localite->code_postal) }} {{ Crypt::decrypt($societe->localite->intitule) }} - {{ Crypt::decrypt($societe->rue) }}, {{ Crypt::decrypt($societe->nrue) }} - {{ Crypt::decrypt($societe->telephone) ?? "" }} - E-mail arttechnic2@skynet.be
    </p>           
    <table>
        <thead>
            <tr>
                <td><strong>Intitulé du poste de vente</strong></td>
                <td><strong>HTVA</strong></td>
                <td><strong>Taux</strong></td>
                <td><strong>TVA</strong></td>
                <td><strong>TVAC</strong></td>
            </tr>
        </thead>
        <tbody>
            <input type="hidden" value="{{ $totalttc = 0 }}">
            <input type="hidden" value="{{ $totalht = 0 }}">
            <input type="hidden" value="{{ $totaltva = 0 }}">
            
            @foreach ($vente->postes as $poste)
                <input type="hidden" value="{{ $totalttca = 0 }}">
                <input type="hidden" value="{{ $totaltvaa = 0 }}">
                
                <input type="hidden" value="{{ $totalttca = floatval($poste->pivot->quantite * $poste->pivot->prix_unitaire) }}">
                <input type="hidden" value="{{ $totalttc += floatval($poste->pivot->quantite * $poste->pivot->prix_unitaire) }}">

                <input type="hidden" value="{{ $totaltva += floatval($poste->pivot->quantite * $poste->pivot->prix_unitaire) * floatval($poste->tva->taux/100) }}">
                <input type="hidden" value="{{ $totaltvaa = floatval($poste->pivot->quantite * $poste->pivot->prix_unitaire) * floatval($poste->tva->taux/100) }}">

                <input type="hidden" value="{{ $totalht += $totalttc -  $totaltva }}">
                <input type="hidden" value="{{ $totalhta = $totalttca -  $totaltvaa }}"> 
                <tr>
                    <td>{{ $poste->intitule }}</td>
                    <td>{{ $totalhta }}</td>
                    <td>{{ $poste->tva->taux }}%</td>
                    <td>{{ $totaltvaa }}</td>
                    <td>{{ $totalttca }}</td>
                </tr>
            @endforeach   
        </tbody>
    </table>
    <p>
      Total HTVA : {{ $totalht }} <br>
      Total TVA : {{ $totaltva }} <br>
      Total TVAC : {{ $totalttc }}
    </p>
  </body>
</html>            
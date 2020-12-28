<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style type="text/css">

.footer p {
    margin:0;
    font-size:10px;
    color:#999;
}
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
table thead th {
    width:100px;
    padding:5px;
    text-align: center;
}
table thead th.large {
    width:150px;
    padding:5px;
    text-align: left;
}
table tbody tr td {
    padding: 5px;
    border: 1px solid;
    text-align: center;
}
table tbody tr td.large{
    text-align: left;
}
table tr.total{
      background: #000;
    color:#FFF;
}
div#header div {
  display: inline-block; 
}
div#header .left {
  text-align: left;
  width: 70%;
}
div#header .right {
  width: 29%;
}
div#header .right p {
  border: solid 1px;
  margin-top: 1px;
  padding : 5px;
}
#info p {
  text-align: center;
  border: solid 1px;
  padding : 5px;
}
body {
  padding: 5%
}
img {
  width: 50%;
}
#total p {
  display: inline-block;
  width: 150px;
}
</style>
</head>
<body>
  <div id=header>
    <div class="left">
      <img src="img/art-technic.png">
    </div>
    <div class="right">
      <p>
        Facture n° : {{ $vente->facture->numero }} <br>
        Date : {{ date('d/m/Y') }}
      </p>
      <p>
        <strong>{{ Crypt::decrypt($vente->client->nom) }} {{ Crypt::decrypt($vente->client->prenom) }} </strong> <br>
        {{ Crypt::decrypt($vente->client->rue) }},{{ Crypt::decrypt($vente->client->nrue) }} <br>
        {{ Crypt::decrypt($vente->client->localite->code_postal) }} {{ Crypt::decrypt($vente->client->localite->intitule) }}  <br>
        {{ Crypt::decrypt($vente->client->pays) }} <br>
        {{ Crypt::decrypt($vente->client->assujetti->num_tva) ?? "" }}
      </p>
    </div>
  </div>
  <div id="info">
    <p>
        {{ Crypt::decrypt($societe->localite->code_postal) }} {{ Crypt::decrypt($societe->localite->intitule) }} - {{ Crypt::decrypt($societe->rue) }}, {{ Crypt::decrypt($societe->nrue) }} - Tél. {{ Crypt::decrypt($societe->telephone) ?? "" }} - E-mail arttechnic2@skynet.be
    </p>
  </div>

    <table>
      <thead>
          <tr>
              <th class="large">Intitulé du poste de vente</th>
              <th>HTVA</th>
              <th>Taux</th>
              <th>TVA</th>
              <th>TVAC</th>
          </tr>
      </thead>
      <tbody>
        @foreach ($vente->postes as $poste)
            <tr>
                <td class="large">{{ $poste->intitule }}</td>
                <td>{{ $totalhta = floatval($poste->pivot->quantite * $poste->pivot->prix_unitaire) * floatval(1 - $poste->tva->taux/100) }}</td>
                <td>{{ $poste->tva->taux }}%</td>
                <td>{{ $totaltvaa = floatval($poste->pivot->quantite * $poste->pivot->prix_unitaire) * floatval($poste->tva->taux/100) }}</td>
                <td>{{ $totalttca = floatval($poste->pivot->quantite * $poste->pivot->prix_unitaire) }}</td>
            </tr>
        @endforeach
        <tr>
            <td class="large"><strong>Totaux</strong></td>
            <td><strong>{{ number_format($donnees['totalht'], 2, '.', '') }}</strong></td>
            <td></td>
            <td><strong>{{ number_format($donnees['totaltva'], 2, '.', '') }}</strong></td>
            <td><strong>{{ number_format($donnees['totalttc'], 2, '.', '') }}</strong></td>
        </tr>
      </tbody>
  </table>
  <p>TVA 6,00% : {{ number_format($donnees['totaltva6'], 2, '.', '') }}</p>
  <p>TVA 21.00% : {{ number_format($donnees['totaltva21'], 2, '.', '') }}</p>
  <div class="footer">
      <hr/>
      
  </div>
</body>
</html>
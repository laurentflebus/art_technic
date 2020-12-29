<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style type="text/css">

th {
  border-bottom: 1px solid black;
  border-collapse: collapse;
}
table thead th {
    width:100px;
    padding:5px;
    text-align: center;
}
table thead th.large {
    width:100px;
    padding:5px;
    text-align: left;
}
table tbody tr td {
    padding: 5px;
    text-align: right;
}
table tbody tr td.large{
    text-align: left;
}
div#header div {
  display: inline-block; 
}
div#header .left {
  width: 250px;
}
div#header .right {
  width: 90px;
  text-align: right;
}
</style>
</head>
<body>
    <div id=header>
        <div class="left">
            <p>
                {{ Crypt::decrypt($societe->nom) }} <br>
                {{ Crypt::decrypt($societe->rue) }}, {{ Crypt::decrypt($societe->nrue) }}
            </p>
        </div>
        <div class="right">
          <p>
            {{ Crypt::decrypt($societe->localite->code_postal) }} {{ Crypt::decrypt($societe->localite->intitule) }} <br>
            {{ Crypt::decrypt($societe->telephone) }}
          </p>
        </div>
    </div>
    <p>Le {{ date('d/m/y') }}</p>
    <table>
        <thead>
            <tr>
                <th class="large">Article</th>
                <th>Qté</th>
                <th>Montant</th>
            </tr>
        </thead>
        <tbody>
          @foreach ($vente->postes as $poste)
              <tr>
                  <td class="large">{{ $poste->intitule }}</td>
                  <td>{{ $poste->pivot->quantite }}</td>
                  <td style="border-bottom: 1px solid">{{ $poste->pivot->prix_unitaire }}</td>
              </tr>
              <tr>
                  <td></td>
                  <td></td>
                  <td>= {{ $total = floatval($poste->pivot->quantite * $poste->pivot->prix_unitaire) }}</td>
              </tr>
          @endforeach
          <tr>
              <td class="large">Total TVAC</td>
              <td></td>
              <td>{{ number_format($donnees['totalttc'], 2, '.', '') }}</td>
          </tr>
          <tr>
              <td class="large">Total HTVA</td>
              <td></td>
              <td>{{ number_format($donnees['totalht'], 2, '.', '') }}</td>
          </tr>
        </tbody>
    </table>
    <p>{{ $vente->modereglement->intitule }}</p>
    <p><strong>TVA 6,00%: {{ number_format($donnees['totaltva6'], 2, '.', '') }}</strong></p>
    <p><strong>TVA 21,00%: {{ number_format($donnees['totaltva21'], 2, '.', '') }}</strong></p>
    <p>Merci de votre visite</p>
</body>
</html>
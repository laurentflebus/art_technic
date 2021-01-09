<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
    <div class="text-center">
        <h3>Impression des opérations relatives aux clients {{ date('Y') }}</h3>
    </div>

    <table>
      <thead>
          <tr>
              <th>Nr facture</th>
              <th>Mont. HTVA</th>
              <th>Mont. TVAC</th>
              <th>Total fact.</th>
              <th>Nom Client</th>
          </tr>
      </thead>
      <tbody>
            @foreach ($postes as $poste)
                @foreach ($factures as $facture)
                    @foreach ($facture->vente->postes as $item)
                      @if ($poste->intitule == $item->intitule)
                        <tr>
                          <td>{{ $poste->numero }}</td>
                          <td>{{ $poste->intitule }}</td>
                          <td></td>
                          <td></td>
                          <td></td>
                        </tr>
                        @foreach ($factures as $facture)
                          @foreach ($facture->vente->postes as $item)
                            @if ($poste->intitule == $item->intitule)
                              <tr>
                                <td>{{ $facture->numero }}</td>
                                <td>{{ floatval($item->pivot->prix_unitaire * $item->pivot->quantite) }}</td>
                                <td></td>
                                <td></td>
                                <td>{{ $facture->vente->client->nom ?? "" }}</td>
                              </tr> 
                              @endif
                          @endforeach
                        @endforeach
                      @endif 
                    @endforeach
                @endforeach
            @endforeach
           
            {{-- <tr>

                <td>{{ $facture->numero }}</td>
                <td>{{ $totalhta = floatval($poste->pivot->quantite * $poste->pivot->prix_unitaire) * floatval(1 - $poste->tva->taux/100) }}</td>
                <td>{{ $poste->tva->taux }}%</td>
                <td>{{ $totaltvaa = floatval($poste->pivot->quantite * $poste->pivot->prix_unitaire) * floatval($poste->tva->taux/100) }}</td>
                <td>{{ $totalttca = floatval($poste->pivot->quantite * $poste->pivot->prix_unitaire) }}</td>
            </tr>
        
        <tr>
            <td class="large"><strong>Totaux</strong></td>
            <td><strong>{{ number_format($donnees['totalht'], 2, '.', '') }}</strong></td>
            <td></td>
            <td><strong>{{ number_format($donnees['totaltva'], 2, '.', '') }}</strong></td>
            <td><strong>{{ number_format($donnees['totalttc'], 2, '.', '') }}</strong></td>
        </tr> --}}
      </tbody>
  </table>
  {{-- <p>TVA 6,00% : {{ number_format($donnees['totaltva6'], 2, '.', '') }}</p>
  <p>TVA 21.00% : {{ number_format($donnees['totaltva21'], 2, '.', '') }}</p> --}}
  <div class="footer">
      <hr/>
      
  </div>
</body>
</html>
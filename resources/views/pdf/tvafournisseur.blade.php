<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <style type="text/css">
table thead th {
    border-bottom: 1px dashed black; 
    border-collapse: collapse;
    width: 125px;
    padding:5px;
    text-align: center;  
}

table tbody tr td {
    padding: 5px;
    text-align: right;
}
table {
  margin-bottom: 20px;
}
table#totaux {
  border: 1px solid black;
  border-collapse: collapse;
}

table#totaux thead th {
    border: 1px solid black; 
    border-collapse: collapse;
    width: 135px;
    padding:5px;
    text-align: center;  
}
table#totaux tbody tr td {
    width: 160px;
    padding: 5px;
    border: 1px solid;
    text-align: right;
}
td.totalfournisseur {
  border-top: 1px dashed black;
  border-bottom: 1px dashed black;
  font-weight: bold;
}
body {
  padding: 2%;
}
div#titre h3 {
  text-align: center;
  border-bottom: solid 1px;
  padding : 10px;
}
</style>
</head>
<body>
  
  
    <div id="titre">
        <h3>Impression des opérations relatives aux fournisseurs {{ date('Y') }}</h3>
    </div>

    <div>
      <p>Période de départ : {{ $depart }}</p>
      <p>Période d'arrêt &nbsp; &nbsp; &nbsp;: {{ $arret }}</p>
    </div>

    <table>
      <thead>
          <tr>
              <th>Date fact.</th>
              <th>Nr fact.</th>
              <th>Mont. HTVA</th>
              <th>Mont. TVAC</th>
              <th>Mont. TVA</th>
          </tr>
      </thead>
      <tbody>
            @foreach ($fournisseurs as $fournisseur)
            
                @foreach ($achats as $achat)
                    @if($fournisseur->id == $achat->fournisseur_id)
                      <tr>
                        <td>{{ Crypt::decrypt($fournisseur->nom) ?? "" }} {{ Crypt::decrypt($fournisseur->prenom) ?? "" }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      @break
                    @endif
                @endforeach
                @foreach ($facturesdetaillees as $facture)
                  @if ($fournisseur->id == $facture['idfournisseur'])       
                      <tr>
                        <td>{{ $facture['date'] }}</td>
                        <td>{{ $facture['numero'] }}</td>
                        <td>{{ number_format($facture['totalhtva'], 2, ".", "") }}</td>
                        <td>{{ number_format($facture['totaltvac'], 2, ".", "") }}</td>
                        <td>{{ number_format($facture['totaltva'], 2, ".", "") }}</td>  
                      </tr> 
                  @endif
                @endforeach
                @foreach ($totauxfacturesfournisseurs as $item)
                      @if ($item['idfournisseur'] == $fournisseur->id)
                      <tr>
                        <td></td>
                        <td></td>
                        <td class="totalfournisseur">{{ number_format($item['totalhtva'], 2, ".", "") }}</td>
                        <td class="totalfournisseur">{{ number_format($item['totaltvac'], 2, ".", "") }}</td>
                        <td class="totalfournisseur">{{ number_format($item['totaltva'], 2, ".", "") }}</td>
                        <td></td>
                      </tr>
                      @endif
                @endforeach
            @endforeach
      </tbody>
  </table>
<input type="hidden" value="{{ $totalhtva = 0 }}">
<input type="hidden" value="{{ $totaltvac = 0 }}">
<input type="hidden" value="{{ $totaltva = 0 }}">
  <table id="totaux">
    <thead>
      <tr>
        <th></th>
        <th>HTVA</th>
        <th>TVAC</th>
        <th>TVA</th>
      </tr> 
    </thead>
    <tbody>
      
      @foreach ($totauxpartva as $item)
        <tr>
          <td>Totaux</td>
          <td>{{ number_format($totalhtva += floatval($item->total) / floatval(1 + $item->taux/100), 2, ".", "") }}</td>
          <td>{{ number_format($totaltvac += $item->total, 2, ".", "") }}</td>
          <td>{{ number_format($totaltva += floatval($item->total / (1+$item->taux/100) * $item->taux/100), 2, ".", "") }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</body>
</html>
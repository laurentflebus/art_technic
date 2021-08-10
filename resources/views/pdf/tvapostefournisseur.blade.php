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
    width: 90px;
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
    padding: 5px;
    border: 1px solid;
    text-align: right;
}
td.totalposte {
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
              <th>Date facture</th>
              <th>Nr fact.</th>
              <th>Mont. HTVA</th>
              <th>Mont. TVAC</th>
              <th>Mont. TVA</th>
              <th>Total fact.</th>
              <th>Nom fournisseur</th>
          </tr>
      </thead>
      <tbody>
            @foreach ($postes as $poste)
              @foreach ($achats as $achat)
                @foreach ($achat->postes as $item)
                    @if($poste->id == $item->id)
                      <tr>
                        <td>{{ $poste->numero }}</td>
                        <td>{{ $poste->intitule }}</td>
                        <td>( TVA {{ $poste->tva->taux }} % )</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      @break
                    @endif
                @endforeach
              @endforeach
                
                @foreach ($achats as $achat)
                  @foreach ($achat->postes as $item)
                    @if ($poste->intitule == $item->intitule)
                      <tr>
                        <td>{{ $datefr = date("d/m/Y", strtotime($achat->date)) }}</td>
                        <td>{{ $achat->numero }}</td>
                        <td>{{ number_format(floatval($item->pivot->prix_unitaire * $item->pivot->quantite) / floatval(1 + $poste->tva->taux/100), 2, ".", "") }}</td>
                        <td>{{ number_format(floatval($item->pivot->prix_unitaire * $item->pivot->quantite), 2, ".", "") }}</td>
                        <td>{{ number_format(floatval($item->pivot->prix_unitaire *  $item->pivot->quantite / (1 + $poste->tva->taux/100) * $poste->tva->taux/100), 2, ".", "") }}</td>
                        
                        @foreach ($totaux as $item)
                          @if ($item->id == $achat->id)
                            <td>{{ number_format($item->total, 2, ".", "") }}</td>
                          @endif  
                        @endforeach
                        <td>{{ Crypt::decrypt($achat->fournisseur->nom) ?? "" }} {{ Crypt::decrypt($achat->fournisseur->prenom) ?? "" }}</td>
                      </tr> 
                    @endif
                  @endforeach
                @endforeach
                @foreach ($totauxparposte as $item)
                      @if ($item->id == $poste->id)
                      <tr>
                        <td></td>
                        <td></td>
                        <td class="totalposte">{{ number_format(floatval($item->total) / floatval(1 + $poste->tva->taux/100), 2, ".", "") }}</td>
                        <td class="totalposte">{{ number_format($item->total, 2, ".", "") }}</td>
                        <td class="totalposte">{{ number_format(floatval($item->total / (1 + $poste->tva->taux/100) * $poste->tva->taux/100), 2, ".", "") }}</td>
                        <td></td>
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
          <td>Totaux des ventes à {{ $item->taux }} % de TVA</td>
          <td>{{ number_format(floatval($item->total / (1 + $item->taux/100)), 2, ".", "") }}</td>
          <td>{{ number_format($item->total, 2, ".", "") }}</td>
          <td>{{ number_format(floatval($item->total / (1 + $item->taux/100) * $item->taux/100), 2, ".", "") }}</td>
        </tr>
      @endforeach
      @foreach ($totauxpartva as $item)
        <tr>
          <td></td>
          <td>{{ number_format($totalhtva += floatval($item->total / (1 + $item->taux/100)), 2, ".", "") }}</td>
          <td>{{ number_format($totaltvac += $item->total, 2, ".", "") }}</td>
          <td>{{ number_format($totaltva += floatval($item->total / (1 + $item->taux/100) * $item->taux/100), 2, ".", "") }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</body>
</html>
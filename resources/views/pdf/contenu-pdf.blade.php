<p>{{ Crypt::decrypt($societe->nom) }} {{ Crypt::decrypt($societe->localite->code_postal) }} {{ Crypt::decrypt($societe->localite->intitule) }}</p>
<p>{{ Crypt::decrypt($societe->rue) }}, {{ Crypt::decrypt($societe->nrue) }} {{ Crypt::decrypt($societe->telephone) }}</p>
<p>Le {{ $vente->date }}</p>

<p>Article Qté Montant</p>
<p>-----------------------------------------------------------------</p>
@foreach ($vente->postes as $poste)
    <input type="hidden" value="{{ $total = floatval($poste->pivot->quantite * $poste->pivot->prix_unitaire) }}">
    <p>{{ $poste->intitule }}           {{ $poste->pivot->quantite }}          {{ $poste->pivot->prix_unitaire }}</p>
    <p> -----------------------------</p>
    <p>= {{ $total }}</p>
@endforeach
<p>Merci de votre visite</p>

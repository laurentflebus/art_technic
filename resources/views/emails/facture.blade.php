@component('mail::message')
@if (Crypt::decrypt($vente->client->civilite) == 'Monsieur')
    ### Bonjour monsieur, {{ Crypt::decrypt($vente->client->nom) }} {{ Crypt::decrypt($vente->client->prenom) }}
@else
    ### Bonjour madame, {{ Crypt::decrypt($vente->client->nom) }} {{ Crypt::decrypt($vente->client->prenom) }}
@endif

Vous trouverez en pièce jointe votre facture.

Cordialement.

Art-Technic
@endcomponent
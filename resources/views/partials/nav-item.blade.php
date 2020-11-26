<li class="nav-item {{ request()->is($lien) ? 'active' : '' }}">
    <a class="nav-link" href={{ url($lien) }}>{{ $texte }}</a>
</li>
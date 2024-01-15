<li class="nav-item @if (request()->is('pendaftar')) active @endif">
    <a class="nav-link single-menu" href="{{ route('dashboard') }}">
        <i class="fa-solid fa-house mr-2"></i>
        <span class="menu-title">DASHBOARD</span>
    </a>
</li>

@canany(['view data biodata'])
<li class="nav-item @if (request()->is('pendaftar/biodata')) active @endif">
    <a class="nav-link single-menu" href="{{ route('pendaftar.biodata.index') }}">
        <i class="fa-solid fa-user mr-2"></i>
        <span class="menu-title">BIODATA</span>
    </a>
</li>
@endcanany

@canany(['view data riwayat pendidikan'])
<li class="nav-item @if (request()->is('pendaftar/riwayat_pendidikan')) active @endif">
    <a class="nav-link single-menu" href="{{ route('pendaftar.riwayat_pendidikan.index') }}">
        <i class="fa-solid fa-user mr-2"></i>
        <span class="menu-title">PENDIDIKAN TERAKHIR</span>
    </a>
</li>
@endcanany

@canany(['view data riwayat pelatihan'])
<li class="nav-item @if (request()->is('pendaftar/riwayat_pelatihan')) active @endif">
    <a class="nav-link single-menu" href="{{ route('pendaftar.riwayat_pelatihan.index') }}">
        <i class="fa-solid fa-user mr-2"></i>
        <span class="menu-title">RIWAYAT PELATIHAN</span>
    </a>
</li>
@endcanany

@canany(['view data riwayat pekerjaan'])
<li class="nav-item @if (request()->is('pendaftar/riwayat_pekerjaan')) active @endif">
    <a class="nav-link single-menu" href="{{ route('pendaftar.riwayat_pekerjaan.index') }}">
        <i class="fa-solid fa-user mr-2"></i>
        <span class="menu-title">RIWAYAT PEKERJAAN</span>
    </a>
</li>
@endcanany

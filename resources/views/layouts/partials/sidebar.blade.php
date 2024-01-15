<nav class="sidebar sidebar-offcanvas overflow-auto" id="sidebar">
    <ul class="nav">
        @hasrole('admin')
            @include('layouts.partials.menus.admin')
        @endhasrole

        @hasrole('pendaftar')
            @include('layouts.partials.menus.pendaftar')
        @endhasrole
    </ul>
</nav>

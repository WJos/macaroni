<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class
         with font-awesome or any other icon font library -->
    <li class="nav-item menu-open">
      <a href="{{ route('dashboard') }}" class="nav-link @if (Route::is('dashboard')) active @endif">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
          Tableau
          {{-- <i class="right fas fa-angle-left"></i> --}}
        </p>
      </a>
      {{-- <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="./index.html" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Dashboard v1</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="./index2.html" class="nav-link active">
            <i class="far fa-circle nav-icon"></i>
            <p>Dashboard v2</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="./index3.html" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Dashboard v3</p>
          </a>
        </li>
      </ul> --}}
    </li>
    
    <li class="nav-item">
      <a href="{{ route('enreg.crud') }}" class="nav-link @if (Route::is('enreg.crud',)) active @endif">
        <i class="nav-icon fas fa-table"></i>
        <p>
          En cours
          {{-- <i class="fas fa-angle-left right"></i> --}}
        </p>
      </a>
    </li>

    <li class="nav-item">
      <a href="{{ route('valide.crud') }}" class="nav-link @if (Route::is('valide.crud',)) active @endif">
        <i class="nav-icon fas fa-check"></i>
        <p>
          Valides
          {{-- <i class="fas fa-angle-left right"></i> --}}
        </p>
      </a>
    </li>

    <li class="nav-item">
      <a href="{{ route('archive.crud') }}" class="nav-link @if (Route::is('archive.crud',)) active @endif">
        <i class="nav-icon fas fa-folder"></i>
        <p>
          Archives
          {{-- <i class="fas fa-angle-left right"></i> --}}
        </p>
      </a>
    </li>

    @role('Super-Admin|Admin')

    <li class="nav-item">
      <a href="{{ route('users.index') }}" class="nav-link {{ str_contains(Route::currentRouteName(), 'users.') ? 'active' : '' }}">
        <i class="nav-icon fas fa-user"></i>
        <p>
          Utlisateurs
          {{-- <i class="fas fa-angle-left right"></i> --}}
        </p>
      </a>
    </li>

    <li class="nav-item">
      <a href="{{ route('clients.index') }}" class="nav-link {{ str_contains(Route::currentRouteName(), 'clients.') ? 'active' : '' }}">
        <i class="nav-icon fas fa-user"></i>
        <p>
          Clients
          {{-- <i class="fas fa-angle-left right"></i> --}}
        </p>
      </a>
    </li>
    {{-- <li class="nav-item">
      <a href="#" class="nav-link {{ str_contains(Route::currentRouteName(), 'users.') || str_contains(Route::currentRouteName(), 'clients.') ? 'active' : '' }}">
        <i class="nav-icon fas fa-user"></i>
        <p>
          Comptes
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{ route('users.index') }}" class="nav-link {{ str_contains(Route::currentRouteName(), 'users.') ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Utlisateurs</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('clients.index') }}" class="nav-link {{ str_contains(Route::currentRouteName(), 'clients.') ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Clients</p>
          </a>
        </li>
      </ul>
    </li> --}}
    @endrole
  </ul>
</nav>
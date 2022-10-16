<!--sidebar start-->
<div class="sidebar d-print-none bg-primary">
    <div class="sidebar-menu pt-3 pb-2">
        {{-- <li class="item profile mb-3">
            <img src="/assets/images/avatar.jpg" alt="">
            <h4 class="text-white m-0 min-width-hidden-item">محمد الحمداوي</h4>
            <p class="min-width-hidden-item">طبيب اسنان</p>
        </li> --}}
        {{-- @if(auth()->user()->type == 'admin')
        <li class="item">
            <a href="{{route('home')}}" class="menu-btn {{ request()->is('home*') ? 'active' : 'menu-btn-hover'}}">
                <i class="fas fa-desktop"></i><span>Tableau de bord</span>
            </a>
        </li>
        @endif --}}
        <li class="item" id="dashboard">
            <a href="{{ route('home') }}"
                class="text-white menu-btn {{ request()->is('*home*') ? 'active' : 'menu-btn-hover'}}">
                <span class="min-width-hidden-item">Home </span> <i class="fa-solid fa-desktop"></i>
            </a>
        </li>
        <li class="item" id="Customers">
            <a href="{{ route('customers') }}"
                class="text-white menu-btn {{ request()->is('*customer*') ? 'active' : 'menu-btn-hover'}}">
                <span class="min-width-hidden-item">Customers </span> <i class="fa-solid fa-user"></i>
            </a>
        </li>
        {{-- Admin Section --}}
        {{-- @if(auth()->user()->hasRole('admin')) --}}
        {{-- <li class="item" id="products">
            <a href="{{route('products')}}"
                class="menu-btn {{ request()->is('*products*') ? 'active' : 'menu-btn-hover'}}">
                <i class="fas fa-archive"></i><span>Produits</span>
            </a>
        </li>
        <li class="item" id="purchases">
            <a href="{{route('purchases')}}"
                class="menu-btn {{ request()->is('*purchases*') ? 'active' : 'menu-btn-hover'}}">
                <i class="fas fa-cart-arrow-down"></i><span>Achats</span>
            </a>
        </li>
        <li class="item" id="movements">
            <a href="{{route('movements')}}"
                class="menu-btn {{ request()->is('*movements*') ? 'active' : 'menu-btn-hover'}}">
                <i class="fas fa-dolly"></i><span>Mouvements</span>
            </a>
        </li> --}}
        {{-- @endif --}}
        {{-- <li class="item" id="sells">
            <a href="{{route('sells')}}" class="menu-btn {{ request()->is('*sells*') ? 'active' : 'menu-btn-hover'}}">
                <i class="fas fa-cart-plus"></i><span>Ventes</span>
            </a>
        </li> --}}
        {{-- @if(auth()->user()->hasRole('admin')) --}}
        {{-- <li class="item" id="organizations">
            <a href="{{route('organizations')}}"
                class="menu-btn {{ request()->is('*organizations*') ? 'active' : 'menu-btn-hover'}}">
                <i class="fas fa-store-alt"></i><span>Organismes </span>
            </a>
        </li>
        <li class="item" id="companies">
            <a href="{{route('companies')}}"
                class="menu-btn {{ request()->is('*companies*') ? 'active' : 'menu-btn-hover'}}">
                <i class="fas fa-building"></i><span>Sociétés </span>
            </a>
        </li> --}}
        {{-- <li class="item" id="payments">
            <a href="{{route('payments')}}"
                class="menu-btn {{ request()->is('*payments*') ? 'active' : 'menu-btn-hover'}}">
                <i class="fas fa-dollar-sign"></i><span>Paiements </span>
            </a>
        </li> --}}
        {{-- <li class="item" id="contracts">
            <a href="{{route('contracts')}}"
                class="menu-btn {{ request()->is('*contract*') ? 'active' : 'menu-btn-hover'}}">
                <i class="fas fa-file-contract"></i><span>Contrats </span>
            </a>
        </li>
        <li class="item" id="prestations">
            <a href="{{route('prestations')}}"
                class="menu-btn {{ request()->is('*prestations*') ? 'active' : 'menu-btn-hover'}}">
                <i class="fas fa-money-check-alt"></i><span>Prestations</span>
            </a>
        </li>
        <li class="item" id="orders">
            <a href="{{route('orders')}}" class="menu-btn {{ request()->is('*orders*') ? 'active' : 'menu-btn-hover'}}">
                <i class="fas fa-headset"></i><span>Commandes</span>
            </a>
        </li>
        <li class="item" id="devis">
            <a href="{{route('devis')}}" class="menu-btn {{ request()->is('*devis*') ? 'active' : 'menu-btn-hover'}}">
                <i class="fas fa-file-invoice"></i><span>Devis</span>
            </a>
        </li>
        <li class="item" id="invoices">
            <a href="{{route('invoices')}}"
                class="menu-btn {{ request()->is('*invoices*') ? 'active' : 'menu-btn-hover'}}">
                <i class="fas fa-file-invoice"></i><span>Factures</span>
            </a>
        </li>
        <li class="item" id="payments">
            <a href="{{route('payments')}}"
                class="menu-btn {{ request()->is('*payments*') ? 'active' : 'menu-btn-hover'}}">
                <i class="fas fa-dollar-sign"></i><span>Paiements </span>
            </a>
        </li>
        <li class="item" id="charges">
            <a href="{{route('charges')}}"
                class="menu-btn {{ request()->is('*charges*') ? 'active' : 'menu-btn-hover'}}">
                <i class="fas fa-file-invoice-dollar"></i><span>Charges </span>
            </a>
        </li>
        <li class="item" id="customers">
            <a href="{{route('customers')}}"
                class="menu-btn {{ request()->is('*customer*') ? 'active' : 'menu-btn-hover'}}">
                <i class="fas fa-user"></i><span>Clients </span>
            </a>
        </li>
        <li class="item" id="vehicles">
            <a href="{{route('vehicles')}}"
                class="menu-btn {{ request()->is('*vehicle*') ? 'active' : 'menu-btn-hover'}}">
                <i class="fas fa-car"></i><span>Véhicules </span>
            </a>
        </li>
        <li class="item" id="users">
            <a href="{{route('users')}}" class="menu-btn {{ request()->is('*user*') ? 'active' : 'menu-btn-hover'}}">
                <i class="fas fa-users"></i><span>Utilisateurs </span>
            </a>
        </li> --}}
        {{-- @endif --}}


        {{-- <li class="item" id="vehicles">
            <a href="{{route('vehicles')}}"
                class="menu-btn {{ request()->is('*vehicles*') ? 'active' : 'menu-btn-hover'}}">
                <i class="fas fa-car"></i><span>Véhicules </span>
            </a>
        </li>
        <li class="item" id="customers">
            <a href="{{route('customers')}}"
                class="menu-btn {{ request()->is('*customers*') ? 'active' : 'menu-btn-hover'}}">
                <i class="fas fa-user"></i><span>Clients </span>
            </a>
        </li>
        <li class="item" id="drivers">
            <a href="{{route('drivers')}}"
                class="menu-btn {{ request()->is('*drivers*') ? 'active' : 'menu-btn-hover'}}">
                <i class="fas fa-id-badge"></i><span>Conducteurs </span>
            </a>
        </li>

        <li class="item" id="addons">
            <a href="{{route('addons')}}" class="menu-btn {{ request()->is('*addons*') ? 'active' : 'menu-btn-hover'}}">
                <i class="fas fa-puzzle-piece"></i><span>Addons </span>
            </a>
        </li>

        <li class="item" id="payments">
            <a href="{{route('payments')}}"
                class="menu-btn {{ request()->is('*payments*') ? 'active' : 'menu-btn-hover'}}">
                <i class="fas fa-dollar-sign"></i><span>Paiements </span>
            </a>
        </li>
        <li class="item" id="traffic_tickets">
            <a href="{{route('traffic_tickets')}}"
                class="menu-btn {{ request()->is('*traffic_tickets*') ? 'active' : 'menu-btn-hover'}}">
                <i class="fas fa-traffic-light"></i><span>Infractions </span>
            </a>
        </li>
        <li class="item" id="locations">
            <a href="{{route('locations')}}"
                class="menu-btn {{ request()->is('*locations*') ? 'active' : 'menu-btn-hover'}}">
                <i class="fas fa-map-marker-alt"></i><span>Locations </span>
            </a>
        </li>
        <li class="item" id="settings">
            <a href="#" class="menu-btn {{ request()->is('*settings*') ? 'active' : 'menu-btn-hover'}}">
                <i class="fas fa-cog"></i><span>Paramêtre</span>
            </a>
        </li>
        <li class="item">
            <a href="#about" class="menu-btn {{ request()->is('*about*') ? 'active' : 'menu-btn-hover'}}">
                <i class="fas fa-info-circle"></i><span>A propos</span>
            </a>
        </li> --}}
    </div>
</div>
<!--sidebar end-->
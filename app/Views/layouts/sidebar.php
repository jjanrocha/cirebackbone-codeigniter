<!-- Sidebar -->
<div class="nav-side-menu">
    <div class="brand">CIRE BACKBONE</div>
    <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>

    <div class="menu-list">

        <ul id="menu-content" class="menu-content collapse out">
            <li>
                <a href="{{ route('index') }}"><i class="fas fa-home sidebar-icon"></i> Início</a>
            </li>
            @if(Auth::user()->nivel == 'ADMINISTRADOR')
            <li>
                <a href="{{route('dashboard.index')}}"><i class="fa fa-tachometer-alt sidebar-icon"></i> Dashboard</a>
            </li>
            @endif
            <li data-toggle="collapse" data-target="#carimbos" class="collapsed">
                <a><i class="fas fa-stamp sidebar-icon"></i> Carimbos <span class="arrow"><i class="fa fa-angle-down"></i></span></a>
            </li>
            <ul class="sub-menu collapse" id="carimbos">
                <li><a href="{{route('carimbos.b2b.index')}}" id="b2b"><i class="fa fa-angle-right"></i> B2B <small><i class="fa fa-external-link"></i></small></a></li>
                <li><a href="{{route('carimbos.controle.index')}}" id="controle"><i class="fa fa-angle-right"></i> Controle </a></li>
                <li><a href="{{route('carimbos.gerais.index')}}" id="gerais"><i class="fa fa-angle-right"></i> Gerais <small><i class="fa fa-external-link"></i></small></a></li>
                <li><a href="{{route('carimbos.vivo2.index')}}" id="vivo2"><i class="fa fa-angle-right"></i> Vivo2 <small><i class="fa fa-external-link"></i></small></a></li>
                <li><a href="https://inmetacode.com.br/carimbo_swap/" target="blank" id="vivo2"><i class="fa fa-angle-right"></i> SWAP (abertura) <small><i class="fa fa-external-link"></i></small></a></li>
            </ul>
            @if(Auth::user()->nivel == 'ADMINISTRADOR')
            <li><a href="{{ route('usuarios.index') }}"><i class="fas fa-users sidebar-icon"></i> Usuários</a></li>
            @endif
            <li><a href="{{ route('links.index') }}"><i class="fas fa-link sidebar-icon"></i> Links</a></li>
            <li>
                <a href="javascript:logout.submit()"><i class="fas fa-sign-out-alt sidebar-icon"></i> Sair</a>
                <form name="logout" method="post" action="{{ route('logout') }}">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</div>

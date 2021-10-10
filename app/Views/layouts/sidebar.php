<!-- Sidebar -->
<div class="nav-side-menu">
    <div class="brand">CIRE BACKBONE</div>
    <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>

    <div class="menu-list">

        <ul id="menu-content" class="menu-content collapse out">
            <li>
                <a href="<?php echo (base_url('/')) ?>"><i class="fas fa-home sidebar-icon"></i> Início</a>
            </li>
            <?php if (session()->get('nivel') == 'ADMINISTRADOR') : ?>
                <li>
                    <a href="<?php echo (base_url('/')) ?>/dashboard"><i class="fa fa-tachometer-alt sidebar-icon"></i> Dashboard</a>
                </li>
            <?php endif; ?>
            <li data-toggle="collapse" data-target="#carimbos" class="collapsed">
                <a><i class="fas fa-stamp sidebar-icon"></i> Carimbos <span class="arrow"><i class="fa fa-angle-down"></i></span></a>
            </li>
            <ul class="sub-menu collapse" id="carimbos">
                <li><a href="<?php echo (base_url('/')) ?>/carimbos/b2b"><i class="fa fa-angle-right"></i> B2B <small><i class="fa fa-external-link"></i></small></a></li>
                <li><a href="<?php echo (base_url('/')) ?>/carimbos/controle"><i class="fa fa-angle-right"></i> Controle </a></li>
                <li><a href="<?php echo (base_url('/')) ?>/carimbos/gerais"><i class="fa fa-angle-right"></i> Gerais <small><i class="fa fa-external-link"></i></small></a></li>
                <li><a href="<?php echo (base_url('/')) ?>/carimbos/vivo2"><i class="fa fa-angle-right"></i> Vivo2 <small><i class="fa fa-external-link"></i></small></a></li>
                <li><a href="https://inmetacode.com.br/carimbo_swap/" target="blank"><i class="fa fa-angle-right"></i> SWAP <small><i class="fa fa-external-link"></i></small></a></li>
            </ul>
            <?php if (session()->get('nivel') == 'ADMINISTRADOR') : ?>
                <li><a href="<?php echo (base_url('/')) ?>/usuarios"><i class="fas fa-users sidebar-icon"></i> Usuários</a></li>
            <?php endif; ?>
            <li><a href="<?php echo (base_url('/')) ?>/links"><i class="fas fa-link sidebar-icon"></i> Links</a></li>
            <li>
                <a href="javascript:logout.submit()"><i class="fas fa-sign-out-alt sidebar-icon"></i> Sair</a>
                <form name="logout" method="post" action="/logout">
                </form>
            </li>
        </ul>
    </div>
</div>
<nav class="sidebar" data-trigger="scrollbar">
<!-- Sidebar Header -->
<div class="sidebar-header d-none d-lg-block">
    <!-- Sidebar Toggle Pin Button -->
    <div class="sidebar-toogle-pin">
        <i class="icofont-tack-pin"></i>
    </div>
    <!-- End Sidebar Toggle Pin Button -->
</div>
<!-- End Sidebar Header -->

<!-- Sidebar Body -->
<div class="sidebar-body">
    <!-- Nav -->
    <ul class="nav">
        <li class="nav-category">Acesso rápido</li>
        <li class="<?= $dash == true ? 'active' : '' ?>">
            <a href="<?=$url?>/pages/dashboard.php">
            <div class="icon">
                <i class="ti-pie-chart"></i>
            </div>
            <span class="link-title">Dashboard</span>
            </a>
        </li>
        <li class="<?= $sfp == true ? 'active' : '' ?>">
            <a href="<?=$url?>/pages/sfp.php">
            <div class="icon">
                <i class="ti-package"></i>
            </div>
            <span class="link-title">SFP</span>
            </a>
        </li>
        <li class="<?= $chave == true ? 'active' : '' ?>">
            <a href="<?=$url?>/pages/chave.php">
            <div class="icon">
                <i class="icon_key_alt"></i>
            </div>
            <span class="link-title">Chaves</span>
            </a>
        </li>
        <li class="<?= $roteador == true ? 'active' : '' ?>">
            <a href="<?=$url?>/pages/roteador.php">
            <div class="icon">
                <i class="social_rss"></i>
            </div>
            <span class="link-title">Roteador</span>
            </a>
        </li>
        <?php
        	if ($_SESSION["perm"] == 2) { ?>


        <li class="<?= $fabricante == true ? 'active' : '' ?>">
            <a href="<?=$url?>/pages/fabricante.php">
            <div class="icon">
                <i class="icon_tags_alt"></i>
            </div>
            <span class="link-title">Fabricantes</span>
            </a>
        </li>

    <?php } ?>
        <li class="<?= $usu == true ? 'active' : '' ?>">
            <a href="<?=$url?>/pages/usuario.php">
            <div class="icon">
                <i class="ti-user"></i>
            </div>
            <span class="link-title">Usuários</span>
            </a>
        </li>
        <li class="<?= $tecnico == true ? 'active' : '' ?>">
            <a href="<?=$url?>/pages/tecnico.php">
            <div class="icon">
                <i class="ti-desktop"></i>
            </div>
            <span class="link-title">Técnicos</span>
            </a>
        </li>
        <li class="<?= $historico == true ? 'active' : '' ?>">
            <a href="<?=$url?>/pages/historico.php">
            <div class="icon">
                <i class="ti-list"></i>
            </div>
            <span class="link-title">Histórico</span>
            </a>
        </li>
    </ul>
    <!-- End Nav -->
</div>
<!-- End Sidebar Body -->
</nav>
<!-- End Sidebar -->
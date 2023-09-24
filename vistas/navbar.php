<!-- Navbar Start -->
<?php

$nombrePersona = isset($_SESSION['nombrePersona']) ? $_SESSION['nombrePersona'] : '';


?>
<nav class="navbar navbar-expand sticky-top py-0">
    <a href="#" class="sidebar-toggler flex-shrink-0" style="margin-left: 25px; color: #e77a34">
        <i class="fa fa-bars" style="color: #e77a34"></i>
    </a>
    <div class="navbar-nav align-items-center ms-auto">
        <div class="nav-item dropdown rounded">
            <a href="#" class="nav-link dropdown-toggle" style="margin-right: 10px" data-bs-toggle="dropdown">
                <img class="rounded" src="../img/grupo.png" alt="" style="color: #e77a34; width: 45px; height: 45px; margin-right: 5px">
                <span style="font-size: 16px; color: #e77a34" class="badge d-lg-inline-flex p-0"><?php echo $nombrePersona?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-end bg-light border-1 rounded-0 rounded-bottom m-0">
                <a href="ajustes.php" class="dropdown-item">Ajustes</a>
                <a href="logout.php" class="dropdown-item">Cerrar Sesión</a>
            </div>
        </div>
    </div>
</nav>


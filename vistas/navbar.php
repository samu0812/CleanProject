<!-- Navbar Start -->
<?php

$nombrePersona = isset($_SESSION['nombrePersona']) ? $_SESSION['nombrePersona'] : '';


?>
<nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
    <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
        <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
    </a>
    <a href="#" class="sidebar-toggler flex-shrink-0">
        <i class="fa fa-bars" style="color: #e77a34"></i>
    </a>
    <div class="navbar-nav align-items-center ms-auto">
        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <img class="rounded-circle me-lg-2" src="../img/user.png" alt="" style="width: 40px; height: 40px;">
                <span class="d-none d-lg-inline-flex"></span>
                <span class="d-none d-lg-inline-flex"><?php echo $nombrePersona?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                <a href="ajustes.php" class="dropdown-item">Ajustes</a>
                <a href="logout.php" class="dropdown-item">Cerrar Sesión</a>
            </div>
        </div>
    </div>
</nav>
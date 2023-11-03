<!-- Sidebar Start -->
<?php
    $idRol = isset($_SESSION['idRol']) ? $_SESSION['idRol'] : '';
?>
<div class="sidebar pe-2 pb-3">
    <nav class="navbar bg-light navbar-light">
        <a href="home.php" class="navbar-brand mx-4 mb-4 mt-1">
            <img class="" src="../img/logo2.png" alt="">
        </a>

        <div class="navbar-nav w-100 mt-2">
        <a href="home.php" class="nav-item nav-link active mb-2"><i class="fa fa-home me-2"></i>Home</a>
            <a href="productos.php" class="nav-item nav-link active mb-2"><i class="fas fa-warehouse me-2"></i>Productos</a>
            <a href="proveedores.php" class="nav-item nav-link active mb-2"><i class="fa fa-truck me-2"></i>Proveedores</a>
            <a href="pedidos.php" class="nav-item nav-link active mb-2"><i class="fab fa-elementor me-2"></i>Pedidos</a>
            <a href="visualizarPedido.php" class="nav-item nav-link active mb-2"><i class="fab fa-elementor me-2"></i>Mis pedidos</a>
            <a href="ventas.php" class="nav-item nav-link active mb-2"><i class="fa fa-shopping-bag me-2"></i>Ventas</a>
            <a href="reportes.php" class="nav-item nav-link active mb-2"><i class="fas fa-paste me-2"></i>Reportes</a>
            <?php
                if ((int)$idRol === 1) {
                    echo '<a href="usuarios.php" class="nav-item nav-link active mb-2"><i class="fa fa-users me-2"></i>Admin Usuarios</a>';
                }
            ?>
        </div>
    </nav>
</div>

<!-- Sidebar Start -->
<?php

$nombrePersona = isset($_SESSION['nombrePersona']) ? $_SESSION['nombrePersona'] : '';
$rol = isset($_SESSION['rol']) ? $_SESSION['rol'] : '';
?>

<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-light navbar-light">
        <a href="home.php" class="navbar-brand mx-4 mb-3">
            <h3 style="color: #e77a34"><i class="fa fa-hashtag me-2"></i>Clean</h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <i class="fa fa-street-view fa-3x" style="color: #e77a34"></i>
                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                </div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0"><?php echo $nombrePersona?></h6>
                <span><?php echo $rol?></span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="home.php" class="nav-item nav-link active mb-1"><i class="fa fa-home me-2"></i>Home</a>
            <a href="productos.php" class="nav-item nav-link active mb-1"><i class="fas fa-warehouse me-2"></i>Productos</a>
            <a href="proveedores.php" class="nav-item nav-link active mb-1"><i class="fa fa-truck me-2"></i>Proveedores</a>
            <a href="usuarios.php" class="nav-item nav-link active mb-1"><i class="fa fa-users me-2"></i>Pedidos</a>
            <a href="ventas.php" class="nav-item nav-link active mb-1"><i class="fa fa-shopping-bag me-2"></i>Ventas</a>
            <a href="facturacion.php" class="nav-item nav-link active mb-1"><i class="fab fa-elementor me-2"></i>Facturación</a>
            <a href="reportes.php" class="nav-item nav-link active mb-1"><i class="fas fa-paste me-2"></i>Reportes</a>
            <a href="usuarios.php" class="nav-item nav-link active mb-1"><i class="fa fa-users me-2"></i>Admin Usuarios</a>

        </div>
        
    </nav>
</div>
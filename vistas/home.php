
<?php 
session_start();
$nombrePersona = isset($_SESSION['nombrePersona']) ? $_SESSION['nombrePersona'] : '';
$rol = isset($_SESSION['rol']) ? $_SESSION['rol'] : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Clean</title>
    <link rel="shortcut icon" href="../img/logoCleanIco.ico"> 
    
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Template Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border" style="color: #e77a34" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <?php
        include "sidebar.php";
        ?>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <?php
            include "navbar.php";
            ?>
            <!-- Navbar End -->


            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                        <div class="bg-personalizado rounded d-flex align-items-center justify-content-between p-4 cursorPointer" onclick="redireccionar('productos.php')">
                            <i class="fa fa-chart-line fa-3x" style="color: #e77a34"></i>
                            <div class="ms-3">
                                <p class="mb-2">Productos</p>
                                <h6 class="mb-0">200</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                        <div class="bg-personalizado rounded d-flex align-items-center justify-content-between p-4 cursorPointer" onclick="redireccionar('proveedores.php')">
                            <i class="fa fa-chart-bar fa-3x" style="color: #e77a34"></i>
                            <div class="ms-3">
                                <p class="mb-2">Proveedores</p>
                                <h6 class="mb-0">5</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                        <div class="bg-personalizado rounded d-flex align-items-center justify-content-between p-4 cursorPointer" onclick="redireccionar('ventas.php')">
                            <i class="fa fa-chart-area fa-3x" style="color: #e77a34"></i>
                            <div class="ms-3">
                                <p class="mb-2">Ventas en el Mes</p>
                                <h6 class="mb-0">543</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                        <div class="bg-personalizado rounded d-flex align-items-center justify-content-between p-4 cursorPointer" onclick="redireccionar('usuarios.php')">
                            <i class="fa fa-chart-pie fa-3x" style="color: #e77a34"></i>
                            <div class="ms-3">
                                <p class="mb-2">Empleados Act.</p>
                                <h6 class="mb-0">6</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sale & Revenue End -->


            <!-- Sales Chart Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-personalizado text-center rounded p-4 cursorPointer2">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0 m-auto">Productos Más Vendidos</h6>
                            </div>
                            <canvas id="prodMasVendidos"></canvas>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-personalizado text-center rounded p-4 cursorPointer2">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0 m-auto">Total Recaudado por Meses</h6>
                            </div>
                            <canvas id="ganancias"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sales Chart End -->


            <!-- Footer Start -->
            <?php
            include "footer.php";
            ?>
            <!-- Footer End -->
        </div>
        <!-- Content End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-warning btn-lg-square back-to-top" style="background-color: #e77a34"><i class="bi bi-arrow-up"></i></a>
    </div>

    <script>
        function redireccionar(url) {
            window.location.href = url;
        }
    </script>

    <script>
        var ctx = document.getElementById('prodMasVendidos').getContext('2d');
        
        var productosData = {
            labels: ["Lavandina", "Jabon", "Cloro", "Shampoo", "Acondicionador", "Poet", "Escoba", "Escurridor", "Trapo de Piso", "Trapo para el auto"],
            datasets: [{
                data: [50, 45, 35, 30, 25, 20, 18, 15, 12, 10],
                backgroundColor: [
                    '#e77a34',
                    '#c65b16',
                    '#ff8c00',
                    '#8e3000',
                    '#ff8c00',
                    '#c65b16',
                    '#ff8c00',
                    '#c65b16',
                    '#ff8c00',
                    '#c65b16',
                ],
                borderWidth: 0
            }]
        };

        new Chart(ctx, {
            type: 'bar',
            data: productosData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false // Oculta la leyenda
                    }
                }
            }
        });
    </script>

    <script>
        var ctx = document.getElementById('ganancias').getContext('2d');
        
        var gananciasPorMesData = {
            labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo"],
            datasets: [{
                label: 'Ganancias por Mes',
                data: [500, 600, 900, 1100, 1600],
                backgroundColor: 'rgba(231, 122, 52, 0.5)',
                borderColor: '#e77a34',
                borderWidth: 2,
                fill: true
            }]
        };

        new Chart(ctx, {
            type: 'line',
            data: gananciasPorMesData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false // Oculta la leyenda
                    }
                }
            }
        });
    </script>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/chart/chart.min.js"></script>
    <script src="../lib/easing/easing.min.js"></script>
    <script src="../lib/waypoints/waypoints.min.js"></script>
    <script src="../lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="../lib/tempusdominus/js/moment.min.js"></script>
    <script src="../lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="../lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="../js/main.js"></script>
</body>

</html>
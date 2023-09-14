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
                        <div class="bg-personalizado rounded d-flex align-items-center justify-content-center p-4 cursorPointer" onclick="redireccionar('productos.php')">
                            <i class="fas fa-boxes fa-3x" style="color: #e77a34"></i>
                            <div class="text-center" style="margin-left: 30px">
                                <p class="mb-2">Productos</p>
                                <?php
                                include '../bd/conexion.php';
                                $query = "SELECT COUNT(idProductos) AS cantidad_de_productos
                                FROM productos;";
                                $result = $conn->query($query);
                                
                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                    $count = $row["cantidad_de_productos"];
                                    echo "<h6 class='mb-0'>$count</h6>";
                                } else {
                                    echo "0";
                                }
                                
                                
                                
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                        <div class="bg-personalizado rounded d-flex align-items-center justify-content-center p-4 cursorPointer" onclick="redireccionar('proveedores.php')">
                            <i class="fas fa-truck-loading fa-3x" style="color: #e77a34"></i>
                            <div class="text-center" style="margin-left: 30px">
                                <p class="mb-2">Proveedores</p>
                                <?php
                                include '../bd/conexion.php';
                                $query = "SELECT COUNT(idProveedores) AS cantidad_de_proveedores
                                FROM proveedores;";
                                $result = $conn->query($query);
                                
                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                    $count = $row["cantidad_de_proveedores"];
                                    echo "<h6 class='mb-0'>$count</h6>";
                                } else {
                                    echo "0";
                                }
                                
                                
                                
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                        <div class="bg-personalizado rounded d-flex align-items-center justify-content-center p-4 cursorPointer" onclick="redireccionar('ventas.php')">
                            <i class="fa fa-chart-area fa-3x" style="color: #e77a34"></i>
                            <div class="text-center" style="margin-left: 30px">
                                <p class="mb-2">Ventas</p>
                                <!-- <h6 class="mb-0">543</h6> -->
                                <?php
                                include '../bd/conexion.php';
                                $query = "SELECT COUNT(*) AS CantidadVentas FROM Ventas;";
                                $result = $conn->query($query);
                                
                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                    $count = $row["CantidadVentas"];
                                    echo "<h6 class='mb-0'>$count</h6>";
                                } else {
                                    echo "0";
                                }
                                   
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                        <div class="bg-personalizado rounded d-flex align-items-center justify-content-center p-4 cursorPointer" onclick="redireccionar('usuarios.php')">
                            <i class="fas fa-people-carry fa-2x" style="color: #e77a34"></i>
                            <div class="text-center" style="margin-left: 30px">
                                <p class="mb-2">Empleados Act.</p>
                                <?php
                                include '../bd/conexion.php';
                                $query = "SELECT COUNT(*) AS count FROM Empleado";
                                $result = $conn->query($query);
                                
                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                    $count = $row["count"];
                                    echo "<h6 class='mb-0'>$count</h6>";
                                } else {
                                    echo "0";
                                }
                                   
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sale & Revenue End -->


            <!-- Sales Chart Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="grafico-container">
                        <!-- Contenedor del primer gráfico -->
                        <div class="bg-personalizado text-center rounded p-4 cursorPointer2 chart-container">
                            <div class="d-flex flex-column align-items-center justify-content-center chart-content">
                                <h6 class="mb-0">Productos Más Vendidos</h6>
                                <canvas id="prodMasVendidos" class="chart-canvas"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="grafico-container">
                        <!-- Contenedor del segundo gráfico -->
                        <div class="bg-personalizado text-center rounded p-4 cursorPointer2 chart-container">
                            <div class="d-flex flex-column align-items-center justify-content-center chart-content">
                                <h6 class="mb-0">Total Recaudado por Meses</h6>
                                <canvas id="ganancias" class="chart-canvas"></canvas>
                            </div>
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
        <a href="#" class="btn btn-lg btn-lg-square back-to-top" style="background: #e77a34; color: white"><i class="bi bi-arrow-up"></i></a>
    </div>

    <style>
    .chart-container {
        max-width: 1000px; /* Cambia el ancho máximo del contenedor */
        margin: 0 auto; /* Centra el contenedor horizontalmente */
        padding: 10px; /* Añade espaciado interno al contenedor */
        text-align: center; /* Centra el contenido horizontalmente */
        display: flex; /* Usa flexbox para centrar verticalmente */
        justify-content: center; /* Centra el contenido verticalmente */
        align-items: center; /* Centra el contenido verticalmente */
    }

    .chart-content {
        flex: 1; /* Hace que el contenido se expanda verticalmente para centrarse */
    }

    .chart-canvas {
        width: 100%; /* Ocupará todo el ancho del contenedor */
        height: auto; /* Se ajustará automáticamente para mantener la relación de aspecto */
    }

    .grafico-container {
        width: 90%; /* Ajusta el ancho como desees, puedes usar un valor en porcentaje o en píxeles */
        height: auto;
        margin: 0 auto; /* Centra el contenedor horizontalmente */
        padding: 20px; /* Agrega espaciado interno si es necesario */
    }
    .chart-canvas {
        margin-top: 10px; /* Ajusta la cantidad de espacio hacia arriba que desees */
        padding-bottom: 30px; /* Añade espacio en la parte inferior */
    }
    </style>

    <script>
        function redireccionar(url) {
            window.location.href = url;
        }
    </script>

    <script>
        function obtenerProductosMasVendidos() {
            
            fetch('../controladores/funcionesHome.php?action=obtenerProductosMasVendidos') 
            .then(response => {
                console.log(response);
                if (!response.ok) {
                    throw new Error("Error en la solicitud al servidor");
                }
                return response.json();
            })
            .then(data => {
                var graficoProdsMasVendidos = document.getElementById('prodMasVendidos').getContext('2d');
                graficoProdsMasVendidos.canvas.width = 450; // Modifica el ancho del segundo gráfico
                graficoProdsMasVendidos.canvas.height = 200; // Modifica la altura del segundo gráfico
                let nombresProductos = data.map(item => item.NombreProducto);
                let cantidadesVendidas = data.map(item => item.CantidadVendida);


                // Función para abreviar un nombre
                function abreviarNombre(nombre) {
                    if (nombre.length > 20) {
                        return nombre.substring(0, 19) + '..';
                    }
                    return nombre;
                }

                let nombresAbreviados = nombresProductos.map(abreviarNombre);

                const productosMasVendidosData = {
                    labels: nombresAbreviados,
                    datasets: [{
                        data: cantidadesVendidas,
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
                        borderWidth: 0,
                        barThickness: 30 // Ajusta el grosor de las barras
                    }]
                };

                const chart = new Chart(graficoProdsMasVendidos, {
                    type: 'bar',
                    data: productosMasVendidosData,
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                            },
                            x: {
                                ticks: {
                                    font: {
                                        size: 10,
                                    },
                                    maxRotation: 45, // Cambia el ángulo de rotación
                                    minRotation: 25, // Cambia el ángulo de rotación
                                },
                            },
                        },
                        plugins: {
                            legend: {
                                display: false,
                            },
                            tooltip: {
                                callbacks: {
                                    label: function (context) {
                                        // Muestra el nombre completo del producto en el tooltip
                                        return nombresProductos[context.dataIndex];
                                    },
                                },
                            },
                        },
                    },
                });


            })
            .catch(error => {
                console.error("Ocurrió un error:", error);
            });
        }

        document.addEventListener('DOMContentLoaded', obtenerProductosMasVendidos);

        
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


    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-tooltip/1.2.0/plugin.tooltip.min.js"></script>


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
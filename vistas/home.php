<?php 
session_start();

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



            <div class="container-fluid pt-4 px-4">
                <div class="row g-4 justify-content-center align-items-stretch">
                    <!-- Contenedor superior de los gráficos -->
                    <div class="col-md-6">
                        <div class="grafico-container">
                            <!-- Contenedor del primer gráfico -->
                            <div class="bg-personalizado text-center rounded p-4 cursorPointer2 chart-container">
                                <div class="d-flex flex-column align-items-center justify-content-center chart-content">
                                    <h6 class="mb-0">Productos Más Vendidos</h6>
                                    <canvas id="prodMasVendidos" class="chart-canvas"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
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
                    <!-- Contenedor inferior de los gráficos -->
                    <div class="col-md-6">
                        <div class="grafico-containerTorta torta-container">
                            <div class="grafico-containerTorta d-flex flex-column">
                                <!-- Contenedor del tercer gráfico -->
                                <div class="bg-personalizado text-center rounded p-4 cursorPointer2 chart-container flex-grow-1">
                                    <div class="d-flex flex-column align-items-center justify-content-center chart-content">
                                        <h6 class="mb-0">Total recaudado por sucursal</h6>
                                        <canvas id="totalRecaudadoPorSucursal" class="chart-canvasTorta"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="grafico-containerTorta torta-container">
                            <div class="grafico-containerTorta d-flex flex-column">
                                <!-- Contenedor del cuarto gráfico -->
                                <div class="bg-personalizado text-center rounded p-4 cursorPointer2 chart-container flex-grow-1">
                                    <div class="d-flex flex-column align-items-center justify-content-center chart-content">
                                        <h6 class="mb-0" id="tituloGraficoGananciasAnualPorSucursal">Total recaudado por sucursal por año</h6>
                                        <canvas id="totalRecaudadoPorSucursalAnual" class="chart-canvasTorta"></canvas>
                                    </div>
                                </div>
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

    /* Estilos para los contenedores de gráficos torta */
    .grafico-containerTorta {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        /* Ajusta el alto de acuerdo a tus preferencias */
        height: 100%; /* Puedes cambiar el valor al que desees, como 40% o 60%, según tus necesidades */
        width: 100%; /* Establece un ancho del 50% para ambos elementos */
    }

    /* Ajusta el ancho de acuerdo a tus preferencias */
    .grafico-containerTorta .chart-container {
        width: 100%; /* O el ancho deseado en porcentaje o píxeles */
        max-width: 380px;
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
                graficoProdsMasVendidos.canvas.width = 400; // Modifica el ancho del segundo gráfico
                graficoProdsMasVendidos.canvas.height = 230; // Modifica la altura del segundo gráfico
                let nombresProductos = data.map(item => item.NombreProducto);
                let cantidadesVendidas = data.map(item => item.CantidadVendida);

                console.log(nombresProductos);

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
                            'rgba(250, 114, 28, 0.2)',
                            'rgba(198, 91, 22, 0.2)',
                            'rgba(255, 140, 0, 0.2)',
                            'rgba(218, 119, 0, 0.2)',
                            'rgba(255, 140, 0, 0.2)',
                            'rgba(162, 69, 0, 0.2)',
                            'rgba(198, 91, 22, 0.2)',
                            'rgba(255, 170, 0, 0.2)',
                            'rgba(168, 94, 0, 0.2)',
                            'rgba(255, 140, 0, 0.2)',
                            
                            ],
                        borderColor: [
                            'rgb(250, 114, 28)',
                            'rgb(198, 91, 22)',
                            'rgb(255, 140, 0)',
                            'rgb(218, 119, 0)',
                            'rgb(255, 140, 0)',
                            'rgb(162, 69, 0)',
                            'rgb(198, 91, 22)',
                            'rgb(255, 170, 0)',
                            'rgb(168, 94, 0)',
                            'rgb(255, 140, 0)',
                            ],
                        borderWidth: 1,
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
                                        // // Muestra el nombre completo del producto en el tooltip
                                        // return nombresProductos[context.dataIndex];
                                        let label = nombresProductos[context.dataIndex];
                                        let cantidad = cantidadesVendidas[context.dataIndex];
                                        return label + ': ' + cantidad + ' unidades vendidas';
                                    },
                                    title: function (context) {
                                        return ''; // Esto hace que el título esté vacío
                                    },
                                },
                            },
                        },
                    },
                });


            })
            .catch(error => {
                console.error("Ocurrió un error:", error);
                console.log("errorr");
            });
        }


        function ObtenerGananciasPorMeses() {
            fetch('../controladores/funcionesHome.php?action=ObtenerGananciasPorMeses') 
            .then(response => {
                if (!response.ok) {
                    throw new Error("Error en la solicitud al servidor");
                }
                return response.json();
            })
            .then(data => {
                var gananciasPorMeses = document.getElementById('ganancias').getContext('2d');
                gananciasPorMeses.canvas.width = 400; // Modifica el ancho del segundo gráfico
                gananciasPorMeses.canvas.height = 230; // Modifica la altura del segundo gráfico
            // Procesa los datos recibidos y organízalos en el formato adecuado
            const mesesData = data.map(item => ({ mes: item.MesNombre, ganancia: parseFloat(item.TotalRecaudado) }));
                        
            // Ordena los datos por mes en orden ascendente
            mesesData.sort((a, b) => {
                const meses = [
                    'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                ];
                return meses.indexOf(a.mes) - meses.indexOf(b.mes);
            });

            const meses = mesesData.map(item => item.mes);
            const ganancias = mesesData.map(item => item.ganancia);

        
            var gananciasPorMesData = {
                labels: meses,
                datasets: [{
                    label: 'Ganancias por Mes',
                    data: ganancias,
                    backgroundColor: 'rgba(231, 122, 52, 0.5)',
                    borderColor: '#e77a34',
                    borderWidth: 2,
                    fill: true,
                    lineTension: 0.3,
                    pointRadius: 2,
                    pointHoverRadius: 10,
                    pointHitRadius: 30,
                }]
            };

            new Chart(gananciasPorMeses, {
                type: 'line',
                data: gananciasPorMesData,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            // Configura el prefijo "$" para el eje Y
                            callback: function (value, index, values) {
                                return '$' + value;
                            }
                        },
                        x: {
                            ticks: {
                                font: {
                                    size: 12, // Ajusta el tamaño de fuente para las etiquetas del eje X
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            labels: {
                                boxWidth: 20,
                                fontColor: 'orange'
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    // Agrega el signo de "$" al valor de ganancia en el tooltip
                                    let label = context.dataset.label || '';
                                    let value = context.parsed.y || 0;
                                    return label + ': $' + value.toFixed(2);
                                },
                            },
                        },
                    },
                }
            });




            })
            .catch(error => {
                console.error("Ocurrió un error:", error);
            });
        }

        function totalRecaudadoPorSucursal() {
            // Obtener el mes actual en formato de texto
            const fechaActual = new Date();
            const mesActual = fechaActual.toLocaleString('es-ES', { month: 'long' });

            // Actualizar el título del gráfico con el mes actual
            document.querySelector(".grafico-containerTorta h6").textContent = `Total recaudado por sucursal en ${mesActual}`;

            fetch('../controladores/funcionesHome.php?action=totalRecaudadoPorSucursal')
            .then(response => {
                if (!response.ok) {
                    throw new Error('La solicitud no fue exitosa');
                }
                return response.json();
            })
            .then(datos => {
                // Procesar los datos recibidos del servidor y actualizar el gráfico
                actualizarGraficoTortaPorMes(datos);
                
            })
            .catch(error => {
                console.error('Error al obtener los datos:', error);
            });


        }

        function actualizarGraficoTortaPorMes(datos) {
            var graficoGananciasPorSucursal = document.getElementById("totalRecaudadoPorSucursal").getContext("2d");

            let total = 0;
            // Recorre los datos y suma los valores de TotalRecaudado
            datos.forEach(dato => {
                if (!isNaN(dato.TotalRecaudado)) {
                    total += parseFloat(dato.TotalRecaudado);
                }
            });

            // Verifica si hay datos de ventas
            if (total === 0) {
                // Si el total es igual a cero, significa que no hay ventas.
                document.querySelector(".grafico-containerTorta").textContent = "No se han realizado ventas en el mes actual";
                return; // Sal del proceso
            }

            // Calcula los porcentajes y crea etiquetas personalizadas con el total y el porcentaje
            var etiquetas = datos.map(dato => {
                var totalRecaudado = parseFloat(dato.TotalRecaudado); // Convierte a float
                if (!isNaN(totalRecaudado)) {
                    var porcentaje = ((totalRecaudado / total) * 100).toFixed(2); // Limita el porcentaje a 2 decimales
                    return `${dato.Sucursal}: (${porcentaje}%)`;
                } else {
                    return `${dato.Sucursal}: $0.00 (0.00%)`; // Maneja el caso en que no haya un valor válido
                }
            });

            var miGrafico = new Chart(graficoGananciasPorSucursal, {
                type: "pie",
                data: {
                    labels: etiquetas,
                    datasets: [{
                        data: datos.map(dato => parseFloat(dato.TotalRecaudado)),
                        backgroundColor: [
                            'rgba(255, 81, 0, 0.5)',
                            'rgba(214, 139, 0, 0.5)',
                            'rgba(255, 209, 0, 0.5)'
                        ],
                        hoverOffset: 4
                    }]
                }
            });

            // Actualiza el gráfico existente con los nuevos datos
            miGrafico.update();
        }


        function totalRecaudadoPorSucursalAnual() {
            // Obtener el año actual
            const fechaActual = new Date();
            const añoActual = fechaActual.getFullYear();

            // Actualizar el título del gráfico con el año actual por su ID
            document.querySelector("#tituloGraficoGananciasAnualPorSucursal").textContent = `Total recaudado por sucursal en ${añoActual}`;

            fetch('../controladores/funcionesHome.php?action=actualizarGraficoTortaAnual')
            .then(response => {
                if (!response.ok) {
                    throw new Error('La solicitud no fue exitosa');
                }
                return response.json();
            })
            .then(datos => {
                // Procesar los datos recibidos del servidor y actualizar el gráfico
                actualizarGraficoTortaAnual(datos)
            })
            .catch(error => {
                console.error('Error al obtener los datos:', error);
            });


        }


        function actualizarGraficoTortaAnual(datos) {

            let total = 0;
            // Recorre los datos y suma los valores de TotalRecaudado
            datos.forEach(dato => {
                if (!isNaN(dato.TotalRecaudado)) {
                    total += parseFloat(dato.TotalRecaudado);
                }
            });


            // Calcula los porcentajes y crea etiquetas personalizadas con el total y el porcentaje
            var etiquetas = datos.map(dato => {
                var totalRecaudado = parseFloat(dato.TotalRecaudado); // Convierte a float
                if (!isNaN(totalRecaudado)) {
                    var porcentaje = ((totalRecaudado / total) * 100).toFixed(2); // Limita el porcentaje a 2 decimales
                    return `${dato.Sucursal}: (${porcentaje}%)`;
                } else {
                    return `${dato.Sucursal}: $0.00 (0.00%)`; // Maneja el caso en que no haya un valor válido
                }
            });

            var totalRecaudadoPorSucursalAnual = document.getElementById("totalRecaudadoPorSucursalAnual").getContext("2d");

            var miGrafico = new Chart(totalRecaudadoPorSucursalAnual, {
                type: "pie",
                data: {
                    labels: etiquetas,
                    datasets: [{
                        data: datos.map(dato => parseFloat(dato.TotalRecaudado)),
                        backgroundColor: [
                            'rgba(255, 81, 0, 0.5)',
                            'rgba(214, 139, 0, 0.5)',
                            'rgba(255, 209, 0, 0.5)'
                        ],
                        hoverOffset: 4
                    }]
                }
                
            });

            // Actualiza el gráfico existente con los nuevos datos
            miGrafico.update();
        }

        document.addEventListener('DOMContentLoaded', function() {
            obtenerProductosMasVendidos();
            ObtenerGananciasPorMeses();
            totalRecaudadoPorSucursal();
            totalRecaudadoPorSucursalAnual();
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
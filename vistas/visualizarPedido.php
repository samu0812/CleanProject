<?php
session_Start();
include ('../bd/conexion.php');
$idPersona = $_SESSION['idPersona'];
$idEmpleado= $_SESSION['idEmpleado'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Clean</title>
    
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

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

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="..\css\style.css" rel="stylesheet">

    <!-- Incluir jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>

    <!-- Incluir Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">

    <!-- Incluir DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <!-- Incluir tus estilos personalizados -->
    <link href="../css/style.css" rel="stylesheet">

    <!-- Incluir Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.min.js"></script>

    <!-- Incluir DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
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
            include 'navbar.php';
            ?>
            <!-- Navbar End -->


            <!-- Sale & Revenue Start -->

            <div class="container-fluid pt-4 px-4">
                <div class="bg-personalizado text-center rounded p-4">
                    <div class="d-flex justify-content-center align-items-center mb-3">
                        <h5 class="mb-0">Pedidos</h5>
                    </div>
                    <div class="d-flex justify-content-center align-items-center text-center">
                        <select id="filtroSucursal" class="form-select form-select-sm" style="width: 150px;">
                            <option value="">Sucursales</option>
                            <option value="Kirchner">Nestor Kirchner</option>
                            <option value="Centro">Eva Peron</option>
                        </select>
                    </div>
                    <div class="table-responsive -xxl position-relative">
                        <table id="tablePedido" class="table display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Nombre</th>
                                    <th>Tipo</th>
                                    <th>Tamaño</th>
                                    <th>Medida</th>
                                    <th>Cantidad</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $fechaActual= date('Y-m-d');
                                    $query = "SELECT codigoProducto,nombreProducto,tipoProducto,tamaño,medida,cantidad FROM PedidosSucursales WHERE fecha = '$fechaActual'";
                                    $result = mysqli_query($conn, $query);
                                    
                                    // Verifica si se obtuvieron resultados
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row["codigoProducto"] . "</td>";
                                        echo "<td>" . $row["nombreProducto"] . "</td>";
                                        echo "<td>" . $row["tipoProducto"] . "</td>";
                                        echo "<td>" . $row["tamaño"] . "</td>";
                                        echo "<td>" . $row["medida"] . "</td>";
                                        echo "<td>" . $row["cantidad"] . "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='7'>No se encontraron productos.</td></tr>";
                            }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Inicializar la tabla DataTable
            var tableSucursal = $('#tablePedido').DataTable({
                select: {
                    style: 'single'
                },
                searching: true,
                lengthChange: true,
                ordering: false ,
                info: false,
                language: {
                    search: "",
                    searchPlaceholder: "Filtrar Productos",
                    lengthMenu: "Mostrar _MENU_ registros",
                    zeroRecords: "No se encontraron resultados",
                    info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
                    infoEmpty: "Mostrando 0 a 0 de 0 registros",
                    infoFiltered: "(filtrado de _MAX_ registros en total)"
                }
            });

            // Capturar el evento de cambio del select y aplicar el filtro a la tabla
            $("#filtroSucursal").on("change", function() {
                var filtro = $(this).val();
                tablePedido.column(2).search(filtro).draw();
            });
        });



    </script>
    <style>
      /* Estilo CSS para la clase personalizada de la alerta */
      .custom-popup-class {
        width: 300px; /* Ajusta el ancho de la alerta según tus necesidades */
        height:135px;
        font-size: 15px; /* Ajusta el tamaño de fuente del contenido de la alerta */
        padding: 2px 3px; /* Ajusta el relleno de la alerta para hacerla un poco más pequeña */
        border-radius: 10px; /* Añade bordes redondeados a la alerta */
        }

        /* Estilo CSS para la clase personalizada del título */
    .custom-title-class {
        font-size: 17px; /* Ajusta el tamaño de fuente del título de la alerta */
        padding: 6px 3px; 
        }


    /* Estilo CSS para la clase personalizada del icono */
    .custom-icon-class {
        font-size: 10px; /* Ajusta el tamaño del icono según tus necesidades */
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 6px;
        text-align: left;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    th {
        background-color: #e77a34;
        color: white;
    }

        /* Estilo para mover el lengthChange a la izquierda */
        div.dataTables_wrapper .dataTables_length {
            text-align: left;
            margin-right: auto;
            margin-left: 0;
        }

        .page-item.active .page-link {
            z-index: 3;
            color: #fff;
            background-color: #e77a34;
            border-color: #e77a34;
        }


        /* Estilo para mover el searching a la derecha */
        div.dataTables_wrapper .dataTables_filter {
            text-align: right;
            margin-left: auto;
            margin-right: 0;
        }

        div.dataTables_wrapper .dataTables_length label {
        display: inline-block;
        margin-right: 20px; /* Espacio entre los elementos */
        }

        div.dataTables_wrapper .dataTables_length select {
            display: inline-block;
            width: auto;
        }

        /* Estilo para hacer más pequeños algunos inputs */
        #porcentajeAumento,
        #precioBase,
        #precioVenta {
            width: 70%; /* Ajusta el valor según tus preferencias */
            margin: auto;
        }

        /* Estilo para el cuerpo del modal */
        .modal-body {
            padding: 10px; /* Ajusta el valor según tus preferencias */
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;;
        }

        /* Estilo para el botón Guardar */
        .modal-footer .btn-primary {
            background-color: #007bff; /* Cambia el color de fondo */
            border-color: #007bff; /* Cambia el color del borde */
        }

        .modal-footer .btn-primary:hover {
            background-color: #5a104c; /* Cambia el color de fondo en el hover */
            border-color: #0056b3; /* Cambia el color del borde en el hover */
        }

    </style>

    <!-- Template Javascript -->
    <script src="../js/main.js"></script>

</body>    
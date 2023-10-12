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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/vfs_fonts.js"></script>

    <!-- Incluir Waypoints -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>

    <!-- Incluir tu archivo main.js después de cargar jQuery y Waypoints -->
    <script src="ruta-a-tu-main.js"></script>



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
            <button id="btnAbrirModal" class="btn btn-primary">Cambiar Estado</button>
            <button id="btnGenerarPDF" type="button" class="btn btn-danger">Comprobante</button>
                <div class="bg-personalizado text-center rounded p-4">
                    <div class="d-flex justify-content-center align-items-center mb-3">
                        <h5 class="mb-0">Pedidos</h5>
                    </div>
                    <div class="d-flex justify-content-center align-items-center text-center">
                        <select id="filtroSucursal" class="form-select form-select-sm" style="width: 150px;">
                            <option value="">Sucursales</option>
                            <option value="Nestor Kirchner">Nestor Kirchner</option>
                            <option value="Eva Peron">Eva Peron</option>
                        </select>
                       
                    </div>
                    <div class="table-responsive -xxl position-relative">
                        <table id="tablePedido" class="table display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>idPedido</th>
                                    <th>fecha</th>
                                    <th>Nombre Producto</th>
                                    <th>Tamaño</th>
                                    <th>Medida</th>
                                    <th>Cantidad</th>
                                    <th>Estado</th>
                                    <th>Descripcion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $query = "SELECT
                                    idPedidosSucursales,
                                    fecha,
                                    nombreProducto,
                                    tamaño,
                                    medida,
                                    cantidad,
                                    estado,
                                    sucursales.Descripcion
                                    FROM pedidosSucursales join sucursales on sucursales.idSucursales= pedidosSucursales.idSucursales
                                    WHERE pedidosSucursales.estado = 'En aprobacion' or pedidosSucursales.estado = 'aprobado' or pedidosSucursales.estado = 'despachado' and DATE(fecha) = CURDATE() ;";
                                    $result = $conn->query($query);
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<tr>';
                                        echo '<td>' . $row['idPedidosSucursales'] . '</td>';
                                        echo '<td>' . $row['fecha'] . '</td>';
                                        echo '<td>' . $row['nombreProducto'] . '</td>';
                                        echo '<td>' . $row['tamaño'] . '</td>';
                                        echo '<td>' . $row['medida'] . '</td>';
                                        echo '<td>' . $row['cantidad'] . '</td>';
                                        echo '<td>' . $row['estado'] . '</td>';
                                        echo '<td>' . $row['Descripcion'] . '</td>';
                                        echo '</tr>';
                                    }
                                    ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="cambiarEstadoModal" tabindex="-1" role="dialog" aria-labelledby="cambiarEstadoModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="cambiarEstadoModalLabel">Pedido Sucursal</h5>
                        </div>
                        <div class="modal-body">
                            <!-- Agrega un formulario dentro del modal -->
                            <form id="cambiarEstadoForm">
                                <div class="form-group">
                                    <label for="sucursalSelect">Pedido Sucursal:</label>
                                    <select class="form-control" id="sucursalSelect">
                                        <option value="Eva Peron">Eva Peron</option>
                                        <option value="Nestor Kirchner">Nestor Kirchner</option>
                                        <!-- Agrega más opciones si es necesario -->
                                    </select>
                                    
                                </div>
                                <div class="form-group">
                                    <label for="estadoSelect">Estado:</label>
                                    <select class="form-control" id="estadoSelect">
                                        <option value="aprobado">Aprobado</option>
                                        <option value="despachado">Despachado</option>
                                        <!-- Agrega más opciones si es necesario -->
                                    </select>
                                    
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="cerrarModal()">Cerrar</button>
                            <button type="button" class="btn btn-primary" id="btnCambiarEstadoModal" onclick="cambiarEstado()">Aceptar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
        var tablePedido = document.getElementById("tablePedido");
        var btnCambiarEstado = document.getElementById("btnAbrirModal");
        var btnComprobante = document.getElementById("btnGenerarPDF");

        // Verificar si la tabla tiene filas de datos (excluyendo la fila del encabezado)
            if (tablePedido.rows.length <= 1) { // Si la tabla está vacía o solo contiene el encabezado
                btnCambiarEstado.disabled = true;
                btnComprobante.disabled = true;
            }
        });
        $(document).ready(function () {
        var tablePedido = $('#tablePedido').DataTable({
            select: {
                style: 'single'
            },
            searching: true,
            lengthChange: true,
            ordering: false,
            info: false,
            language: {
                search: "",
                searchPlaceholder: "Filtrar Productos",
                lengthMenu: "Mostrar _MENU_ registros",
                zeroRecords: "No tienes pedidos por preparar",
                info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
                infoEmpty: "Mostrando 0 a 0 de 0 registros",
                infoFiltered: "(filtrado de _MAX_ registros en total)"
            }
        });

        // Capturar el evento de cambio del select de sucursal y aplicar el filtro a la tabla
        $("#filtroSucursal").on("change", function () {
            var filtroSucursal = $(this).val();
            tablePedido.column(7).search(filtroSucursal).draw();
        });

        // Capturar el evento de cambio del select de descripción y aplicar el filtro a la tabla
        $("#filtroDescripcion").on("change", function () {
            var filtroDescripcion = $(this).val();
            tablePedido.column(8).search(filtroDescripcion).draw();
        });
    });
        
        function cambiarEstado(){
            const sucursalSeleccionada = sucursalSelect.value;
            const nuevoEstado = estadoSelect.value;

            console.log(sucursalSeleccionada);
            console.log(nuevoEstado);

            const data = {
                sucursal: sucursalSeleccionada,
                nuevoEstado: nuevoEstado
            };

            console.log(data);

            // Convierte el objeto 'data' en una cadena JSON
            const jsonData = JSON.stringify(data);
            console.log(jsonData);

            // Realiza una solicitud fetch para actualizar el estado en la base de datos
            fetch("../controladores/pedidoEncargado.php", {
                method: "POST",
                body: jsonData, // Utiliza la cadena JSON como cuerpo de la solicitud
                headers: {
                    'Content-Type':'application/json' // Especifica el tipo de contenido como JSON
                }
            })
            .then(response => {
                    console.log(response);
                    return response.json();
                }) // Parsea la respuesta JSON
            .then(data => {
                // Cierra el modal
                console.log(data);
                $("#cambiarEstadoModal").modal("hide");

                // Recarga la tabla PedidosSucursales para reflejar los cambios
                $("#tablePedido").DataTable().ajax.reload();
            })
            .catch(error => {
                console.error(response);
            });
            if (fetch()){
                Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Se ha actualizado el estado',
                        showConfirmButton: false,
                        timer: 1500,
                        background: false, // Desactiva el fondo oscurecido
                        backdrop: false,
                        customClass: {
                            container: 'custom-container-class',
                            popup: 'custom-popup-class', // Clase personalizada para ajustar el tamaño de la alerta
                            title: 'custom-title-class', // Clase personalizada para ajustar el tamaño del título
                            icon: 'custom-icon-class',
                        },
                        })
            }
            cerrarModal()
        }
        
    function cerrarModal() {
        $('#cambiarEstadoModal').modal('hide');
    }
    $(document).ready(function() {
        // Manejar el clic en el botón para abrir el modal
        $("#btnAbrirModal").click(function() {
            $("#cambiarEstadoModal").modal("show"); // Mostrar el modal
        });
    })
    document.getElementById('btnGenerarPDF').addEventListener('click', function () {
    // Obtener la referencia a la tabla
    var table = document.getElementById('tablePedido');

    // Obtener el contenido de las celdas de la tabla y los títulos de las columnas
    var tableData = [];
    var tableHeaders = [];
    
    // Obtener los títulos de las columnas desde la primera fila (thead)
    var headerRow = table.rows[0];
    for (var i = 0; i < headerRow.cells.length; i++) {
        tableHeaders.push(headerRow.cells[i].textContent);
    }

    // Recorrer las filas de datos (tbody) y obtener el contenido de las celdas
    for (var i = 1; i < table.rows.length; i++) {
        var rowData = [];
        var row = table.rows[i];
        for (var j = 0; j < row.cells.length; j++) {
            rowData.push(row.cells[j].textContent);
        }
        tableData.push(rowData);
    }

    // Definir la estructura del documento PDF
    var docDefinition = {
        content: [
            { text: 'Tabla de Pedidos', style: 'header' },
            {
                table: {
                    headerRows: 1,
                    widths: 'auto',
                    body: [tableHeaders].concat(tableData)
                },
                layout: 'lightHorizontalLines'
            }
        ],
        styles: {
            header: {
                fontSize: 18,
                bold: true,
                alignment: 'center',
                margin: [0, 10]
            }
        }
    };

    // Genera el PDF
    pdfMake.createPdf(docDefinition).open();
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
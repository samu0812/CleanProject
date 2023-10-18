<?php 
include ('../bd/conexion.php');
include ('../controladores/pedidoStock.php');

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
                    <div class="table-responsive -xxl">
                    <table id="tableProd" class="table display" style="width:100%">
                        <h5>Busqueda de Productos</h5>
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Tipo</th>
                                <th>Tamaño</th>
                                <th>Medida</th>
                                <th>
                                    <button id="btnAgregarTableProd" style="background: #e77a34; color: white;" class="btn btn-sm" disabled><i class="fas fa-plus"></i></button>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $sql = "SELECT
                            p.idProductos AS idProducto,
                            p.Nombre AS NombreProducto,
                            p.Tamaño AS Tamaño,
                            tt.Abreviatura AS AbreviaturaTipoTamaño,
                            tp.Descripcion AS DescripcionTipoProducto,
                            ss.idSucursales  -- Agregamos la columna idSucursales
                        FROM
                            StockSucursales ss
                        JOIN
                            Productos p ON ss.idProductos = p.idProductos
                        JOIN
                            TipoTamaño tt ON p.idTipoTamaño = tt.idTipoTamaño
                        JOIN
                            TipoProducto tp ON p.idTipoProducto = tp.idTipoProducto
                        where 
                            ss.Cantidad >=0 and ss.idSucursales=1;";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["idProducto"] . "</td>";
                                echo "<td>" . $row["NombreProducto"] . "</td>";
                                echo "<td>" . $row["DescripcionTipoProducto"] . "</td>";
                                echo "<td>" . $row["Tamaño"] . "</td>";
                                echo "<td>" . $row["AbreviaturaTipoTamaño"] . "</td>";
                                echo "<td></td>";
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

            <div class="container-fluid pt-4 px-4">
                <div class="bg-personalizado text-center rounded p-4">
                    <div class="d-flex justify-content-center align-items-center mb-3">
                        <h5 class="mb-0">Pedido realizado</h5>
                    </div>
                    <button type="button" style="position:relative;" class="btn btn-warning" onclick="obtenerDatos()">Finalizar Pedido</button>
                    <div class="table-responsive -xxl position-relative">
                        <table id="tableSucursal" class="table display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Nombre</th>
                                    <th>Tipo</th>
                                    <th>Tamaño</th>
                                    <th>Medida</th>
                                    <th>Cantidad</th>
                                    <th>
                                    <button id="btnEditarTableSucu" style="background: #e77a34; color: white;" class="btn btn-sm" onclick="editarPedido()" disabled><i class="far fa-edit"></i></button>
                                    <button id="btnEliminarTableSucu" style="background: #e77a34; color: white;" class="btn btn-sm" disabled><i class="fas fa-trash"></i></button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modalSucursal" tabindex="-1" aria-labelledby="modalSucursal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content" style="text-align: center;">
                        <div class="modal-header">
                            <h5 class="modal-title" id="labelAgregarStock">Agregar Producto</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="codigo" class="form-label">Código</label>
                                        <input type="text" class="form-control" id="codigoSucursal">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="nombre" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="nombreSucursal">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="cantidad" class="form-label">Cantidad</label>
                                        <input type="number" class="form-control" id="cantidadSucursal">
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="tipoProducto" class="form-label">Tipo de Producto</label>
                                        <select class="form-select" id="tipoProductoSucursal">
                                            <option value="" selected disabled>Seleccione un tipo</option>
                                            <option value="Suelto">Suelto</option>
                                            <option value="Envasado">Envasado</option>
                                            <option value="Preparado">Preparado</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="tamaño" class="form-label">Tamaño</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="tamañoSucursal" placeholder="Tamaño">
                                            <input type="text" class="form-control" id="medidaSucursal" placeholder="Medida">
                                            
                                        </div>
                                    </div>
                                    
                                </div>
                                
                            </div>
                        </div>
                        <div class="modal-footer">
                            <!-- Cambio en el botón "Guardar" del modal -->
                            <button id="btnGuardar" onclick="editarTabla()" type="button" class="btn btn-primary" >Editar</button>
                            <!-- Cambio en el botón "Cerrar" del modal -->
                            <button id="btnCerrar" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Agregar Producto-->
            <div class="modal fade" id="modalAgregarProducto" tabindex="-1" aria-labelledby="modalAgregarProducto" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content" style="text-align: center;">
                        <div class="modal-header">
                            <h5 class="modal-title" id="labelAgregarStock">Agregar Producto</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="codigo" class="form-label">Código</label>
                                        <input type="text" class="form-control" id="codigo">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="nombre" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="nombre">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="cantidad" class="form-label">Cantidad</label>
                                        <input type="number" class="form-control" id="cantidad" name= "cantidadPedido">
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="tipoProducto" class="form-label">Tipo de Producto</label>
                                        <select class="form-select" id="tipoProducto">
                                            <option value="" selected disabled>Seleccione un tipo</option>
                                            <option value="Suelto">Suelto</option>
                                            <option value="Envasado">Envasado</option>
                                            <option value="Preparado">Preparado</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="tamaño" class="form-label">Tamaño</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="tamaño" placeholder="Tamaño">
                                            <input type="text" class="form-control" id="medida" placeholder="Medida">
                                            
                                        </div>
                                    </div>
                                    
                                </div>
                                
                            </div>
                        </div>
                        <div class="modal-footer">
                            <!-- Cambio en el botón "Cerrar" del modal -->
                            <button id="btnCerrar" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <!-- Cambio en el botón "Guardar" del modal -->
                            <button id="btnGuardar" type="button" class="btn btn-primary" onclick="agregarProducto()">Guardar</button>
                        </div>
                    </div>
                </div>
                <?php
                    $cantidad = $_POST['cantidadPedido']; // Supongamos que obtuviste esto del formulario
                    $sql = "SELECT cantidad from stocksucursales WHERE cantidad >= '$cantidad';";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $stock_disponible = $row['cantidad'];
                    }
                ?>
            </div>

            <!-- Modal para eliminar registro -->
            <div class="modal fade" id="modalEliminarProducto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Confirmar Eliminación</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ¿Está seguro que quiere eliminar este producto?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-danger" onclick= "eliminarFila()">Eliminar</button>
                        </div>
                    </div>
                </div>
            </div>

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
    <script>
        var datos;
        function enviarDatosAlServidor(datos) {
            console.log(datos,"hola");
            // URL a tu archivo PHP
            var url = '../controladores/pedidoStock.php';

            // Configuración de la solicitud
            var requestOptions = {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ datos: datos }) // Asegúrate de que 'datos' corresponda a la clave que estás utilizando en PHP
            };

            // Realizar la solicitud Fetch
            fetch(url, requestOptions)
                .then(response =>{
                    console.log(response);
                    return response.json();
                } ) // Si esperas una respuesta JSON del servidor
                .then(data => {
                    // Maneja la respuesta del servidor aquí (data)
                    console.log(data);
                })
                .catch(error => {
                    // Maneja cualquier error aquí
                    console.error('Error:', error);
                });
            if (fetch()){
                Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'El pedido se ha realizado con exito',
                        showConfirmButton: false,
                        timer: 2000,
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
        }

        function obtenerDatos(){
            // Obtén una referencia a la tabla por su ID
            var tabla = document.getElementById("tableSucursal");

            // Accede a la fila de encabezado para obtener los nombres de las columnas
            var encabezado = tabla.getElementsByTagName("thead")[0];
            var columnas = [];
            for (var i = 0; i < encabezado.rows[0].cells.length; i++) {
                columnas.push(encabezado.rows[0].cells[i].textContent);
            }

            // Accede a las filas de datos
            var filas = tabla.getElementsByTagName("tbody")[0].rows;
            var datos = [];

            // Recorre las filas y obtén los datos
            for (var i = 0; i < filas.length; i++) {
                var fila = filas[i];
                var registro = {};
                
                for (var j = 0; j < columnas.length; j++) {
                    var celda = fila.cells[j];
                    registro[columnas[j]] = celda.textContent;
                }
                
                datos.push(registro);
            }
            while (tabla.rows.length > 0){
                tabla.deleteRow(0);
            }

            // Ahora tienes todos los datos de la tabla en el arreglo 'datos'
            console.log(datos);
            enviarDatosAlServidor(datos);
            return datos;

        }
            function validarCantidad(){
                var cantidadPedido= parseInt(document.getElementById("cantidad").value);
                if (cantidadPedido > <?php echo $stock_disponible; ?>){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'No hay stock del producto',
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
                    return false; // Evitar que el formulario se envíe
                }
                return true; 
            }


            function eliminarFila() {
            var fila = $('#tableSucursal tbody tr.selected');
            if (fila.length > 0) {
                tableSucursal.row(fila).remove().draw();
            }
            $('#modalEliminarProducto').modal('hide');
        }

            function editarPedido() {
                var filaSeleccionada = tableSucursal.row('.selected').data();
                if (filaSeleccionada) {
                // Aquí debes completar tu modal con los datos de la fila seleccionada
                // Puedes acceder a los valores de la fila con filaSeleccionada[0], filaSeleccionada[1], etc.
                // Luego, puedes establecer esos valores en los campos del modal
                // Por ejemplo:
                    $('#modalSucursal #codigoSucursal').val(filaSeleccionada[0]);
                    $('#modalSucursal #nombreSucursal').val(filaSeleccionada[1]);
                    $('#modalSucursal #tipoProductoSucursal').val(filaSeleccionada[2]);
                    $('#modalSucursal #tamañoSucursal').val(filaSeleccionada[3]);
                    $('#modalSucursal #medidaSucursal').val(filaSeleccionada[4]);
                    $('#modalSucursal #cantidadSucursal').val(filaSeleccionada[5]);

                    $('#modalSucursal #codigoSucursal').prop('disabled', true);
                    $('#modalSucursal #nombreSucursal').prop('disabled', true);
                    $('#modalSucursal #tipoProductoSucursal').prop('disabled', true);
                    $('#modalSucursal #tamañoSucursal').prop('disabled', true);
                    $('#modalSucursal #medidaSucursal').prop('disabled', true);
                    

                    
                    console.log(filaSeleccionada)
                    // Finalmente, muestra el modal de edición
                    $('#modalSucursal').modal('show');
                } else {
                // Muestra un mensaje o realiza alguna acción si no hay fila seleccionada
            }
        }
    </script>

    <script>
        // Declarar tableSucursal en el ámbito global
       function editarTabla(){
        var nuevoCodigo = $('#codigoSucursal').val();
        var nuevoNombre = $('#nombreSucursal').val();
        var nuevaCantidad = $('#cantidadSucursal').val();
        var nuevoTipoProducto = $('#tipoProductoSucursal').val();
        var nuevoTamaño = $('#tamañoSucursal').val();
        var nuevaMedida = $('#medidaSucursal').val();

        var filaSeleccionada = tableSucursal.row('.selected');
        if (filaSeleccionada.any()) {
            filaSeleccionada.data([
                nuevoCodigo,
                nuevoNombre,
                nuevoTipoProducto,
                nuevoTamaño,
                nuevaMedida,
                nuevaCantidad,
                ""
                ]).draw();
                $('#modalSucursal').modal('hide');
        }}

        var tableSucursal;
        function agregarProducto() {
            if (!validarCantidad()){
                return;
            }else{
                // Obtener los valores de los campos del modal
                var codigo = document.getElementById("codigo").value;
                var nombre = document.getElementById("nombre").value;
                var cantidad = document.getElementById("cantidad").value;
                var tipoProducto = document.getElementById("tipoProducto").value;
                var tamaño = document.getElementById("tamaño").value;
                var medida = document.getElementById("medida").value;
                

                // Verificar si tableSucursal está definida
                if (tableSucursal) {
                    // Crear una nueva fila en la segunda tabla con los datos del producto
                    var filaNueva = 
                    '<tr>' +
                        '<td>' + codigo + '</td>' +
                        '<td>' + nombre + '</td>' +
                        '<td>' + tipoProducto + '</td>' +
                        '<td>' + tamaño + '</td>' +
                        '<td>' + medida + '</td>' +
                        '<td>' + cantidad + '</td>' +
                        '<td>' + "" + '</td>' 
                    '</tr>';
                    
                    // Agregar la fila a la segunda tabla
                    
                    tableSucursal.row.add($(filaNueva)).draw(); // Nota el uso de $() alrededor de filaNueva

                    // Cerrar el modal
                    $('#modalAgregarProducto').modal('hide');
                }
            }
        }
            

        function limpiarModal() {
            $('#codigo').val('');
            $('#nombre').val('');
            $('#tipoProducto').val('');
            $('#tamaño').val('');
            $('#medida').val('');
            $('#cantidad').val('');
        }

        function btnOn() {
            $('#codigo').prop('disabled', false);
            $('#nombre').prop('disabled', false);
            $('#tipoProducto').prop('disabled', false);
            $('#tamaño').prop('disabled', false);
            $('#medida').prop('disabled', false);
        }

        function btnDisabled() {
            $('#codigo').prop('disabled', true);
            $('#nombre').prop('disabled', true);
            $('#proveedor').prop('disabled', true);
            $('#tipoProducto').prop('disabled', true);
            $('#tamaño').prop('disabled', true);
            $('#medida').prop('disabled', true);
        }

        $(document).ready(function() {
            tableSucursal = $('#tableSucursal').DataTable({
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
                    zeroRecords: "No se encontraron resultados",
                    info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
                    infoEmpty: "Mostrando 0 a 0 de 0 registros",
                    infoFiltered: "(filtrado de _MAX_ registros en total)"
                }
            });

            $('#tableSucursal tbody').on('click', 'tr', function() {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                    $('#btnEditarTableSucu').prop('disabled', true);
                    $('#btnEliminarTableSucu').prop('disabled', true);
                    console.log("ceci2")
                } else {
                    tableSucursal.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                    $('#btnEditarTableSucu').prop('disabled', false);
                    $('#btnEliminarTableSucu').prop('disabled', false);
                    var rowData = tableProd.row($(this)).data();


                    $('#btnEditarTableSucu').click(function() {
                        $('#labelAgregarStock').text('Editar Pedido');
                        $('#modalSucursal').modal('show');
                    });
                    $('#btnEliminarTableSucu').click(function() {
                        $('#modalEliminarProducto').modal('show');
                    });

                }
            });


            var tableProd = $('#tableProd').DataTable({
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
                    zeroRecords: "No hay stock",
                    info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
                    infoEmpty: "Mostrando 0 a 0 de 0 registros",
                    infoFiltered: "(filtrado de _MAX_ registros en total)"
                }
            });

            $('#tableProd tbody').on('click', 'tr', function() {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                    $('#labelAgregarStock').text('Agregar Producto');
                    $('#btnAgregarProd').prop('disabled', false);
                    btnOn()
                    limpiarModal()
                    modoAgregar = true;
                    $('#btnAgregarTableProd').prop('disabled', true);

                } else {
                    tableProd.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                    $('#btnAgregarProd').prop('disabled', true);
                    // Mostrar el botón "Ver Detalles"
                    $('#btnAgregarTableProd').prop('disabled', false);
                    // Obtener los datos del producto seleccionado
                    modoAgregar = false;
                    var rowData = tableProd.row($(this)).data();

                    // Limpiar los datos en el modal
                    limpiarModal()

                    // Llenar los elementos en el modal con los datos del producto
                    $('#codigo').val(rowData[0]);
                    $('#nombre').val(rowData[1]);
                    $('#tipoProducto').val(rowData[2]);
                    $('#tamaño').val(rowData[3]);
                    $('#medida').val(rowData[4]);

                    // Acción cuando se hace clic en el modal
                    $('#btnAgregarTableProd').click(function() {
                        // Cambiar el contenido del label
                        $('#labelAgregarStock').text('Agregar Pedido');
                        btnDisabled()
                        $('#modalAgregarProducto').modal('show');
                    });
                    

                // Acción cuando se hace clic en el botón "Guardar" en el modal
                    
                }
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

</html>

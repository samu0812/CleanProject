<?php 
session_start();
include("../bd/conexion.php");
$fechaActual = date("Y-m-d");
$idSucursal = isset($_SESSION['idSucursales']) ? $_SESSION['idSucursales'] : '';
// Buscar el registro de número de venta para la fecha actual
$sql = "SELECT nroVenta FROM Ventas WHERE date(fecha) = '$fechaActual' ORDER BY nroVenta DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Si se encontraron registros, obtener el número de venta actual
    $row = $result->fetch_assoc();
    $nroVenta = $row["nroVenta"] + 1;
} else {
    // Si no se encontraron registros, establecer el número de venta en 1
    $nroVenta = 1;
}
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
    
    <!-- Incluir jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Incluir DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    
    <!-- Incluir DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/vfs_fonts.js"></script>
    
    <!-- toast -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://kit.fontawesome.com/8c68749bc1.js" crossorigin="anonymous"></script>
    
    <!-- Incluir tus estilos personalizados -->
    <link href="../css/style.css" rel="stylesheet">
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
            include "navbar.php";
            ?>
            <!-- Navbar End -->

            <!-- Tabla Ventas Diarias -->
            <div class="container-fluid pt-4 px-4">
                <div class="row mb-3">

                    <div class="col-md-9">

                        <div class="row">

                            <!-- INPUT PARA INGRESO DEL CODIGO DE BARRAS O DESCRIPCION DEL PRODUCTO -->
                            <div class="col-md-12 mb-3">
                                <div class="form-group mb-2">
                                    <label class="col-form-label" for="inputBusqueda">
                                        <i class="fas fa-barcode fs-6"></i>
                                        <span class="small">Productos</span>
                                    </label>
                                    <input type="text" class="form-control form-control-sm" id="inputBusqueda"
                                        placeholder="Ingrese el código de barras o el nombre del producto">
                                    <!-- Agrega un contenedor para las sugerencias -->
                                    <div id="suggestions" class="autocomplete-suggestions">
                                        <!-- Aquí se mostrarán las sugerencias -->
                                    </div>
                                </div>
                            </div>

                            <!-- ETIQUETA QUE MUESTRA LA SUMA TOTAL DE LOS PRODUCTOS AGREGADOS AL LISTADO -->
                            <div class="col-md-6 mb-3">
                                <h3>Total Venta: S./ <span id="totalVenta">0.00</span></h3>
                            </div>

                            <!-- BOTONES PARA VACIAR LISTADO Y COMPLETAR LA VENTA -->
                            <div class="col-md-6 text-right btn-group btn-group" role="group" aria-label="Basic example">
                                <button class="btn btn-primary btn-sm" id="btnRealizarVenta">
                                    <i class="fas fa-shopping-cart"></i> Realizar Venta
                                </button>
                                <button class="btn btn-danger btn-sm" id="btnVaciarListado">
                                    <i class="far fa-trash-alt"></i> Vaciar Listado
                                </button>
                            </div>


                            <!-- LISTADO QUE CONTIENE LOS PRODUCTOS QUE SE VAN AGREGANDO PARA LA COMPRA -->
                            <div class="container-fluid pt-4 px-4">
                                <div class="bg-personalizado text-center rounded p-4">
                                    <div class="table-responsive -xxl">
                                        <table id="lstProductosVenta" class="table display" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Código</th>
                                                    <th>Nombre</th>
                                                    <th>Producto</th>
                                                    <th>Categoria</th>
                                                    <th>Tamaño</th>
                                                    <th>Precio Unitario</th>
                                                    <th>Precio p/ Cant.</th>
                                                    <th>Cantidad</th>
                                                    <th>Descuento (Mayorista)</th>
                                                    <th class="text-center">Opciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- /.col -->

                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="card shadow">

                            <h5 class="card-header py-1 bg-primary text-white text-center">
                                Datos de Venta<span id="totalVentaRegistrar"></span>
                            </h5>

                            <div class="card-body p-2">

                                <!-- SELECCIONAR TIPO DE DOCUMENTO -->
                                <div class="form-group mb-2">
                                    <label class="col-form-label" for="selDocumentoVenta">
                                        <i class="fas fa-file-alt fs-6"></i>
                                        <span class="small">Documento</span><span class="text-danger">*</span>
                                    </label>

                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="selDocumentoVenta" name="documento">
                                        <option value="0" selected disabled id="defaultOption">Seleccione Documento</option>
                                        <?php
                                        // Conexión a la base de datos (debes configurar tus datos de conexión)
                                        include("../bd/conexion.php");

                                        // Verificar la conexión
                                        if ($conn->connect_error) {
                                            die("Conexión fallida: " . $conn->connect_error);
                                        }

                                        // Consulta SQL para obtener los tipos de factura
                                        $sql = "SELECT idTipoFactura, Descripcion FROM TipoFactura";
                                        $result = $conn->query($sql);
                                        // Consulta SQL para obtener las opciones del select "Tipo Pago" desde la tabla "FormaDePago"
                                        $sqlTipoPago = "SELECT idFormaDePago, Descripcion FROM FormaDePago";
                                        $resultTipoPago = $conn->query($sqlTipoPago);
                                


                                        // Generar las opciones del select
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo '<option required value="' . $row["idTipoFactura"] . '">' . $row["Descripcion"] . '</option>';
                                            }
                                        }

                                        // Cerrar la conexión a la base de datos
                                        $conn->close();
                                        ?>
                                    </select>

                                    <span id="validate_categoria" class="text-danger small fst-italic" style="display:none">
                                        Debe Seleccione documento
                                    </span>
                                </div>


                                <!-- SELECCIONAR TIPO DE PAGO -->
                                <div class="form-group mb-2">

                                    <label class="col-form-label" for="selCategoriaReg">
                                        <i class="fas fa-money-bill-alt fs-6"></i>
                                        <span class="small">Tipo Pago</span><span class="text-danger">*</span>
                                    </label>

                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="selTipoPago">
                                        <option value="" selected disabled id="defaultOption">Seleccione Tipo Pago</option>
                                        <?php
                                        // Generar las opciones del select "Tipo Pago" desde la consulta SQL
                                        if ($resultTipoPago->num_rows > 0) {
                                            while ($rowTipoPago = $resultTipoPago->fetch_assoc()) {
                                                echo '<option required value="' . $rowTipoPago["idFormaDePago"] . '">' . $rowTipoPago["Descripcion"] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>

                                    

                                    <span id="validate_categoria" class="text-danger small fst-italic" style="display:none">
                                        Debe Ingresar tipo de pago
                                    </span>

                                </div>


                                <!-- SERIE Y NRO DE BOLETA -->
                                <div class="form-group">

                                    <div class="row">

                                        <div class="col-md-8">
                                            <label for="iptNroVenta">Nro Venta</label>
                                            <input type="text" min="1" name="iptEfectivo" id="iptNroVenta" class="form-control form-control-sm" placeholder="Nro Venta" disabled>
                                        </div>

                                    </div>

                                </div>

                                <!-- INPUT DE EFECTIVO ENTREGADO -->
                                <div class="form-group">
                                    <label for="iptEfectivoRecibido">Monto recibido</label>
                                    <input type="number" min="0" name="iptEfectivo" id="iptEfectivoRecibido"
                                        class="form-control form-control-sm" placeholder="Cantidad de efectivo recibida">
                                </div>

                                <!-- INPUT CHECK DE EFECTIVO EXACTO -->
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="chkEfectivoExacto">
                                    <label class="form-check-label" for="chkEfectivoExacto">
                                        Monto Exacto
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label for="iptagregarDescuento">Agregar Descuento %</label>
                                    <input type="number" value=0 min="0" max="100" name="agregarDescuento" id="iptagregarDescuento" class="form-control form-control-sm" placeholder="0">
                                </div>

                                <!-- MOSTRAR MONTO EFECTIVO ENTREGADO Y EL VUELTO -->
                                <div class="row mt-2">

                                    <div class="col-12">
                                        <h6 class="text-start fw-bold">Monto: S./ <span
                                                id="EfectivoEntregado">0.00</span></h6>
                                    </div>

                                    <div class="col-12">
                                        <h6 class="text-start text-danger fw-bold">Vuelto: S./ <span id="Vuelto" value= 0.00 type="number">0.00</span>
                                        </h6>
                                    </div>

                                </div>

                                <!-- MOSTRAR EL SUBTOTAL, IGV Y TOTAL DE LA VENTA -->
                                <div class="row">
                                    <div class="col-md-7">
                                        <span>SUBTOTAL</span>
                                    </div>
                                    <div class="col-md-5 text-right">
                                        S./ <span class="" id="boleta_subtotal">0.00</span>
                                    </div>

                                    <div class="col-md-7">
                                        <span>Descuentos</span>
                                    </div>
                                    <div class="col-md-5 text-right">
                                        S./ <span class="" id="boleta_descuentos">0.00</span>
                                    </div>

                                    <div class="col-md-7">
                                        <span>Recargos</span>
                                    </div>
                                    <div class="col-md-5 text-right">
                                        S./ <span class="" id="boleta_recargos">0.00</span>
                                    </div>

                                    <div class="col-md-7">
                                        <span>TOTAL</span>
                                    </div>
                                    <div class="col-md-5 text-right">
                                        S./ <span class="" id="boleta_total">0.00</span>
                                    </div>
                                </div>

                            </div><!-- ./ CARD BODY -->

                        </div><!-- ./ CARD -->
                    </div>
                </div>
            </div>
            <div class="container-fluid pt-4 px-4">
                <div class="bg-personalizado text-center rounded p-4">
                    <div class="table-responsive -xxl">
                        <table id="ventaDiaria" class="table display" style="width:100%">
                            <h5>Ventas</h5>
                            <thead>
                                <tr>
                                    <th>Código de Venta</th>
                                    <th>Código de Factura</th>
                                    <th>Nro de Venta</th>
                                    <th>Fecha</th>
                                    <th>Total</th>
                                    <th>Comprobante</th>
                                    <th>Opción</th>
                                </tr>
                            </thead>
                            <tbody id="ventaBody">
                                <?php
                                include('../bd/conexion.php');
                                $idSucursal = isset($_SESSION['idSucursales']) ? $_SESSION['idSucursales'] : '';
                                // Consulta SQL para obtener todas las ventas
                                $sqlVenta = "SELECT v.idVentas, v.nroVenta, v.Fecha, df.idDetalleFactura, df.Total, df.idFacturas
                                                    FROM ventas v
                                                    INNER JOIN detallefactura df ON v.idDetalleFactura = df.idDetalleFactura
                                                    WHERE v.idSucursales = $idSucursal";
                                $resultVenta = $conn->query($sqlVenta);
                                $previousIdDetalleFactura = null; // Variable para realizar un seguimiento del ID previo

                                if ($resultVenta->num_rows > 0) {
                                    while ($rowVenta = $resultVenta->fetch_assoc()) {
                                        $fechaVenta = strtotime($rowVenta['Fecha']);
                                        $fechaActual = strtotime('now');
                                        $diferencia = ($fechaActual - $fechaVenta) / 60; // Diferencia en minutos
                                        // Comprueba si el ID de detalle de factura ha cambiado
                                        if ($rowVenta['idDetalleFactura'] !== $previousIdDetalleFactura) {
                                            echo '<tr>';
                                            echo '<td>' . $rowVenta['idDetalleFactura'] . '</td>';
                                            echo '<td>' . $rowVenta['idFacturas'] . '</td>';
                                            echo '<td>' . $rowVenta['nroVenta'] . '</td>';
                                            echo '<td>' . $rowVenta['Fecha'] . '</td>';
                                            echo '<td>' . $rowVenta['Total'] . '</td>';
                                            echo '<td><button class="btn btn-danger btn-sm comprobante-btn" data-id="' . $rowVenta['idDetalleFactura'] . '"> 
                                                <i class="fa-regular fa-file-pdf" style="color: #ffffff;"></i> Comprobante
                                                </button> </td>'; 
                                            if ($diferencia >= 1440) {
                                                echo '<td><button class="btn btn-danger btn-sm cancelar-venta-btn" disabled>Cancelar Venta</button></td>';
                                            } else {
                                                echo '<td><button class="btn btn-danger btn-sm cancelar-venta-btn" data-id="' . $rowVenta['idDetalleFactura'] . '">Cancelar Venta</button></td>';
                                            }
                                        }

                                        $previousIdDetalleFactura = $rowVenta['idDetalleFactura'];
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php
            include "footer.php";
            ?>
        </div>

    </div>
    <script>
        $(document).ready(function() {
            // Inicializa DataTables
            var table = $('#ventaDiaria').DataTable({
                "order": [], // Elimina la ordenación predeterminada de la primera columna
                "searching": true // Habilita la función de búsqueda
            });
            // Obtiene la fecha actual (sin hora)
            var fechaActual = new Date();

            // Obtiene el año, mes y día
            var año = fechaActual.getFullYear();
            var mes = fechaActual.getMonth() + 1; // Ten en cuenta que los meses comienzan desde 0 (enero) hasta 11 (diciembre)
            var dia = fechaActual.getDate();

            // Formatea la fecha como una cadena (por ejemplo, "2023-09-26")
            var fechaFormateada = año + '-' + (mes < 10 ? '0' : '') + mes + '-' + (dia < 10 ? '0' : '') + dia;

            console.log(fechaFormateada); // Muestra la fecha formateada en la consola

            table.search(fechaFormateada).draw();
        });

        $(document).ready(function() {
    var productoIdsAgregados = [];

    // Escucha un evento cuando se presiona una tecla en el campo de búsqueda
    $('#inputBusqueda').keydown(function(event) {
        // Verificar si se presionó la tecla "Enter"
        if (event.keyCode === 13) {
            var productoId = $(this).val();

            // Verificar si el productoId ya ha sido agregado
            if (productoIdsAgregados.includes(productoId)) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Este Producto ya ha sido agregado',
                    showConfirmButton: false,
                    timer: 2000,
                    background: false,
                    backdrop: false,
                    customClass: {
                        container: 'custom-container-class',
                        popup: 'custom-popup-class',
                        title: 'custom-title-class',
                        icon: 'custom-icon-class',
                    },
                });
                return; // No hacer nada si ya está en la lista
            }

            // Agregar el productoId a la lista de productos agregados
            productoIdsAgregados.push(productoId);

            // Aquí puedes obtener los detalles del producto usando el productoId
            // y luego crear la fila de la tabla con los detalles del producto.
            // Reemplaza esto con tu lógica para obtener los detalles del producto.

            var nombre = "Nombre del producto"; // Reemplaza con el nombre real
            var tipoProducto = "Tipo del producto"; // Reemplaza con el tipo real
            var tipoCategoria = "Categoría del producto"; // Reemplaza con la categoría real
            var tamaño = "Tamaño del producto"; // Reemplaza con el tamaño real
            var precioProducto = 10.99; // Reemplaza con el precio real

            // Crear una nueva fila para la tabla de ventas
            var nuevaFila = '<tr scope="row">';
            nuevaFila += '<td>' + productoId + '</td>';
            nuevaFila += '<td>' + nombre + '</td>';
            nuevaFila += '<td>' + tipoProducto + '</td>';
            nuevaFila += '<td>' + tipoCategoria + '</td>';
            nuevaFila += '<td>' + tamaño + '</td>';
            nuevaFila += '<td>' + precioProducto + '</td>';
            // Agrega más campos según los detalles del producto

            nuevaFila += '</tr>';

            // Agregar la nueva fila a la tabla
            $('#lstProductosVenta tbody').append(nuevaFila);

            // Calcular el total de la venta
            calcularTotalVenta();

            // Limpiar el campo de búsqueda
            $(this).val('');
        }
    });
});

    $(document).ready(function() {
        descuentoAgregado=0;
        // Inicializa el autocompletado
        $('#inputBusqueda').keyup(function() {
        var query = $(this).val();
        if (query !== '') {
            $.ajax({
            url: '../controladores/ventas.php', // Cambia esto por la URL de tu script PHP que buscará en la base de datos
            method: 'POST',
            data: { query: query },
            success: function(data) {
                $('#suggestions').html(data);
            }
            });
        } else {
            $('#suggestions').html('');
        }
        });

        // Maneja la selección de un producto del autocompletado
        $('#suggestions').on('click', '.autocomplete-suggestion', function() {
        var productoSeleccionado = $(this).text();
        $('#inputBusqueda').val(productoSeleccionado);
        $('#suggestions').html('');
        });
    });

    $(document).ready(function() {
        var productoIdsAgregados = [];
        $('#iptNroVenta').val('<?php echo $nroVenta; ?>');

        // Manejar la selección de un producto del autocompletado
        $('#suggestions').on('click', '.autocomplete-suggestion', function() {
            var productoSeleccionado = $(this).text();
            var productoId = $(this).data('producto-id'); // Obtener el ID del producto

        // Verificar si el productoId ya ha sido agregado
            if (productoIdsAgregados.includes(productoId)) {
                Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Este Producto ya ha sido agregado',
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
                $('#inputBusqueda').val('');
                $('#suggestions').html('');
                return; // No hacer nada si ya está en la lista
            }

            productoIdsAgregados.push(productoId);

            var nombre = $(this).data('nombre');
            var tipoProducto = $(this).data('tipo-producto')
            var tipoCategoria = $(this).data('tipo-categoria')
            var tamaño = $(this).data('tamaño');
            var precioProducto = parseFloat($(this).data('precio'));
            var precioFinal = precioProducto; //multiplicar por la cantidad y si es mayorista o min
            var cantidadStock = parseFloat($(this).data('cantidad-stock'));
            var descuento = 0.00;
            var efectivo = 0;
            
            // Crear una nueva fila para la tabla de ventas
            var nuevaFila = '<tr scope="row">';
            nuevaFila += '<td>' + productoId + '</td>';
            nuevaFila += '<td>' + nombre + '</td>';
            nuevaFila += '<td>' + tipoProducto + '</td>';
            nuevaFila += '<td>' + tipoCategoria + '</td>';
            nuevaFila += '<td>' + tamaño + '</td>';
            nuevaFila += '<td>' + precioProducto + '</td>';
            nuevaFila += '<td>' +  precioFinal + '</td>';
               // Verificar el tipo de producto
            if (tipoProducto === 'suelto' || tipoProducto === 'Suelto' || tipoProducto === 'SUELTO') {
                nuevaFila += '<td><input type="number" step="0.01" min="0.01" max="' + cantidadStock + '" value="1" class="form-control form-control-sm cantidad-input" data-cantidad-stock="' + cantidadStock + '" id="cantidad_' + productoId + '"></td>';
            } else {
                nuevaFila += '<td><input type="number" step="1" min="1" max="' + cantidadStock + '" value="1" class="form-control form-control-sm cantidad-input" data-cantidad-stock="' + cantidadStock + '" id="cantidad_' + productoId + '"></td>';
            }

            nuevaFila += '<td>' +  descuento + '</td>';
            nuevaFila += '<td><button class="btn btn-danger btn-sm eliminar-producto" data-producto-id="' + productoId + '">Eliminar</button></td>';
            nuevaFila += '</tr>';
            

            // Agregar la nueva fila a la tabla
            $('#lstProductosVenta tbody').append(nuevaFila);

            // Calcular el total de la venta
            calcularTotalVenta();

            // Limpiar el campo de búsqueda
            $('#inputBusqueda').val('');
            $('#suggestions').html('');
        });
     
        $('#btnVaciarListado').click(function() {
            // Limpiar la lista de productos agregados
            productoIdsAgregados = [];
            // Limpiar la tabla
            $('#lstProductosVenta tbody').empty();
            // Restablecer el total a 0
            $('#boleta_subtotal').text('0.00');
            $('#boleta_descuentos').text('0.00');
            $('#boleta_total').text('0.00');
            // Resetear el campo "Agregar Descuento"
            $('#iptagregarDescuento').val(0.00);
            // Resetear el campo "Monto Recibido"
            $('#iptEfectivoRecibido').val(0.00);
            
            $('#chkEfectivoExacto').prop('checked', false);

            // Recalcular el total de la venta (que será 0 en este punto)
            calcularTotalVenta();
        });

        // Manejar cambios en la cantidad de productos
        $('#lstProductosVenta').on('change', '.cantidad-input', function() {
            var productoId = $(this).closest('tr').find('td:eq(0)').text();
            var cantidadInput = $(this);
            var cantidad = parseFloat(cantidadInput.val());
            var precioUnitario = parseFloat($(this).closest('tr').find('td:eq(5)').text());
            var cantidadStock = parseFloat($(this).data('cantidad-stock'));
            var tipoProducto = $(this).closest('tr').find('td:eq(2)').text().toLowerCase(); // Obtener el tipo de producto

            // Validar si el tipo de producto es "suelto" o no
            if (tipoProducto === "suelto") {
                // Validar si la cantidad ingresada es un número válido para productos "suelto"
                if (isNaN(cantidad) || cantidad <= 0) {
                    cantidadInput.val(1); // Establecer la cantidad a 1 si no es un número válido
                    cantidad = 1; // Actualizar la cantidad
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'La cantidad debe ser un número mayor a 0.',
                        showConfirmButton: false,
                        timer: 4000,
                        background: false,
                        backdrop: false,
                        customClass: {
                            container: 'custom-container-class',
                            popup: 'custom-popup-class',
                            title: 'custom-title-class',
                            icon: 'custom-icon-class',
                        },
                    });
                }            
            } else {
                // Validar si la cantidad ingresada es un número válido para otros tipos de productos
                if (isNaN(cantidad) || cantidad <= 0 || !Number.isInteger(cantidad)) {
                    cantidadInput.val(1); // Establecer la cantidad a 1 si no es un número válido
                    cantidad = 1; // Actualizar la cantidad
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'La cantidad debe ser un número mayor a 0.',
                        showConfirmButton: false,
                        timer: 4000,
                        background: false,
                        backdrop: false,
                        customClass: {
                            container: 'custom-container-class',
                            popup: 'custom-popup-class',
                            title: 'custom-title-class',
                            icon: 'custom-icon-class',
                        },
                    });
                }
            }
            if (cantidad > cantidadStock) {
                    cantidadInput.val(cantidadStock); // Establecer la cantidad al valor máximo de stock
                    cantidad = cantidadStock; // Actualizar la cantidad
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'La cantidad no puede ser mayor que la cantidad en stock (' + cantidadStock + ').',
                        showConfirmButton: false,
                        timer: 4000,
                        background: false,
                        backdrop: false,
                        customClass: {
                            container: 'custom-container-class',
                            popup: 'custom-popup-class',
                            title: 'custom-title-class',
                            icon: 'custom-icon-class',
                        },
                    });
                }
            // Aplicar descuento del 10% si es una venta mayorista (cantidad >= 6)
            var idSucursal = <?php echo json_encode($idSucursal); ?>;

            // Asegúrate de que idSucursal sea un número para comparar correctamente con el número 1
            idSucursal = parseInt(idSucursal);
            if (cantidad >= 6  && idSucursal === 1) {
                //precioUnitario *= 0.9; // Aplicar descuento del 10%
                var descuento = (cantidad * precioUnitario) *0.1;
            }else{
                var descuento = 0.00;
            }

            var precioFinal = cantidad * precioUnitario;

            // Verificar si la cantidad es 1 y establecer el precioFinal a precioUnitario en ese caso
            if (cantidad === 1) {
                precioFinal = precioUnitario;
                var descuento = 0.00;
            }

            // Actualizar el precio final en la tabla
            $(this).closest('tr').find('td:eq(6)').text(precioFinal.toFixed(2));
            $(this).closest('tr').find('td:eq(8)').text(descuento.toFixed(2));

            // Recalcular el total de la venta
            calcularTotalVenta();
        });

        $('#iptEfectivoRecibido').keyup(function() {
                calcularTotalVenta(); // Llama a la función al ingresar el efectivo
        });

        // Manejar cambios en el campo de entrada de descuento
        $('#iptagregarDescuento').on('input', function() {
            var descuentoPorcentaje = parseFloat($(this).val()) / 100; // Divide por 100 para obtener el valor en porcentaje
            var subtotal = parseFloat($('#boleta_subtotal').text()); // Obtener el subtotal actual
            // Calcula el descuento en base al porcentaje y al subtotal
            var descuentos = 0;
            $('#lstProductosVenta tbody tr').each(function() {
                var descuentoProducto = parseFloat($(this).find('td:eq(8)').text()); // Obtener el descuento del producto
                descuentos = descuentoProducto + descuentoAgregado;
                total=subtotal+descuentos;
            });

            if (isNaN(descuentoPorcentaje)) {
                descuentos = calcularDescuentos(); // Establecer 0 como valor predeterminado
            }
            // Actualiza el valor de los descuentos en la tarjeta
            $('#boleta_descuentos').text(descuentos.toFixed(2));
            // Recalcula el total de la venta
            calcularTotalVenta();
        });

        // Manejar clics en el botón "Eliminar" de un producto en la tabla
        $('#lstProductosVenta').on('click', '.eliminar-producto', function() {
            var productoId = $(this).data('producto-id');
            // Eliminar el productoId del array de productos agregados
            var index = productoIdsAgregados.indexOf(productoId);
            if (index !== -1) {
                productoIdsAgregados.splice(index, 1);
            }
            // Eliminar la fila de la tabla
            $(this).closest('tr').remove();
            if ($('#lstProductosVenta tbody tr').length === 0) {
                productoIdsAgregados = [];
                // Limpiar la tabla
                $('#lstProductosVenta tbody').empty();
                // Restablecer el total a 0
                $('#boleta_subtotal').text('0.00');
                $('#boleta_descuentos').text('0.00');
                $('#boleta_recargos').text('0.00');
                $('#boleta_total').text('0.00');
                $('#selDocumentoVenta').val('0');
                // Resetear el campo "Agregar Descuento"
                $('#iptagregarDescuento').val(0);
                // Resetear el campo "Monto Recibido"
                $('#iptEfectivoRecibido').val(0);
                $('#selTipoPago').val('0');
                $('#chkEfectivoExacto').prop('checked', false);
            }
            // Recalcular el total de la venta
            calcularTotalVenta();
        });
        

        $('#chkEfectivoExacto').change(function() {
            var isChecked = $(this).is(":checked");
            var totalVenta = parseFloat($('#boleta_total').text());
            if (isChecked) {
                // Si está marcado, establece el monto efectivo igual al total
                $('#iptEfectivoRecibido').val(totalVenta.toFixed(2));
                $('#EfectivoEntregado').text(totalVenta.toFixed(2));
                $('#Vuelto').text('0.00'); // Actualiza el campo "Monto Efectivo"
            } else {
                // Si no está marcado, limpia el campo de monto efectivo
                $('#iptEfectivoRecibido').val('');
                $('#EfectivoEntregado').text('0.00'); // Reinicia el campo "Monto Efectivo"
            }
            // Vuelve a calcular el vuelto y actualizar los totales
            calcularTotalVenta();
            habilitarEfectivoRecibido();
        });

        function habilitarEfectivoRecibido() {
            var isChecked = $('#chkEfectivoExacto').is(":checked");
            $('#iptEfectivoRecibido').prop('disabled', isChecked);
        }
            // Escuchar cambios en el total de la venta
        function observarCambioEnTotalVenta() {
            // Obtiene el total actualizado
            var totalVenta = parseFloat($('#boleta_total').text());

            // Verifica si la casilla "Monto Exacto" está marcada
            var isChecked = $('#chkEfectivoExacto').is(":checked");

            // Actualiza el campo "Monto Efectivo" si la casilla está marcada
            if (isChecked) {
                $('#iptEfectivoRecibido').val(totalVenta.toFixed(2));
                $('#EfectivoEntregado').text(totalVenta.toFixed(2));
            }
            // Vuelve a calcular el vuelto y actualizar los totales
            calcularTotalVenta();
            habilitarEfectivoRecibido();
        }
        // Llama a la función cuando se cambia el total de la venta
        setInterval(observarCambioEnTotalVenta, 0000); // Se verifica cada segundo (ajusta el intervalo según tus necesidades)

        // Función para calcular el total de la venta
        function calcularTotalVenta() {
            calcularSubtotalVenta(); // Calcular el subtotal
            //calcularDescuentos(); // Calcular los descuentos

            var subtotal = parseFloat($('#boleta_subtotal').text());
            var descuentos = parseFloat($('#boleta_descuentos').text());
            var recargo = parseFloat($('#boleta_recargos').text());
            var total = subtotal - descuentos + recargo;
            

            var descuentoPorcentaje = parseFloat($('#iptagregarDescuento').val()) / 100;
            if (isNaN(descuentoPorcentaje)) {
                descuentoPorcentaje = 0; // Establecer 0 como valor predeterminado
            }

            var descuentoAgregado = descuentoPorcentaje * subtotal;
            var descuentos = calcularDescuentos() + descuentoAgregado; // Sumar el descuento agregado

            $('#boleta_descuentos').text(descuentos.toFixed(2));

            $('#boleta_total').text(total.toFixed(2)); // Actualizar el total en el elemento HTML

            var efectivoRecibido = parseFloat($('#iptEfectivoRecibido').val()); // Obtener el efectivo recibido
            var vuelto = efectivoRecibido - total;

            if (isNaN(efectivoRecibido)) {
                efectivoRecibido = 0;
                 // Establecer 0 como valor predeterminado si es NaN o menor que total
            }
            if (efectivoRecibido < total) {
                vuelto = 0;
                 // Establecer 0 como valor predeterminado si es NaN o menor que total
            }


            if (isNaN(vuelto)) {
                vuelto = 0; // Establecer 0 como valor predeterminado
            }

            $('#Vuelto').text(vuelto.toFixed(2)); // Actualizar el vuelto en el elemento HTML
            $('#totalVenta').text(total.toFixed(2));
            $('#EfectivoEntregado').text(efectivoRecibido.toFixed(2));
        }



        function calcularSubtotalVenta() {
            var subtotal = 0;
            $('#lstProductosVenta tbody tr').each(function() {
                var precioFinal = parseFloat($(this).find('td:eq(6)').text()); // Obtener el precioFinal del producto
                subtotal += precioFinal;
            });

            $('#boleta_subtotal').text(subtotal.toFixed(2)); // Actualizar el subtotal en el elemento HTML
        }

        function calcularDescuentos() {
            var descuentos = 0;
    
            $('#lstProductosVenta tbody tr').each(function() {
                var cantidad = parseFloat($(this).find('td:eq(7) input').val()); // Obtener la cantidad del producto
                var precioUnitario = parseFloat($(this).find('td:eq(5)').text()); // Obtener el precio unitario
                var descuentoProducto = parseFloat($(this).find('td:eq(8)').text()); // Obtener el descuento del producto
                var subtotalProducto = cantidad * precioUnitario; // Calcular el subtotal del producto
                
                // Sumar el descuento del producto al total de descuentos
                descuentos += descuentoProducto;
            });
            
            return descuentos;
        }

        });

            // Agregar evento al cambio de opción en el select de tipo de pago
        $('#selTipoPago').change(function() {
            // Obtener el valor seleccionado
            var tipoPagoSeleccionado = $(this).val();
            console.log(tipoPagoSeleccionado);
            // Calcular el recargo solo si el tipo de pago es "tarjeta de crédito"
            if (tipoPagoSeleccionado === '2') {
                // Calcular el recargo como el 10% del subtotal de la venta
                var subtotal = parseFloat($('#boleta_subtotal').text());
                var recargo = subtotal * 0.10; // 10% del subtotal

                // Actualizar el total sumando el recargo
                var total = subtotal + recargo;
                $('#boleta_total').text(total.toFixed(2));

                // Actualizar el contenido del elemento span con el recargo
                $('#boleta_recargos').text(recargo.toFixed(2));
            } else {
                // Si el tipo de pago no es tarjeta de crédito, quitar el recargo del total
                var subtotal = parseFloat($('#boleta_subtotal').text());
                $('#boleta_total').text(subtotal.toFixed(2));

                // Restablecer el contenido del elemento span de recargos
                $('#boleta_recargos').text('0.00');
            }
        });


        $('#btnRealizarVenta').click(function() {
            // Verificar si todos los campos están completos
            if (validarCampos()) {
                // Obtén los datos de la tabla de productos y de la card
                var datosProductos = obtenerDatosTablaProductos();
                var datosCard = obtenerDatosCard();

                // Crea un objeto con los datos a enviar
                var datosVenta = {
                    productos: datosProductos,
                    card: datosCard
                };
                console.log(datosVenta);
                // Envía los datos al archivo PHP utilizando AJAX
                $.ajax({
                    url: '../controladores/realizarVenta.php',
                    method: 'POST',
                    data: { ventaData: JSON.stringify(datosVenta) },
                    success: function(response) {
                        response = JSON.parse(response); // Parsear la respuesta JSON
                        console.log(datosVenta);
                        if (response.success) {
                            // Si la venta fue exitosa, muestra una notificación
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: response.message,
                                showConfirmButton: false,
                                timer: 4000,
                                background: false,
                                backdrop: false,
                                customClass: {
                                    container: 'custom-container-class',
                                    popup: 'custom-popup-class',
                                    title: 'custom-title-class',
                                    icon: 'custom-icon-class',
                                }
                            });

                            // Actualiza la página después de 4 segundos (4000 ms)
                            setTimeout(function() {
                                location.reload();
                            }, 2000);
                        } else {
                            // Si la venta no fue exitosa, muestra una notificación de error
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: response.message,
                                showConfirmButton: false,
                                timer: 4000,
                                background: false,
                                backdrop: false,
                                customClass: {
                                    container: 'custom-container-class',
                                    popup: 'custom-popup-class',
                                    title: 'custom-title-class',
                                    icon: 'custom-icon-class',
                                }
                            });
                        }
                    },
                    error: function(error) {
                        // Maneja los errores aquí
                        console.error(error);
                    }
                });
            } else {
                // Si no se completaron todos los campos, muestra un mensaje de error
                Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: 'Por favor complete todos los campos',
                                showConfirmButton: false,
                                timer: 2000,
                                background: false,
                                backdrop: false,
                                customClass: {
                                    container: 'custom-container-class',
                                    popup: 'custom-popup-class',
                                    title: 'custom-title-class',
                                    icon: 'custom-icon-class',
                                }
                            });
            }
        });
        function validarCampos() {
            var documentoVenta = $('#selDocumentoVenta').val();
            var tipoPago = $('#selTipoPago').val();
            var destinatario = $('#selDestinatario').val();
            var montoRecibido = parseFloat($('#iptEfectivoRecibido').val());

            // Verificar que los campos requeridos no estén vacíos
            if (documentoVenta === '' || tipoPago === '' || destinatario === '') {
                return false;
            }

            // Verificar que el monto recibido sea un número válido y mayor que cero
            if (isNaN(montoRecibido) || montoRecibido <= 0) {
                return false;
            }

            // Verificar que haya al menos un producto en la tabla
            if ($('#lstProductosVenta tbody tr').length === 0) {
                return false;
            }

            var total = $('#boleta_total').text();
            if (montoRecibido < total) {
                return false;
            }

            // Si todos los campos están completos y el monto recibido es válido, y hay productos en la tabla, retornar true
            return true;
        }
        // Función para obtener los datos de la tabla de productos
        function obtenerDatosTablaProductos() {
            var datos = [];
            $('#lstProductosVenta tbody tr').each(function() {
                var idProducto = $(this).find('td:eq(0)').text();
                var nombreProducto = $(this).find('td:eq(1)').text();
                var cantidad = parseFloat($('#cantidad_' + idProducto).val());
                var cantidadStock = parseFloat($(this).find('td:eq(7) input').data('cantidad-stock'));
                var precioUnitario = parseFloat($(this).find('td:eq(5)').text());
                var tipoProducto = $(this).find('td:eq(2)').text();
                var tipoCategoria = $(this).find('td:eq(3)').text();
                var tamaño = $(this).find('td:eq(4)').text();
                var descuentoProducto = $(this).find('td:eq(8)').text();
                datos.push({
                    id: idProducto,
                    nombre: nombreProducto + ' - ' + tipoProducto + ' - ' + tipoCategoria + ' - ' + tamaño,
                    cantidad: cantidad,
                    cantidadStock: cantidadStock,
                    precioUnitario: precioUnitario,
                    descuentoProducto:descuentoProducto
                });
            });
            return datos;
        }

        // Función para obtener los datos de la card
        function obtenerDatosCard() {
            var subtotal = parseFloat($('#boleta_subtotal').text()); // Obtiene el subtotal
            var descuentos = parseFloat($('#boleta_descuentos').text()); // Obtiene los descuentos
            var totalVenta = $('#boleta_total').text();
            var tipoDocumento = $('#selDocumentoVenta').val();
            var recargos = parseFloat($('#boleta_recargos').text());
            var tipoPago = $('#selTipoPago').val();
            var nroVenta = $('#iptNroVenta').val();
            var efectivoRecibido = $('#iptEfectivoRecibido').val();
            var vuelto = $('#Vuelto').val();
            // Agrega más campos según sea necesario
            var datosCard = {
                subtotal: subtotal,
                descuentos: descuentos,
                totalVenta: totalVenta,
                tipoDocumento: tipoDocumento,
                recargos: recargos,
                tipoPago: tipoPago,
                nroVenta: nroVenta,
                efectivoRecibido: efectivoRecibido,
                vuelto: vuelto
                // Agrega más campos aquí
            };
            return datosCard;
        }

        // Función para cargar una imagen desde una URL y convertirla a base64
        function convertImageToBase64(url, callback) {
            var img = new Image();
            img.crossOrigin = 'Anonymous';
            img.onload = function() {
                var canvas = document.createElement('canvas');
                canvas.width = img.width;
                canvas.height = img.height;
                var ctx = canvas.getContext('2d');
                ctx.drawImage(img, 0, 0);
                var base64 = canvas.toDataURL('image/png'); // Puedes cambiar 'image/png' al formato de imagen deseado
                callback(base64);
            };
            img.src = url;
        }


document.querySelectorAll('.comprobante-btn').forEach(button => {
    button.addEventListener('click', function() {
        const idDetalleFactura = this.getAttribute('data-id');
        // Definir la ruta de la imagen
        var imagenUrl = '../img/logoCleanIco2.ico';
        var fechaActual = new Date().toLocaleDateString();

        // Llama a la función para convertir la imagen y obtener su representación en base64
        convertImageToBase64(imagenUrl, function(base64Image) {

            // Realizar una solicitud AJAX para obtener los datos del detalle de factura
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '../controladores/comprobanteVenta.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);

                    // Crear un arreglo de filas de la tabla para los productos
                    const tablaProductos = [];
                    var tableHeaders = [
                        'Código Producto',
                        'Producto',
                        'Precio Unitario',
                        'Cantidad',
                        'Precio por Cantidad',
                        'Descuentos'
                    ];

                    // Agregar cada producto como una fila en la tabla
                    response.datos.forEach(producto => {
                        const filaProducto = [
                            producto.idProducto,
                            producto.nombreProducto,
                            producto.precioProducto,
                            producto.cantidad,
                            producto.precioCantidad,
                            producto.descuentoProducto,
                        ];

                        tablaProductos.push(filaProducto);
                    });

                    // Definir la estructura del documento PDF con los estilos
                    const pdfDefinition = {
                        content: [
                            {
                                columns: [
                                    {
                                        // Agregar la imagen usando la representación en base64
                                        image: base64Image, // Utiliza la representación en base64 de la imagen
                                        width: 100, // Ancho de la imagen en puntos (ajusta según sea necesario)
                                        alignment: 'left',
                                        margin: [0, 10], // Márgenes (arriba, abajo)
                                    },
                                    {
                                        text: 'Factura Nro: ' + response.datos[0].idFacturas,
                                        width: '*',
                                        fontSize: 12,
                                        bold: true,
                                        alignment: 'right',
                                    },
                                ]
                            },
                            {
                                text: 'Formosa Argentina\nTeléfono: (123) 456-7890\nEmail: cleanfsa@empresa.com\nFecha: ' 
                                + fechaActual + '\nFecha de Venta: ' + response.datos[0].FechaEmision + '\nDocumento: ' + response.datos[0].tipoFacturaDescripcion,
                                fontSize: 10,
                                margin: [0, 0, 0, 15],
                            },
                            { text: 'Datos del Producto:', style: 'subheader' },
                            {
                                table: {
                                    headerRows: 1,
                                    widths: ['auto', 'auto', 'auto', 'auto', 'auto', 'auto'],
                                    body: [
                                        tableHeaders.map(header => ({
                                            text: header,
                                            fontSize: 10,
                                            fillColor: '#FFA07A', // Color de fondo de las celdas de encabezado
                                            color: 'white', // Color de texto en las celdas de encabezado
                                        })),
                                        ...tablaProductos.map(row => row.map(cell => ({
                                            text: cell,
                                            fontSize: 10,
                                        }))),
                                    ],
                                },
                                layout: {
                                    fillColor: function (rowIndex, node, columnIndex) {
                                        // Color de fondo para las filas alternas (opcional)
                                        return (rowIndex % 2 === 0) ? '#F5F5F5' : null;
                                    },
                                },
                            },
                            { text: '\n\n' }, // Espacio adicional entre la tabla y los elementos siguientes
                            { text: `SubTotal: ${response.datos[0].subTotal}`, bold: true, fontSize: 10 },
                            { text: `Total: ${response.datos[0].total}`, bold: true, fontSize: 10 },
                            { text: `Descuentos: ${response.datos[0].descuentos}`, bold: true, fontSize: 10 },
                            { text: `Recargos: ${response.datos[0].recargos}` ,bold: true, fontSize: 10 },
                            { text: `Forma de Pago: ${response.datos[0].formaDePagoDescripcion}`, bold: true, fontSize: 10 },
                            { text: `Dinero Recibido: ${response.datos[0].dineroRecibido}`, bold: true, fontSize: 10 },
                            { text: `Vuelto: ${response.datos[0].vuelto}`, bold: true, fontSize: 10 },
                        ],
                        styles: {
                            header: {
                                fontSize: 18,
                                bold: true,
                                alignment: 'center'
                            },
                            subheader: {
                                fontSize: 14,
                                bold: true,
                                margin: [0, 10, 0, 5]
                            }
                        }
                    };

                    // Crear el PDF
                    pdfMake.createPdf(pdfDefinition).open();
                }
            };

            xhr.send('idDetalleFactura=' + idDetalleFactura);
        });
    });
});


    document.getElementById("selTipoPago").addEventListener("change", function() {
        var defaultOption = document.getElementById("defaultOption");
        if (defaultOption) {
            defaultOption.disabled = true;
        }
    });
    document.getElementById("selDocumentoVenta").addEventListener("change", function() {
        var defaultOption = document.getElementById("defaultOption");
        if (defaultOption) {
            defaultOption.disabled = true;
        }
    });


    $(document).ready(function () {
        $(".cancelar-venta-btn").click(function () {
            var idDetalleFactura = $(this).data("id");

            $.ajax({
                type: "POST",
                url: "../controladores/cancelarVenta.php",
                data: { idDetalleFactura: idDetalleFactura },
                success: function (response) {
                    // Maneja la respuesta del servidor, por ejemplo, mostrar un mensaje al usuario
                    Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: 'La venta se ha cancelado con éxito.',
                                showConfirmButton: false,
                                timer: 4000,
                                background: false,
                                backdrop: false,
                                customClass: {
                                    container: 'custom-container-class',
                                    popup: 'custom-popup-class',
                                    title: 'custom-title-class',
                                    icon: 'custom-icon-class',
                                }
                            });
                    // Recarga la página o realiza otras acciones según tus necesidades
                    setTimeout(function() {
                                location.reload();
                            }, 2000);
                },
                error: function () {
                    alert("Error al cancelar la venta.");
                }
            });
        });
    });
</script>

    </script>


    <style>
/* Estilo para la lista de sugerencias */
        /* Estilo para las celdas de encabezado */
        th.thVenta {
            background-color: #FFA07A; 
            color: #ffffff; /* Cambia el color del texto a blanco */
            font-weight: bold;   
            padding: 0.1rem 1rem;
            display: table-cell;
            vertical-align: inherit;
            font-weight: bold;
            
        }
        .autocomplete-suggestions {
            position: absolute;
            z-index: 9999;
            max-height: 150px; /* Altura máxima de la lista desplegable */
            overflow-y: auto;
            background-color: #fff;
            width: 58%; /* Ajusta el ancho de la lista al 100% del input */
            box-sizing: border-box; /* Incluye el padding y el borde en el ancho total */
        }

        .autocomplete-suggestion {
            padding: 5px;
            cursor: pointer;
        }

        .autocomplete-suggestion:hover {
            background-color: #f0f0f0;
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

                /* Estilo CSS para la clase personalizada de la alerta */
                .custom-popup-class {
            width: 250px; /* Ajusta el ancho de la alerta según tus necesidades */
            font-size: 10px; /* Ajusta el tamaño de fuente del contenido de la alerta */
            padding: 2px 3px; /* Ajusta el relleno de la alerta para hacerla un poco más pequeña */
            border-radius: 10px; /* Añade bordes redondeados a la alerta */
            }

        /* Estilo CSS para la clase personalizada del título */
        .custom-title-class {
            font-size: 13px; /* Ajusta el tamaño de fuente del título de la alerta */
            padding: 6px 3px; 
            }
        /* Estilo CSS para la clase personalizada del icono */
        .custom-icon-class {
            font-size: 8px; /* Ajusta el tamaño del icono según tus necesidades */
        }
        .bg-primary{
            background-color: #FF6347 !important;
        } 
        .btn-group, .btn-group-vertical {
            position: relative;
            display: inline; 
            vertical-align: middle;
        }
        #btnRealizarVenta{
            background-color:#FF6347;
            border-color: #FF6347;
        }
        #lstProductosVenta{
            background-color:#FFFFFF !important;
            color:#757575;
            padding: 0.3rem 0.5rem;
        }
        #ventaDiaria{
            background-color:#FFFFFF !important;
            color:#757575;
            padding: 0.3rem 0.5rem;
        }
        div.bg-personalizado{
            max-height: 450px; /* Ajusta la altura máxima según tus necesidades */
            overflow-y: auto;
        }
        div.dataTables_wrapper .dataTables_length label {
        display: inline-block;
        margin-right: 20px; /* Espacio entre los elementos */
        }

        

    </style>

<!-- Template Javascript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="../lib/chart/chart.min.js"></script>
<script src="../lib/easing/easing.min.js"></script>
<script src="../lib/waypoints/waypoints.min.js"></script>
<script src="../lib/owlcarousel/owl.carousel.min.js"></script>
<script src="../lib/tempusdominus/js/moment.min.js"></script>
<script src="../lib/tempusdominus/js/moment-timezone.min.js"></script>
<script src="../lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<!-- Template Javascript -->
<script src="../js/main.js"></script>
</body>


</html>
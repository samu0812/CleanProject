<?php
session_start();
include("../bd/conexion.php");
$fechaActual = date("Y-m-d");

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
    <script src="https://code.jquery.com/jquery-3.7.0.js"
        integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
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
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
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
                            <div class="col-md-6 text-right btn-group btn-group" role="group"
                                aria-label="Basic example">
                                <button class="btn btn-primary btn-sm" id="btnRealizarVenta">
                                    <i class="fas fa-shopping-cart"></i> Realizar Venta
                                </button>
                                <button class="btn btn-danger btn-sm" id="btnVaciarListado">
                                    <i class="far fa-trash-alt"></i> Vaciar Listado
                                </button>
                                <button class="btn btn-danger btn-sm" id="btnExportToPDF" disabled>
                                    <i class="fa-regular fa-file-pdf" style="color: #ffffff;"></i> Comprobante
                                </button>
                            </div>


                            <!-- LISTADO QUE CONTIENE LOS PRODUCTOS QUE SE VAN AGREGANDO PARA LA COMPRA -->
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="lstProductosVenta" class="table table-striped">
                                        <thead class="bg-info text-left fs-6">
                                            <tr>
                                                <th scope="col" class="thVenta">Código</th>
                                                <th scope="col" class="thVenta">Nombre</th>
                                                <th scope="col" class="thVenta">Producto</th>
                                                <th scope="col" class="thVenta">Categoria</th>
                                                <th scope="col" class="thVenta">Tamaño</th>
                                                <th scope="col" class="thVenta">Precio Unitario</th>
                                                <th scope="col" class="thVenta">Precio p/ Cant.</th>
                                                <th scope="col" class="thVenta">Cantidad</th>
                                                <th scope="col" class="thVenta">Descuento (Mayorista)</th>
                                                <th scope="col" class="thVenta text-center">Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody class="small text-left fs-6">
                                        </tbody>
                                    </table>
                                </div>
                                <!-- / table -->
                            </div>
                            <!-- /.col -->

                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="card shadow">

                            <h5 class="card-header py-1 bg-primary text-white text-center">
                                Total Venta: S./ <span id="totalVentaRegistrar">0.00</span>
                            </h5>

                            <div class="card-body p-2">

                                <!-- SELECCIONAR TIPO DE DOCUMENTO -->
                                <div class="form-group mb-2">
                                    <label class="col-form-label" for="selDocumentoVenta">
                                        <i class="fas fa-file-alt fs-6"></i>
                                        <span class="small">Documento</span><span class="text-danger">*</span>
                                    </label>

                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                        id="selDocumentoVenta" name="documento">
                                        <option value="0" required>Seleccione Documento</option>
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
                                                echo '<option value="' . $row["idTipoFactura"] . '">' . $row["Descripcion"] . '</option>';
                                            }
                                        }

                                        // Cerrar la conexión a la base de datos
                                        $conn->close();
                                        ?>
                                    </select>

                                    <span id="validate_categoria" class="text-danger small fst-italic"
                                        style="display:none">
                                        Debe Seleccione documento
                                    </span>
                                </div>


                                <!-- SELECCIONAR TIPO DE PAGO -->
                                <div class="form-group mb-2">

                                    <label class="col-form-label" for="selCategoriaReg">
                                        <i class="fas fa-money-bill-alt fs-6"></i>
                                        <span class="small">Tipo Pago</span><span class="text-danger">*</span>
                                    </label>

                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                        id="selTipoPago">
                                        <option value="0">Seleccione Tipo Pago</option>
                                        <?php
                                        // Generar las opciones del select "Tipo Pago" desde la consulta SQL
                                        if ($resultTipoPago->num_rows > 0) {
                                            while ($rowTipoPago = $resultTipoPago->fetch_assoc()) {
                                                echo '<option value="' . $rowTipoPago["idFormaDePago"] . '">' . $rowTipoPago["Descripcion"] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>



                                    <span id="validate_categoria" class="text-danger small fst-italic"
                                        style="display:none">
                                        Debe Ingresar tipo de pago
                                    </span>

                                </div>


                                <!-- SERIE Y NRO DE BOLETA -->
                                <div class="form-group">

                                    <div class="row">

                                        <div class="col-md-8">
                                            <label for="iptNroVenta">Nro Venta</label>
                                            <input type="text" min="1" name="iptEfectivo" id="iptNroVenta"
                                                class="form-control form-control-sm" placeholder="Nro Venta" disabled>
                                        </div>

                                    </div>

                                </div>

                                <!-- INPUT DE EFECTIVO ENTREGADO -->
                                <div class="form-group">
                                    <label for="iptEfectivoRecibido">Monto recibido</label>
                                    <input type="number" min="0" name="iptEfectivo" id="iptEfectivoRecibido"
                                        class="form-control form-control-sm"
                                        placeholder="Cantidad de efectivo recibida">
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
                                    <input type="number" value=0 min="0" max="100" name="agregarDescuento"
                                        id="iptagregarDescuento" class="form-control form-control-sm" placeholder="0">
                                </div>

                                <!-- MOSTRAR MONTO EFECTIVO ENTREGADO Y EL VUELTO -->
                                <div class="row mt-2">

                                    <div class="col-12">
                                        <h6 class="text-start fw-bold">Monto: S./ <span
                                                id="EfectivoEntregado">0.00</span></h6>
                                    </div>

                                    <div class="col-12">
                                        <h6 class="text-start text-danger fw-bold">Vuelto: S./ <span id="Vuelto"
                                                value=0.00 type="number">0.00</span>
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

            <!-- Footer Start -->
            <?php
            include "footer.php";
            ?>
            <!-- Footer End -->
        </div>
        <!-- Content End -->


    </div>
    <script>
        $(document).ready(function () {
            // Inicializa el autocompletado
            $('#inputBusqueda').keyup(function () {
                var query = $(this).val();
                if (query !== '') {
                    $.ajax({
                        url: '../controladores/ventas.php', // Cambia esto por la URL de tu script PHP que buscará en la base de datos
                        method: 'POST',
                        data: { query: query },
                        success: function (data) {
                            $('#suggestions').html(data);
                        }
                    });
                } else {
                    $('#suggestions').html('');
                }
            });

            // Maneja la selección de un producto del autocompletado
            $('#suggestions').on('click', '.autocomplete-suggestion', function () {
                var productoSeleccionado = $(this).text();
                $('#inputBusqueda').val(productoSeleccionado);
                $('#suggestions').html('');
            });
        });


        $(document).ready(function () {
            // ...
            var productoIdsAgregados = [];
            $('#iptNroVenta').val('<?php echo $nroVenta; ?>');


            // Manejar la selección de un producto del autocompletado
            $('#suggestions').on('click', '.autocomplete-suggestion', function () {
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

                // Agregar el productoId a la lista de productos agregados
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
                nuevaFila += '<td>' + precioFinal + '</td>';
                nuevaFila += '<td><input type="number" min="1" max="' + cantidadStock + '" value="1" class="form-control form-control-sm cantidad-input" data-cantidad-stock="' + cantidadStock + '" id="cantidad_' + productoId + '"></td>';
                nuevaFila += '<td>' + descuento + '</td>';
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

            $('#btnVaciarListado').click(function () {
                // Limpiar la lista de productos agregados
                productoIdsAgregados = [];
                // Limpiar la tabla
                $('#lstProductosVenta tbody').empty();
                // Restablecer el total a 0
                $('#boleta_subtotal').text('0.00');
                $('#boleta_descuentos').text('0.00');
                $('#boleta_total').text('0.00');
                // Resetear el campo "Agregar Descuento"
                $('#iptagregarDescuento').val(0);
                // Resetear el campo "Monto Recibido"
                $('#iptEfectivoRecibido').val(0);
                $('#selTipoPago').val('0');
                $('#chkEfectivoExacto').prop('checked', false);

                // Recalcular el total de la venta (que será 0 en este punto)
                calcularTotalVenta();
            });

            // Manejar cambios en la cantidad de productos
            // Manejar cambios en la cantidad de productos
            $('#lstProductosVenta').on('change', '.cantidad-input', function () {
                var productoId = $(this).closest('tr').find('td:eq(0)').text();
                var cantidadInput = $(this);
                var cantidad = parseInt(cantidadInput.val());
                var precioUnitario = parseFloat($(this).closest('tr').find('td:eq(5)').text());
                var cantidadStock = parseFloat($(this).data('cantidad-stock'));

                // Validar si la cantidad ingresada es un número válido
                if (isNaN(cantidad) || cantidad <= 0 || cantidad !== parseInt(cantidadInput.val())) {
                    cantidadInput.val(1); // Establecer la cantidad a 1 si no es un número válido
                    cantidad = 1; // Actualizar la cantidad
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'La cantidad debe ser un número entero mayor que 0.',
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
                } else if (cantidad > cantidadStock) {
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
                if (cantidad <= 0) {
                    cantidad = 1; // Establecer la cantidad en stock
                    $(this).val(cantidad); // Actualizar el valor en el campo de cantidad

                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'La cantidad no puede ser Menor o Igual a 0.',
                        showConfirmButton: false,
                        timer: 4000,
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
                // Aplicar descuento del 10% si es una venta mayorista (cantidad >= 6)
                if (cantidad >= 6) {
                    //precioUnitario *= 0.9; // Aplicar descuento del 10%
                    var descuento = (cantidad * precioUnitario) * 0.1;
                } else {
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

            $('#iptEfectivoRecibido').keyup(function () {
                calcularTotalVenta(); // Llama a la función al ingresar el efectivo
            });

            // Manejar cambios en el campo de entrada de descuento
            $('#iptagregarDescuento').on('input', function () {
                var descuentoPorcentaje = parseFloat($(this).val()) / 100; // Divide por 100 para obtener el valor en porcentaje
                var subtotal = parseFloat($('#boleta_subtotal').text()); // Obtener el subtotal actual
                // Calcula el descuento en base al porcentaje y al subtotal

                var descuentos = 0;
                $('#lstProductosVenta tbody tr').each(function () {
                    var descuentoProducto = parseFloat($(this).find('td:eq(8)').text()); // Obtener el descuento del producto
                    descuentos = descuentoProducto + descuentoAgregado;
                    total = subtotal + descuentos;

                });

                if (isNaN(descuentoPorcentaje)) {
                    descuentos = calcularDescuentos(); // Establecer 0 como valor predeterminado
                }



                console.log('Evento de entrada input activado.', descuentos);

                // Actualiza el valor de los descuentos en la tarjeta
                $('#boleta_descuentos').text(descuentos.toFixed(2));


                // Recalcula el total de la venta
                calcularTotalVenta();
            });




            // Manejar clics en el botón "Eliminar" de un producto en la tabla
            $('#lstProductosVenta').on('click', '.eliminar-producto', function () {
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


            $('#chkEfectivoExacto').change(function () {
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

            // ...

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
                $('#lstProductosVenta tbody tr').each(function () {
                    var precioFinal = parseFloat($(this).find('td:eq(6)').text()); // Obtener el precioFinal del producto
                    subtotal += precioFinal;
                });

                $('#boleta_subtotal').text(subtotal.toFixed(2)); // Actualizar el subtotal en el elemento HTML
            }

            function calcularDescuentos() {
                var descuentos = 0;

                $('#lstProductosVenta tbody tr').each(function () {
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
        $('#selTipoPago').change(function () {
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


        $('#btnRealizarVenta').click(function () {
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

                // Envía los datos al archivo PHP utilizando AJAX
                $.ajax({
                    url: '../controladores/realizarVenta.php',
                    method: 'POST',
                    data: { ventaData: JSON.stringify(datosVenta) },
                    success: function (response) {
                        response = JSON.parse(response); // Parsear la respuesta JSON

                        if (response.success) {
                            $('#btnExportToPDF').prop('disabled', false);
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
                            setTimeout(function () {
                                location.reload();
                            }, 10000);
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
                    error: function (error) {
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
            $('#lstProductosVenta tbody tr').each(function () {
                var idProducto = $(this).find('td:eq(0)').text();
                var nombreProducto = $(this).find('td:eq(1)').text();
                var cantidad = parseInt($('#cantidad_' + idProducto).val());
                var cantidadStock = parseFloat($(this).find('td:eq(7) input').data('cantidad-stock'));
                console.log(cantidadStock);
                datos.push({
                    id: idProducto,
                    nombre: nombreProducto,
                    cantidad: cantidad,
                    cantidadStock: cantidadStock
                });
            });
            return datos;
        }

        // Función para obtener los datos de la card
        function obtenerDatosCard() {
            var subtotal = parseFloat($('#boleta_subtotal').text()); // Obtiene el subtotal
            var descuentos = parseFloat($('#boleta_descuentos').text()); // Obtiene los descuentos
            var totalVenta = $('#totalVentaRegistrar').text();
            var tipoDocumento = $('#selDocumentoVenta').val();
            var recargos = parseFloat($('#boleta_recargos').text());
            var tipoPago = $('#selTipoPago').val();
            var nroVenta = $('#iptNroVenta').val();
            var efectivoRecibido = $('#iptEfectivoRecibido').val();
            // Agrega más campos según sea necesario
            var datosCard = {
                subtotal: subtotal,
                descuentos: descuentos,
                totalVenta: totalVenta,
                tipoDocumento: tipoDocumento,
                recargos: recargos,
                tipoPago: tipoPago,
                nroVenta: nroVenta,
                efectivoRecibido: efectivoRecibido
                // Agrega más campos aquí
            };
            return datosCard;
        }

        // Función para cargar una imagen desde una URL y convertirla a base64
        function convertImageToBase64(url, callback) {
            var img = new Image();
            img.crossOrigin = 'Anonymous';
            img.onload = function () {
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

        // Función para exportar el PDF con la imagen
        function exportToPDF() {
            // Definir la ruta de la imagen
            var imagenUrl = '../img/logoCleanIco2.ico';

            // Llama a la función para convertir la imagen y obtener su representación en base64
            convertImageToBase64(imagenUrl, function (base64Image) {
                // Obtener los demás datos que deseas incluir en el PDF
                var tableHeaders = [
                    'Código Producto',
                    'Nombre',
                    'Tipo Producto',
                    'Categoría',
                    'Tamaño',
                    'Precio Unitario',
                    'Precio p/ Cantidad',
                    'Cantidad',
                    'Descuento'
                ];

                var tableData = [];
                $('#lstProductosVenta tbody tr').each(function () {
                    var rowData = [];
                    $(this).find('td').each(function (index) {
                        if (index === 7) {
                            rowData.push($(this).find('input').val());
                        } else {
                            rowData.push($(this).text());
                        }
                    });

                    rowData.pop();

                    tableData.push(rowData);
                });

                // Obtener los datos del card
                var totalVenta = $('#totalVentaRegistrar').text();
                var documentoVenta = $('#selDocumentoVenta option:selected').text();
                var tipoPago = $('#selTipoPago option:selected').text();
                var nroVenta = $('#iptNroVenta').val();
                var efectivoRecibido = $('#iptEfectivoRecibido').val();
                var vuelto = $('#Vuelto').text();
                var subtotal = $('#boleta_subtotal').text();
                var descuentos = $('#boleta_descuentos').text();
                var recargos = $('#boleta_recargos').text();
                var total = $('#boleta_total').text();
                var fechaActual = new Date().toLocaleDateString();

                // Definir la estructura del documento PDF
                var docDefinition = {
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
                                    text: 'Factura Nro: ' + nroVenta,
                                    width: '*',
                                    fontSize: 12,
                                    bold: true,
                                    alignment: 'right',
                                },
                            ]
                        },
                        {
                            text: 'Dirección de tu Empresa\nFormosa, Argentina\nTeléfono: (123) 456-7890\nEmail: cleanfsa@empresa.com\nFecha: ' + fechaActual + '\n' + documentoVenta,
                            fontSize: 10,
                            margin: [0, 0, 0, 15],
                        },
                        {
                            table: {
                                headerRows: 1,
                                widths: ['auto', 'auto', 'auto', 'auto', 'auto', 'auto', 'auto', 'auto', 'auto'],
                                body: [
                                    tableHeaders.map(header => {
                                        return {
                                            text: header,
                                            alignment: 'center',
                                            fontSize: 10,
                                            fillColor: '#FFA07A', // Color de fondo de encabezados
                                            style: 'tableHeader',
                                            color: 'white', // Color de texto en encabezados
                                        };
                                    }),
                                    ...tableData.map(row => row.map(cell => ({ text: cell, fontSize: 10 }))),
                                ],
                            },
                            layout: 'lightHorizontalLines', // Líneas horizontales ligeras entre las filas
                        },
                        { text: 'Datos de la Compra', style: 'header', margin: [0, 15, 0, 5] },
                        {
                            table: {
                                widths: ['auto', '*'],
                                body: [
                                    ['Tipo de Pago:', tipoPago],
                                    ['Dinero Recibido:', efectivoRecibido],
                                    ['Vuelto:', vuelto],
                                    ['Subtotal:', subtotal],
                                    ['Descuentos:', descuentos],
                                    ['Recargos:', recargos],
                                    ['Total:', total],
                                ],
                            },
                            fontSize: 11,
                            layout: 'noBorders', // Sin bordes entre las celdas
                        },
                    ],
                    styles: {
                        header: {
                            fontSize: 12,
                            bold: true,
                            alignment: 'center',
                        },
                        tableHeader: {
                            fontSize: 11,
                            bold: true,
                        },
                    },
                };

                // Generar el PDF
                var pdf = pdfMake.createPdf(docDefinition);
                pdf.open();
            });
        }

        // Asignar la función al botón de exportar a PDF
        $('#btnExportToPDF').click(function () {
            exportToPDF();
        });


    </script>


    <style>
        /* Estilo para la lista de sugerencias */
        /* Estilo para las celdas de encabezado */
        th.thVenta {
            background-color: #FFA07A;
            color: #ffffff;
            /* Cambia el color del texto a blanco */
            font-weight: bold;
        }

        .autocomplete-suggestions {
            position: absolute;
            z-index: 9999;
            max-height: 150px;
            /* Altura máxima de la lista desplegable */
            overflow-y: auto;
            background-color: #fff;
            width: 58%;
            /* Ajusta el ancho de la lista al 100% del input */
            box-sizing: border-box;
            /* Incluye el padding y el borde en el ancho total */
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
            margin-right: 20px;
            /* Espacio entre los elementos */
        }

        div.dataTables_wrapper .dataTables_length select {
            display: inline-block;
            width: auto;
        }

        /* Estilo para hacer más pequeños algunos inputs */
        #porcentajeAumento,
        #precioBase,
        #precioVenta {
            width: 70%;
            /* Ajusta el valor según tus preferencias */
            margin: auto;
        }

        /* Estilo para el cuerpo del modal */
        .modal-body {
            padding: 10px;
            /* Ajusta el valor según tus preferencias */
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            ;
        }

        /* Estilo para el botón Guardar */
        .modal-footer .btn-primary {
            background-color: #007bff;
            /* Cambia el color de fondo */
            border-color: #007bff;
            /* Cambia el color del borde */
        }

        .modal-footer .btn-primary:hover {
            background-color: #5a104c;
            /* Cambia el color de fondo en el hover */
            border-color: #0056b3;
            /* Cambia el color del borde en el hover */
        }

        /* Estilo CSS para la clase personalizada de la alerta */
        .custom-popup-class {
            width: 250px;
            /* Ajusta el ancho de la alerta según tus necesidades */
            font-size: 10px;
            /* Ajusta el tamaño de fuente del contenido de la alerta */
            padding: 2px 3px;
            /* Ajusta el relleno de la alerta para hacerla un poco más pequeña */
            border-radius: 10px;
            /* Añade bordes redondeados a la alerta */
        }

        /* Estilo CSS para la clase personalizada del título */
        .custom-title-class {
            font-size: 13px;
            /* Ajusta el tamaño de fuente del título de la alerta */
            padding: 6px 3px;
        }

        /* Estilo CSS para la clase personalizada del icono */
        .custom-icon-class {
            font-size: 8px;
            /* Ajusta el tamaño del icono según tus necesidades */
        }

        .bg-primary {
            background-color: #FF6347 !important;
        }

        .btn-group,
        .btn-group-vertical {
            position: relative;
            display: inline;
            vertical-align: middle;
        }

        #btnRealizarVenta {
            background-color: #FF6347;
            border-color: #FF6347;
        }

        #lstProductosVenta {
            background-color: #FFFFFF !important;
            color: #757575;
            padding: 0.3rem 0.5rem;
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
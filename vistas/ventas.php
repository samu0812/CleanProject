<?php 
session_start();

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

    <!-- Incluir DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">


    <!-- Incluir DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>

    <!-- toast -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

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
                            <div class="col-md-6 text-right">
                                <button class="btn btn-primary" id="btnIniciarVenta">
                                    <i class="fas fa-shopping-cart"></i> Realizar Venta
                                </button>
                                <button class="btn btn-danger" id="btnVaciarListado">
                                    <i class="far fa-trash-alt"></i> Vaciar Listado
                                </button>
                            </div>

                            <!-- LISTADO QUE CONTIENE LOS PRODUCTOS QUE SE VAN AGREGANDO PARA LA COMPRA -->
                            <div class="col-md-12">
                               <div class="table-responsive">
                                <table id="lstProductosVenta" class="display nowrap table-striped w-100 shadow table-sm">
                                    <thead class="bg-info text-left fs-6">
                                        <tr>
                                            <th class="thVenta">Id Productos</th>
                                            <th class="thVenta">Nombre</th>
                                            <th class="thVenta">Tipo Producto</th>
                                            <th class="thVenta">Tipo Categoria</th>
                                            <th class="thVenta">Tipo Tamaño</th>
                                            <th class="thVenta">Precio Unitario</th>
                                            <th class="thVenta">Precio Final</th>
                                            <th class="thVenta">Cantidad</th>
                                            <th class="thVenta">Porcentaje</th>
                                            <th class="thVenta text-center">Opciones</th>
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

                                    <label class="col-form-label" for="selCategoriaReg">
                                        <i class="fas fa-file-alt fs-6"></i>
                                        <span class="small">Documento</span><span class="text-danger">*</span>
                                    </label>

                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                        id="selDocumentoVenta">
                                        <option value="0">Seleccione Documento</option>
                                        <option value="1" selected="true">Boleta</option>
                                        <option value="2">Factura</option>
                                        <option value="3">Ticket</option>
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

                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                        id="selTipoPago">
                                        <option value="0">Seleccione Tipo Pago</option>
                                        <option value="1" selected="true">Efectivo</option>
                                        <option value="2">Tarjeta</option>
                                        <option value="3">Yape</option>
                                        <option value="4">plin</option>
                                    </select>

                                    <span id="validate_categoria" class="text-danger small fst-italic" style="display:none">
                                        Debe Ingresar tipo de pago
                                    </span>

                                </div>

                                <!-- SERIE Y NRO DE BOLETA -->
                                <div class="form-group">

                                    <div class="row">

                                        <div class="col-md-4">

                                            <label for="iptNroSerie">Serie</label>

                                            <input type="text" min="0" name="iptEfectivo" id="iptNroSerie"
                                                class="form-control form-control-sm" placeholder="nro Serie" disabled>
                                        </div>

                                        <div class="col-md-8">

                                            <label for="iptNroVenta">Nro Venta</label>

                                            <input type="text" min="0" name="iptEfectivo" id="iptNroVenta"
                                                class="form-control form-control-sm" placeholder="Nro Venta" disabled>

                                        </div>

                                    </div>

                                </div>

                                <!-- INPUT DE EFECTIVO ENTREGADO -->
                                <div class="form-group">
                                    <label for="iptEfectivoRecibido">Efectivo recibido</label>
                                    <input type="number" min="0" name="iptEfectivo" id="iptEfectivoRecibido"
                                        class="form-control form-control-sm" placeholder="Cantidad de efectivo recibida">
                                </div>

                                <!-- INPUT CHECK DE EFECTIVO EXACTO -->
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="chkEfectivoExacto">
                                    <label class="form-check-label" for="chkEfectivoExacto">
                                        Efectivo Exacto
                                    </label>
                                </div>

                                <!-- MOSTRAR MONTO EFECTIVO ENTREGADO Y EL VUELTO -->
                                <div class="row mt-2">

                                    <div class="col-12">
                                        <h6 class="text-start fw-bold">Monto Efectivo: S./ <span
                                                id="EfectivoEntregado">0.00</span></h6>
                                    </div>

                                    <div class="col-12">
                                        <h6 class="text-start text-danger fw-bold">Vuelto: S./ <span id="Vuelto">0.00</span>
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
                                        <span>IGV (18%)</span>
                                    </div>
                                    <div class="col-md-5 text-right">
                                        S./ <span class="" id="boleta_igv">0.00</span>
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

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>
    <script>
    $(document).ready(function() {
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
    // ...
        var productoIdsAgregados = [];

        // Manejar la selección de un producto del autocompletado
        $('#suggestions').on('click', '.autocomplete-suggestion', function() {
            var productoSeleccionado = $(this).text();
            var productoId = $(this).data('producto-id'); // Obtener el ID del producto

        // Verificar si el productoId ya ha sido agregado
            if (productoIdsAgregados.includes(productoId)) {
                alert('Este producto ya ha sido agregado.');
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
            

            // Crear una nueva fila para la tabla de ventas
            var nuevaFila = '<tr>';
            nuevaFila += '<td>' + productoId + '</td>';
            nuevaFila += '<td>' + nombre + '</td>';
            nuevaFila += '<td>' + tipoProducto + '</td>';
            nuevaFila += '<td>' + tipoCategoria + '</td>';
            nuevaFila += '<td>' + tamaño + '</td>';
            nuevaFila += '<td>' + precioProducto + '</td>';
            nuevaFila += '<td>' +  precioFinal + '</td>';
            nuevaFila += '<td><input type="number" min="1" max="' + cantidadStock + '" value="1" class="form-control form-control-sm cantidad-input" id="cantidad"></td>';
            nuevaFila += '<td><input type="number" min="0" max="100" value="0" class="form-control form-control-sm porcentaje-input" id="porcentaje"></td>';
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

    // ...
        
        $('#btnVaciarListado').click(function() {
            // Limpiar la lista de productos agregados
            productoIdsAgregados = [];

            // Limpiar la tabla
            $('#lstProductosVenta tbody').empty();

            // Calcular el total de la venta (que será 0 en este punto)
            calcularTotalVenta();
        });
    

    // Manejar cambios en la cantidad de productos
// ...

        // Manejar cambios en la cantidad de productos
        $('#lstProductosVenta').on('change', '.cantidad-input', function() {
            var cantidad = parseInt($(this).val());
            var precioUnitario = parseFloat($(this).closest('tr').find('td:eq(5)').text());
            var cantidadStock = parseFloat($(this).closest('tr').find('td:eq(7)').data('cantidad-stock'));

            // Verificar si la cantidad ingresada es mayor que la cantidad en stock
            if (cantidad > cantidadStock) {
                alert('La cantidad no puede ser mayor que la cantidad en stock (' + cantidadStock + ').');
                cantidad = cantidadStock; // Establecer la cantidad en stock
                $(this).val(cantidad); // Actualizar el valor en el campo de cantidad
            }

            // Aplicar descuento del 10% si es una venta mayorista (cantidad >= 6)
            if (cantidad >= 6) {
                precioUnitario *= 0.9; // Aplicar descuento del 10%
            }

            var precioFinal = cantidad * precioUnitario;

            // Verificar si la cantidad es 1 y establecer el precioFinal a precioUnitario en ese caso
            if (cantidad === 1) {
                precioFinal = precioUnitario;
            }

            // Actualizar el precio final en la tabla
            $(this).closest('tr').find('td:eq(6)').text(precioFinal.toFixed(2));

            // Recalcular el total de la venta
            calcularTotalVenta();
        });

// ...



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
        // Recalcular el total de la venta
        calcularTotalVenta();
        });
        
        // Función para calcular el total de la venta
        function calcularTotalVenta() {
        var total = 0;
        $('#lstProductosVenta tbody tr').each(function() {
            var subtotal = parseFloat($(this).find('td:eq(6)').text()); // Obtener el precioFinal del producto
            total += subtotal;
        });

        $('#totalVenta').text(total.toFixed(2)); // Actualizar el valor en el elemento HTML
        }

        });

    </script>


    <style>
/* Estilo para la lista de sugerencias */
        /* Estilo para las celdas de encabezado */
        .thVenta {
            background-color: #e77a34; /* Cambia el color de fondo a rojo */
            color: #ffffff; /* Cambia el color del texto a blanco */
            font-weight: bold;   
        }
        .autocomplete-suggestions {
            position: absolute;
            z-index: 9999;
            max-height: 150px; /* Altura máxima de la lista desplegable */
            overflow-y: auto;
            border: 1px solid #ccc;
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

        .child-table {
            width: 100%;
            border-collapse: collapse;
        }
        .info-row td {
            width: 100%;
        }
        table {
        border-collapse: collapse;
        width: 100%;
        }
        th, td {
        border: 1px solid black;
        padding: 8px;
        text-align: center;
        }
        tr:hover {
        background-color: #f2f2f2;
        }
        .info {
        display: none;
        }
        .wide-column {
            width: 40%; /* Ajusta el ancho según tus necesidades */
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
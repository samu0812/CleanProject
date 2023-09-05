<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="es">

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
    <link href="../css/style.css" rel="stylesheet">

    <!-- Incluir jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>

    <!-- Incluir Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">

    <!-- Incluir DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- Incluir Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.min.js"></script>

    <!-- Incluir DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

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
            <!-- Contenido de la Página -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                        <div class="d-flex align-items-center justify-content-center p-4">
                            <button id="btnAgregarProd" style="background: #e77a34; color: white" class="btn btn-md" data-bs-toggle="modal" data-bs-target="#modalAgregarProducto">
                            <i class="fas fa-plus"></i> Agregar Producto</button>    
                        </div>
                    </div>
                    
                    <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                        <div class="bg-personalizado rounded d-flex align-items-center justify-content-center p-4">
                            <svg xmlns="http://www.w3.org/2000/svg" style="color: #e77a34" class="icon icon-tabler icon-tabler-forklift" width="55" height="55" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M5 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                <path d="M14 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                <path d="M7 17l5 0"></path>
                                <path d="M3 17v-6h13v6"></path>
                                <path d="M5 11v-4h4"></path>
                                <path d="M9 11v-6h4l3 6"></path>
                                <path d="M22 15h-3v-10"></path>
                                <path d="M16 13l3 0"></path>
                            </svg>
                            <div class="text-center" style="margin-left: 30px">
                                <p class="mb-2">Galpon</p>
                                <h6 class="mb-0">1000</h6>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                        <div class="bg-personalizado rounded d-flex align-items-center justify-content-center p-4">
                            <svg xmlns="http://www.w3.org/2000/svg" style="color: #e77a34" class="icon icon-tabler icon-tabler-building-warehouse me-1" width="55" height="55" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M3 21v-13l9 -4l9 4v13"></path>
                                <path d="M13 13h4v8h-10v-6h6"></path>
                                <path d="M13 21v-9a1 1 0 0 0 -1 -1h-2a1 1 0 0 0 -1 1v3"></path>
                            </svg>
                            <div class="text-center" style="margin-left: 30px">
                                <p class="mb-2">Kirchner</p>
                                <h6 class="mb-0">600</h6>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                        <div class="bg-personalizado rounded d-flex align-items-center justify-content-center p-4">
                            <svg xmlns="http://www.w3.org/2000/svg" style="color: #e77a34" class="icon icon-tabler icon-tabler-building-warehouse" width="55" height="55" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M3 21v-13l9 -4l9 4v13"></path>
                            <path d="M13 13h4v8h-10v-6h6"></path>
                            <path d="M13 21v-9a1 1 0 0 0 -1 -1h-2a1 1 0 0 0 -1 1v3"></path>
                            </svg>
                            <div class="text-center" style="margin-left: 30px">
                                <p class="mb-2">Centro</p>
                                <h6 class="mb-0">600</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid pt-4 px-4">
                <div class="bg-personalizado text-center rounded p-4">
                    <div class="table-responsive -xxl">
                    <table id="tableProd" class="table display" style="width:100%">
                        <h5>Busqueda de Productos</h5>
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Proveedor</th>
                                <th>Tipo Prod</th>
                                <th>Tipo Cat</th>
                                <th>Tamaño</th>
                                <th>Medida</th>
                                <th>Cantidad</th>
                                <th>P. Base</th>
                                <th>%</th>
                                <th>P. Venta</th>
                                <th>
                                    <button id="btnAgregarTableProd" style="background: #e77a34; color: white;" class="btn btn-sm" disabled><i class="fas fa-plus"></i></button>
                                    <button id="btnEditarTableProd" style="background: #e77a34; color: white;" class="btn btn-sm" disabled><i class="far fa-edit"></i></button>
                                    <button id="btnEliminarTableProd" style="background: #e77a34; color: white;" class="btn btn-sm" disabled><i class="fas fa-trash"></i></button>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php include '../controladores/obtener_productos.php'; ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>

            <div class="container-fluid pt-4 px-4">
                <div class="bg-personalizado text-center rounded p-4">
                    <div class="d-flex justify-content-center align-items-center mb-3">
                        <h5 class="mb-0">Busqueda por Sucursal</h5>
                    </div>
                    <div class="d-flex justify-content-center align-items-center text-center">
                        <select id="filtroSucursal" class="form-select form-select-sm" style="width: 150px;">
                            <option value="">Sucursales</option>
                            <option value="Galpon">Galpon</option>
                            <option value="Kirchner">Kirchner</option>
                            <option value="Centro">Centro</option>
                        </select>
                    </div>
                    <div class="table-responsive -xxl">
                        <table id="tableSucursal" class="table display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Nombre</th>
                                    <th>Sucursal</th>
                                    <th>Tamaño</th>
                                    <th>Medida</th>
                                    <th>Cantidad</th>
                                    <th>P. Venta</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>001</td>
                                    <td>Jabon en Polvo</td>
                                    <td>Galpon</td>
                                    <td>300</td>
                                    <td>Grs</td>
                                    <td>100</td>
                                    <td>363</td>
                                </tr>
                            </tbody>
                        </table>
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
                        <form action="../controladores/nuevo_producto.php" method="POST">
                            <div class="modal-body">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="codigo" class="form-label">Código</label>
                                            <input type="text" class="form-control" id="codigo" name="codigo" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="nombre" class="form-label">Nombre</label>
                                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="proveedor" class="form-label">Proveedor</label>
                                            <select class="form-select" id="proveedor" name="proveedor" required>
                                            <option value="" selected disabled>Seleccione un proveedor</option>
                                            <?php include '../controladores/obtener_proveedores.php'; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="tipoProducto" class="form-label">Tipo Producto</label>
                                            <label for="tipoCategoria" class="form-label">Tipo Categoria</label>
                                            <div class="input-group"> 
                                                <select class="form-select" id="tipoProducto" name="tipoProducto" required>
                                                    <option value="" selected disabled>Seleccione...</option>
                                                    <?php include '../controladores/obtener_tipoproducto.php'; ?>
                                                </select>
                                                <select class="form-select" id="tipoCategoria" name="tipoCategoria" required>
                                                    <option value="" selected disabled>Seleccione...</option>
                                                    <?php include '../controladores/obtener_prodcategoria.php'; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="tamaño" class="form-label">Tamaño</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" id="tamaño" name="tamaño" placeholder="Tamaño" required>
                                                <select class="form-select" id="tipoTamaño" name="tipoTamaño" style="width: 2px;" required>
                                                    <option value="" selected disabled>Seleccione una Medida</option required>
                                                    <?php include '../controladores/obtener_tipotamaño.php'; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="cantidad" class="form-label">Cantidad</label>
                                            <input type="number" class="form-control" id="cantidad" name="cantidad" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="precioBase" class="form-label">Precio Base</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                                <input type="number" class="form-control" id="precioBase" name="precioBase" requirede costo')">
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="porcentajeAumento" class="form-label">Porcentaje de Aumento</label>
                                            <!-- <label for="precioVenta" class="form-label">Precio Venta</label> -->
                                            <div class="input-group">
                                                <input style="width: 40px;" type="number" class="form-control" name="porcentajeAumento" id="porcentajeAumento" required>
                                                <!--<input style="width: 40px;" type="number" class="form-control" id="precioVenta">-->
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="sucursal" id="sucursalField" style="display: none;" class="form-label">Sucursal</label>
                                            <div class="input-group">
                                                <select class="form-select" id="sucursalField2" style="display: none;" name="sucursal" id="sucursal" style="width: 2px;" required>
                                                    <option value="" selected disabled>Seleccione una Sucursal</option>
                                                    <?php include '../controladores/obtener_sucursales.php'; ?>
                                                </select>
                                            </div>
                                            <div id="precioVentaField" style="display: none;">
                                                <label for="precioVenta" class="form-label">Precio Venta</label>
                                                <input style="width: 240px;" type="number" class="form-control" id="precioVenta">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div class="modal-footer">
                            <button id="btnCerrar" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button id="btnGuardar" type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal para eliminar registro -->
            <div class="modal fade" id="modalEliminarStock" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <button type="button" class="btn btn-danger">Eliminar</button>
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
        document.addEventListener("DOMContentLoaded", function() {
            // Inicializar la tabla DataTable
            var tableSucursal = $('#tableSucursal').DataTable({
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
                tableSucursal.column(2).search(filtro).draw();
            });
        });
    </script>

    <script>

        // Obtener elementos relevantes
            const precioVentaField = document.getElementById('precioVentaField');
            const sucursalField = document.getElementById('sucursalField');
            const sucursalField2 = document.getElementById('sucursalField2');
            const btnAgregarProd = document.getElementById('btnAgregarProd');
            const btnEditarTableProd = document.getElementById('btnEditarTableProd');
            const btnEliminarTableProd = document.getElementById('btnEliminarTableProd');

            // Función para mostrar u ocultar el campo de "Precio Venta"
            function togglePrecioVentaField(showPrecioVenta) {
            if (showPrecioVenta) {
                precioVentaField.style.display = 'block';
            } else {
                precioVentaField.style.display = 'none';
            }
            }

            // Función para mostrar u ocultar el campo de "Sucursal"
            function toggleSucursalField(showSucursal) {
            if (showSucursal) {
                sucursalField.style.display = 'block';
                sucursalField2.style.display = 'block';
            } else {
                sucursalField.style.display = 'none';
                sucursalField2.style.display = 'none';
            }}

            // Función para mostrar u ocultar el campo de "Sucursal" adicional
            function toggleSucursalField2(showSucursal) {
                if (showSucursal) {
                    // Muestra el campo de sucursal adicional (sucursalField2)
                    sucursalField2.style.display = 'block';
                } else {
                    // Oculta el campo de sucursal adicional (sucursalField2)
                    sucursalField2.style.display = 'none';
                }
            }


            // Manejar el evento de hacer clic en "Editar"
            btnEditarTableProd.addEventListener('click', function() {
            togglePrecioVentaField(true);
            toggleSucursalField(false);
            toggleSucursalField2(false);
            });

            // Manejar el evento de hacer clic en "Eliminar"
            btnEliminarTableProd.addEventListener('click', function() {
            togglePrecioVentaField(true);
            toggleSucursalField(false);
            toggleSucursalField2(false);
            });

            // Manejar el evento de hacer clic en "Agregar"
            btnAgregarProd.addEventListener('click', function() {
            togglePrecioVentaField(false);
            toggleSucursalField(true);
            toggleSucursalField2(true);
            });

            btnAgregarTableProd.addEventListener('click', function() {
            togglePrecioVentaField(true);
            toggleSucursalField(false);
            toggleSucursalField2(false);
            });



        function limpiarModal () {
            $('#codigo').val('');
            $('#nombre').val('');
            $('#proveedor').val('');
            $('#tipoProducto').val('');
            $('#tipoCategoria').val('');
            $('#tamaño').val('');
            $('#tipoTamaño').val('');
            $('#cantidad').val('');
            $('#precioBase').val('');
            $('#porcentajeAumento').val('');
            $('#precioVenta').val('');
            $('#sucursal').val('');
        }

        function btnOn () {
            $('#codigo').prop('disabled', false);
            $('#nombre').prop('disabled', false);
            $('#proveedor').prop('disabled', false);
            $('#tipoProducto').prop('disabled', false);
            $('#tipoCategoria').prop('disabled', false);
            $('#tamaño').prop('disabled', false);
            $('#tipoTamaño').prop('disabled', false);
            $('#precioBase').prop('disabled', false);
            $('#porcentajeAumento').prop('disabled', false);
            $('#precioVenta').prop('disabled', false);
            $('#sucursal').prop('disabled', false);
        }

        function btnDisabled () {
            $('#codigo').prop('disabled', true);
            $('#nombre').prop('disabled', true);
            $('#proveedor').prop('disabled', true);
            $('#tipoProducto').prop('disabled', true);
            $('#tipoCategoria').prop('disabled', true);
            $('#tamaño').prop('disabled', true);
            $('#tipoTamaño').prop('disabled', true);
            $('#precioBase').prop('disabled', true);
            $('#porcentajeAumento').prop('disabled', true);
            $('#precioVenta').prop('disabled', true);
            $('#sucursal').prop('disabled', true);
        }

        $(document).ready(function() {
            var tableProd = $('#tableProd').DataTable({
                select: {
                    style: 'single',
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

            let modoAgregar = true; // Modo por defecto: agregar
            btnAgregarProd.addEventListener('click', () => {
                limpiarModal()
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
                    $('#btnEditarTableProd').prop('disabled', true);
                    $('#btnEliminarTableProd').prop('disabled', true);

                } else {
                    tableProd.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                    $('#btnAgregarProd').prop('disabled', true);
                    // Mostrar el botón "Ver Detalles"
                    $('#btnAgregarTableProd').prop('disabled', false);
                    $('#btnEditarTableProd').prop('disabled', false);
                    $('#btnEliminarTableProd').prop('disabled', false);
                    // Obtener los datos del producto seleccionado
                    modoAgregar = false;
                    var rowData = tableProd.row($(this)).data();

                    // Limpiar los datos en el modal
                    limpiarModal()

                    // Llenar los elementos en el modal con los datos del producto
                    $('#codigo').val(rowData[0]);
                    $('#nombre').val(rowData[1]);
                    $('#proveedor').val(rowData[2]);
                    $('#tipoProducto').val(rowData[3]);
                    $('#tipoCategoria').val(rowData[4]);
                    $('#tipoTamaño').val(rowData[5]);
                    $('#tamaño').val(rowData[6]);
                    $('#cantidad').val(rowData[7]);
                    $('#precioBase').val(rowData[8]);
                    $('#porcentajeAumento').val(rowData[9]);
                    $('#precioVenta').val(rowData[10]);

                    // Acción cuando se hace clic en el modal
                    $('#btnAgregarTableProd').click(function() {
                        // Cambiar el contenido del label
                        $('#labelAgregarStock').text('Agregar Cantidad de Stock');
                        btnDisabled()
                        $('#modalAgregarProducto').modal('show');
                    });
                    $('#btnEditarTableProd').click(function() {
                        $('#labelAgregarStock').text('Editar Producto');
                        btnOn()
                        $('#modalAgregarProducto').modal('show');
                    });
                    $('#btnEliminarTableProd').click(function() {
                        $('#modalEliminarStock').modal('show');
                    });
                }
            });
            // Acción cuando se hace clic en el botón "Guardar" en el modal
            $('#btnGuardar').click(function(e) {
                console.log("entro al boton guardar")
                if (modoAgregar) {
                    console.log("entro al modo agregar")
                    e.preventDefault(); // Previene la acción predeterminada del botón (enviar el formulario)
                    // Obtén los datos del formulario
                    var codigo = $("#codigo").val();
                    var nombre = $("#nombre").val();
                    var proveedor = $("#proveedor").val();
                    var tipoProducto = $("#tipoProducto").val();
                    var tipoCategoria = $("#tipoCategoria").val();
                    var tamaño = $("#tamaño").val();
                    var tipoTamaño = $("#tipoTamaño").val();
                    var cantidad = $("#cantidad").val();
                    var precioBase = $("#precioBase").val();
                    var porcentajeAumento = $("#porcentajeAumento").val();
                    var sucursal = $("#sucursal").val();

                    // Realiza una solicitud Axios para enviar los datos al servidor
                    axios.post("../controladores/nuevo_producto.php", {
                        codigo: codigo,
                        nombre: nombre,
                        proveedor: proveedor,
                        tipoProducto: tipoProducto,
                        tipoCategoria: tipoCategoria,
                        tamaño: tamaño,
                        tipoTamaño: tipoTamaño,
                        cantidad: cantidad,
                        precioBase: precioBase,
                        porcentajeAumento: porcentajeAumento,
                        sucursal: sucursal
                    })
                    .then(function(response) {
                        // Maneja la respuesta del servidor
                        console.log(response),
                        console.log(response.data.message)
                        if (response.data.message == "success") {
                            console.log("entro")
                            // Redirigir al usuario a productos.php después de una respuesta exitosa
                            window.location.href = '../vistas/productos.php';
                            alert("CECI")
                            toastr.success("Hubo un error al insertar en StockSucursales", "Error");
                        } else if (response.data.message === "error_stock") {
                            // Manejar el caso de error en la respuesta, si es necesario
                            toastr.error("Hubo un error al insertar en StockSucursales", "Error");
                        }
                    })
                    .catch(function(error) {
                        // Maneja los errores de la solicitud Axios
                        console.error("Error en la solicitud Axios:", error);
                        toastr.error("Surgió un problema al intentar agregar el nuevo producto", "Error", {
                            closeButton: true,
                            positionClass: "toast-bottom-right",
                            preventDuplicates: true,
                            onclick: null,
                            showDuration: "300",
                            hideDuration: "1000",
                            timeOut: "4000",
                            extendedTimeOut: "1000",
                            showEasing: "swing",
                            hideEasing: "linear",
                            showMethod: "fadeIn",
                            hideMethod: "fadeOut"
                        });
                    });
                } else {
                    // Estás en modo de actualizar, llama a la función para actualizar el producto existente
                    // actualizarProducto();
                    console.log("ceci esta actualizando")
                }
                $('#modalAgregarProducto').modal('hide');
            });
        });
    </script>

    <style>
        .toast-warning {
            background-color: #e77a34 !important; /* Cambia el color a tu preferencia */
        }

        #tableProd tr.selected {
            background-color: #e77a34 !important;
            color: #fff !important;
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
            background-color: #e77a34; /* Cambia el color de fondo en el hover */
            border-color: #e77a34; /* Cambia el color del borde en el hover */
        }

    </style>

    <script src="../js/main.js"></script>
</body>

</html>
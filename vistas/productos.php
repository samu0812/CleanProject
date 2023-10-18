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
    <!-- Agrega estos enlaces en el head de tu HTML -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.6/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Incluir DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Incluir Bootstrap JS -->
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
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>

        <?php
        include "sidebar.php";
        ?>

        <div class="content">
            <?php
            include 'navbar.php';
            ?>

            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                        <div class="d-flex align-items-center justify-content-center p-4">
                            <button id="btnAgregarProd" type="button" style="background: #e77a34; color: white" class="btn btn-md" data-bs-toggle="modal" data-bs-target="#modalAgregarProducto">
                                <i class="fas fa-plus"></i> Agregar Producto
                            </button>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-8 col-xl-9"> <!-- Contenedor para las cartas de sucursales -->
                        <div class="row g-4" id="sucursalesContainer">
                            <!-- Aquí se agregarán las cartas dinámicamente -->
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
                                    <button id="btnAgregarTableProd" style="color: #e77a34;" class="btn btn-sm" disabled><i class="fas fa-plus"></i></button>
                                    <button id="btnEditarTableProd" style="color: #e77a34;" class="btn btn-sm" disabled><i class="far fa-edit"></i></button>
                                    <button id="btnEliminarTableProd" style="color: #e77a34;" class="btn btn-sm" disabled><i class="fas fa-trash"></i></button>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="tableProdBody">
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
                        <form id="formAgregarProducto">
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
                                                <input type="number" class="form-control" id="precioBase" name="precioBase" required>
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="porcentajeAumento" class="form-label">Porcentaje de Aumento</label>
                                            <div class="input-group d-flex justify-content-center align-items-center">
                                                <div class="custom-control custom-checkbox" style="margin-right: 10px;">
                                                    <input type="checkbox" class="custom-control-input" id="iva" name="iva" value="21">
                                                    <label class="custom-control-label" id="ivaLabel" for="iva">Iva</label>
                                                </div>

                                                <div class="custom-control custom-checkbox" style="margin-right: 10px;">
                                                    <input type="checkbox" class="custom-control-input" id="rentas" name="rentas" value="3">
                                                    <label class="custom-control-label" id="rentasLabel" for="rentas">Rentas</label>
                                                </div>

                                                <div class="mr-4">
                                                    <input style="width: 70px;" type="number" value="0.00" class="form-control" name="porcentajeAumento" id="porcentajeAumento" required min="0">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-4 mb-3">
                                            <label for="sucursal" id="sucursalField" style="display: none;" class="form-label">Sucursal</label>
                                            <div class="input-group">
                                                <select class="form-select" id="sucursalField2" style="display: none;" name="sucursal" id="sucursal" style="width: 2px;">
                                                    <option value="" selected disabled>Seleccione una Sucursal</option>
                                                    <?php include '../controladores/obtener_sucursales.php'; ?>
                                                </select>
                                            </div>
                                            <div id="precioVentaField" style="display: none;">
                                                <label for="precioVenta" class="form-label">Precio Venta</label>
                                                <input style="width: 240px;" value="0.00" type="number" class="form-control" id="precioVenta">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div class="modal-footer">
                            <button id="btnCerrar" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button id="btnGuardar" type="button" class="btn btn-primary">Guardar</button>
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
                            <button id="btnEliminar" type="button" class="btn btn-primary">Eliminar</button>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            include "footer.php";
            ?>

        </div>
        <a href="#" class="btn btn-lg btn-lg-square back-to-top" style="background: #e77a34; color: white"><i class="bi bi-arrow-up"></i></a>
    </div>

    <script>
        // Función para cargar las cartas de sucursales y cantidad de productos
        function cargarCartasSucursales() {
            fetch('../controladores/nuevo_producto.php?action=listarcards')
                .then(response => response.json())
                .then(data => {
                    const sucursalesContainer = document.getElementById('sucursalesContainer');

                    // Limpia el contenedor antes de agregar las cartas
                    sucursalesContainer.innerHTML = '';

                    // Iterar a través de los datos de las sucursales
                    data.forEach(sucursal => {
                        const carta = document.createElement('div');
                        carta.classList.add('col-lg-4'); // Agrega clase para columnas de Bootstrap

                        if (sucursal.Descripcion == "Galpon"){
                            carta.innerHTML = `
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
                                    <p class="mb-2">${sucursal.Descripcion}</p>
                                    <h6 class="mb-0">${sucursal.CantidadProductos}</h6>
                                </div>
                            </div>
                        `;
                        } else {
                            carta.innerHTML = `
                                <div class="bg-personalizado rounded d-flex align-items-center justify-content-center p-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" style="color: #e77a34" class="icon icon-tabler icon-tabler-building-warehouse" width="55" height="55" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M3 21v-13l9 -4l9 4v13"></path>
                                    <path d="M13 13h4v8h-10v-6h6"></path>
                                    <path d="M13 21v-9a1 1 0 0 0 -1 -1h-2a1 1 0 0 0 -1 1v3"></path>
                                    </svg>
                                    <div class="text-center" style="margin-left: 30px">
                                        <p class="mb-2">${sucursal.Descripcion}</p>
                                        <h6 class="mb-0">${sucursal.CantidadProductos}</h6>
                                    </div>
                                </div>
                            `;
                        }
                        sucursalesContainer.appendChild(carta);
                    });
                    obtenerProductos()
                })
                .catch(error => {
                    console.error('Error al obtener las sucursales: ', error);
                });
        }

        // Llama a la función para cargar las cartas cuando se carga la página
        window.addEventListener('load', cargarCartasSucursales);
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
        }}

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
        }}

        // Manejar el evento de hacer clic en "Editar"
        btnEditarTableProd.addEventListener('click', function() {
        togglePrecioVentaField(true);
        toggleSucursalField(false);
        toggleSucursalField2(false);
        $('#iva').hide(); // Ocultar el checkbox IVA
        $('#rentas').hide(); // Ocultar el checkbox Rentas
        $('#ivaLabel').hide(); // Ocultar el checkbox IVA
        $('#rentasLabel').hide(); // Ocultar el checkbox Rentas
        $('#porcentajeAumento').css('width', '230px');
        });

        // Manejar el evento de hacer clic en "Agregar"
        btnAgregarProd.addEventListener('click', function() {
        togglePrecioVentaField(false);
        toggleSucursalField(true);
        toggleSucursalField2(true);
        $('#iva').show(); // Ocultar el checkbox IVA
        $('#rentas').show(); // Ocultar el checkbox Rentas
        $('#ivaLabel').show(); // Ocultar el checkbox IVA
        $('#rentasLabel').show(); // Ocultar el checkbox Rentas
        $('#porcentajeAumento').css('width', '70px');
        });
        
        btnAgregarTableProd.addEventListener('click', function() {
        togglePrecioVentaField(false);
        toggleSucursalField(true);
        toggleSucursalField2(true);
        $('#iva').hide(); // Ocultar el checkbox IVA
        $('#rentas').hide(); // Ocultar el checkbox Rentas
        $('#ivaLabel').hide(); // Ocultar el checkbox IVA
        $('#rentasLabel').hide(); // Ocultar el checkbox Rentas
        $('#porcentajeAumento').css('width', '230px');
        });
    </script>
    
    <script>
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
            $('#iva').prop('checked', false);
            $('#rentas').prop('checked', false);
            $('#porcentajeAumento').val('0.00');
            $('#precioVenta').val('');
            $('#sucursalField2').val('');
        }

        function inputsActivos () {
            $('#codigo').prop('disabled', false);
            $('#nombre').prop('disabled', false);
            $('#proveedor').prop('disabled', false);
            $('#tipoProducto').prop('disabled', false);
            $('#tipoCategoria').prop('disabled', false);
            $('#tamaño').prop('disabled', false);
            $('#tipoTamaño').prop('disabled', false);
            $('#precioBase').prop('disabled', false);
            $('#iva').prop('disabled', false);
            $('#rentas').prop('disabled', false);
            $('#porcentajeAumento').prop('disabled', false);
            $('#precioVenta').prop('disabled', false);
            $('#sucursal').prop('disabled', false);
        }

        function inputsOcultos () {
            $('#codigo').prop('disabled', true);
            $('#nombre').prop('disabled', true);
            $('#proveedor').prop('disabled', true);
            $('#tipoProducto').prop('disabled', true);
            $('#tipoCategoria').prop('disabled', true);
            $('#tamaño').prop('disabled', true);
            $('#tipoTamaño').prop('disabled', true);
            $('#precioBase').prop('disabled', true);
            $('#iva').prop('disabled', true);
            $('#rentas').prop('disabled', true);
            $('#porcentajeAumento').prop('disabled', true);
            $('#precioVenta').prop('disabled', true);
            $('#sucursal').prop('disabled', true);
        }

        function btnOcultos (accion) {
            if (accion == "ocultos"){
                $('#btnAgregarTableProd').prop('disabled', true);
                $('#btnEditarTableProd').prop('disabled', true);
                $('#btnEliminarTableProd').prop('disabled', true);
            } else {
                $('#btnAgregarTableProd').prop('disabled', false);
                $('#btnEditarTableProd').prop('disabled', false);
                $('#btnEliminarTableProd').prop('disabled', false);
            }
        }

        function obtenerProductos() {
            // Inicializa DataTables al cargar la página
            $(document).ready(function() {
                if (table1 !== undefined && $.fn.DataTable.isDataTable('#tableProd')) {
                    table1.destroy();
                }
                table1 = $('#tableProd').DataTable({
                    select: {
                        style: 'single',
                    },
                    searching: true,
                    lengthChange: true,
                    ordering: true, // Habilita el ordenamiento de columnas
                    order: [[0, 'asc']], // Ordena la primera columna de forma ascendente (puedes cambiar '0' al índice de la columna que desees)
                    info: false,
                    columnDefs: [{
                        targets: -1, // Última columna (cambiar a la columna que desees)
                        orderable: false, // Deshabilita el ordenamiento en esta columna
                        }
                    ],
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
                $('#tableProd tbody td').css('color', 'black');
            });            
            // Realiza una solicitud Fetch para obtener los datos de los proveedores desde tu servidor
            fetch('../controladores/nuevo_producto.php?action=listar')
                .then(response => response.json())
                .then(data => {
                    //inicializo la tabla despues de cargar los datos
                    const tbody = tableProd.querySelector("tbody");
                    let productos = data
                    // Limpia el contenido actual de la tabla
                    table1.clear().draw();
                    let Vacio = "";
                    // Recorre los datos de los proveedores y crea filas para cada uno
                    productos.forEach(producto => {
                            const row = [
                                producto.idProductos,
                                producto.Nombre,
                                producto.Proveedor,
                                producto.TipoProd,
                                producto.TipoCat,
                                producto.Tamaño,
                                producto.Medida,
                                producto.CantidadTotal,
                                producto.PrecioCosto,
                                producto.Impuesto,
                                producto.PrecioFinal,
                                Vacio
                            ];
                            table1.rows.add([row]).draw();
                            //table1.clear().rows.add(row).draw();
                        });
                })
                .catch(error => {
                    console.error('Error al obtener los productos: ', error);
                });
        };

        function addProducto() {
            inputsActivos();
            const formularioProd = document.getElementById('formAgregarProducto');
            const datosFormularioProductos = new FormData(formularioProd);
            let iva = $('#iva').prop('checked');
            let rentas = $('#rentas').prop('checked');
            let impuesto = 0;

            if (iva && rentas) {
                impuesto = 1;
            } else if (iva) {
                impuesto = 2;
            } else if (rentas) {
                impuesto = 3;
            }

            // Puedes acceder a los valores de cada campo por su nombre
            const codigo = datosFormularioProductos.get('codigo');
            const nombre = datosFormularioProductos.get('nombre');
            const proveedor = datosFormularioProductos.get('proveedor');
            const tipoProducto = datosFormularioProductos.get('tipoProducto');
            const tipoCategoria = datosFormularioProductos.get('tipoCategoria');
            const tamaño = datosFormularioProductos.get('tamaño');
            const tipoTamaño = datosFormularioProductos.get('tipoTamaño');
            const cantidad = datosFormularioProductos.get('cantidad');
            const precioBase = datosFormularioProductos.get('precioBase');
            const porcentajeAumento = datosFormularioProductos.get('porcentajeAumento');
            const sucursal = datosFormularioProductos.get('sucursal');

            let contieneNumeros = /[0-9]/.test(nombre);
            let camposIncompletos = codigo === "" || nombre === "" || proveedor === "" || tipoProducto === "" || tipoCategoria === "" || tamaño === "" || tipoTamaño === "" || cantidad === "" || precioBase === "" || porcentajeAumento === "" || sucursal === "";

            // Verifica si debes mostrar el error por números en el nombre
            if (contieneNumeros || camposIncompletos) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: contieneNumeros ? 'El nombre no debe contener números.' : 'Todos los campos son requeridos. Por favor, completa todos los campos.',
                    showConfirmButton: true,
                    timer: 2000,
                    background: false,
                    backdrop: false,
                    customClass: {
                        container: 'custom-container-class',
                        popup: 'custom-popup-class',
                        title: 'custom-title-class',
                        icon: 'custom-icon-class',
                    },
                }).then((result) => {
                    if (result.isConfirmed) {
                        // El usuario hizo clic en el botón "Ok" de la alerta, permitir que modifiquen los datos
                        inputsActivos();
                        $('#btnGuardar').prop('disabled', false);
                        return;
                    }
                });
            } else {
                // El formulario es válido, procede con el envío de datos al servidor

                // Crea un objeto con los datos a enviar
                const datosProd = { codigo, nombre, proveedor, tipoProducto, tipoCategoria, tamaño, tipoTamaño, cantidad, precioBase, impuesto, porcentajeAumento, sucursal };

                // Hacer el fetch al backend
                fetch("../controladores/nuevo_producto.php?action=agregar", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify(datosProd)
                })
                    .then(response => response.json())
                    .then(data => {
                        if (!data.success) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: 'Error, ' + data.message,
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
                        } else {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Se ha añadido el producto correctamente',
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
                        obtenerProductos();
                        cargarCartasSucursales()
                        btnOcultos("ocultos")
                        $('#modalAgregarProducto').modal('hide');
                        $('#btnAgregarProd').prop('disabled', false);
                    })
                    .catch(error => {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: 'Ocurrió un error inesperado',
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
                    })
                    .finally(() => {
                        // Restablece el estado del botón "Guardar" después de un error
                        $('#btnGuardar').prop('disabled', false);
                        contextoActual = "agregarProducto";
                    });
            }
        }

        function addStock(){
            inputsActivos()
            const valoresEditados = {
                codigo: id,
                nombre: document.getElementById('nombre').value,
                proveedor: document.getElementById('proveedor').value,
                tipoProducto: document.getElementById('tipoProducto').value,
                tipoCategoria: document.getElementById('tipoCategoria').value,
                tamaño: document.getElementById('tamaño').value,
                tipoTamaño: document.getElementById('tipoTamaño').value,
                cantidad: document.getElementById('cantidad').value,
                precioBase: document.getElementById('precioBase').value,
                porcentajeAumento: document.getElementById('porcentajeAumento').value,
                sucursal: document.getElementById('sucursalField2').value,
            };
            fetch('../controladores/nuevo_producto.php?action=editarstock', {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(valoresEditados)
            } )
            .then(response => response.text())
            .then(data => {
                obtenerProductos()
                cargarCartasSucursales()
                // Cierra el modal de confirmación
                btnOcultos("ocultos")
                $('#modalAgregarProducto').modal('hide');
                $('#btnAgregarProd').prop('disabled', false);
                // mostramos el mensaje
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Se ha actualizado el stock correctamente',
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
            })
            .catch(error => {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Ocurrió un error',
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
            });
        }

        function editProducto() {
            inputsActivos();

            const codigoActual = document.getElementById('codigo').value.trim();
            const codigoOriginal = id.trim(); // El código original del producto
            let codigoOriginalPhp = id;

            if (!codigoActual || codigoActual.length === 0) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Ingrese el código.',
                    showConfirmButton: true,
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
                return; // Sale de la función si el campo no es válido
            }

            let contieneNumeros = /[0-9]/.test(document.getElementById('nombre').value.trim());

            if (contieneNumeros) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'El nombre no debe contener números.',
                    showConfirmButton: true,
                    timer: 2000,
                    background: false,
                    backdrop: false,
                    customClass: {
                        container: 'custom-container-class',
                        popup: 'custom-popup-class',
                        title: 'custom-title-class',
                        icon: 'custom-icon-class',
                    },
                }).then((result) => {
                    if (result.isConfirmed) {
                        // El usuario hizo clic en el botón "Ok" de la alerta, permitir que modifiquen los datos
                        inputsActivos();
                        $('#btnGuardar').prop('disabled', false);
                        return;
                    }
                });
            } else {
                if (codigoActual !== codigoOriginal) {
                    // Si el código ha cambiado, realizar la verificación en la base de datos
                    const valoresEditados = {codigo: codigoActual,};
                    fetch('../controladores/nuevo_producto.php?action=verificarcodigo', {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify(valoresEditados)
                    } )
                    .then(response => {
                        if (!response.ok) {
                            // El servidor devolvió un código de estado de error
                            throw new Error("Error en la solicitud al servidor");
                        }
                        return response.text();
                    })
                    .then(existe => {
                        if (existe) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: 'El código ya existe en la base de datos.',
                                showConfirmButton: true,
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
                        } else {
                            // El código no existe en la base de datos, podemos enviar los datos al servidor
                            const valoresEditados = {
                                codigo: codigoOriginalPhp, // Utilizamos el código original
                                nombre: document.getElementById('nombre').value,
                                proveedor: document.getElementById('proveedor').value,
                                tipoProducto: document.getElementById('tipoProducto').value,
                                tipoCategoria: document.getElementById('tipoCategoria').value,
                                tamaño: document.getElementById('tamaño').value,
                                tipoTamaño: document.getElementById('tipoTamaño').value,
                                cantidad: document.getElementById('cantidad').value,
                                precioBase: document.getElementById('precioBase').value,
                                porcentajeAumento: document.getElementById('porcentajeAumento').value,
                                precioVenta: document.getElementById('precioVenta').value,
                            };

                            fetch('../controladores/nuevo_producto.php?action=editar', {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/json"
                                },
                                body: JSON.stringify(valoresEditados)
                            })
                            .then(response => {
                                if (!response.ok) {
                                    // El servidor devolvió un código de estado de error
                                    // Forzar que se vaya por el catch
                                    throw new Error("Error en la solicitud al servidor");
                                }
                                return response.json();
                            })
                            .then(data => {
                                if (!data.success) {
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'error',
                                        title: 'Error, ' + data.message,
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
                                } else {
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        title: 'Se ha actualizado el producto correctamente',
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
                                    obtenerProductos()
                                    cargarCartasSucursales()
                                    // Cierra el modal de confirmación
                                    btnOcultos("ocultos")
                                    $('#modalAgregarProducto').modal('hide');
                                    $('#btnAgregarProd').prop('disabled', false);
                                }
                            })
                            .catch(error => {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'error',
                                    title: 'Ocurrió un error',
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
                            });
                        }
                    });
                } else {
                    // Si el código no ha cambiado, enviar los datos al servidor sin verificar la base de datos
                    const valoresEditados = {
                        codigo: codigoOriginal, // Utilizamos el código original
                        nombre: document.getElementById('nombre').value,
                        proveedor: document.getElementById('proveedor').value,
                        tipoProducto: document.getElementById('tipoProducto').value,
                        tipoCategoria: document.getElementById('tipoCategoria').value,
                        tamaño: document.getElementById('tamaño').value,
                        tipoTamaño: document.getElementById('tipoTamaño').value,
                        cantidad: document.getElementById('cantidad').value,
                        precioBase: document.getElementById('precioBase').value,
                        porcentajeAumento: document.getElementById('porcentajeAumento').value,
                        precioVenta: document.getElementById('precioVenta').value,
                    };

                    fetch('../controladores/nuevo_producto.php?action=editar', {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify(valoresEditados)
                    })
                        .then(response => {
                            if (!response.ok) {
                                // El servidor devolvió un código de estado de error
                                // Forzar que se vaya por el catch
                                throw new Error("Error en la solicitud al servidor");
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (!data.success) {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'error',
                                    title: 'Error, ' + data.message,
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
                            } else {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Se ha actualizado el producto correctamente',
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
                                obtenerProductos()
                                cargarCartasSucursales()
                                // Cierra el modal de confirmación
                                btnOcultos("ocultos")
                                $('#modalAgregarProducto').modal('hide');
                                $('#btnAgregarProd').prop('disabled', false);
                            }
                        })
                        .catch(error => {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: 'Ocurrió un error',
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
                        });
                }
            }
        }

        const tableProd = document.getElementById("tableProd");
        let table1;
        let contextoActual = null;
        obtenerProductos()
        cargarCartasSucursales()
        let id;
        $('#btnAgregarProd').click(function() {
            limpiarModal()
            contextoActual = "agregarProducto";
            $('#labelAgregarStock').text('Agregar Producto');
            $('#btnAgregarProd').prop('disabled', false);
        });
        $('#tableProd tbody').on('click', 'tr', function() {
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
                $('#labelAgregarStock').text('Agregar Producto');
                $('#btnAgregarProd').prop('disabled', false);
                inputsActivos()
                limpiarModal()
                $('#btnAgregarProd').click(function() {
                    contextoActual = "agregarProducto";
                });
                btnOcultos("ocultos")
            } else {
                table1.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
                $('#btnAgregarProd').prop('disabled', true);
                btnOcultos("mostrar")
                limpiarModal()
                $('#btnAgregarTableProd').click(function() {
                    contextoActual = "agregarTablaProducto";
                    $('#labelAgregarStock').text('Agregar Cantidad de Stock');
                    inputsOcultos()
                    limpiarModal()
                    $('#sucursalField2').val('');
                    $('#modalAgregarProducto').modal('show');
                    var filaSeleccionada = table1.rows('.selected').data()[0];
                    let valoresActuales = {};
                    id = filaSeleccionada[0];
                    fetch('../controladores/nuevo_producto.php?action=obtener&id=' + id)
                    .then(response => response.json())
                    .then(data => {
                        // Almacena los valores actuales antes de mostrar el modal
                        valoresActuales = {
                            codigo: String(data.idProductos),
                            nombre: String(data.Nombre),
                            proveedor: String(data.Proveedor),
                            tipoProducto: String(data.TipoProd),
                            tipoCategoria: String(data.TipoCat),
                            tamaño: String(data.Medida),
                            tipoTamaño: String(data.Tamaño),
                            precioBase: String(data.PrecioCosto),
                            porcentajeAumento: String(data.Impuesto)
                        };

                        // Llenar los campos del formulario de edición con los datos obtenidos
                        document.getElementById('codigo').value = valoresActuales.codigo;
                        document.getElementById('nombre').value = valoresActuales.nombre;
                        document.getElementById('proveedor').value = valoresActuales.proveedor;
                        document.getElementById('tipoProducto').value = valoresActuales.tipoProducto;
                        document.getElementById('tipoCategoria').value = valoresActuales.tipoCategoria;
                        document.getElementById('tamaño').value = valoresActuales.tamaño;
                        document.getElementById('tipoTamaño').value = valoresActuales.tipoTamaño;
                        document.getElementById('precioBase').value = valoresActuales.precioBase;
                        document.getElementById('porcentajeAumento').value = valoresActuales.porcentajeAumento;
                        $('#cantidad').prop('disabled', false);
                        // Mostrar el modal de edición
                        $('#modalAgregarProducto').modal('show');
                    })
                    .catch(error => {
                        console.error('Error al obtener datos del producto: ', error);
                    });
                });
                $('#btnEditarTableProd').click(function() {
                    // Obtén los elementos relevantes
                    const porcentajeAumentoInput = document.getElementById('porcentajeAumento');
                    const precioFinalInput = document.getElementById('precioVenta');
                    // Función para calcular y actualizar el precio final
                    function calcularPrecioFinal() {
                        const porcentajeAumento = parseFloat(porcentajeAumentoInput.value);
                        const precioBase = parseFloat(document.getElementById('precioBase').value); // Asegúrate de tener el ID correcto para el precio base
                        if (!isNaN(porcentajeAumento) && !isNaN(precioBase)) {
                            const precioFinal = precioBase * (1 + porcentajeAumento / 100);
                            precioFinalInput.value = precioFinal.toFixed(2); // Limita a dos decimales
                        } else {
                            precioFinalInput.value = '0.00';
                        }
                    }
                    // Agrega un evento de cambio al input del porcentaje
                    porcentajeAumentoInput.addEventListener('change', calcularPrecioFinal);
                    // Calcula el precio final inicialmente
                    calcularPrecioFinal();

                    contextoActual = "editarTablaProducto";
                    $('#labelAgregarStock').text('Editar Producto');
                    inputsActivos()
                    $('#modalAgregarProducto').modal('show');
                    var filaSeleccionada = table1.rows('.selected').data()[0];
                    let valoresActuales = {};
                    id = filaSeleccionada[0];
                    fetch('../controladores/nuevo_producto.php?action=obtener&id=' + id)
                        .then(response => response.json())
                        .then(data => {
                            // Almacena los valores actuales antes de mostrar el modal
                            valoresActuales = {
                                codigo: String(data.idProductos),
                                nombre: String(data.Nombre),
                                proveedor: String(data.Proveedor),
                                tipoProducto: String(data.TipoProd),
                                tipoCategoria: String(data.TipoCat),
                                tamaño: String(data.Medida),
                                tipoTamaño: String(data.Tamaño),
                                cantidad: String(data.CantidadTotal),
                                precioBase: String(data.PrecioCosto),
                                porcentajeAumento: String(data.Impuesto),
                                precioFinal: String(data.PrecioFinal),
                            };

                            // Llenar los campos del formulario de edición con los datos obtenidos
                            document.getElementById('codigo').value = valoresActuales.codigo;
                            document.getElementById('nombre').value = valoresActuales.nombre;
                            document.getElementById('proveedor').value = valoresActuales.proveedor;
                            document.getElementById('tipoProducto').value = valoresActuales.tipoProducto;
                            document.getElementById('tipoCategoria').value = valoresActuales.tipoCategoria;
                            document.getElementById('tamaño').value = valoresActuales.tamaño;
                            document.getElementById('tipoTamaño').value = valoresActuales.tipoTamaño;
                            document.getElementById('cantidad').value = valoresActuales.cantidad;
                            document.getElementById('precioBase').value = valoresActuales.precioBase;
                            document.getElementById('porcentajeAumento').value = valoresActuales.porcentajeAumento;
                            document.getElementById('precioVenta').value = valoresActuales.precioFinal;
                            $('#cantidad').prop('disabled', true);
                            // Mostrar el modal de edición
                            $('#modalEditarStock').modal('show');
                            $('#btnAgregarProd').prop('disabled', false);
                        })
                        .catch(error => {
                            console.error('Error al obtener datos del producto: ', error);
                        });
                });
            
                $('#btnEliminarTableProd').click(function() {
                    var filaSeleccionada = table1.rows('.selected').data()[0];
                    id = filaSeleccionada[0];
                    $('#modalEliminarStock').modal('show');
                    const datosProducto = {
                        id : id,
                    };
                    $('#btnEliminar').click(function() {
                        fetch("../controladores/nuevo_producto.php?action=eliminar", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json"
                            },
                            body: JSON.stringify(datosProducto)
                        })
                        .then(response => response.text())
                        .then(data => {
                            obtenerProductos()
                            cargarCartasSucursales()
                            // Cierra el modal de confirmación
                            $('#modalEliminarStock').modal('hide');
                            $('#btnAgregarProd').prop('disabled', false);
                            // mostramos el mensaje
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Se eliminó con éxito',
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
                        })
                        .catch(error => {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: 'Ocurrió un error',
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
                        });
                    })
                });
            }
        });

        $('#btnGuardar').click('click', function() {
            if (contextoActual === "agregarProducto") {
                addProducto()
            } else if (contextoActual === "agregarTablaProducto") {
                addStock()
            } else if (contextoActual === "editarTablaProducto") {
                editProducto()
            }
            $('#btnGuardar').prop('disabled', false);
        });
    </script>

    <style>
        /* Estilo personalizado para los checkboxes */
        .custom-checkbox {
            padding-left: 0; /* Elimina el espacio a la izquierda del checkbox */
        }

        .custom-checkbox .custom-control-input:checked ~ .custom-control-label::before {
            width: 1.25em; /* Ancho del checkbox cuando está marcado */
            height: 1.25em; /* Altura del checkbox cuando está marcado */
        }

        .custom-checkbox .custom-control-label::before {
            width: 1.25em; /* Ancho del checkbox por defecto */
            height: 1.25em; /* Altura del checkbox por defecto */
        }

        /* Estilo para el texto del checkbox */
        .custom-checkbox .custom-control-label::after {
            margin-left: 0.5em; /* Espacio entre el checkbox y el texto */
        }

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

    <!-- Table Libraries -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"></script>
    <script src="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css"></script>

    <!-- libreria toast -->
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="../js/main.js"></script>
</body>
</html>

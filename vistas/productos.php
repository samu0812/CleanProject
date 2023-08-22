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

    <!-- Template Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">

    <!-- Agrega estos enlaces en el head de tu HTML -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.11.6/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">

    
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


            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                        <div class="d-flex align-items-center justify-content-center p-4">
                            <button style="background: #e77a34; color: white" class="btn btn-md" data-bs-toggle="modal" data-bs-target="#modalAgregarProducto"><i class="fas fa-plus"></i> Agregar Producto</button>
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

                    <!-- Modal Agregar Producto-->
                    <div class="modal fade" id="modalAgregarProducto" tabindex="-1" aria-labelledby="modalAgregarProducto" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content" style="text-align: center;">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalAgregarProducto">Agregar Producto</h5>
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
                                                <label for="proveedor" class="form-label">Proveedor</label>
                                                <select class="form-select" id="proveedor">
                                                    <option value="" selected disabled>Seleccione un proveedor</option>
                                                    <option value="proveedor1">Proveedor 1</option>
                                                    <option value="proveedor2">Proveedor 2</option>
                                                    <option value="proveedor3">Proveedor 3</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label for="tipoProducto" class="form-label">Tipo de Producto</label>
                                                <select class="form-select" id="tipoProducto">
                                                    <option value="" selected disabled>Seleccione un tipo</option>
                                                    <option value="suelto">Suelto</option>
                                                    <option value="envasado">Envasado</option>
                                                    <option value="preparado">Preparado</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="tamaño" class="form-label">Tamaño</label>
                                                <div class="input-group">
                                                    <select class="form-select" id="tamaño" style="width: 2px;">
                                                        <option value="" selected disabled>Seleccione un tamaño</option>
                                                        <option value="centimetrosCubicos">Cm3</option>
                                                        <option value="litro">Lts</option>
                                                        <option value="gramos">Grs</option>
                                                        <option value="kilo">Kg</option>
                                                    </select>
                                                    <input type="text" class="form-control" id="cantidadTamaño" placeholder="Cantidad">
                                                </div>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label for="cantidad" class="form-label">Cantidad</label>
                                                <input type="number" class="form-control" id="cantidad">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label for="precioBase" class="form-label">Precio Base</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                                    <input type="number" class="form-control" id="precioBase">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="porcentajeAumento" class="form-label">Porcentaje para Aumentar</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control" id="porcentajeAumento">
                                                    <span class="input-group-text"><i class="fas fa-percent"></i></span>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="precioVenta" class="form-label">Precio de Venta</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                                    <input type="number" class="form-control" id="precioVenta">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="button" class="btn btn-primary">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- Sale & Revenue End -->
            <!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-personalizado text-center rounded p-4">
                    <div class="table-responsive -xxl">
                    <table id="tableProd" class="table table-striped" style="width:100%">
                        <h5>Busqueda de Productos</h5>
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Proveedor</th>
                                <th>Tipo</th>
                                <th>Tamaño</th>
                                <th>Cantidad</th>
                                <th>P. Base</th>
                                <th>%</th>
                                <th>P. Venta</th>
                                <th>
                                    <button style="background: #e77a34; color: white;" class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#modalActualizarStock"><i class="fas fa-plus"></i></button>
                                    <button style="background: #e77a34; color: white;" class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditarStock"><i class="far fa-edit"></i></button>
                                    <button style="background: #e77a34; color: white;" class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#modalEliminarStock"><i class="fas fa-trash"></i></button>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>001</td>
                                <td>Jabon en Polvo</td>
                                <td>LCL</td>
                                <td>Limpieza</td>
                                <td>300grs</td>
                                <td>200</td>
                                <td>$300</td>
                                <td>21</td>
                                <td>$363</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>002</td>
                                <td>Lavandina</td>
                                <td>LCL</td>
                                <td>Limpieza</td>
                                <td>300grs</td>
                                <td>200</td>
                                <td>$300</td>
                                <td>21</td>
                                <td>$363</td>
                                <td></td>
                            </tr>
                        </tbody>
                        <tfoot>
                        </tfoot>
                    </table>
                    </div>
                </div>
            </div>

            <!-- Modal de edición -->
            <div class="modal fade" id="modalEditarStock" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editar Producto</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Campos de edición con identificadores únicos -->
                            <input type="text" id="editCodigo" class="form-control" placeholder="Código">
                            <input type="text" id="editNombre" class="form-control" placeholder="Nombre">
                            <input type="text" id="editProveedor" class="form-control" placeholder="Proveedor">
                            <input type="text" id="editTipo" class="form-control" placeholder="Tipo">
                            <input type="text" id="editTamaño" class="form-control" placeholder="Tamaño">
                            <input type="text" id="editCantidad" class="form-control" placeholder="Cantidad">
                            <input type="text" id="editPrecioBase" class="form-control" placeholder="Precio Base">
                            <input type="text" id="editPorcentaje" class="form-control" placeholder="%">
                            <input type="text" id="editPrecioVenta" class="form-control" placeholder="Precio de Venta">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="container-fluid pt-4 px-4">
                <div class="bg-personalizado text-center rounded p-4">
                    <div class="table-responsive -xxl">
                        <table id="tableSucursal" class="table table-striped" style="width:100%">
                            <h5>Busqueda por Sucursal</h5>
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Nombre</th>
                                    <th>Sucursal</th>
                                    <th>Tamaño</th>
                                    <th>Cantidad</th>
                                    <th>P. Venta</th>
                                    <th>
                                        <button style="background: #e77a34; color: white;" class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#modalActualizarStock"><i class="fas fa-plus"></i></button>
                                        <button style="background: #e77a34; color: white;" class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditarStock"><i class="far fa-edit"></i></button>
                                        <button style="background: #e77a34; color: white;" class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#modalEliminarStock"><i class="fas fa-trash"></i></button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>001</td>
                                    <td>Jabon en Polvo</td>
                                    <td>Galpon</td>
                                    <td>300grs</td>
                                    <td>200</td>
                                    <td>$363</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>002</td>
                                    <td>Lavandina</td>
                                    <td>Kirchner</td>
                                    <td>300grs</td>
                                    <td>200</td>
                                    <td>$363</td>
                                    <td></td>
                                </tr>
                            </tbody>
                            <tfoot>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Modal para actualizar stock -->
            <div class="modal fade" id="modalActualizarStock" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Stock</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Contenido del modal para actualizar stock -->
                            <form>
                                <!-- Agrega aquí los inputs para actualizar el stock -->
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal para editar stock -->
            <div class="modal fade" id="modalEditarStock" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Stock</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Contenido del modal para actualizar stock -->
                            <form>
                                <!-- Agrega aquí los inputs para actualizar el stock -->
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal para eliminar registro -->
            <div class="modal fade" id="modalEliminarStock" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Confirm Delete</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete this record?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-danger">Delete</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Sales End -->

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

    <script>
        $(document).ready(function() {
            var table1 = $('#tableProd').DataTable({
                searching: true,      // Habilita la búsqueda estándar
                lengthChange: true,
                ordering: true,
                info: false,
                language: {
                    search: "",
                    searchPlaceholder: "Filtrar Productos",
                    lengthMenu: "Mostrar _MENU_ registros", // Cambia el texto del "Show x entries"
                    zeroRecords: "No se encontraron resultados",
                    info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
                    infoEmpty: "Mostrando 0 a 0 de 0 registros",
                    infoFiltered: "(filtrado de _MAX_ registros en total)"
                }
            });

            var table2 = $('#tableSucursal').DataTable({
                searching: true,    
                lengthChange: true,
                ordering: true,
                info: false,
                language: {
                    search: "",
                    searchPlaceholder: "Filtrar por sucursal",
                    lengthMenu: "Mostrar _MENU_ registros", // Cambia el texto del "Show x entries"
                    zeroRecords: "No se encontraron resultados",
                    info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
                    infoEmpty: "Mostrando 0 a 0 de 0 registros",
                    infoFiltered: "(filtrado de _MAX_ registros en total)"
                }
            });
        });
    </script>

    <style>
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
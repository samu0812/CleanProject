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
                    <div class="col-sm-6 col-xl-3">
                        <div class="d-flex align-items-center justify-content-center p-3">
                            <button class="btn btn-lg btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregarCategoria">Agregar Categoría</button>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="d-flex align-items-center justify-content-center p-3">
                            <button class="btn btn-lg btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregarCategoria">Agregar Categoría</button>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="modalAgregarProducto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Añadir Producto</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="nombreProducto" class="form-label">Nombre del Producto</label>
                                                <input type="text" class="form-control" id="nombreProducto">
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <label for="codigoBarras" class="form-label">Código de Barras</label>
                                                <input type="text" class="form-control" id="codigoBarras">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="proveedor" class="form-label">Proveedor</label>
                                                <select class="form-select" id="proveedor">
                                                    <option value="proveedor1">Proveedor 1</option>
                                                    <option value="proveedor2">Proveedor 2</option>
                                                    <!-- Agrega más opciones de proveedores aquí -->
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="precioBase" class="form-label">Precio Base</label>
                                                <input type="number" class="form-control" id="precioBase">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="precioVenta" class="form-label">Precio para Venta</label>
                                                <input type="number" class="form-control" id="precioVenta">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="cantidad" class="form-label">Cantidad</label>
                                                <input type="number" class="form-control" id="cantidad">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="categoria" class="form-label">Categoría</label>
                                                <input type="text" class="form-control" id="categoria">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="button" class="btn btn-primary">Guardar Producto</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-bar fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Productos Totales</p>
                                <h6 class="mb-0">$1234</h6>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-bar fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Productos Totales</p>
                                <h6 class="mb-0">$1234</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sale & Revenue End -->
            <!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
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
                                <th></th>
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
                                <td>
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalActualizarStock"><i class="fas fa-plus"></i></button>
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalEditarStock"><i class="far fa-edit"></i></button>
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalEliminarStock"><i class="fas fa-trash"></i></button>
                                </td>
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

            <div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="table-responsive -xxl">
                        <table id="tableSucursal" class="table table-striped" style="width:100%">
                            <h5>Busqueda por Sucursal</h5>
                            <div class="text-center d-flex justify-content-center mt-3 mb-3">
                                <select id="filtroSucursal" class="form-select form-control w-auto border">
                                    <option value="">Todas las sucursales</option>
                                    <option value="Galpón">Galpón</option>
                                    <option value="Kirchner">Kirchner</option>
                                    <option value="Kirchner">Centro</option>
                                </select>
                            </div>
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Nombre</th>
                                    <th>Sucursal</th>
                                    <th>Tamaño</th>
                                    <th>Cantidad</th>
                                    <th>P. Venta</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>001</td>
                                    <td>Jabon en Polvo</td>
                                    <td>Galpón</td>
                                    <td>300grs</td>
                                    <td>200</td>
                                    <td>$363</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalActualizarStock"><i class="fas fa-plus"></i></button>
                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalEditarStock"><i class="far fa-edit"></i></button>
                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalEliminarStock"><i class="fas fa-trash"></i></button>
                                    </td>
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
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
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
            var table = $('#tableSucursal').DataTable({
                searching: false,
                lengthChange: false,
                ordering: true,
                info: false
            });

            $('#filtroSucursal').on('change', function() {
                var filtro = $(this).val();
                table.column(2).search(filtro).draw(); // Cambia el número de columna según la posición de "Sucursal" en tu tabla
            });
        });
    </script>


    <!-- Template Javascript -->
    <script src="../js/main.js"></script>

</body>

</html>

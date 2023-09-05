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

    <!-- libreria toast -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    
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
            <div class="container-fluid pt-4 px-0">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3 custom-button-div">
                        <div class="d-flex align-items-center justify-content-center p-3">
                            <button class="botonAgregarProveedor" data-bs-toggle="modal" data-bs-target="#modalAgregarProducto"><i class="fa fa-truck me-1"></i>  Agregar Proveedor </button>
                        </div>
                    </div>

                    <!-- Modal Agregar Producto-->
                    <div class="modal fade" id="modalAgregarProducto" tabindex="-1" aria-labelledby="modalAgregarProducto" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content" style="text-align: center;">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalAgregarProducto">Agregar Proveedor</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="container">
                                        <div class="row">
                                        <form id="formAgregarProveedor">
                                                <div class="col-md-4 mb-3">
                                                    <label for="cuit" class="form-label">Cuit</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="fa fa-id-card"></i></span>
                                                        <input name="cuit" type="number" class="form-control" id="cuit" required>
                                                    </div>   
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="nombre" class="form-label">Nombre</label>              
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="fa fa-building"></i></span>
                                                        <input name="nombre" type="text" class="form-control" id="nombre" required>
                                                    </div>   
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="domicilio" class="form-label">Domicilio</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="fa fa-location-arrow"></i></span>
                                                        <input name="domicilio" type="text" class="form-control" id="domicilio" required>
                                                    </div>    
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <label for="telefono" class="form-label">Telefono</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                                        <input name="telefono" type="number" class="form-control" id="telefono" required>
                                                    </div>     
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="email" class="form-label">Email</label>              
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                                        <input name="email" type="text" class="form-control" id="email" required>
                                                    </div>       
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="ciudad" class="form-label">Ciudad</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="fa fa-map-marker"></i></span>
                                                        <input name="ciudad" type="text" class="form-control" id="ciudad" required>
                                                    </div>        
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <label for="precioBase" class="form-label">Razon Social</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="fa fa-briefcase"></i></span>
                                                        <input name="razonSocial" type="text" class="form-control" id="razonSocial" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="button" class="btn btn-secondary" id= "guardarProveedorBtn">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal de edición -->
            <div class="modal fade" id="modalEditarStock" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editar Producto</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Campos de edición con identificadores únicos -->                 
                            <div class="container">
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa fa-id-card"></i></span>
                                                    <input  type="text" id="editCuit" class="form-control" placeholder="Cuit">
                                                </div>   
                                            </div>
                                            <div class="col-md-4 mb-3">
                
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa fa-building"></i></span>
                                                    <input type="text" id="editNombre" class="form-control"  placeholder="Nombre">
                                                </div>   
                                            </div>
                                            <div class="col-md-4 mb-3">
        
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa fa-location-arrow"></i></span>
                                                    <input type="text" id="editDomicilio" class="form-control"  placeholder="Domicilio">
                                                </div>    
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
    
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                                    <input type="text" id="editTelefono" class="form-control"  placeholder="Telefono">
                                                </div>     
                                            </div>
                                            <div class="col-md-4 mb-3">            
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                                    <input type="text" id="editEmail" class="form-control"  placeholder="Email">
                                                </div>       
                                            </div>
                                            <div class="col-md-4 mb-3">

                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa fa-map-marker"></i></span>
                                                    <input type="text" id="editCiudad" class="form-control"  placeholder="Ciudad">
                                                </div>        
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
            
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa fa-briefcase"></i></span>
                                                    <input type="text" id="editRazonSocial" class="form-control"  placeholder="Razon Social">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="button" class="btn btn-secondary">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>

          <!-- Tabla de Proveedores -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-personalizado text-center rounded p-4">
                    <div class="table-responsive -xxl">
                    <table id="tableProveedores" class="table table-striped" style="width:100%">
                            <h5>Busqueda De Proveedores</h5>
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Cuit</th>
                                    <th>Nombre</th>
                                    <th>Domicilio</th>
                                    <th>Telefono</th>
                                    <th>Email</th>
                                    <th>Ciudad</th>
                                    <th>RazonSocial</th>
                                    <th>
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="proveedoresBody">
                                <!-- <tr>
                                    <td>001</td>
                                    <td>20334595968</td>
                                    <td>indio</td>
                                    <td>gonzalez</td>
                                    <td>3704112234</td>
                                    <td>indio@gmail.com</td>
                                    <td>chaco</td>
                                    <td>indio SOCIEDAD</td>
                                    <td class="d-flex justify-content-between">
                                        <button id="btnEditarTableProveedores" style="background: #e77a34; color: white;" class="btn btn-sm d-inline-block" data-bs-toggle="modal" data-bs-target="#modalEditarStock"><i class="far fa-edit"></i></button>
                                        <button id="btnEliminarTableProveedores" data-id="001" style="background: #e77a34; color: white;" class="btn btn-sm d-inline-block" data-bs-toggle="modal" data-bs-target="#modalEliminarStock"><i class="fas fa-trash"></i></button>
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td>002</td>
                                    <td>20444649328</td>
                                    <td>domitec</td>
                                    <td>Kirchner</td>
                                    <td>3704008834</td>
                                    <td>domitec@gmail.com</td>
                                    <td>formosa</td>
                                    <td>domitec SOCIEDAD</td>
                                    <td class="d-flex justify-content-between">
                                        <button id="btnEditarTableProveedores" style="background: #e77a34; color: white;" class="btn btn-sm d-inline-block" data-bs-toggle="modal" data-bs-target="#modalEditarStock"><i class="far fa-edit"></i></button>
                                        <button id="btnEliminarTableProveedores" data-id="002" style="background: #e77a34; color: white;" class="btn btn-sm d-inline-block" data-bs-toggle="modal" data-bs-target="#modalEliminarStock"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr> -->
                            </tbody>
                            <tfoot>
                            </tfoot>
                        </table>
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
                            ¿Estás seguro de que deseas eliminar este registro?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button id="confirmarEliminar" type="button" class="btn btn-danger">Eliminar</button>
                        </div>
                    </div>
                </div>
            </div>
                
            <!-- Modal de eliminacion exitosa -->
            <div class="modal fade" id="modalExitoEliminar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Eliminación Exitosa</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            El registro ha sido eliminado exitosamente.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
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

    <!-- libreria toast -->
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

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
    <script>
        function limpiarModal () {
            $('#cuit').val('');
            $('#nombre').val('');
            $('#domicilio').val('');
            $('#telefono').val('');
            $('#email').val('');
            $('#ciudad').val('');
            $('#razonSocial').val('');
        }

        function btnOn () {
            $('#cuit').prop('disabled', false);
            $('#nombre').prop('disabled', false);
            $('#domicilio').prop('disabled', false);
            $('#telefono').prop('disabled', false);
            $('#email').prop('disabled', false);
            $('#ciudad').prop('disabled', false);
            $('#razonSocial').prop('disabled', false);
        }

        function btnDisabled () {
            $('#cuit').prop('disabled', true);
            $('#nombre').prop('disabled', true);
            $('#domicilio').prop('disabled', true);
            $('#telefono').prop('disabled', true);
            $('#email').prop('disabled', true);
            $('#ciudad').prop('disabled', true);
            $('#razonSocial').prop('disabled', true);
        }

    //-----------------funcion que obtiene datos del registro y los inserta en los inputs-----------------//
    document.addEventListener("DOMContentLoaded", function() {
    const btnEditarTableProveedores = document.querySelectorAll("#btnEditarTableProveedores");

    btnEditarTableProveedores.forEach(button => {
        button.addEventListener("click", function() {
            const row = this.closest("tr"); // Obtenemos la fila más cercana al botón clickeado
            const cuit = row.cells[1].textContent;
            const nombre = row.cells[2].textContent;
            const domicilio = row.cells[3].textContent;
            const telefono = row.cells[4].textContent;
            const email = row.cells[5].textContent;
            const ciudad = row.cells[6].textContent;
            const razonSocial = row.cells[7].textContent;

            // Ahora tienes los valores de la fila en las variables correspondientes
            // Puedes usarlos para llenar el formulario de edición u otro propósito


            // Insertar los valores en los inputs de edición
            document.getElementById("editCuit").value = cuit;
            document.getElementById("editNombre").value = nombre;
            document.getElementById("editDomicilio").value = domicilio;
            document.getElementById("editTelefono").value = telefono;
            document.getElementById("editEmail").value = email;
            document.getElementById("editCiudad").value = ciudad;
            document.getElementById("editRazonSocial").value = razonSocial;

        });
    });
});

//-----------------funcion que obtiene el id del registro que quiere eliminarr-----------------//
document.addEventListener("DOMContentLoaded", function() {
    const btnEliminarTableProveedores = document.querySelectorAll("#btnEliminarTableProveedores");
    const confirmarEliminarButton = document.getElementById("confirmarEliminar");
    const modalExitoEliminar = new bootstrap.Modal(document.getElementById("modalExitoEliminar"));
    const modalEliminarStock = new bootstrap.Modal(document.getElementById("modalEliminarStock"));
    let selectedId = null;

    btnEliminarTableProveedores.forEach(button => {
        button.addEventListener("click", function() {
            selectedId = this.getAttribute("data-id");
        });
    });

    confirmarEliminarButton.addEventListener("click", function() {
        if (selectedId) {
            // Aquí puedes enviar el ID al backend para eliminar el registro
            console.log("Eliminar registro con ID:", selectedId);
            selectedId = null; // Reiniciar el valor para futuras acciones

            // Cerrar el modal de confirmación

            modalEliminarStock.hide();

            // Abrir el modal de éxito de eliminación
            modalExitoEliminar.show();

            // Cerrar el modal de éxito después de 3 segundos
            setTimeout(() => {
                modalExitoEliminar.hide();
            }, 3000);
        }
    });
});

//-----------------funcion obtener los datos del nuevo proveedor a agregar-----------------//
document.addEventListener("DOMContentLoaded", function() {
    const tableProveedores = document.getElementById("tableProveedores");
        let table1

        function obtenerProveedores() {
            // Inicializa DataTables al cargar la página
            $(document).ready(function() {
                if (table1 !== undefined && $.fn.DataTable.isDataTable('#tableProveedores')) {
                    table1.destroy();
                }
                table1 = $('#tableProveedores').DataTable({
                    searching: true,      // Habilita la búsqueda estándar
                    lengthChange: true,
                    ordering: true,
                    info: true,
                    lengthMenu: [ 5, 10, 15, 20 ], // Personaliza las opciones disponibles
                    language: {
                        search: "",
                        searchPlaceholder: "Filtrar proveedores",
                        zeroRecords: "No se encontraron resultados",
                        info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
                        infoEmpty: "Mostrando 0 a 0 de 0 registros",
                        infoFiltered: "(filtrado de MAX registros en total)"
                    }
                });

            });
            // Realiza una solicitud Fetch para obtener los datos de los proveedores desde tu servidor
            fetch('../controladores/proveedores.php?action=listar')
                .then(response => response.json())
                .then(data => {
                    //inicializo la tabla despues de cargar los datos
                    const tbody = tableProveedores.querySelector("tbody");
                    console.log(data);
                    let proveedores = data
                // Limpia el contenido actual de la tabla
                table1.clear().draw();

                // Recorre los datos de los proveedores y crea filas para cada uno
                proveedores.forEach(proveedor => {
                        const row = [
                            proveedor.idProveedores,
                            proveedor.Cuit,
                            proveedor.Nombre,
                            proveedor.Domicilio,
                            proveedor.Telefono,
                            proveedor.Email,
                            proveedor.Ciudad,
                            proveedor.RazonSocial,
                            `
                            <button id="btnEditarTableProveedores" data-id=${proveedor.idProveedores} style="background: #e77a34; color: white;" class="btn btn-sm d-inline-block" data-bs-toggle="modal" data-bs-target="#modalEditarStock"><i class="far fa-edit"></i></button>
                            <button id="btnEliminarTableProveedores" data-id=${proveedor.idProveedores} style="background: #e77a34; color: white;" class="btn btn-sm d-inline-block" data-bs-toggle="modal" data-bs-target="#modalEliminarStock"><i class="fas fa-trash"></i></button>
                            `
                        ];
                        table1.rows.add([row]).draw();
                        //table1.clear().rows.add(row).draw();
                    });
                })
                .catch(error => {
                    console.error('Error al obtener los proveedores: ', error);
                });
        }
    
    //llamamos a listar los proveedores
    obtenerProveedores()

        //obtenemos el boton de agregar y el formulario
        const modalAgregarProveedor= new bootstrap.Modal(document.getElementById("modalAgregarProducto"));

        const guardarProveedorBtn = document.querySelector("#guardarProveedorBtn");
        const formularioProveedor = document.getElementById('formAgregarProveedor');

        //capturamos cuando hace click al boton guardar
        guardarProveedorBtn.addEventListener("click", function(evento) {

            evento.preventDefault();
            // Crea un objeto FormData a partir del formulario
            const datosFormularioProveedor = new FormData(formularioProveedor);

            // Puedes acceder a los valores de cada campo por su nombre
            const cuit = datosFormularioProveedor.get('cuit');
            const nombre = datosFormularioProveedor.get('nombre');
            const domicilio = datosFormularioProveedor.get('domicilio');
            const telefono = datosFormularioProveedor.get('telefono');
            const email = datosFormularioProveedor.get('email');
            const ciudad = datosFormularioProveedor.get('ciudad');
            const razonSocial = datosFormularioProveedor.get('razonSocial');
            

            if (
                cuit === "" ||
                nombre === "" ||
                domicilio === "" ||
                telefono === "" ||
                email === "" ||
                ciudad === "" ||
                razonSocial === ""
            ) {
                // Muestra un mensaje de error
                alert("Todos los campos son requeridos. Por favor, completa todos los campos.");
                return; // Detiene el flujo si falta algún campo
            }

            // Crea un objeto con los datos a enviar
            const datosProveedor = {
                cuit,
                nombre,
                domicilio,
                telefono,
                email,
                ciudad,
                razonSocial
            };

            // hacemos el fetch al backend
            fetch("../controladores/proveedores.php?action=agregar", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify(datosProveedor)
                })
                .then(response => response.text())
                .then(data => {
                    // recargamos la tabla
                    obtenerProveedores()
                    // mostramos el mensaje
                    toastr.warning("Se ha añadido el usuario correctamente a la base de datos", "Usuario Registrado!" , {
                        "closeButton": true,
                        "positionClass": "toast-bottom-right",
                        "preventDuplicates": true,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "4000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    })
                    // cerramos el modal
                    modalAgregarProveedor.hide();

                })
                .catch(error => {
                    console.error("Error al enviar los datos: ", error);
                });

            

        });
    });

//-----------------funcion que limpia los inputs cuando apreta cerrar, pero los guarda temporalmente si le da a guardar y luego entra otra vez al modal de agregar-----------------//
    document.addEventListener("DOMContentLoaded", function() {
        const modalAgregarProducto = document.getElementById("modalAgregarProducto");
        const guardarProveedorBtn = document.getElementById("guardarProveedorBtn");

        // Variables para almacenar temporalmente los valores de los campos
        let tempInputValues = {};

        // Agrega un listener para el botón "Guardar" para almacenar temporalmente los valores
        guardarProveedorBtn.addEventListener('click', function() {
            // Obtiene todos los campos de entrada dentro del formulario
            const inputs = modalAgregarProducto.querySelectorAll("input");

            // Verifica si todos los campos requeridos están vacíos
            const someFieldsEmpty = Array.from(inputs).some(input => input.required && !input.value);

            if (someFieldsEmpty) {
                // Al menos un campo requerido está vacío, guarda los valores en tempInputValues
                inputs.forEach(input => {
                    tempInputValues[input.id] = input.value;
                });
            }
        });

        // Agrega un listener para el evento 'hidden.bs.modal' (se ejecuta cuando se cierra el modal)
        modalAgregarProducto.addEventListener('hidden.bs.modal', function () {
            // Obtiene todos los campos de entrada dentro del formulario
            const inputs = modalAgregarProducto.querySelectorAll("input");

            // Restaura los valores desde tempInputValues
            inputs.forEach(input => {
                if (tempInputValues.hasOwnProperty(input.id)) {
                    input.value = tempInputValues[input.id];
                } else {
                    input.value = '';
                }
            });

            // Limpia el almacenamiento temporal
            tempInputValues = {};
        });
    });

    </script>
    
</body>

</html>

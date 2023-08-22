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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    
    <!-- Agrega el enlace a la hoja de estilo de DataTables Select -->
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.7.0/css/select.dataTables.min.css">
    
    <!-- ... (otros enlaces a hojas de estilo y fuentes aquí) ... -->
    
    <!-- Agrega el enlace a la hoja de estilo de Bootstrap (ejemplo) -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">


    
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
                            <button class="btn btn-lg btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregarProducto">Agregar Nuevo Usuario</button>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xl-2">
                        <div class="bg-personalizado rounded d-flex align-items-center justify-content-between p-4 cursorPointer"onclick="redireccionar('empleados.php')">
                            <i class="fa fa-chart-pie fa-3x" style="color: #fa721c;"></i>
                            <div class="ms-3">
                                <p class="mb-2">Usuarios</p>
                                <?php
                                include '../bd/conexion.php';
                                $query = "SELECT COUNT(*) AS count FROM Empleado";
                                $result = $conn->query($query);
                                
                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                    $count = $row["count"];
                                    echo "<h6 class='mb-0'>$count</h6>";
                                } else {
                                    echo "0";
                                }
                                
                                
                                
                                ?>
                                
                            </div>
                        </div>
                    </div>

                    <!-- Modal Agregar Producto-->
                    
                    <div class="modal fade" id="modalAgregarProducto" tabindex="-1" aria-labelledby="modalAgregarProducto" aria-hidden="true">
                        <form class="form" action="" method="POST">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content" style="text-align: center;">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalAgregarProducto">Agregar Nuevo Usuario</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <label for="Nombre" class="form-label">Nombre</label>
                                                    <input type="text" class="form-control" name="Nombre">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="Email" class="form-label">Email</label>
                                                    <input type="email" class="form-control" name="Email">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="Telefono" class="form-label">Teléfono</label>
                                                    <input type="tel" class="form-control" name="Telefono">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="Direccion" class="form-label">Dirección</label>
                                                    <input type="text" class="form-control" name="Direccion">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="FechaNacimiento" class="form-label">Fecha de Nacimiento</label>
                                                    <input type="date" class="form-control" name="FechaNacimiento">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="DescripcionRol" class="form-label">Rol</label>
                                                    <select class="form-select" name="DescripcionRol">
                                                        <option value="" selected disabled>Seleccione un Rol</option>
                                                        <option value="Administrador">Administrador</option>
                                                        <option value="Cajero">Cajero</option>
                                                        <option value="Cajero">Repositor</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <label for="DescripcionSucursal" class="form-label">Sucursal</label>
                                                    <select class="form-select" name="DescripcionSucursal">
                                                        <option value="" selected disabled>Seleccione una Sucursal</option>
                                                        <option value="Sucursal1">Sucursal 1</option>
                                                        <option value="Sucursal2">Sucursal 2</option>
                                                        <option value="Sucursal3">Sucursal 3</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="Clave" class="form-label">Contraseña</label>
                                                    <input type="text" class="form-control" name="Clave">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <button type="submit" value="crearUsuario" name="crearUsuario" class="btn btn-primary">Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <?php include("../controladores/usuarios.php")?>
                    <!-- Parte de tu HTML -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="table-responsive -xxl">
            <table id="tableUsuario" class="table table-striped" style="width:100%">
                <h5>Lista de Usuarios</h5>
                <thead>
                    <tr>
                        <th>ID Persona</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Dirección</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Rol</th>
                        <th>Sucursal</th>
                        <th>                       
                            <button id="editarSeleccionados" class='btn btn-sm btn-primary' data-bs-toggle='modal'><i class='far fa-edit'></i></button>
                            <button class='btn btn-sm btn-primary' data-bs-toggle='modal' data-bs-target='#modalEliminarStock'><i class='fas fa-trash'></i></button>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Obtén los datos de la vista 
                    $query = "SELECT * FROM tablaUsuarios";
                    $result = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['idPersona'] . "</td>";
                        echo "<td>" . $row['Nombre'] . "</td>";
                        echo "<td>" . $row['Email'] . "</td>";
                        echo "<td>" . $row['Telefono'] . "</td>";
                        echo "<td>" . $row['Direccion'] . "</td>";
                        echo "<td>" . $row['FechaNacimiento'] . "</td>";
                        echo "<td>" . $row['Rol'] . "</td>";
                        echo "<td>" . $row['Sucursal'] . "</td>";
                        echo "<td></td>";
                        echo "</tr>";
                    }
                    ?>
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
                            <h5 class="modal-title" id="exampleModalLabel">Editar Usuario</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Campos de edición con identificadores únicos -->
                            <input type="text" id="editNombre" class="form-control" placeholder="Nombre">
                            <input type="text" id="editEmail" class="form-control" placeholder="Email">
                            <input type="text" id="editTelefono" class="form-control" placeholder="Teléfono">
                            <input type="text" id="editFechaNacimiento" class="form-control" placeholder="Fecha de Nacimiento">
                            <input type="text" id="editDireccion" class="form-control" placeholder="Direccion">
                            <input type="text" id="editRol" class="form-control" placeholder="Rol">
                            <input type="text" id="editSucursal" class="form-control" placeholder="Sucursal">
                            <input type="text" id="editClave" class="form-control" placeholder="Contraseña">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Modal para eliminar registro -->
            <div class="modal fade" id="modalEliminarStock" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Confirmar Acción</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ¿Estas seguro de que deseas eliminar este usuario?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-danger">Eliminar</button>
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
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    
    <!-- Agrega la librería DataTables -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    
    <!-- Agrega la extensión Select para DataTables -->
    <script src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>

    <script>
$(document).ready(function() {
    var table = $('#tableUsuario').DataTable({
        searching: true,
        lengthChange: true,
        ordering: true,
        info: true,
        language: {
            search: "",
            searchPlaceholder: "Filtrar Nombre",
            lengthMenu: "Mostrar _MENU_ registros",
            zeroRecords: "No se encontraron resultados",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            infoFiltered: "(filtrado de _MAX_ registros en total)"
        },
        select: {
            style: 'multi'
        }
    });

    $('#editarSeleccionados').click(function() {
        var selectedRows = table.rows('.selected').data(); // Obtiene los datos de las filas seleccionadas

        if (selectedRows.length > 0) {
            // Obtiene los datos de la primera fila seleccionada
            var rowData = selectedRows[0];
            
            // Llena los campos de edición con los valores de la fila seleccionada
            $('#editNombre').val(rowData[1]);
            $('#editEmail').val(rowData[2]);
            $('#editTelefono').val(rowData[3]);
            $('#editDireccion').val(rowData[4]);
            $('#editFechaNacimiento').val(rowData[5]);
            $('#editRol').val(rowData[6]);
            $('#editSucursal').val(rowData[7]);

            // Abre el modal de edición
            $('#modalEditarStock').modal('show');
        } else {
            alert('Por favor, seleccione al menos una fila para editar.');
        }
    });

    // Agrega el manejador de eventos para el botón "Guardar" dentro del modal de edición
    $('#modalEditarStock').on('click', '.btn-primary', function() {
        // Aquí puedes realizar la lógica para guardar los cambios en la fila seleccionada
        // Recopila los valores de los campos de edición y realiza la actualización en la base de datos
        var editNombre = $('#editNombre').val();
        var editEmail = $('#editEmail').val();
        var editTelefono = $('#editTelefono').val();
        var editDireccion = $('#editDireccion').val();
        var editFechaNacimiento = $('#editFechaNacimiento').val();
        var editRol = $('#editRol').val();
        var editSucursal = $('#editSucursal').val();
        
        // Luego, cierra el modal
        $('#modalEditarStock').modal('hide');
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
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

    <!-- Incluir jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>

    <!-- Incluir Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">

    <!-- Incluir DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <!-- Incluir tus estilos personalizados -->
    <link href="../css/style.css" rel="stylesheet">

    <!-- Incluir Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.min.js"></script>

    <!-- Incluir DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>


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
                            <button id="btnAgregarUser" style="background: #e77a34; color: white" class="btn btn-md" data-bs-toggle="modal" data-bs-target="#modalAgregarUsuario"><i class="fas fa-plus"></i> Agregar Usuario</button>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                        <div class="bg-personalizado rounded d-flex align-items-center justify-content-center p-4 cursorPointer" onclick="redireccionar('usuarios.php')">
                            <i class="fas fa-people-carry fa-2x" style="color: #e77a34"></i>
                            <div class="text-center" style="margin-left: 30px">
                                <p class="mb-2">Empleados Act.</p>
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

                </div>
            </div>

            <div class="container-fluid pt-4 px-4">
                <div class="bg-personalizado text-center rounded p-4">
                    <div class="table-responsive -xxl">
                    <table id="tableUser" class="table display" style="width:100%">
                        <h5>Busqueda de Productos</h5>
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
                            <th>Clave</th>
                                <th>
                                    <button id="btnEditarTableUsuario" style="background: #e77a34; color: white;" class="btn btn-sm" disabled><i class="far fa-edit"></i></button>
                                    <button id="btnEliminarTableUsuario" style="background: #e77a34; color: white;" class="btn btn-sm" disabled><i class="fas fa-trash"></i></button>
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
                        echo "<td> *** </td>";
                        echo "<td></td>";
                        echo "</tr>";
                    }
                    ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>

            
            <!-- Modal Agregar Producto-->
    <div class="modal fade" id="modalAgregarUsuario" tabindex="-1" aria-labelledby="modalAgregarUsuario" aria-hidden="true">
    <form class="form" action="" method="POST">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" style="text-align: center;">
                <div class="modal-header">
                    <h5 class="modal-title" id="labelAgregarUsuario">Agregar Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="Nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" name="Nombre" id="Nombre" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="Email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="Email" id="Email" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="Telefono" class="form-label">Teléfono</label>
                                <input type="tel" class="form-control" name="Telefono" id="Telefono" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="FechaNacimiento" class="form-label">Fecha de Nacimiento</label>
                                <input type="date" class="form-control" name="FechaNacimiento" id="FechaNacimiento" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="Direccion" class="form-label">Dirección</label>
                                <input type="text" class="form-control" name="Direccion" id="Direccion" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="DescripcionRol" class="form-label">Rol</label>
                                <select class="form-select" name="DescripcionRol" id="DescripcionRol"  required>
                                    <option value="" selected disabled>Seleccione un Rol</option>
                                    <option value="Administrador">Administrador</option>
                                    <option value="Cajero">Cajero</option>
                                    <option value="Repositor">Repositor</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="DescripcionSucursal" class="form-label">Sucursal</label>
                                <select class="form-select" name="DescripcionSucursal" id="DescripcionSucursal" required>
                                    <option value="" selected disabled>Seleccione una Sucursal</option>
                                    <option value="Sucursal1">Sucursal 1</option>
                                    <option value="Sucursal2">Sucursal 2</option>
                                    <option value="Sucursal3">Sucursal 3</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="Clave" class="form-label">Contraseña</label>
                                <input type="text" class="form-control" name="Clave" id="Clave" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="idPersona" class="form-label">Id Persona</label>
                                <input type="number" class="form-control" name="idPersona" id="idPersona">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- Cambio en el botón "Cerrar" del modal -->
                    <button id="btnCerrar" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <!-- Cambio en el botón "Guardar" del modal -->
                    <button type="submit" value="crearUsuario" id="btnCrearUsuario" name="crearUsuario" type="button" class="btn btn-primary">Guardar</button>
                    <button type="submit" value="UpdateUsuario" id="btnUpdateUsuario" name="UpdateUsuario" type="button" class="btn btn-primary" disabled>Actualizar</button>
                </div>
            </div>
        </div>
    </form>
</div>
<?php include("../controladores/usuarios.php");?>



            <!-- Modal para eliminar registro -->
            <div class="modal fade" id="modalEliminarUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Confirmar Eliminación</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ¿Está seguro de que desea eliminar este usuario?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-danger">Eliminar</button>
                        </div>
                    </div>
                </div>
                </form>

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

        function limpiarModal () {
            $('#Nombre').val('');
            $('#Email').val('');
            $('#Telefono').val('');
            $('#Direccion').val('');
            $('#FechaNacimiento').val('');
            $('#DescripcionRol').val('');
            $('#DescripcionSucursal').val('');
            $('#idPersona').val('');

            
        }

        function btnOn () {
            $('#Nombre').prop('disabled', false);
            $('#Email').prop('disabled', false);
            $('#Telefono').prop('disabled', false);
            $('#Direccion').prop('disabled', false);
            $('#FechaNacimiento').prop('disabled', false);
            $('#DescripcionRol').prop('disabled', false);
            $('#DescripcionSucursal').prop('disabled', false);
            $('#idPersona').prop('disabled', true);
        }

        function btnDisabled () {
            $('#Nombre').prop('disabled', true);
            $('#Email').prop('disabled', true);
            $('#Telefono').prop('disabled', true);
            $('#Direccion').prop('disabled', true);
            $('#FechaNacimiento').prop('disabled', true);
            $('#DescripcionRol').prop('disabled', true);
            $('#DescripcionSucursal').prop('disabled', true);
            $('#idPersona').prop('disabled', false);
        }

        $(document).ready(function() {
            var tableUser = $('#tableUser').DataTable({
                select: {
                    style: 'single'
                },
                searching: true,
                lengthChange: true,
                ordering: false ,
                info: false,
                language: {
                    search: "",
                    searchPlaceholder: "Filtrar Nombre",
                    lengthMenu: "Mostrar _MENU_ registros",
                    zeroRecords: "No se encontraron resultados",
                    info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
                    infoEmpty: "Mostrando 0 a 0 de 0 registros",
                    infoFiltered: "(filtrado de _MAX_ registros en total)"
                }
            });
            $('#idPersona').prop('disabled', true);


            $('#tableUser tbody').on('click', 'tr', function() {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                    $('#labelAgregarUsuario').text('Agregar Usuario');
                    $('#btnAgregarUser').prop('disabled', false);
                    $('#btnCrearUsuario').prop('disabled', false);
                    btnOn()
                    limpiarModal()
                    $('#idPersona').prop('disabled', true);
                    $('#btnUpdateUsuario').prop('disabled', true);
                    $('#btnEditarTableUsuario').prop('disabled', true);
                    $('#btnEliminarTableUsuario').prop('disabled', true);
                    $('#idPersona').prop('disabled', true);

                } else {
                    tableUser.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                    $('#btnAgregarUser').prop('disabled', true);
                    $('#btnCrearUsuario').prop('disabled', true);
                    // Mostrar el botón "Ver Detalles"
                    $('#idPersona').prop('disabled', true);
                    $('#btnUpdateUsuario').prop('disabled', false);
                    $('#btnEditarTableUsuario').prop('disabled', false);
                    $('#btnEliminarTableUsuario').prop('disabled', false);
                    // Obtener los datos del producto seleccionado
                    var rowData = tableUser.row($(this)).data();

                    // Limpiar los datos en el modal
                    limpiarModal()

                    // Llenar los elementos en el modal con los datos del producto
                    $('#idPersona').val(rowData[0]);
                    $('#Nombre').val(rowData[1]);
                    $('#Email').val(rowData[2]);
                    $('#Telefono').val(rowData[3]);
                    $('#Direccion').val(rowData[4]);
                    $('#FechaNacimiento').val(rowData[5]);
                    $('#DescripcionRol').val(rowData[6]);
                    $('#DescripcionSucursal').val(rowData[7]);

                    // Acción cuando se hace clic en el modal

                    $('#btnEditarTableUsuario').click(function() {
                    $('#labelAgregarUsuario').text('Editar Usuario');
                    btnOn();
                    $('#modalAgregarUsuario').modal('show');});
                    $('#btnEliminarTableUsuario').click(function() {
                        $('#modalEliminarUsuario').modal('show');
                    });

                // Acción cuando se hace clic en el botón "Guardar" en el modal
                    $('#btnUpdateUsuario').click(function() {
                        <?php include("../controladores/updateUsuarios.php");?>
                        // Aquí puedes agregar el código para guardar los datos si es necesario
                        // ...
                        // Cerrar el modal después de guardar los datos (si es necesario)
                        $('#idPersona').prop('disabled', false);
                        $('#modalAgregarUsuario').modal('hide');

                        
                    });
                    $('#btnCrearUsuario').click(function() {
                        // Aquí puedes agregar el código para guardar los datos si es necesario
                        // ...
                        // Cerrar el modal después de guardar los datos (si es necesario)
                        $('#idPersona').prop('disabled', false);
                        $('#modalAgregarUsuario').modal('hide');
                        
                    });
                    
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
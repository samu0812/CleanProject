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
    <link rel="shortcut icon" href="../img/cleaning2.ico">
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
    <!-- Agrega estos enlaces en el head de tu HTML -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">
    <!-- Table Libraries -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css"></script>
    <!-- Customized Bootstrap Stylesheet -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- Template Stylesheet -->
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
            include "navbar.php";
            ?>

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
                                <p class="mb-2">Usuarios Activos</p>
                                <div id="usuariosContainer">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="container-fluid pt-4 px-4">
                <div class="bg-personalizado text-center rounded p-4">
                    <div class="table-responsive -xxl">
                    <table id="tableUser" class="table display" style="width:100%">
                        <h5>Usuarios </h5>
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
                                <button id="btnEditarTableUsuario" style="color: #e77a34;" class="btn btn-sm"><i class="far fa-edit"></i></button>
                                <button id="btnEliminarTableUsuario" style="color: #e77a34;" class="btn btn-sm"><i class="fas fa-trash"></i></button>
                            </th>
                            </tr>
                        </thead>
                        <tbody id="usuariosBody">
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        
            <div class="modal fade" id="modalAgregarUsuario" tabindex="-1" aria-labelledby="modalAgregarUsuario" aria-hidden="true">
                <form id="formAgregarUsuario">
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
                                                <option value="" selected disabled>Seleccione un rol</option>
                                                <?php include '../controladores/obtener_rol.php'; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="DescripcionSucursal" class="form-label">Sucursal</label>
                                            <select class="form-select" name="DescripcionSucursal" id="DescripcionSucursal" required>
                                                <option value="" selected disabled>Seleccione una Sucursal</option>
                                                <?php include '../controladores/obtener_sucursales.php'; ?>
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
                            <button id="btnCerrar" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button id="btnGuardar" type="button" class="btn btn-primary">Guardar</button>
                        </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal fade" id="modalEliminarUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Confirmar Eliminación</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ¿Está seguro que quiere eliminar este usuario?
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

        </div>
            <a href="#" class="btn btn-lg btn-lg-square back-to-top" style="background: #e77a34; color: white"><i class="bi bi-arrow-up"></i></a>
        </div>
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

        function cargarCarta() {
            fetch('../controladores/usuariosActions.php?action=cargarcard')
                .then(response => response.json())
                .then(data => {
                    const numUsuarios = data;
                    const usuariosContainer = document.getElementById('usuariosContainer');
                    usuariosContainer.textContent = numUsuarios;
                    obtenerUsuarios()
                })
                .catch(error => {
                    console.error('Error al obtener las sucursales: ', error);
                });
        }

        function obtenerUsuarios() {
            $(document).ready(function () {
                if (table1 !== undefined && $.fn.DataTable.isDataTable('#tableUser')) {
                    table1.destroy();
                }
                table1 = $('#tableUser').DataTable({
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
                    lengthMenu: "Mostrar MENU registros",
                    zeroRecords: "No se encontraron resultados",
                    info: "Mostrando START a END de TOTAL registros",
                    infoEmpty: "Mostrando 0 a 0 de 0 registros",
                    infoFiltered: "(filtrado de MAX registros en total)"
                }
            });

            });
            // Realiza una solicitud Fetch para obtener los datos de los usuarios desde tu servidor
            fetch('../controladores/usuariosActions.php?action=listar')
                .then(response => response.json())
                .then(data => {
                    //inicializo la tabla despues de cargar los datos
                    const tbody = tableUser.querySelector("tbody");
                    let usuarios = data;
                    // Limpia el contenido actual de la tabla
                    table1.clear().draw();
                    let Vacio = "";
                    let claveMostrar = "***";
                    // Recorre los datos de los usuarios y crea filas para cada uno
                    usuarios.forEach(usuario => {
                        const row = [
                            usuario.idPersona,
                            usuario.Nombre,
                            usuario.Email,
                            usuario.Telefono,
                            usuario.Direccion,
                            usuario.FechaNacimiento,
                            usuario.Rol,
                            usuario.Sucursal,
                            Vacio
                        ];
                        table1.rows.add([row]).draw();
                        //table1.clear().rows.add(row).draw();
                    });
                })
                .catch(error => {
                    console.error('Error al obtener los usuarios: ', error);
                });
        }
        // Llama a la función para cargar las cartas cuando se carga la página
        window.addEventListener('load', cargarCarta);
        $('#idPersona').prop('disabled', true);
        const tableUser = document.getElementById("tableUser");
        let table1
        let contextoActual = null;
        obtenerUsuarios()
        cargarCarta()
        let id;
        let emailFila;
        $('#btnAgregarUser').click(function() {
            limpiarModal()
            contextoActual = "agregarUsuario";
            $('#labelAgregarUsuario').text('Agregar Usuario');
            $('#btnGuardar').prop('disabled', false);
        });
        $('#tableUser tbody').on('click', 'tr', function() {
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
                $('#labelAgregarUsuario').text('Agregar Usuario');
                btnOn()
                limpiarModal()
                $('#btnAgregarUser').prop('disabled', false);
                $('#btnAgregarUser').click(function() {
                    limpiarModal()
                    contextoActual = "agregarUsuario";
                    $('#labelAgregarUsuario').text('Agregar Usuario');
                    $('#btnGuardar').prop('disabled', false);
                });
                $('#idPersona').prop('disabled', true);
                $('#btnEditarTableUsuario').prop('disabled', true);
                $('#btnEliminarTableUsuario').prop('disabled', true);
            } else {
                table1.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
                $('#labelAgregarUsuario').text('Editar Usuario');
                $('#btnAgregarUser').prop('disabled', true);
                $('#idPersona').prop('disabled', true);
                $('#btnEditarTableUsuario').prop('disabled', false);
                $('#btnEliminarTableUsuario').prop('disabled', false);
                $('#btnEditarTableUsuario').click(function() {
                    $('#labelAgregarUsuario').text('Editar Usuario');
                    btnOn();
                    contextoActual = "editarUsuario";
                    var filaSeleccionadaEmail = table1.rows('.selected').data()[0];
                    emailFila = filaSeleccionadaEmail[2];
                    var filaSeleccionada = table1.rows('.selected').data()[0];
                    let valoresActuales = {};
                    id = filaSeleccionada[0];
                    fetch('../controladores/usuariosActions.php?action=obtener&id=' + id)
                        .then(response => response.json())
                        .then(data => {
                            valoresActuales = {
                                codigo: String(data.idPersona),
                                nombre: String(data.Nombre),
                                email: String(data.Email),
                                telefono: String(data.Telefono),
                                direccion: String(data.Direccion),
                                fechanacimiento: String(data.FechaNacimiento),
                                rol: String(data.Rol),
                                sucursal: String(data.Sucursal),
                                clave: String(data.Clave)
                            };
                            let vacio = "";
                            // Llenar los campos del formulario de edición con los datos obtenidos
                            document.getElementById('idPersona').value = valoresActuales.codigo;
                            document.getElementById('Nombre').value = valoresActuales.nombre;
                            document.getElementById('Email').value = valoresActuales.email;
                            document.getElementById('Telefono').value = valoresActuales.telefono;
                            document.getElementById('Direccion').value = valoresActuales.direccion;
                            document.getElementById('FechaNacimiento').value = valoresActuales.fechanacimiento;
                            document.getElementById('DescripcionRol').value = valoresActuales.rol;
                            document.getElementById('DescripcionSucursal').value = valoresActuales.sucursal;
                            document.getElementById('Clave').value = vacio;
                            // Mostrar el modal de edición
                            $('#modalAgregarUsuario').modal('show');
                            $('#btnAgregarUser').prop('disabled', false);
                        })
                        .catch(error => {
                            console.error('Error al obtener datos del producto: ', error);
                        });
                });
            
                $('#btnEliminarTableUsuario').click(function() {
                    // btnEliminar el boton que debe presionar
                    var filaSeleccionada = table1.rows('.selected').data()[0];
                    id = parseInt(filaSeleccionada[0]);
                    $('#modalEliminarUsuario').modal('show');
                    const datosUsuarioEliminar = {
                        id : id,
                    };
                    console.log(datosUsuarioEliminar);
                    $('#btnEliminar').click(function() {
                        console.log("a");
                        fetch("../controladores/usuariosActions.php?action=eliminar", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json"
                            },
                            body: JSON.stringify(datosUsuarioEliminar)
                        })
                        .then(response => response.json())
                        .then(data => {
                            console.log(data);
                            obtenerUsuarios()
                            cargarCarta()
                            // Cierra el modal de confirmación
                            $('#modalEliminarUsuario').modal('hide');
                            $('#btnAgregarUser').prop('disabled', false);
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

        function editUsuario() {
            emailActual = document.getElementById('Email').value;
            emailOriginal = emailFila; // El código original del producto
            const formularioUsuarios = document.getElementById('formAgregarUsuario');
            const datosFormularioUsuarios = new FormData(formularioUsuarios);
            const codigo = datosFormularioUsuarios.get('idPersona');
            const nombre = datosFormularioUsuarios.get('Nombre');
            const email = datosFormularioUsuarios.get('Email');
            const telefono = datosFormularioUsuarios.get('Telefono');
            const direccion = datosFormularioUsuarios.get('Direccion');
            const fechanacimiento = datosFormularioUsuarios.get('FechaNacimiento');
            const rol = datosFormularioUsuarios.get('DescripcionRol');
            const sucursal = datosFormularioUsuarios.get('DescripcionSucursal');
            const clave = datosFormularioUsuarios.get('Clave');
            let contieneNumeros = /[0-9]/.test(document.getElementById('Nombre').value.trim());
            let camposIncompletos = nombre === "" || email === "" || telefono === "" || direccion === "" || fechanacimiento === "" || rol === "" || sucursal === "" || clave === "";

            if (!emailActual || emailActual.length === 0) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Ingrese el email.',
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
                        $('#btnGuardar').prop('disabled', false);
                        return;
                    }
                });
            } else {
                if (emailActual !== emailOriginal) {
                    // Si el código ha cambiado, realizar la verificación en la base de datos
                    const valoresEditados = {email: emailActual};
                    fetch('../controladores/usuariosActions.php?action=verificaremail', {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify(valoresEditados)
                    })
                    .then(response => {
                        if (!response.ok) {
                            // El servidor devolvió un código de estado de error
                            throw new Error("Error en la solicitud al servidor");
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (!data.success) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: 'El correo ya existe en la base de datos.',
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
                                codigo: document.getElementById('idPersona').value, // Utilizamos el código original
                                nombre: document.getElementById('Nombre').value,
                                email: emailActual,
                                telefono: document.getElementById('Telefono').value,
                                direccion: document.getElementById('Direccion').value,
                                fechanacimiento: document.getElementById('FechaNacimiento').value,
                                rol: document.getElementById('DescripcionRol').value,
                                sucursal: document.getElementById('DescripcionSucursal').value,
                                clave: document.getElementById('Clave').value
                            };
                            fetch('../controladores/usuariosActions.php?action=editar', {
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
                                    obtenerUsuarios()
                                    cargarCarta()
                                    $('#modalAgregarUsuario').modal('hide');
                                    $('#btnAgregarUser').prop('disabled', false);
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
                } else {
                    // Si el código no ha cambiado, enviar los datos al servidor sin verificar la base de datos
                    const valoresEditados = {
                        codigo: document.getElementById('idPersona').value, // Utilizamos el código original
                        nombre: document.getElementById('Nombre').value,
                        email: emailOriginal,
                        telefono: document.getElementById('Telefono').value,
                        direccion: document.getElementById('Direccion').value,
                        fechanacimiento: document.getElementById('FechaNacimiento').value,
                        rol: document.getElementById('DescripcionRol').value,
                        sucursal: document.getElementById('DescripcionSucursal').value,
                        clave: document.getElementById('Clave').value,
                    };
                    console.log(valoresEditados)
                    fetch('../controladores/usuariosActions.php?action=editar', {
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
                                title: 'Se ha actualizado el usuario correctamente',
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
                            obtenerUsuarios()
                            cargarCarta()
                            $('#modalAgregarUsuario').modal('hide');
                            $('#btnAgregarUser').prop('disabled', false);
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

        function addUsuario() {
            const formularioUsuarios = document.getElementById('formAgregarUsuario');
            const datosFormularioUsuarios = new FormData(formularioUsuarios);
            // Puedes acceder a los valores de cada campo por su nombre
            const id = datosFormularioUsuarios.get('idPersona');
            const nombre = datosFormularioUsuarios.get('Nombre');
            const email = datosFormularioUsuarios.get('Email');
            const telefono = datosFormularioUsuarios.get('Telefono');
            const direccion = datosFormularioUsuarios.get('Direccion');
            const fechanacimiento = datosFormularioUsuarios.get('FechaNacimiento');
            const rol = datosFormularioUsuarios.get('DescripcionRol');
            const sucursal = datosFormularioUsuarios.get('DescripcionSucursal');
            const clave = datosFormularioUsuarios.get('Clave');
            const regexNombre = /^[a-zA-Z\s'-]+$/; // Acepta letras, espacios, apóstrofes y guiones bajos
            const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const regexTelefono = /^(?:\+\d{1,3})?(?:\d{1,4})?(?:[ -]?\d{1,4}){1,12}$/;
            // let contieneNumeros = /[0-9]/.test(nombre);
            let camposIncompletos = nombre === "" || email === "" || telefono === "" || direccion === "" || fechanacimiento === "" || rol === "" || sucursal === "" || clave === "";
            // Verifica si debes mostrar el error por números en el nombre
            if (camposIncompletos) { 
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Todos los campos son requeridos. Por favor, completa todos los campos.', 
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
                        $('#btnGuardar').prop('disabled', false);
                        return;
                    }
                });
            } else if (nombre.trim() === '' || !regexNombre.test(nombre)) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Ha ingresado incorrectamente el nombre.',
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
                        $('#btnGuardar').prop('disabled', false);
                        return;
                    }
                });
            } else if (email.trim() === '' || !regexEmail.test(email)) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Ha ingresado un mail incorrecto.',
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
                        $('#btnGuardar').prop('disabled', false);
                        return;
                    }
                });
            } else if (!regexTelefono.test(telefono) || telefono.length < 10 ) { // 3704 3362 64
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Ha ingresado un telefono incorrecto. Recuerda que debe contener 10 caracteres.',
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
                        $('#btnGuardar').prop('disabled', false);
                        return;
                    }
                });
            } else {
                const datosUsuarios = {nombre, email, telefono, direccion, fechanacimiento, rol, sucursal, clave};
                console.log(datosUsuarios)
                // Hacer el fetch al backend
                fetch("../controladores/usuariosActions.php?action=agregar", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify(datosUsuarios)
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data)
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
                            title: 'Se ha añadido el usuario correctamente',
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
                        obtenerUsuarios();
                        cargarCarta()
                        $('#modalAgregarUsuario').modal('hide');
                        $('#btnAgregarUser').prop('disabled', false);
                    }
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
                    contextoActual = "agregarUsuario";
                });
            }
        }

        $('#btnGuardar').click('click', function() {
            if (contextoActual === "agregarUsuario") {
                addUsuario()
            } else if (contextoActual === "editarUsuario") {
                editUsuario()
            } else if (contextoActual === "eliminarUsuario") {
                deleteUsuario()
            }
            $('#btnGuardar').prop('disabled', false);
        });
                
    </script>

    <style>
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
    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/chart/chart.min.js"></script>
    <script src="../lib/easing/easing.min.js"></script>
    <script src="../lib/waypoints/waypoints.min.js"></script>
    <script src="../lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="../lib/tempusdominus/js/moment.min.js"></script>
    <script src="../lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="../lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="../js/main.js"></script>
</body>
</html>
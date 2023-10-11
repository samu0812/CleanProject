<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Clean</title>
    <link rel="shortcut icon" href="../img/logoCleanIco.ico"> 
    
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script src="https://kit.fontawesome.com/8c68749bc1.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <!-- Template Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border" style="color: #e77a34" style="width: 3rem; height: 3rem;" role="status">
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
                    <div class="bg-personalizado rounded d-flex align-items-center justify-content-center p-4 cursorPointer" onclick="abrirModal('rol')">
                        <i class="fas fa-people-carry fa-2x" style="color: #e77a34"></i>
                        <div class="text-center" style="margin-left: 30px">
                            <p class="mb-2">Roles</p>
                            <h6 id="rolCard" class="mb-0"></h6>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                    <div class="bg-personalizado rounded d-flex align-items-center justify-content-center p-4 cursorPointer" onclick="abrirModal('sucursal')">
                        <i class="fa-solid fa-shop fa-2xl" style="color: #e77a34;"></i>
                        <div class="text-center" style="margin-left: 30px">
                            <p class="mb-2">Sucursales</p>
                            <h6 id="sucursalCard" class="mb-0"></h6>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                    <div class="bg-personalizado rounded d-flex align-items-center justify-content-center p-4 cursorPointer" onclick="abrirModal('tipoproducto')">
                        <i class="fas fa-boxes fa-3x" style="color: #e77a34"></i>
                        <div class="text-center" style="margin-left: 30px">
                        <p class="mb-2">Tipo Productos</p>
                            <h6 id="tipoProductoCard" class="mb-0"></h6>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                    <div class="bg-personalizado rounded d-flex align-items-center justify-content-center p-4 cursorPointer" onclick="abrirModal('tipocategoria')">
                        <i class="fa-solid fa-layer-group fa-2xl" style="color: #e77a34"></i>
                        <div class="text-center" style="margin-left: 30px">
                            <p class="mb-2">Categorías</p>
                            <h6 id="tipoCategoriaCard" class="mb-0"></h6>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                    <div class="bg-personalizado rounded d-flex align-items-center justify-content-center p-4 cursorPointer" onclick="abrirModal('tipotamaño')">
                        <i class="fa-solid fa-chart-simple fa-2xl" style="color: #e77a34"></i>
                        <div class="text-center" style="margin-left: 30px">
                            <p class="mb-2">Tamaños</p>
                            <h6 id="tamañoCard" class="mb-0"></h6>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                    <div class="bg-personalizado rounded d-flex align-items-center justify-content-center p-4 cursorPointer" onclick="abrirModal('formadepago')">
                    <i class="fa-regular fa-credit-card fa-2xl" style="color: #e77a34"></i>
                        <div class="text-center" style="margin-left: 30px">
                            <p class="mb-2">Formas de Pago</p>
                            <h6 id="formaPagoCard" class="mb-0"></h6>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                    <div class="bg-personalizado rounded d-flex align-items-center justify-content-center p-4 cursorPointer" onclick="abrirModal('tipodedocumento')">
                        <i class="fa-regular fa-file-lines fa-2xl"  style="color: #e77a34"></i>
                        <div class="text-center" style="margin-left: 30px">
                            <p class="mb-2">Documentos</p>
                            <h6 id="documentoCard" class="mb-0"></h6>
                        </div>
                    </div>
                </div>

                <!-- Modal para agregar nuevo dato -->
                <div class="modal fade" id="nuevoDatoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Agregar Nuevo Dato</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Formulario para ingresar nueva descripción -->
                                <form id="nuevoDatoForm">
                                    <div class="mb-3">
                                        <label for="nuevaDescripcion" class="form-label">Descripción:</label>
                                        <input type="text" class="form-control" id="nuevaDescripcion" name="nuevaDescripcion" required>
                                    </div>
                                    <div class="mb-3" id="abreviaturaContainer" style="display: none;">
                                        <label for="nuevaAbreviatura" class="form-label">Abreviatura:</label>
                                        <input type="text" class="form-control" id="nuevaAbreviatura" name="nuevaAbreviatura" required>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-primary" id="guardarDato">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal para editar datos existentes -->
                <div class="modal fade" id="editarDatoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Editar Dato</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="editarDatoForm">
                                    <div class="mb-3">
                                        <label for="editarID" class="form-label">ID:</label>
                                        <input type="text" class="form-control" id="editarID" name="editarID" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label for="editarDescripcion" class="form-label">Descripción:</label>
                                        <input type="text" class="form-control" id="editarDescripcion" name="editarDescripcion" required>
                                    </div>
                                    <div class="mb-3" id="editarAbreviaturaContainer" style="display: none;">
                                        <label for="editarAbreviatura" class="form-label">Abreviatura:</label>
                                        <input type="text" class="form-control" id="editarAbreviatura" name="editarAbreviatura" required>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-primary" id="guardarEdicionDato">Guardar Cambios</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-fluid pt-4 px-4">
                    <div class="bg-personalizado text-center rounded p-4">
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <select id="seleccionarDato" class="form-select">
                                <option value="" disabled selected>Selecciona una opción</option>
                                    <option value="rol" data-table="miDataTable" data-modal="nuevoDatoModal">Rol</option>
                                    <option value="sucursal">Sucursal</option>
                                    <option value="tipoproducto">Tipo de Producto</option>
                                    <option value="tipocategoria">Tipo de Categoría</option>
                                    <option value="tipotamaño">Tamaño y Abreviatura</option>
                                    <option value="formadepago">Forma de Pago</option>
                                    <option value="tipodedocumento">Tipo de Documento</option>
                                </select>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                        <div class="table-responsive -xxl mt-4">
                            <table id="miDataTable" class="table display" style="width:100%">
                                <thead>
                                    <tr>
                                    </tr>
                                </thead>
                                <tbody class="selectable">
                                    <!-- Los datos de la tabla se cargarán aquí -->
                                </tbody>
                            </table>
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
        var tipoSeleccionado = ""; // Variable global para almacenar el tipo seleccionado

        function abrirModal(tipo) {
            tipoSeleccionado = tipo; // Almacena el tipo seleccionado en la variable global
            $('#nuevoDatoModal').modal('show'); // Abre el modal
            if (tipoSeleccionado === 'tipotamaño') {
                abreviaturaContainer.style.display = 'block'; // Mostrar el input de abreviatura
            } else {
                abreviaturaContainer.style.display = 'none'; // Ocultar el input de abreviatura para otras opciones
            }
        }
        $(document).ready(function() {
            // Llama a la función para cargar inicialmente el contenido de las tarjetas
            actualizarTarjetas();
        });



        $(document).ready(function() {
                // Escucha cambios en el select
                $('#seleccionarDato').on('change', function() {
                    // Obtiene el valor seleccionado
                    var selectedOption = $(this).val();

                    // Verifica si la opción seleccionada no es la inicial
                    if (selectedOption !== "") {
                        // Habilita el botón "Nuevo Dato"
                        $('#guardarNuevoDato').prop('disabled', false);
                    } else {
                        // Deshabilita el botón "Nuevo Dato"
                        $('#guardarNuevoDato').prop('disabled', true);
                    }
                });
            });
// Agregar un evento 'click' a las filas de la tabla
// Agregar un evento 'click' a las filas de datos en la tabla
$(document).ready(function() {
    $('#miDataTable').on('click', 'tbody tr', function() {
        // Desmarca todas las filas previamente seleccionadas
        $('#miDataTable tbody tr').removeClass('selected');

        // Marca la fila clicada como seleccionada
        $(this).addClass('selected');

        // Habilitar o deshabilitar los botones de editar y eliminar según si hay una fila seleccionada
        var hayFilaSeleccionada = $('#miDataTable tbody tr.selected').length > 0;
        $('#btnEditar, #btnEliminar').prop('disabled', !hayFilaSeleccionada);
    });
});
            

        document.getElementById('seleccionarDato').addEventListener('change', function() {
        var selectedOption = this.value;
        var tableHead = document.querySelector('#miDataTable thead tr');
        var tableBody = document.querySelector('#miDataTable tbody');
        var abreviaturaContainer = document.getElementById('abreviaturaContainer'); // Elemento del input de abreviatura

        // Limpiar el encabezado y el cuerpo de la tabla
        tableHead.innerHTML = '';
        tableBody.innerHTML = '';

        if (selectedOption === 'tipotamaño') {
            abreviaturaContainer.style.display = 'block'; // Mostrar el input de abreviatura
        } else {
            abreviaturaContainer.style.display = 'none'; // Ocultar el input de abreviatura para otras opciones
        }


        // Agregar encabezado según la opción seleccionada
// Agrega este código en el caso correspondiente
switch (selectedOption) {
    case 'rol':
    case 'sucursal':
    case 'tipoproducto':
    case 'tipocategoria':
    case 'formadepago':
    case 'tipodedocumento':
        tableHead.innerHTML = '<th>ID</th><th>Descripción</th><th><button id="btnEditar" style="color: #e77a34;" class="btn btn-sm" disabled><i class="far fa-edit"></i></button><button id="btnEliminar" style="color: #e77a34;" class="btn btn-sm" disabled><i class="fas fa-trash"></i></button></th>';
        
        // Asocia el evento 'click' al botón "Eliminar" dentro de este caso
        $('#btnEliminar').on('click', function() {
            // Obtener el ID y la opción seleccionada
            var filaSeleccionada = $('#miDataTable tbody tr.selected');
            var id = filaSeleccionada.find('td:first').text();
            var opcion = $('#seleccionarDato').val();

            if (filaSeleccionada.length > 0) {
                eliminarDato(id, opcion);
            } else {
                alert('Selecciona una fila para eliminar.');
            }
        });
        
        $('#btnEditar').on('click', function() {
        // Obtener la fila seleccionada y sus datos
        var filaSeleccionada = $('#miDataTable tbody tr.selected');
        var id = filaSeleccionada.find('td:first').text();
        var descripcion = filaSeleccionada.find('td:nth-child(2)').text();
        var abreviatura = filaSeleccionada.find('td:nth-child(3)').text();

        // Llenar los campos del modal de edición con los datos de la fila seleccionada
        $('#editarID').val(id);
        $('#editarDescripcion').val(descripcion);
        $('#editarAbreviatura').val(abreviatura);

        // Mostrar o ocultar el campo "Abreviatura" según la opción seleccionada en el campo de selección
        if ($('#seleccionarDato').val() === 'tipotamaño') {
            $('#editarAbreviaturaContainer').show();
        } else {
            $('#editarAbreviaturaContainer').hide();
        }

        // Abrir el modal de edición
        $('#editarDatoModal').modal('show');
    });

        break;
    case 'tipotamaño':
        tableHead.innerHTML = '<th>ID Tipo Tamaño</th><th>Descripción</th><th>Abreviatura</th><th><button id="btnEditar" style="color: #e77a34;" class="btn btn-sm" disabled><i class="far fa-edit"></i></button><button id="btnEliminar" style="color: #e77a34;" class="btn btn-sm" disabled><i class="fas fa-trash"></i></button></th>';
        
        // Asocia el evento 'click' al botón "Eliminar" dentro de este caso
        $('#btnEliminar').on('click', function() {
            // Obtener el ID y la opción seleccionada
            var filaSeleccionada = $('#miDataTable tbody tr.selected');
            var id = filaSeleccionada.find('td:first').text();
            var opcion = $('#seleccionarDato').val();

            if (filaSeleccionada.length > 0) {
                eliminarDato(id, opcion);
            } else {
                alert('Selecciona una fila para eliminar.');
            }
        });
        $('#btnEditar').on('click', function() {
        // Obtener la fila seleccionada y sus datos
        var filaSeleccionada = $('#miDataTable tbody tr.selected');
        var id = filaSeleccionada.find('td:first').text();
        var descripcion = filaSeleccionada.find('td:nth-child(2)').text();
        var abreviatura = filaSeleccionada.find('td:nth-child(3)').text();

        // Llenar los campos del modal de edición con los datos de la fila seleccionada
        $('#editarID').val(id);
        $('#editarDescripcion').val(descripcion);
        $('#editarAbreviatura').val(abreviatura);

        // Mostrar o ocultar el campo "Abreviatura" según la opción seleccionada en el campo de selección
        if ($('#seleccionarDato').val() === 'tipotamaño') {
            $('#editarAbreviaturaContainer').show();
        } else {
            $('#editarAbreviaturaContainer').hide();
        }

        // Abrir el modal de edición
        $('#editarDatoModal').modal('show');
    });
        break;
    default:
        break;
}




  // Realizar una petición AJAX para obtener los datos desde el servidor
  $.ajax({
    url: '../controladores/obtenerDatosAjustes.php', // Cambia 'obtener_datos.php' al nombre de tu archivo PHP que obtiene los datos
    type: 'POST',
    data: { opcion: selectedOption }, // Envia la opción seleccionada al servidor
    dataType: 'json',
    success: function(data) {
      // Recorre los datos recibidos y agrega filas a la tabla
      data.forEach(function(row) {
        var newRow = document.createElement('tr');
        for (var key in row) {
        newRow.innerHTML += '<td>' + row[key] + '</td>';
        }
        tableBody.appendChild(newRow);
    });
    },
    error: function(xhr, status, error) {
      console.error('Error al cargar datos:', error);
    }
  });
});


    // Agrega este código en tu script existente
// Agrega este código en tu script existente
document.getElementById('guardarDato').addEventListener('click', function() {
    var nuevaDescripcion = document.getElementById('nuevaDescripcion').value;
    var nuevaAbreviatura = document.getElementById('nuevaAbreviatura').value;

    if (nuevaDescripcion) {
        // Realiza una solicitud AJAX para insertar el nuevo dato
        $.ajax({
            url: '../controladores/guardarDescripcion.php',
            type: 'POST',
            data: {
                opcion: tipoSeleccionado, // Envía el tipo seleccionado
                descripcion: nuevaDescripcion,
                abreviatura: nuevaAbreviatura
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Datos Agregados',
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
                            
                        actualizarTarjetas();   
                        actualizarTabla(tipoSeleccionado);   
                    $('#nuevoDatoModal').modal('hide');
                    document.getElementById('nuevaDescripcion').value = '';
                    document.getElementById('nuevaAbreviatura').value = '';
                    var selectElement = document.getElementById('seleccionarDato');
                    selectElement.value = tipoSeleccionado;

                } else {
                    alert('Error al guardar el nuevo dato.');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error al realizar la solicitud AJAX:', error);
                alert('Error al guardar el nuevo dato.');
            }
        });
    } else {
        alert('Por favor, ingresa una descripción válida.');
    }
});

function eliminarDato(id, opcion) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: 'Esta acción eliminará el dato seleccionado.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '../controladores/eliminarAjustes.php',
                type: 'POST',
                data: { id: id, opcion: opcion },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Datos Elimnados',
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
                        // Eliminación exitosa, quitar la fila de la tabla
                        $('#miDataTable tbody tr.selected').remove();
                        // Deseleccionar cualquier fila seleccionada
                        $('#miDataTable tbody tr.selected').removeClass('selected');
                        // Deshabilitar los botones de editar y eliminar
                        $('#btnEditar, #btnEliminar').prop('disabled', true);
                        actualizarTarjetas();
                    } else {
                        Swal.fire('Error', 'Hubo un error al eliminar el dato.', 'error');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error al realizar la solicitud AJAX:', error);
                    Swal.fire('Error', 'Hubo un error al eliminar el dato.', 'error');
                }
            });
        }
    });
}

$(document).ready(function() {
    $('#guardarEdicionDato').on('click', function() {
        // Obtener los datos editados del modal de edición
        var id = $('#editarID').val();
        var descripcion = $('#editarDescripcion').val();
        var abreviatura = $('#editarAbreviatura').val();
        var opcion = $('#seleccionarDato').val();
        // Realizar una solicitud AJAX para guardar los cambios
        console.log(id, descripcion, abreviatura);
        $.ajax({
            url: '../controladores/updateAjustes.php', 
            type: 'POST',
            data: {
                id: id,
                descripcion: descripcion,
                abreviatura: abreviatura,
                opcion:opcion
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    // Actualizar la fila en la tabla con los nuevos datos
                    var filaSeleccionada = $('#miDataTable tbody tr.selected');
                    filaSeleccionada.find('td:nth-child(2)').text(descripcion);
                    filaSeleccionada.find('td:nth-child(3)').text(abreviatura);

                    // Cerrar el modal de edición
                    $('#editarDatoModal').modal('hide');
                    Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Datos Actualizados',
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

                } else {
                    alert('Error al guardar los cambios.');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error al realizar la solicitud AJAX:', error);
                alert('Error al guardar los cambios.');
            }
        });
    });
});

function actualizarTarjetas() {
    // Realiza una petición AJAX para obtener los datos actualizados
    $.ajax({
        url: '../controladores/actualizarTarjetas.php', // Reemplaza 'ruta_para_obtener_datos_actualizados.php' con la URL correcta
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            // Actualiza el contenido de las tarjetas con los datos recibidos
            $("#rolCard").html(data.rol);
            $("#sucursalCard").html(data.sucursal);
            $("#tipoProductoCard").html(data.tipoproducto);
            $("#tipoCategoriaCard").html(data.categoria);
            $("#tamañoCard").html(data.tamaño);
            $("#formaPagoCard").html(data.formadepago);
            $("#documentoCard").html(data.factura);

            // Continúa actualizando las demás tarjetas de la misma manera
        },
        error: function(xhr, status, error) {
            console.error('Error al obtener datos actualizados:', error);
        }
    });
}
// Esta función realizará una solicitud AJAX para cargar los datos de la tabla
function actualizarTabla(selectedOption) {
  var tableHead = document.querySelector('#miDataTable thead tr');
  var tableBody = document.querySelector('#miDataTable tbody');

  // Limpiar el encabezado y el cuerpo de la tabla
  tableHead.innerHTML = '';
  tableBody.innerHTML = '';

  // Agregar encabezado según la opción seleccionada
  switch (selectedOption) {
    case 'rol':
    case 'sucursal':
    case 'tipoproducto':
    case 'tipocategoria':
    case 'formadepago':
    case 'tipodedocumento':
        tableHead.innerHTML = '<th>ID</th><th>Descripción</th><th><button id="btnEditar" style="color: #e77a34;" class="btn btn-sm" disabled><i class="far fa-edit"></i></button><button id="btnEliminar" style="color: #e77a34;" class="btn btn-sm" disabled><i class="fas fa-trash"></i></button></th>';
        
        // Asocia el evento 'click' al botón "Eliminar" dentro de este caso
        $('#btnEliminar').on('click', function() {
            // Obtener el ID y la opción seleccionada
            var filaSeleccionada = $('#miDataTable tbody tr.selected');
            var id = filaSeleccionada.find('td:first').text();
            var opcion = $('#seleccionarDato').val();

            if (filaSeleccionada.length > 0) {
                eliminarDato(id, opcion);
            } else {
                alert('Selecciona una fila para eliminar.');
            }
        });
        
        $('#btnEditar').on('click', function() {
        // Obtener la fila seleccionada y sus datos
        var filaSeleccionada = $('#miDataTable tbody tr.selected');
        var id = filaSeleccionada.find('td:first').text();
        var descripcion = filaSeleccionada.find('td:nth-child(2)').text();
        var abreviatura = filaSeleccionada.find('td:nth-child(3)').text();

        // Llenar los campos del modal de edición con los datos de la fila seleccionada
        $('#editarID').val(id);
        $('#editarDescripcion').val(descripcion);
        $('#editarAbreviatura').val(abreviatura);

        // Mostrar o ocultar el campo "Abreviatura" según la opción seleccionada en el campo de selección
        if ($('#seleccionarDato').val() === 'tipotamaño') {
            $('#editarAbreviaturaContainer').show();
        } else {
            $('#editarAbreviaturaContainer').hide();
        }

        // Abrir el modal de edición
        $('#editarDatoModal').modal('show');
    });

        break;
    case 'tipotamaño':
        tableHead.innerHTML = '<th>ID Tipo Tamaño</th><th>Descripción</th><th>Abreviatura</th><th><button id="btnEditar" style="color: #e77a34;" class="btn btn-sm" disabled><i class="far fa-edit"></i></button><button id="btnEliminar" style="color: #e77a34;" class="btn btn-sm" disabled><i class="fas fa-trash"></i></button></th>';
        
        // Asocia el evento 'click' al botón "Eliminar" dentro de este caso
        $('#btnEliminar').on('click', function() {
            // Obtener el ID y la opción seleccionada
            var filaSeleccionada = $('#miDataTable tbody tr.selected');
            var id = filaSeleccionada.find('td:first').text();
            var opcion = $('#seleccionarDato').val();

            if (filaSeleccionada.length > 0) {
                eliminarDato(id, opcion);
            } else {
                alert('Selecciona una fila para eliminar.');
            }
        });
        $('#btnEditar').on('click', function() {
        // Obtener la fila seleccionada y sus datos
        var filaSeleccionada = $('#miDataTable tbody tr.selected');
        var id = filaSeleccionada.find('td:first').text();
        var descripcion = filaSeleccionada.find('td:nth-child(2)').text();
        var abreviatura = filaSeleccionada.find('td:nth-child(3)').text();

        // Llenar los campos del modal de edición con los datos de la fila seleccionada
        $('#editarID').val(id);
        $('#editarDescripcion').val(descripcion);
        $('#editarAbreviatura').val(abreviatura);

        // Mostrar o ocultar el campo "Abreviatura" según la opción seleccionada en el campo de selección
        if ($('#seleccionarDato').val() === 'tipotamaño') {
            $('#editarAbreviaturaContainer').show();
        } else {
            $('#editarAbreviaturaContainer').hide();
        }

        // Abrir el modal de edición
        $('#editarDatoModal').modal('show');
    });
        break;
    default:
        break;
}

  // Realizar una petición AJAX para obtener los datos desde el servidor
  $.ajax({
    url: '../controladores/obtenerDatosAjustes.php', // Cambia 'obtener_datos.php' al nombre de tu archivo PHP que obtiene los datos
    type: 'POST',
    data: { opcion: selectedOption }, // Enviar la opción seleccionada al servidor
    dataType: 'json',
    success: function (data) {
      // Recorrer los datos recibidos y agregar filas a la tabla
      data.forEach(function (row) {
        var newRow = document.createElement('tr');
        for (var key in row) {
          newRow.innerHTML += '<td>' + row[key] + '</td>';
        }
        tableBody.appendChild(newRow);
      });
    },
    error: function (xhr, status, error) {
      console.error('Error al cargar datos:', error);
    }
  });
}

// Agregar un evento 'click' a las filas de la tabla
$(document).ready(function () {
  $('#miDataTable').on('click', 'tbody tr', function () {
    // Desmarca todas las filas previamente seleccionadas
    $('#miDataTable tbody tr').removeClass('selected');

    // Marca la fila clicada como seleccionada
    $(this).addClass('selected');

    // Habilitar o deshabilitar los botones de editar y eliminar según si hay una fila seleccionada
    var hayFilaSeleccionada = $('#miDataTable tbody tr.selected').length > 0;
    $('#btnEditar, #btnEliminar').prop('disabled', !hayFilaSeleccionada);
  });
});
   
    </script>


    <style>
        /* Estilo para fila seleccionada */
    .selected {
        background-color: #e77a34; /* Naranja */
        color: white; /* Texto en blanco para mejorar la legibilidad */
    }
    .custom-form {
            max-width: 600px;
            margin: 0 auto;
        }

    .custom-form .btn-custom {
        background-color: #e77a34;
        color: white;
    }

    .custom-form .form-control {
        width: 100%;
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
    </style>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-tooltip/1.2.0/plugin.tooltip.min.js"></script>


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

    <!-- Template Javascript -->
    <script src="../js/main.js"></script>
</body>

</html>

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
    <!-- fecha flatpickr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

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
                <h5>Elige el tipo de reporte que quieres generar:</h5>
                <div class="row g-4">
                <div class="radio-button-container">
                    <div class="radio-button">
                    <input type="radio" class="radio-button__input" id="radio2" name="radio-group">
                    <label class="radio-button__label" for="radio2">
                        <span class="radio-button__custom"></span>
                        Ventas
                    </label>
                    </div>
                    <div class="radio-button">
                    <input type="radio" class="radio-button__input" id="radio3" name="radio-group">
                    <label class="radio-button__label" for="radio3">
                        <span class="radio-button__custom"></span>
                        Productos
                    </label>
                    </div>
                    </div>
                </div>
            </div>
            <!-- Sale & Revenue End -->


            <div class="container-fluid pt-4 px-4" id="ventasTable" style="display: none;">
                <div class="bg-personalizado text-center rounded p-4">
                    <h4>Ventas</h4>
                    <div class="filters mb-3">
                        <div class="row">
                            <!-- Filtro por Fecha -->
                            <div class="col-md-2 filter-group">
                                <label for="filterFecha">Fecha:</label>
                                <div class="divFiltroFecha">
                                    <div class="input-group input-group-sm"> <!-- Aplicar una clase para inputs más pequeños -->
                                        <label class="input-group-text" >Desde</label>
                                        <input type="text" id="datepickerDesde" class="inputFechaDesde form-control">
                                    </div>
                                    <div class="input-group input-group-sm"> <!-- Aplicar una clase para inputs más pequeños -->
                                        <label class="input-group-text">Hasta</label>
                                        <input type="text" id="datepickerHasta" class="inputFechaHasta form-control">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-2 filter-group">
                                <label for="filterProducto" id="labelFiltroProducto">Producto:</label>
                                <div>
                                    <button id="btnFiltrarProductos" class="btn btn-primary">Ver Productos</button>
                                </div>
                            </div>

                            <!-- Filtro por Vendedor -->
                            <div class="col-md-2 filter-group">
                                <label for="filterVendedor" id="labelFiltroVendedor">Vendedor:</label>
                                <input type="text" id="filtroVendedor" class="form-control" placeholder="Buscar por vendedor">
                            </div>
                              
                            <!-- Filtro por Sucursal -->
                            <div class="col-md-2 filter-group" id="sucursalFilterGroup">
                                <label for="filterSucursal">Sucursal:</label>
                                <div id="sucursalCheckboxes" class="text-center">
                                    <!-- Aquí se agregarán las casillas de verificación de sucursales uno debajo del otro. -->
                                </div>
                            </div>



                            <div class="col-md-2 filter-group">
                                <label for="filterSucursal" id="labelFiltroRangoPrecio">Rango de Precio:</label>
                                <div class="d-flex align-items-center justify-content-center">
                                    <input type="number" id="filtroPrecioMin" class="form-control form-control" placeholder="Mínimo">
                                    <label for="">-</label>
                                    <input type="number" id ="filtroPrecioMax" class="form-control form-control" placeholder="Máximo">
                                </div>
                            </div>


                            <button type="button" class="btn btn-primary" id ="btnAplicarFiltros" data-bs-dismiss="modal" onclick="aplicarFiltros()">Aplicar Filtros</button>
                            <!-- Agrega más filtros según sea necesario -->
                        </div>
                    </div>

                    <div class="table-responsive -xxl">
                        <table id="tablaVentas" class="table table-striped" style="width:100%">
                            <thead>
                                <tr class="text-dark">
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Producto</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Vendedor</th>
                                    <th scope="col">Sucursal</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Aquí se mostrarán los datos filtrados dinámicamente -->
                            </tbody>
                            <tfoot>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>


            
            <div class="modal fade" id="modalListaProductos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Seleccione los Productos a Filtrar</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div id="productosCheckboxes"> <!-- Aquí se agregarán las casillas de verificación -->

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="btnAplicarFiltroProductos">Confirmar</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btnCerrarModal">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>





            <!-- tabla de productos -->
            <div class="container-fluid pt-4 px-4" id="productosTable" style="display: none;">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Productos</h6>
                        <a href="">Show All</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">
                                    <th scope="col"><input class="form-check-input" type="checkbox"></th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Invoice</th>
                                    <th scope="col">Customer</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input class="form-check-input" type="checkbox"></td>
                                    <td>01 Jan 2045</td>
                                    <td>INV-0123</td>
                                    <td>Jhon Doe</td>
                                    <td>$123</td>
                                    <td>Paid</td>
                                    <td><a class="btn btn-sm btn-primary" href="">Detail</a></td>
                                </tr>
                                <tr>
                                    <td><input class="form-check-input" type="checkbox"></td>
                                    <td>01 Jan 2045</td>
                                    <td>INV-0123</td>
                                    <td>Jhon Doe</td>
                                    <td>$123</td>
                                    <td>Paid</td>
                                    <td><a class="btn btn-sm btn-primary" href="">Detail</a></td>
                                </tr>
                                <tr>
                                    <td><input class="form-check-input" type="checkbox"></td>
                                    <td>01 Jan 2045</td>
                                    <td>INV-0123</td>
                                    <td>Jhon Doe</td>
                                    <td>$123</td>
                                    <td>Paid</td>
                                    <td><a class="btn btn-sm btn-primary" href="">Detail</a></td>
                                </tr>
                                <tr>
                                    <td><input class="form-check-input" type="checkbox"></td>
                                    <td>01 Jan 2045</td>
                                    <td>INV-0123</td>
                                    <td>Jhon Doe</td>
                                    <td>$123</td>
                                    <td>Paid</td>
                                    <td><a class="btn btn-sm btn-primary" href="">Detail</a></td>
                                </tr>
                                <tr>
                                    <td><input class="form-check-input" type="checkbox"></td>
                                    <td>01 Jan 2045</td>
                                    <td>INV-0123</td>
                                    <td>Jhon Doe</td>
                                    <td>$123</td>
                                    <td>Paid</td>
                                    <td><a class="btn btn-sm btn-primary" href="">Detail</a></td>
                                </tr>
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

    <!-- libreria sweetAlert -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- fecha flatpickr -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <!-- Template Javascript -->
    <script src="../js/main.js"></script>


    <style>
        .radio-button-container {
        display: flex;
        align-items: center;
        gap: 24px;
        }

        .radio-button {
        display: inline-block;
        position: relative;
        cursor: pointer;
        }

        .radio-button__input {
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
        }

        .radio-button__label {
        display: inline-block;
        padding-left: 30px;
        margin-bottom: 10px;
        position: relative;
        font-size: 15px;
        color: #757575;
        font-weight: 600;
        cursor: pointer;
        text-transform: uppercase;
        transition: all 0.3s ease;
        }

        .radio-button__custom {
        position: absolute;
        top: 0;
        left: 0;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        border: 2px solid #555;
        transition: all 0.3s ease;
        }

        .radio-button__input:checked + .radio-button__label .radio-button__custom {
        background-color: #e77a34;
        border-color: transparent;
        transform: scale(0.8);
        box-shadow: 0 0 20px #F7A251;
        }

        .radio-button__input:checked + .radio-button__label {
        color: #e77a34;
        }

        .radio-button__label:hover .radio-button__custom {
        transform: scale(1.2);
        border-color: #e77a34;
        box-shadow: 0 0 20px #757575;
        }

        #tablaVentas_length {
            float: left;
            padding: 5px 15px;
            background-color: #dee2e626;
            border-radius: 10px;
        }

        #tablaVentas_filter {
            float: right;
        }

        .container-fluid .bg-personalizado {
            background-color: #ffffff96;
        }

       
        .page-item.active .page-link {
            background-color: #e77a34; /* Cambia el color de fondo a tu preferencia */
            color: white; /* Cambia el color del texto para que sea legible en el nuevo fondo */
        }
        .paginate_button.current {
            color: green;
        }

        .iconoCalendario {
            display: flex;
            align-items: center;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: white;
            text-align: center;
            white-space: nowrap;
            background-color: #e77a34;
            border: 1px solid #ced4da;
            border-radius: 5px;

        }

        .inputFiltro {
            border: 2px solid transparent;
            width: 6.8em;
            height: 2.5em;
            padding-left: 0.8em;
            outline: none;
            overflow: hidden;
            background-color: #F3F3F3;
            border-radius: 10px;
            transition: all 0.5s;
            }

            .inputFiltro:hover,
            .inputFiltro:focus {
            border: 2px solid #4A9DEC;
            box-shadow: 0px 0px 0px 7px rgb(74, 157, 236, 20%);
            background-color: white;
            }

            .divFiltroFecha .input-group {
                /* Establece el ancho que desees */
                width: 150px;
                margin: 5px 0;
            }

            .divFiltroFecha .input-group-text {
                color: #757575;
                background-color: #e77a3400;
            }

            /* Estilo CSS para la clase personalizada de la alerta */
            .custom-popup-class {
                width: 250px; /* Ajusta el ancho de la alerta según tus necesidades */
                font-size: 10px; /* Ajusta el tamaño de fuente del contenido de la alerta */
                padding: 2px 3px; /* Ajusta el relleno de la alerta para hacerla un poco más pequeña */
                border-radius: 10px; /* Añade bordes redondeados a la alerta */
                }

            /* Estilo CSS para la clase personalizada del título */
            .custom-title-class {
                font-size: 13px; /* Ajusta el tamaño de fuente del título de la alerta */
                padding: 10px 3px; 
                }


            /* Estilo CSS para la clase personalizada del icono */
            .custom-icon-class {
                font-size: 8px; /* Ajusta el tamaño del icono según tus necesidades */
            }

            /* Estilos para el contenedor del botón */
            .col-md-2.filter-group {
                display: flex;
                flex-direction: column;
                align-items: center; /* Opcional: para centrar el botón verticalmente */
            }
            .form-check-label {
                font-size: 15px; /* Ajusta el tamaño del label según tus preferencias */
            }

            .form-check-label {
                display: flex;
                align-items: center;
            }

            .form-check-label input {
                margin-right: 5px;
            }

            #sucursalCheckboxes {
                display: flex;
                flex-direction: column;
                align-items: center;
            }
            
            #sucursalCheckboxes .form-check {
                display: flex;
                align-items: center;
            }

            .form-check .form-check-input {
                margin-right: 10px;
            }
            .divFiltroVendedor {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100%; /* Esto asegura que ocupe todo el espacio vertical */
            }


            #filtroVendedor {
                width: 95%; /* Ajusta el ancho según tus necesidades */
                padding: 0.25rem 0.5rem;
                font-size: 1rem;
                border: 1px solid #ccc;
                border-radius: 0.25rem;
                transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            }

            #filtroVendedor:focus {
                outline: none;
                border-color: #007bff;
                box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
            }

            #labelFiltroVendedor {
                margin-bottom: 10px;
            }

            #labelFiltroProducto{
                margin-bottom: 10px;
            }

            #filtroPrecioMin{
                width: 80px; /* Ajusta el ancho según tus necesidades */
                height: 30px; /* Ajusta la altura según tus necesidades */
                margin: 0 5px; /* Espaciado entre los inputs */
                padding: 5px; /* Espaciado interno del input */
                font-size: 14px; /* Tamaño de fuente */
                border-radius: 8%;
            }
            #filtroPrecioMax{
                width: 80px; /* Ajusta el ancho según tus necesidades */
                height: 30px; /* Ajusta la altura según tus necesidades */
                margin: 0 5px; /* Espaciado entre los inputs */
                padding: 5px; /* Espaciado interno del input */
                font-size: 14px; /* Tamaño de fuente */
                border-radius: 8%;
            }

            .custom-filter-div label {
                margin: 0 5px; /* Aplicar espaciado al label dentro del div */
            }

            #labelFiltroRangoPrecio{
                margin-bottom: 10px;
            }

            #btnAplicarFiltros {
                margin-top: 10px;
            }

    </style>

    <script>
        let tablaVentas;
        let datosOriginales = [];
        // Estructura para rastrear las selecciones del usuario
        const filtros = {
            fechaDesde: '',
            fechaHasta: '',
            productos: new Set(),
            vendedores: new Set(),
            sucursales: new Set(),
            // Agrega más categorías de filtro según tus necesidades
        };

        
        document.addEventListener("DOMContentLoaded", function () {

            flatpickr("#datepickerDesde", {
                dateFormat: "Y-m-d", // Formato de fecha (por ejemplo, "2023-10-25")
                altFormat: "F j, Y", // Formato del campo de entrada alternativo
                locale: {
                    firstDayOfWeek: 0, // Primer día de la semana (0 para domingo, 1 para lunes, etc.)
                }
            });

            flatpickr("#datepickerHasta", {
                dateFormat: "Y-m-d", // Formato de fecha (por ejemplo, "2023-10-25")
                altFormat: "F j, Y", // Formato del campo de entrada alternativo
                locale: {
                    firstDayOfWeek: 0, // Primer día de la semana (0 para domingo, 1 para lunes, etc.)
                }
            });
        });



        // Obtenemos los elementos de los radio buttons
        const radioVentas = document.getElementById("radio2");
        const radioProductos = document.getElementById("radio3");

        // Obtenemos las tablas de Ventas y Productos
        const ventasTable = document.getElementById("ventasTable");
        const productosTable = document.getElementById("productosTable");

        // Manejamos el cambio en la selección de los radio buttons
        radioVentas.addEventListener("change", function() {
            if (radioVentas.checked) {
                // Mostrar la tabla de Ventas y ocultar la de Productos
                ventasTable.style.display = "block";
                productosTable.style.display = "none";
                
                // Aquí puedes llamar a una función que genere la tabla de Ventas y aplique los filtros.
                generarTablaVentas();

            }
        });

        radioProductos.addEventListener("change", function() {
            if (radioProductos.checked) {
                // Mostrar la tabla de Productos y ocultar la de Ventas
                productosTable.style.display = "block";
                ventasTable.style.display = "none";
                
                // Aquí puedes llamar a una función que genere la tabla de Productos y aplique los filtros.
                generarTablaProductos();
            }
        });



        function generarTablaVentas() {
            // Realiza una solicitud GET para obtener los datos de ventas desde el servidor
            fetch('../controladores/funcionesReportes.php?action=generarTablaVentas')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('La solicitud no fue exitosa');
                    }
                    return response.json(); // Convierte la respuesta a JSON
                })
                .then(data => {
                    // Aquí puedes procesar los datos y crear la tabla dinámicamente
                    datosOriginales = data;
                    crearTablaVentas(data);
                })
                .catch(error => {
                    console.error('Error al obtener los datos de ventas:', error);
                });
        }

        function crearTablaVentas(data) {
            //creamos el modal de todos los productos
            const productos = obtenerProductos(datosOriginales);
            agregarCasillasDeVerificacion(productos);


            //creamos los checks de las sucursales
            const sucursales = obtenerSucursales(datosOriginales);
            agregarCasillasDeVerificacionSucursales(sucursales);
            

            const tabla = document.querySelector('#ventasTable table tbody');
            tabla.innerHTML = ''; // Limpia cualquier contenido previo en la tabla

            data.forEach(venta => {
                const fila = document.createElement('tr');

                const propiedades = ['Fecha', 'Producto', 'cantidad', 'Vendedor', 'Sucursal', 'Total'];

                propiedades.forEach(propiedad => {
                    const celda = document.createElement('td');
                    celda.textContent = venta[propiedad];
                    fila.appendChild(celda);
                });

                tabla.appendChild(fila);
            });

            if (tablaVentas) {
                // Si ya existe una instancia de DataTable, actualiza los datos y el orden sin destruirla
                tablaVentas.clear().rows.add(data).draw();
            } else {
                // Si no existe una instancia de DataTable, crea una nueva
                tablaVentas = $('#tablaVentas').DataTable({
                    searching: false,
                    lengthChange: true,
                    order: [[0, 'desc']],
                    columns: [ // Define las columnas
                        { data: 'Fecha' },
                        { data: 'Producto' },
                        { data: 'cantidad' },
                        { data: 'Vendedor' },
                        { data: 'Sucursal' },
                        { data: 'Total' }
                    ],
                    info: true,
                    lengthMenu: [10, 20, 40, 60],
                    language: {
                        search: "",
                        searchPlaceholder: "Filtrar proveedores",
                        zeroRecords: "No se encontraron resultados",
                        info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
                        infoEmpty: "Mostrando 0 a 0 de 0 registros",
                        infoFiltered: "(filtrado de MAX registros en total)"
                    }
                });
            }
        }

        // --------------------------------------FILTRADO POR RANGO DE FECHA---------------------------------------------------
        $('#datepickerDesde, #datepickerHasta').on('change', function () {
            // Verifica si ambas fechas están presentes antes de llamar a la función
            const fechaDesde = document.querySelector('#datepickerDesde').value;
            const fechaHasta = document.querySelector('#datepickerHasta').value;
            if (fechaDesde && fechaHasta) {
                if (validarFechas(fechaDesde, fechaHasta)) {
                    filtrarPorRangoDeFecha();
                } else {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Error Rango de Fechas',
                        title: 'La fecha "Hasta" debe ser posterior a la fecha "Desde',
                        showConfirmButton: false,
                        timer: 3000,
                        background: false, // Desactiva el fondo oscurecido
                        backdrop: false,
                        customClass: {
                            container: 'custom-container-class',
                            popup: 'custom-popup-class', // Clase personalizada para ajustar el tamaño de la alerta
                            title: 'custom-title-class', // Clase personalizada para ajustar el tamaño del título
                            icon: 'custom-icon-class',
                        },
                        })
                }
            }
        });

        function validarFechas(fechaDesde, fechaHasta) {
            return new Date(fechaHasta) > new Date(fechaDesde);
        }

        function filtrarPorRangoDeFecha() {
            const fechaDesde = document.querySelector('#datepickerDesde').value;
            const fechaHasta = document.querySelector('#datepickerHasta').value;

            if (fechaDesde && fechaHasta && validarFechas(fechaDesde, fechaHasta)) {
                filtros.fechaDesde = document.querySelector('#datepickerDesde').value;
                filtros.fechaHasta = document.querySelector('#datepickerHasta').value;
            }
        }

// --------------------------------------FIN---------------------------------------------------//


// --------------------------------------FILTRADO POR PRODCUTOS---------------------------------------------------//

        const productosSeleccionados = new Set();
        // Agregar un controlador de eventos clic al botón
        document.getElementById('btnFiltrarProductos').addEventListener('click', function () {
            // Selecciona el modal por su id y llama al método `modal` de Bootstrap para abrirlo
            $('#modalListaProductos').modal('show');
        });


        function obtenerProductos(data) {
            console.log(data);
            const productosUnicos = new Set();
            data.forEach(venta => {
                productosUnicos.add(venta.Producto);
            });
            return Array.from(productosUnicos);
        }

        function limpiarCasillasDeVerificacion() {
            const contenedor = document.getElementById('productosCheckboxes');
            contenedor.innerHTML = ''; // Borra todo el contenido anterior
        }

        function agregarCasillasDeVerificacion(productos) {
            limpiarCasillasDeVerificacion()
            const contenedor = document.getElementById('productosCheckboxes');

            const totalProductos = productos.length;
            const mitadProductos = Math.ceil(totalProductos / 2);

            // Divide los productos en dos mitades
            const mitad1 = productos.slice(0, mitadProductos);
            const mitad2 = productos.slice(mitadProductos);

            // Ordena ambas mitades alfabéticamente
            mitad1.sort();
            mitad2.sort();

            const columna1 = document.createElement('div');
            columna1.classList.add('col-6'); // Columna izquierda

            const columna2 = document.createElement('div');
            columna2.classList.add('col-6'); // Columna derecha

            for (let i = 0; i < mitad1.length; i++) {
                const producto1 = mitad1[i];
                const producto2 = mitad2[i];

                const div1 = document.createElement('div');
                div1.classList.add('form-check');

                const checkbox1 = document.createElement('input');
                checkbox1.type = 'checkbox';
                checkbox1.value = producto1;
                checkbox1.id = `checkbox-${producto1}`;
                checkbox1.classList.add('form-check-input'); // Agrega una clase para el checkbox

                const label1 = document.createElement('label');
                label1.htmlFor = `checkbox-${producto1}`;
                label1.textContent = producto1;
                label1.classList.add('form-check-label'); // Agrega una clase para el label

                div1.appendChild(checkbox1);
                div1.appendChild(label1);

                columna1.appendChild(div1);

                // Si hay un producto en la segunda mitad, crear su casilla
                if (producto2) {
                    const div2 = document.createElement('div');
                    div2.classList.add('form-check');

                    const checkbox2 = document.createElement('input');
                    checkbox2.type = 'checkbox';
                    checkbox2.value = producto2;
                    checkbox2.id = `checkbox-${producto2}`;
                    checkbox2.classList.add('form-check-input'); // Agrega una clase para el checkbox

                    const label2 = document.createElement('label');
                    label2.htmlFor = `checkbox-${producto2}`;
                    label2.textContent = producto2;
                    label2.classList.add('form-check-label'); // Agrega una clase para el label

                    div2.appendChild(checkbox2);
                    div2.appendChild(label2);

                    columna2.appendChild(div2);
                }
            }

            // Crea una fila para albergar ambas columnas
            const fila = document.createElement('div');
            fila.classList.add('row');

            fila.appendChild(columna1);
            fila.appendChild(columna2);

            contenedor.appendChild(fila);
        }

        //evento para boton de ver productos, aplicar
        document.getElementById('btnAplicarFiltroProductos').addEventListener('click', function () {
            // Obtén una lista de todos los checkboxes seleccionados
            const checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');

            // Extrae los valores de los checkboxes seleccionados
            const productosSeleccionadosArray = Array.from(checkboxes).map(checkbox => checkbox.value);

            // Actualiza la variable productosSeleccionados con los productos seleccionados
            productosSeleccionados.clear();
            productosSeleccionadosArray.forEach(producto => {
                productosSeleccionados.add(producto);
            });

            // Llama a la función para filtrar por productos con la lista de productos seleccionados
            filtrarPorProductos(productosSeleccionadosArray);

            // Cierra el modal
            $('#modalListaProductos').modal('hide');
        });

        //evento para boton de ver productos, cancelar
        document.getElementById('btnCerrarModal').addEventListener('click', function (event) {
            event.preventDefault(); // Evita el comportamiento predeterminado del botón

            const checkboxes = document.querySelectorAll('input[type="checkbox"]');
            const cambiosPendientes = Array.from(checkboxes).some(checkbox => {
                const producto = checkbox.value;
                return checkbox.checked !== productosSeleccionados.has(producto);
            });

            if (cambiosPendientes) {
                Swal.fire({
                    title: 'Cambios no guardados',
                    confirmButtonText: 'OK',
                }).then(() => {
                    // Cierra el modal sin guardar
                    $('#modalListaProductos').modal('hide');
                    // Restaura el estado de los checkboxes a su estado original
                    checkboxes.forEach(checkbox => {
                        checkbox.checked = productosSeleccionados.has(checkbox.value);
                    });
                });
            } else {
                // Cierra el modal sin mostrar la advertencia
                $('#modalListaProductos').modal('hide');
            }
        });

        // Define la función para filtrar por productos
        function filtrarPorProductos(productosSeleccionadosArray) {
            // Limpia el conjunto de productos seleccionados antes de agregar los nuevos
            productosSeleccionados.clear();

            // Agrega los productos seleccionados al conjunto
            productosSeleccionadosArray.forEach(producto => {
                productosSeleccionados.add(producto);
            })
        }

        // --------------------------------------FILTRADO POR sucursales---------------------------------------------------//
        function obtenerSucursales(data) {
            const sucursalesUnicas = new Set();
            data.forEach(venta => {
                sucursalesUnicas.add(venta.Sucursal);
            });
            return Array.from(sucursalesUnicas);
        }

        function limpiarCasillasDeVerificacionSucursales() {
            const contenedor = document.getElementById('sucursalFilterGroup');

            // Obtén todos los elementos 'input' dentro del contenedor
            const checkboxes = contenedor.querySelectorAll('input.form-check-input');

            // Elimina cada checkbox, dejando el label "Sucursal" intacto
            checkboxes.forEach(checkbox => {
                contenedor.removeChild(checkbox.parentElement.parentElement.parentElement);
            });
        }

        function agregarCasillasDeVerificacionSucursales(sucursales) {
            limpiarCasillasDeVerificacionSucursales();
            const contenedor = document.getElementById('sucursalCheckboxes');

            sucursales.forEach(sucursal => {
                const div = document.createElement('div');
                div.classList.add('form-check'); // Agrega la clase "form-check" para mantener el estilo del checkbox

                const checkbox = document.createElement('input');
                checkbox.type = 'checkbox';
                checkbox.value = sucursal;
                checkbox.id = `checkbox-sucursal-${sucursal}`;
                checkbox.classList.add('form-check-input');

                const label = document.createElement('label');
                label.htmlFor = `checkbox-sucursal-${sucursal}`;
                label.textContent = sucursal;
                label.classList.add('form-check-label');
                div.appendChild(checkbox);
                div.appendChild(label);

                contenedor.appendChild(div);
            });
        }




        // --------------------------------------FIN---------------------------------------------------//

        function aplicarFiltros() {
            const filtroVendedor = document.getElementById('filtroVendedor').value.toLowerCase(); // Obtener el valor del campo de búsqueda en minúsculas
            // Limpia los datos filtrados antes de aplicar nuevos filtros
            datosFiltrados = datosOriginales;

            // Verifica si se ha seleccionado un rango de fechas
            if (filtros.fechaDesde && filtros.fechaHasta) {
                datosFiltrados = datosFiltrados.filter(venta => {
                    const fechaVenta = venta.Fecha;
                    return fechaVenta >= filtros.fechaDesde && fechaVenta <= filtros.fechaHasta;
                });
            }

            // Aplica el filtro de productos
            datosFiltrados = datosFiltrados.filter(venta => {
                return productosSeleccionados.size === 0 || productosSeleccionados.has(venta.Producto);
            });

            // Obtiene los checkbox de sucursales seleccionadas
            const sucursalCheckboxes = document.querySelectorAll('#sucursalFilterGroup input[type="checkbox"]:checked');
            const sucursalesSeleccionadas = new Set();

            sucursalCheckboxes.forEach(checkbox => {
                sucursalesSeleccionadas.add(checkbox.value);
            });

            // Aplica el filtro por sucursales
            datosFiltrados = datosFiltrados.filter(venta => {
                return sucursalesSeleccionadas.size === 0 || sucursalesSeleccionadas.has(venta.Sucursal);
            });


            // Aplica el filtro por vendedor
            datosFiltrados = datosFiltrados.filter(venta => {
                const nombreVendedor = venta.Vendedor.toLowerCase(); // Obtener el nombre del vendedor en minúsculas
                return nombreVendedor.includes(filtroVendedor); // Comprobar si el nombre del vendedor incluye el filtro
            });

            
            // Aplica el filtro por rango de precio
            const minPrecio = parseFloat(document.getElementById('filtroPrecioMin').value);
            const maxPrecio = parseFloat(document.getElementById('filtroPrecioMax').value);


            if (minPrecio > maxPrecio) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Error Rango de Precio',
                    text: 'El precio mínimo no puede ser mayor que el precio máximo',
                    showConfirmButton: false,
                    timer: 3000,
                    background: false,
                    backdrop: false,
                    customClass: {
                        container: 'custom-container-class',
                        popup: 'custom-popup-class',
                        title: 'custom-title-class',
                        icon: 'custom-icon-class',
                    },
                });
                return;
            }

            // Filtra los datos por rango de precio
            datosFiltrados = datosFiltrados.filter(venta => {
                const precioVenta = parseFloat(venta.Total);
                console.log(precioVenta, "precioVenta");
                console.log(typeof (precioVenta));
                console.log(typeof (minPrecio));
                console.log(typeof (maxPrecio));
                
                return precioVenta >= minPrecio && precioVenta <= maxPrecio;
            });


            // Verifica si no se ha seleccionado ningún filtro y muestra todos los registros
            if (!filtros.fechaDesde && !filtros.fechaHasta && productosSeleccionados.size === 0 && sucursalesSeleccionadas.size === 0 && filtroVendedor === '' && (isNaN(minPrecio) || isNaN(maxPrecio) || minPrecio > maxPrecio)) {
                datosFiltrados = datosOriginales;
            }

            console.log(datosFiltrados); // Muestra los datos filtrados por fecha, productos y sucursales.


            // Después de aplicar todos los filtros, actualiza la tabla con los datos filtrados
            actualizarTabla(datosFiltrados);
        }

        function actualizarTabla(datos) {
            if (tablaVentas) {
                // Si ya existe una instancia de DataTable, actualiza los datos sin destruirla
                tablaVentas.clear().rows.add(datos).draw();
            }
        }


    </script>
        
</body>

</html>
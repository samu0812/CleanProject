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


            <!-- tabla de productos -->
            <div class="container-fluid pt-4 px-4" id="productosTableContent" style="display: none;">
                <div class="bg-personalizado text-center rounded p-4">
                    <h4>Productos</h4>
                    <div class="filters mb-3">
                        <div class="row">

                            <!-- Filtro por Nombre del Producto -->
                            <div class="col-md-2 filter-group">
                                <label for="filterProducto" id="labelFiltroProducto">Nombre del Producto:</label>
                                <input type="text" id="filtroProducto" class="form-control" placeholder="Buscar por Producto">
                            </div>

                            <!-- Filtro por Proveedor -->
                            <div class="col-md-2 filter-group">
                                <label for="filterProveedor" id="labelFiltroProveedor">Proveedor:</label>
                                <input type="text" id="filtroProveedor" class="form-control" placeholder="Buscar por Proveedor">
                            </div>
                            
                            <!-- Filtro por Tipo Prodcuto -->
                            <div class="col-md-2 filter-group">
                            <label for="filterTipoProdcuto">Tipo Prodcuto:</label>
                                <div id="TipoProductoCheckboxes" class="text-center">
                                </div>
                            </div>

                            <!-- Filtro por Tipo Categoria -->
                            <div class="col-md-2 filter-group">
                            <label for="filterCategoria">Categoria:</label>
                                <div id="categoriaCheckboxes" class="text-center">
                                </div>
                            </div>
                              
                            <!-- Filtro por Rango de Precio -->
                            <div class="col-md-2 filter-group">
                                <label for="filterRangoPrecioProducto" id="labelFiltroRangoPrecioProducto">Rango de Precio:</label>
                                <div class="d-flex align-items-center justify-content-center">
                                    <input type="number" id="filtroPrecioMinProducto" class="form-control form-control" placeholder="Mínimo">
                                    <label for="">-</label>
                                    <input type="number" id ="filtroPrecioMaxProducto" class="form-control form-control" placeholder="Máximo">
                                </div>
                            </div>



                            <div class="col-md-2 filter-group">
                            </div>

                            <div id="contenedorBotones">
                                <button type="button" class="btn btn-primary btn-sm btn-block" id="btnResetFiltros" data-bs-dismiss="modal" onclick="resetFiltrosProductos()" >Resetear Filtros</button>
                                <button type="button" class="btn btn-primary btn-sm btn-block" id="btnAplicarFiltros" data-bs-dismiss="modal" onclick="aplicarFiltrosProductos()">Aplicar Filtros</button>
                            </div>

                            
                            <div id="pdfContainerProductos">
                                <button class="download-button" >
                                        <div class="docs"><svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2" stroke="currentColor" height="20" width="20" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line y2="13" x2="8" y1="13" x1="16"></line><line y2="17" x2="8" y1="17" x1="16"></line><polyline points="10 9 9 9 8 9"></polyline></svg> PDF</div>
                                        <div class="download" id="generarPDFProductos" onclick="generarPDFVentasProductos()">
                                            <svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2" stroke="currentColor" height="24" width="24" viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line y2="3" x2="12" y1="15" x1="12"></line></svg>
                                        </div>
                                </button>
                            </div>
                            
                            
                            
                        </div>

                    </div>

                    <div class="table-responsive -xxl">
                        <table id="tablaProductos" class="table table-striped" style="width:100%">
                            <thead>
                                <tr class="text-dark">
                                    <th scope="col">Codigo</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Proveedor</th>
                                    <th scope="col">Tipo Producto</th>
                                    <th scope="col">Categoria</th>
                                    <th scope="col">Tamaño</th>
                                    <th scope="col">Medida</th>
                                    <th scope="col">Cantidad Total</th>
                                    <th scope="col">Precio Costo</th>
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

            <!-- tabla de ventas -->
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

                            <!-- Filtro por nombre del producto -->
                            <div class="col-md-2 filter-group">
                                <label for="filterProducto" id="labelFiltroNombreProducto">Producto:</label>
                                <input type="text" id="filtroNombreProducto" class="form-control" placeholder="Buscar por Producto">
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


                            <!-- Filtro por Rango de Precio -->
                            <div class="col-md-2 filter-group">
                                <label for="filterSucursal" id="labelFiltroRangoPrecio">Rango de Precio:</label>
                                <div class="d-flex align-items-center justify-content-center">
                                    <input type="number" id="filtroPrecioMin" class="form-control form-control" placeholder="Mínimo">
                                    <label for="">-</label>
                                    <input type="number" id ="filtroPrecioMax" class="form-control form-control" placeholder="Máximo">
                                </div>
                            </div>

                            <div id="contenedorBotones">
                                <button type="button" class="btn btn-primary btn-sm btn-block" id="btnResetFiltros" data-bs-dismiss="modal"  onclick="resetFiltrosVentas()">Resetear Filtros</button>
                                <button type="button" class="btn btn-primary btn-sm btn-block" id="btnAplicarFiltros" data-bs-dismiss="modal" onclick="aplicarFiltros()">Aplicar Filtros</button>
                            </div>
                            <div id="pdfContainer">
                                <button class="download-button" >
                                        <div class="docs"><svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2" stroke="currentColor" height="20" width="20" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line y2="13" x2="8" y1="13" x1="16"></line><line y2="17" x2="8" y1="17" x1="16"></line><polyline points="10 9 9 9 8 9"></polyline></svg> PDF</div>
                                        <div class="download" id="generarPDFVentas" onclick="generarPDFVentas()">
                                            <svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2" stroke="currentColor" height="24" width="24" viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line y2="3" x2="12" y1="15" x1="12"></line></svg>
                                        </div>
                                </button>
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

    <!-- Libreria PDF make -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js" integrity="sha512-a9NgEEK7tsCvABL7KqtUTQjl69z7091EVPpw5KxPlZ93T141ffe1woLtbXTX+r2/8TtTvRX/v4zTL2UlMUPgwg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/vfs_fonts.js"></script>
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
                font-size: 15px; /* Ajusta el tamaño de fuente del título de la alerta */
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


            #filtroVendedor , #filtroNombreProducto {
                width: 100%; /* Ajusta el ancho según tus necesidades */
                padding: 0.25rem 0.5rem;
                font-size: 1rem;
                border: 1px solid #ccc;
                border-radius: 0.25rem;
                transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            }

            #labelFiltroVendedor , #labelFiltroNombreProducto {
                margin-bottom: 10px;
            }


            #filtroPrecioMin , #filtroPrecioMinProducto{
                width: 80px; /* Ajusta el ancho según tus necesidades */
                height: 30px; /* Ajusta la altura según tus necesidades */
                margin: 0 5px; /* Espaciado entre los inputs */
                padding: 5px; /* Espaciado interno del input */
                font-size: 14px; /* Tamaño de fuente */
                border-radius: 8%;
            }
            #filtroPrecioMax , #filtroPrecioMaxProducto{
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

            #labelFiltroRangoPrecio, #labelFiltroProducto , #labelFiltroRangoPrecioProducto{
                margin-bottom: 10px;
            }

            #btnAplicarFiltros {
                margin-top: 10px;
            }

            .col-md-2.filter-group {
                margin: 0 19px;
            }

            .filters.mb-3 {
                margin: 20px;
            }

            #btnResetFiltros{               
                height: 65%;
                border-radius: 10px;
                background: #ABABAB;
                border-color: #ABABAB;
                margin: 10px 5px;
                padding: 2px;
                font-size: 14px;
                width: 140px;
            }

            #btnAplicarFiltros {
                height: 65%;
                border-radius: 10px;
                background: #e77a34;
                border-color: #e77a34;
                margin: 10px 5px;
                padding: 2px;
                font-size: 14px;
                width: 140px;
            }

            #btnFiltrarProductos {
                background: #e77a34;
                font-size: 10px;
                border-radius: 10px;
                border-color: #e77a34;
            }

            .btn-primary:visited {
                text-transform: uppercase;
                text-decoration: none;
                color: rgb(27, 27, 27);
                padding: 10px 30px;
                border: 1px solid;
                border-radius: 1000px;
                display: inline-block;
                transition: all .2s;
                position: relative;
            }
            
            .btn-primary:hover {
                transform: translateY(-5px);
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            }
            
            .btn-primary:active {
                transform: translateY(-3px);
            }
            
            .btn-primary::after {
                content: "";
                display: inline-block;
                height: 100%;
                width: 100%;
                border-radius: 100px;
                top: 0;
                left: 0;
                position: absolute;
                z-index: -1;
                transition: all .3s;
            }
            
            .btn-primary:hover::after {
                background-color: rgba(0, 0, 0, 0.2);
                transform: scaleX(0.6) scaleY(0.8);
                opacity: 0;
            }

            .btn-primary:hover::after {
                background-color: rgba(0, 0, 0, 0.2);
                transform: scaleX(0.6) scaleY(0.8);
                opacity: 0;
            }

            .btn-primary:hover::after {
                background-color: rgba(0, 0, 0, 0.2);
                transform: scaleX(0.6) scaleY(0.8);
                opacity: 0;
            }

            #tablaProductos_length {
                float: left;
                padding: 5px 15px;
                background-color: #dee2e626;
                border-radius: 10px;
            }

            #tablaProductos_filter {
                float: right;
            }

            #filtroProveedor , #filtroProducto{
                width: 180px;
            }

            #labelFiltroProveedor {
                margin-bottom: 10px;
            }

            #contenedorBotones {
                margin-top: 5px;
            }

            #ventasTable {
                display: none;
                position: relative; /* Asegura que el contenedor sea el contexto relativo */

                /* Agrega cualquier otro estilo que desees */
            }

            /* Estilos para el contenedor del botón PDF */
            #pdfContainer {
                position: absolute;
                top: 37px;
                left: 565px;
            }

            #pdfContainerProductos {
                position: absolute;
                top: 190px;
                left: 690px;
            }    


            .download-button {
                width: 80px; /* Ajusta el ancho según tus necesidades */
                height: 40px; /* Ajusta el alto según tus necesidades */
                background: #ffffff96;
                position: relative;
                border-width: 0;
                color: white;
                font-size: 15px;
                font-weight: 600;
                border-radius: 4px;
                z-index: 1;
                }

                .download-button .docs {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 10px;
                min-height: 40px;
                padding: 0 5px;
                border-radius: 4px;
                z-index: 1;
                background-color: #F83631;;
                border: solid 1px #F83631;
                transition: all .5s cubic-bezier(0.77, 0, 0.175, 1);
                }

                .download {
                position: absolute;
                inset: 0;
                display: flex;
                align-items: center;
                justify-content: center;
                max-width: 80%;
                margin: 0 auto;
                z-index: -1;
                border-radius: 4px;
                transform: translateY(0%);
                background-color: #F86561;
                border: solid 1px #F86561;
                transition: all .7s cubic-bezier(0.77, 0, 0.175, 1);
                }


                .download-button:hover .download {
                transform: translateY(100%)
                }

                .download svg polyline,.download svg line {
                animation: docs 1s infinite;
                }

                @keyframes docs {
                0% {
                transform: translateY(0%);
                }

                50% {
                transform: translateY(-15%);
                }

                100% {
                transform: translateY(0%);
                }
                }

    </style>

    <script>
        //variables tabla Ventas
        let tablaVentas;
        let datosOriginales = [];
        let datosFiltrados = [];
        // Estructura para rastrear las selecciones del usuario
        const filtros = {
            fechaDesde: '',
            fechaHasta: '',
            productos: new Set(),
            vendedores: new Set(),
            sucursales: new Set(),
            // Agrega más categorías de filtro según tus necesidades
        };
        
        //variables tabla Prodcutos
        let datosOriginalesProductos = [];
        let tablaProductos;
        let datosFiltradosProductos = [];

        
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

        console.log(radioVentas.checked);
        console.log(radioProductos.checked);

        // Obtenemos las tablas de Ventas y Productos
        const ventasTable = document.getElementById("ventasTable");
        const productosTableContent = document.getElementById("productosTableContent");

        // Manejamos el cambio en la selección de los radio buttons
        radioVentas.addEventListener("change", function() {
            if (radioVentas.checked) {
                // Mostrar la tabla de Ventas y ocultar la de Productos
                ventasTable.style.display = "block";
                productosTableContent.style.display = "none";
                
                // Aquí puedes llamar a una función que genere la tabla de Ventas y aplique los filtros.
                generarTablaVentas();

            }
        });

        radioProductos.addEventListener("change", function() {
            if (radioProductos.checked) {
                // Mostrar la tabla de Productos y ocultar la de Ventas
                // ...

                productosTableContent.style.display = "block";
                ventasTable.style.display = "none";
                
                // Aquí puedes llamar a una función que genere la tabla de Productos y aplique los filtros.
                generarTablaProductos();
            }
        });

        function generarTablaProductos() {
            // Realiza una solicitud GET para obtener los datos de productos desde el servidor
            fetch('../controladores/funcionesReportes.php?action=generarTablaProductos')
            .then(response => {
                if (!response.ok) {
                    throw new Error('La solicitud no fue exitosa');
                }
                return response.json(); // Convierte la respuesta a JSON
            })
            .then(data => {
                // Aquí puedes procesar los datos y crear la tabla dinámicamente
                datosOriginalesProductos = data;
                crearTablaProdcutos(datosOriginalesProductos);
            })
            .catch(error => {
                console.error('Error al obtener los datos de ventas:', error);
            });

        }

        function crearTablaProdcutos(datosOriginalesProductos) {
            //agrega los checks de los tiposProductos
            const tipoProductos = obtenerTipoProductos(datosOriginalesProductos);
            agregarCasillasDeVerificacionTipoProductos(tipoProductos);

            //agrega los checks de las categorias
            const tipoCategorias = obtenerCategoria(datosOriginalesProductos);
            agregarCasillasDeVerificaciontipoCategoria(tipoCategorias);

            const tabla = document.querySelector('#productosTableContent table tbody');
            tabla.innerHTML = ''; // Limpia cualquier contenido previo en la tabla

            datosOriginalesProductos.forEach(producto => {
                const fila = document.createElement('tr');

                const propiedades = ['idProductos','Nombre', 'Proveedor', 'TipoProd', 'TipoCat', 'Tamaño', 'Medida', 'CantidadTotal' , 'PrecioCosto'];

                propiedades.forEach(propiedad => {
                    const celda = document.createElement('td');
                    celda.textContent = producto[propiedad];
                    fila.appendChild(celda);
                });

                tabla.appendChild(fila);
            });


            if (tablaProductos) {
                // Si ya existe una instancia de DataTable, actualiza los datos y el orden sin destruirla
                tablaProductos.clear().rows.add(datosOriginalesProductos).draw();
            } else {
                // Si no existe una instancia de DataTable, crea una nueva
                tablaProductos = $('#tablaProductos').DataTable({
                    searching: false,
                    lengthChange: true,
                    order: [[0, 'desc']],
                    columns: [
                            { data: 'idProductos' },
                            { data: 'Nombre' },
                            { data: 'Proveedor' },
                            { data: 'TipoProd' },
                            { data: 'TipoCat' },
                            { data: 'Tamaño' },
                            { data: 'Medida' },
                            { data: 'CantidadTotal' },
                            { data: 'PrecioCosto' }
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

        function obtenerTipoProductos(datosOriginalesProductos) {
            const tipoProductosUnicos = new Set();
            datosOriginalesProductos.forEach(producto => {
                tipoProductosUnicos.add(producto.TipoProd);
            });
            return Array.from(tipoProductosUnicos);
        }

        function agregarCasillasDeVerificacionTipoProductos(tipoProductos) {
            limpiarCasillasDeVerificacionTipoProductos();

            const contenedor = document.getElementById('TipoProductoCheckboxes');

            tipoProductos.forEach(tipoProducto => {
                const div = document.createElement('div');
                div.classList.add('form-check'); // Agrega la clase "form-check" para mantener el estilo del checkbox

                const checkbox = document.createElement('input');
                checkbox.type = 'checkbox';
                checkbox.value = tipoProducto;
                checkbox.id = `checkbox-tipoProducto-${tipoProducto}`;
                checkbox.classList.add('form-check-input');

                const label = document.createElement('label');
                label.htmlFor = `checkbox-tipoProducto-${tipoProducto}`;
                label.textContent = tipoProducto;
                label.classList.add('form-check-label');
                div.appendChild(checkbox);
                div.appendChild(label);

                contenedor.appendChild(div);
            });
        }

        function limpiarCasillasDeVerificacionTipoProductos() {
            const contenedor = document.getElementById('TipoProductoCheckboxes');
            contenedor.innerHTML = ''; // Borra todo el contenido anterior
        }

        function obtenerCategoria(datosOriginalesProductos) {
            const tipoCategoriaUnicos = new Set();
            datosOriginalesProductos.forEach(producto => {
                tipoCategoriaUnicos.add(producto.TipoCat);
            });
            return Array.from(tipoCategoriaUnicos);
        }

        function agregarCasillasDeVerificaciontipoCategoria(tipoCategorias) {
            limpiarCasillasDeVerificacionTipoCategoria();

            const contenedor = document.getElementById('categoriaCheckboxes');

            tipoCategorias.forEach(tipoCategoria => {
                const div = document.createElement('div');
                div.classList.add('form-check'); // Agrega la clase "form-check" para mantener el estilo del checkbox

                const checkbox = document.createElement('input');
                checkbox.type = 'checkbox';
                checkbox.value = tipoCategoria;
                checkbox.id = `checkbox-tipoCategoria-${tipoCategoria}`;
                checkbox.classList.add('form-check-input');

                const label = document.createElement('label');
                label.htmlFor = `checkbox-tipoCategoria-${tipoCategoria}`;
                label.textContent = tipoCategoria;
                label.classList.add('form-check-label');
                div.appendChild(checkbox);
                div.appendChild(label);

                contenedor.appendChild(div);
            });
        }

        function limpiarCasillasDeVerificacionTipoCategoria() {
            const contenedor = document.getElementById('categoriaCheckboxes');
            contenedor.innerHTML = ''; // Borra todo el contenido anterior
        }

        function aplicarFiltrosProductos() {
            datosFiltradosProductos = datosOriginalesProductos;
            console.log(datosFiltradosProductos);
            const filtroProducto = document.getElementById('filtroProducto').value.toLowerCase().trim(); 
            const filtroProveedor = document.getElementById('filtroProveedor').value.toLowerCase().trim(); // Obtener el valor del campo de búsqueda en minúsculas y eliminar espacios en blanco


            // Aplica el filtro por producto
            datosFiltradosProductos = datosFiltradosProductos.filter(producto => {
                const nombreProducto = producto.Nombre.toLowerCase().trim(); // Obtener el nombre del proveedor en minúsculas y eliminar espacios en blanco
                return nombreProducto.includes(filtroProducto); // Comprobar si el nombre del proveedor incluye el filtro
            });

            // Aplica el filtro por proveedor
            datosFiltradosProductos = datosFiltradosProductos.filter(producto => {
                const nombreProveedor = producto.Proveedor.toLowerCase().trim(); // Obtener el nombre del proveedor en minúsculas y eliminar espacios en blanco
                return nombreProveedor.includes(filtroProveedor); // Comprobar si el nombre del proveedor incluye el filtro
            });


            // Obtiene los checkbox de los tipos productos seleccionadas
            const tipoProductosCheckboxes = document.querySelectorAll('#TipoProductoCheckboxes input[type="checkbox"]:checked');
            const tipoProductosSeleccionados = new Set();

            tipoProductosCheckboxes.forEach(checkbox => {
                tipoProductosSeleccionados.add(checkbox.value);
            });

            console.log(tipoProductosSeleccionados);

            // Aplica el filtro por tipos productos
            datosFiltradosProductos = datosFiltradosProductos.filter(producto => {
                console.log(producto.TipoProd);
                return tipoProductosSeleccionados.size === 0 || tipoProductosSeleccionados.has(producto.TipoProd);
            });


            // Obtiene los checkbox de los tipos Categorias seleccionadas
            const categoriasCheckboxes = document.querySelectorAll('#categoriaCheckboxes input[type="checkbox"]:checked');
            const categoriasSeleccionados = new Set();

            categoriasCheckboxes.forEach(checkbox => {
                categoriasSeleccionados.add(checkbox.value);
            });

            console.log(tipoProductosSeleccionados);

            // Aplica el filtro por tipos productos
            datosFiltradosProductos = datosFiltradosProductos.filter(producto => {
                console.log(producto.TipoCat);
                return categoriasSeleccionados.size === 0 || categoriasSeleccionados.has(producto.TipoCat);
            });


            // Aplica el filtro por rango de precio
            const minPrecio = parseFloat(document.getElementById('filtroPrecioMinProducto').value);
            const maxPrecio = parseFloat(document.getElementById('filtroPrecioMaxProducto').value);

            if ( minPrecio < 0 || maxPrecio < 0 || minPrecio > maxPrecio) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Error en el Rango de Precio',
                    text: 'el mínimo no puede ser mayor que el máximo, y no pueden ser números negativos.',
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
                return
            }

            console.log(minPrecio);
            console.log(maxPrecio);
            // Filtra los datos por rango de precio si se han proporcionado valores válidos
            if (!isNaN(minPrecio) && !isNaN(maxPrecio) && minPrecio <= maxPrecio) {
                datosFiltradosProductos = datosFiltradosProductos.filter(producto => {
                    
                    const precioCostoProducto = parseFloat(producto.PrecioCosto);
                    //console.log(minPrecio , " " , precioCostoProducto , " ", maxPrecio)
                    return precioCostoProducto >= minPrecio && precioCostoProducto <= maxPrecio;
                });
            }


            console.log(datosFiltradosProductos);

            if (filtroProveedor === '' && filtroProducto === '' && tipoProductosSeleccionados.size === 0 && categoriasSeleccionados.size === 0 && (isNaN(minPrecio) || isNaN(maxPrecio) || minPrecio > maxPrecio)) {
                datosFiltradosProductos = datosOriginalesProductos;
            }




            // Después de aplicar todos los filtros, actualiza la tabla con los datos filtrados
            actualizarTablaProdcutos(datosFiltradosProductos);

        }

        function actualizarTablaProdcutos(datosFiltradosProductos) {
            if (tablaProductos) {
                // Si ya existe una instancia de DataTable, actualiza los datos sin destruirla
                tablaProductos.clear().rows.add(datosFiltradosProductos).draw();
            }
        }

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
            const filtroNombreProducto = document.getElementById('filtroNombreProducto').value.toLowerCase().trim(); 
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
                const nombreProductoVenta = venta.Producto.toLowerCase().trim(); // Obtener el nombre del proveedor en minúsculas y eliminar espacios en blanco
                return nombreProductoVenta.includes(filtroNombreProducto); // Comprobar si el nombre del proveedor incluye el filtro
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


            if ( minPrecio < 0 || maxPrecio < 0 || minPrecio > maxPrecio) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Error en el Rango de Precio',
                    text: 'el mínimo no puede ser mayor que el máximo, y no pueden ser números negativos.',
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
                return
            }

            // Filtra los datos por rango de precio si se han proporcionado valores válidos
            if (!isNaN(minPrecio) && !isNaN(maxPrecio) && minPrecio <= maxPrecio) {
                datosFiltrados = datosFiltrados.filter(venta => {
                    const precioVenta = parseFloat(venta.Total);
                    return precioVenta >= minPrecio && precioVenta <= maxPrecio;
                });
            }

            // Verifica si no se ha seleccionado ningún filtro y muestra todos los registros
            if (!filtros.fechaDesde && !filtros.fechaHasta && filtroNombreProducto.size === '' && sucursalesSeleccionadas.size === 0 && filtroVendedor === '' && (isNaN(minPrecio) || isNaN(maxPrecio) || minPrecio > maxPrecio)) {
                datosFiltrados = datosOriginales;
                console.log(datosFiltrados, "nada");
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


        function resetFiltrosVentas () {
            console.log("reset");

            //resetea las fechas
            filtros.fechaDesde = ''; // Restablece la fecha desde
            filtros.fechaHasta = ''; // Restablece la fecha hasta
            // Luego, actualiza los campos de entrada y los elementos de filtro en la interfaz gráfica si es necesario
            document.querySelector('#datepickerDesde').value = '';
            document.querySelector('#datepickerHasta').value = '';

            // Resetea el input de productos
            const filtroNombreProducto = document.getElementById('filtroNombreProducto');
            filtroNombreProducto.value = ''; // Establece el valor en una cadena vacía

            
            // Resetea el input de Vendedor
            const filtroVendedor = document.getElementById('filtroVendedor');
            filtroVendedor.value = ''; // Establece el valor en una cadena vacía

            // Resetea todos los checkboxes de sucursal
            const sucursalCheckboxes = document.querySelectorAll('#sucursalFilterGroup input[type="checkbox"]');
            sucursalCheckboxes.forEach(checkbox => {
                checkbox.checked = false;
            });


            // Resetea los inputs de rangos de precio
            const inputMinPrecio = document.getElementById('filtroPrecioMin');
            const inputMaxPrecio = document.getElementById('filtroPrecioMax');

            // Restablece los valores a los originales
            inputMinPrecio.value = ''; // Establece el valor mínimo en vacío
            inputMaxPrecio.value = ''; // Establece el valor máximo en vacío

            //Resetea la tabla
            actualizarTabla(datosOriginales);

        }

        function resetFiltrosProductos () {
            console.log("asdsad")

            // Resetea el input de Nombre de Producto
            const filtroProducto = document.getElementById('filtroProducto');
            filtroProducto.value = ''; 

            // Resetea el input de Proveedor
            const filtroProveedor = document.getElementById('filtroProveedor');
            filtroProveedor.value = ''; 

            // Resetea todos los checkboxes de Tipo Producto
            const TipoProductoCheckboxes = document.querySelectorAll('#TipoProductoCheckboxes input[type="checkbox"]');
            TipoProductoCheckboxes.forEach(checkbox => {
                checkbox.checked = false;
            });

            // Resetea todos los checkboxes de Tipo Producto
            const categoriaCheckboxes = document.querySelectorAll('#categoriaCheckboxes input[type="checkbox"]');
            categoriaCheckboxes.forEach(checkbox => {
                checkbox.checked = false;
            });

            // Resetea los inputs de rangos de precio
            const inputMinPrecio = document.getElementById('filtroPrecioMinProducto');
            const inputMaxPrecio = document.getElementById('filtroPrecioMaxProducto');

            // Restablece los valores a los originales
            inputMinPrecio.value = ''; // Establece el valor mínimo en vacío
            inputMaxPrecio.value = ''; // Establece el valor máximo en vacío

            //Resetea la tabla
            actualizarTablaProdcutos(datosOriginalesProductos);
        }



        function generarPDFVentas(){
        const data = datosFiltrados; 

        // Verificar si hay datos para generar el PDF
        if (data.length === 0) {
            Swal.fire({
                position: 'top-end',
                icon: 'warning',
                title: 'No Realizó Ningún Filtro',
                showConfirmButton: false,
                timer: 3000,
                background: false,
                backdrop: false,
                customClass: {
                    container: 'custom-container-class',
                    popup: 'custom-popup-class',
                    title: 'custom-title-class',
                    icon: 'custom-icon-class',
                }
            });
            return;
        }
        // Agregar un contador a los datos antes de generar el PDF
        const dataWithCounter = data.map((venta, index) => {
            return { nro: index + 1, ...venta };
        });

        const totalSum = data.reduce((acc, venta) => {
            if (venta.Total) {
                console.log(acc , venta.Total)
                return acc + parseFloat(venta.Total);
            }
            return acc;
        }, 0);

        console.log(totalSum)

        // Agregar una fila al final con el total
        const tableBody = [
            ...dataWithCounter.map(venta => [
                { text: venta.nro, alignment: 'center' }, 
                { text: venta.Fecha, alignment: 'center' }, 
                { text: venta.Producto, alignment: 'center' }, 
                { text: venta.cantidad, alignment: 'center' }, 
                { text: venta.Vendedor, alignment: 'center' }, 
                { text: venta.Sucursal, alignment: 'center' }, 
                { text: venta.Total, alignment: 'center' }
            ]),
        ];
        const docDefinition = {
            content: [
                { text: 'Reporte de Ventas', style: 'header' },
                '\n',
                {
                    table: {
                        headerRows: 1,
                        widths: [40, 80, 230, 70, 120, 100, 60],
                        body: [
                            [{ text: 'Nro', style: 'tableHeader' }, { text: 'Fecha', style: 'tableHeader' }, { text: 'Producto', style: 'tableHeader' }, { text: 'Cantidad', style: 'tableHeader' }, { text: 'Vendedor', style: 'tableHeader' }, { text: 'Sucursal', style: 'tableHeader' }, { text: 'Total', style: 'tableHeader' }],
                            ...tableBody // Usamos la tabla con la fila de totales
                        ],
                    },
                },
                {
                    layout: 'noBorders', // Elimina los bordes de esta sección
                    table: {
                        widths: ['*', 'auto'], // Dos columnas: una con tamaño automático y otra con un ancho específico
                        body: [
                            [
                                { text: 'Total', style: 'totalLabel' },
                                { text: '$' + totalSum.toFixed(2).toString(), style: 'totalValue', alignment: 'right' } // Alinea el valor a la derecha
                            ]
                        ]
                    }
                }
            ],
            styles: {
                header: { 
                    fontSize: 25, // Tamaño de fuente
                    bold: true, // Texto en negrita
                    alignment: 'center', // Alineación en el centro
                    margin: [0, 10, 0, 20], // Márgenes [arriba, derecha, abajo, izquierda]
                    color: 'black', // Color de texto
                    lineHeight: 1.2, // Altura de línea
                    padding: 5, // Espaciado interno
                },
                tableHeader: { bold: true, fontSize: 15, color: 'black', fillColor: '#DFDFDF', alignment: 'center' },
                tableCell: { fontSize: 15, alignment: 'center' }, // Alineación del texto en las celdas de datos
                totalLabel: { fontSize: 15, bold: true, border: [true, true, true, false]}, // Borde solo en la parte superior
                totalValue: { fontSize: 15, bold: true, border: [true, true, true, true], alignment: 'center' }, // Borde en todos los lados
            },
            defaultStyle: {
                fontSize: 13,
            },
            columnStyles: {
                0: { alignment: 'center' }, // Centrar la primera columna (Nro)
                1: { alignment: 'center' }, // Centrar la segunda columna (Fecha)
                2: { alignment: 'center' }, // Centrar la tercera columna (Producto)
                3: { alignment: 'center' }, // Centrar la cuarta columna (Cantidad)
                4: { alignment: 'center' }, // Centrar la quinta columna (Vendedor)
                5: { alignment: 'center' }, // Centrar la sexta columna (Sucursal)
                6: { alignment: 'center' }, // Centrar la séptima columna (Total)
            },
            pageOrientation: 'landscape', // Configura la orientación a apaisada
            footer: function (currentPage, pageCount) {
                const currentDate = new Date();
                const months = ["enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"];

                const formattedDate = currentDate.getDate() + " de " + months[currentDate.getMonth()] + " de " + currentDate.getFullYear();

                return {
                    text: [
                        { text: 'Página ' + currentPage.toString() + ' de ' + pageCount, alignment: 'right', fontSize: 12, bold: true },
                        '\n',
                        { text: formattedDate, alignment: 'right', fontSize: 12, bold: true },
                    ],
                    margin: [20, 0],
                };
            },
        };

        // Personaliza la apariencia de la tabla
        docDefinition.styles.table = {
            margin: [0, 5, 0, 15], // Márgenes de la tabla
            fontSize: 10, // Tamaño de fuente de las celdas de la tabla
            alignment: 'center', // Alineación del texto en las celdas
        };

        // Estilo de las celdas de datos (puedes personalizarlo según tus preferencias)
        docDefinition.styles.tableCell = {
            fillColor: '#F5F5F5', // Color de fondo de las celdas
            fontSize: 10, // Tamaño de fuente de las celdas de datos
            color: 'black', // Color del texto en las celdas de datos
        };

        pdfMake.createPdf(docDefinition).open();

}

    function generarPDFVentasProductos() {
    const dataProductos = datosFiltradosProductos;

    console.log(dataProductos);

    // Verificar si hay datos para generar el PDF
    if (dataProductos.length === 0) {
        Swal.fire({
            position: 'top-end',
            icon: 'warning',
            title: 'No Realizó Ningún Filtro',
            showConfirmButton: false,
            timer: 3000,
            background: false,
            backdrop: false,
            customClass: {
                container: 'custom-container-class',
                popup: 'custom-popup-class',
                title: 'custom-title-class',
                icon: 'custom-icon-class',
            }
        });
        return;
    }

    // Agregar un contador a los datos antes de generar el PDF
    const dataWithCounter = dataProductos.map((producto, index) => {
        return { nro: index + 1, ...producto };
    });

    const totalSumCostoProducto = dataProductos.reduce((acc, producto) => {
        if (!isNaN(parseFloat(producto.PrecioCosto))) { // Verificar si el valor es un número válido
            return acc + parseFloat(producto.PrecioCosto);
        }
        return acc;
    }, 0);

    console.log(totalSumCostoProducto);


    // Crear una tabla para el PDF
    const tableBody = [
        ...dataWithCounter.map(producto => [
            { text: producto.nro, alignment: 'center' },
            { text: producto.Nombre, alignment: 'center' },
            { text: producto.Proveedor, alignment: 'center' },
            { text: producto.TipoProd, alignment: 'center' },
            { text: producto.TipoCat, alignment: 'center' },
            { text: producto.Tamaño, alignment: 'center' },
            { text: producto.Medida, alignment: 'center' },
            { text: producto.CantidadTotal, alignment: 'center' },
            { text: `$${parseFloat(producto.PrecioCosto).toFixed(2)}`, alignment: 'center' },
        ]),
    ];

    // Definir la estructura del documento PDF
    const docDefinition = {
        content: [
            { text: 'Reporte de Productos', style: 'header' },
            '\n',
            {
                table: {
                    headerRows: 1,
                    widths: [30, 210, 70, 70, 80, 50, 50, 60, 80],
                    body: [
                        [
                            { text: 'Nro', style: 'tableHeader' },
                            { text: 'Nombre', style: 'tableHeader' },
                            { text: 'Proveedor', style: 'tableHeader' },
                            { text: 'Tipo', style: 'tableHeader' },
                            { text: 'Categoría', style: 'tableHeader' },
                            { text: 'Tamaño', style: 'tableHeader' },
                            { text: 'Medida', style: 'tableHeader' },
                            { text: 'Cantidad', style: 'tableHeader' },
                            { text: 'Precio Costo', style: 'tableHeader' },
                        ],
                        ...tableBody,
                    ],
                },
            },
            {
                    layout: 'noBorders', // Elimina los bordes de esta sección
                    table: {
                        widths: ['*', 'auto'], // Dos columnas: una con tamaño automático y otra con un ancho específico
                        body: [
                            [
                                { text: 'Total', style: 'totalLabel' },
                                { text: '$' + totalSumCostoProducto.toFixed(2).toString(), style: 'totalValue', alignment: 'right' } // Alinea el valor a la derecha
                            ]
                        ]
                    }
            }
        ],
        styles: {
            header: {
                fontSize: 25,
                bold: true,
                alignment: 'center',
                margin: [0, 10, 0, 20],
                color: 'black',
                lineHeight: 1.2,
                padding: 5,
            },
            tableHeader: {
                bold: true,
                fontSize: 13,
                color: 'black',
                fillColor: '#DFDFDF',
                alignment: 'center',
            },
            tableCell: { fontSize: 13, alignment: 'center' }, // Alineación del texto en las celdas de datos
            totalLabel: { fontSize: 13, bold: true, border: [true, true, true, false]}, // Borde solo en la parte superior
            totalValue: { fontSize: 13, bold: true, border: [true, true, true, true], alignment: 'center' }, // Borde en todos los lados
        },
        defaultStyle: {
            fontSize: 13,
        },
        columnStyles: {
            0: { alignment: 'center' },
            1: { alignment: 'center' },
            2: { alignment: 'center' },
            3: { alignment: 'center' },
            4: { alignment: 'center' },
            5: { alignment: 'center' },
            6: { alignment: 'center' },
            7: { alignment: 'center' },
            8: { alignment: 'center' },
        },
        pageOrientation: 'landscape', // Configura la orientación a apaisada
            footer: function (currentPage, pageCount) {
                const currentDate = new Date();
                const months = ["enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"];

                const formattedDate = currentDate.getDate() + " de " + months[currentDate.getMonth()] + " de " + currentDate.getFullYear();

                return {
                    text: [
                        { text: 'Página ' + currentPage.toString() + ' de ' + pageCount, alignment: 'right', fontSize: 12, bold: true },
                        '\n',
                        { text: formattedDate, alignment: 'right', fontSize: 12, bold: true },
                    ],
                    margin: [20, 0],
                };
            },
    };

        // Personaliza la apariencia de la tabla
        docDefinition.styles.table = {
        margin: [0, 5, 0, 15], // Márgenes de la tabla
        fontSize: 10, // Tamaño de fuente de las celdas de la tabla
        alignment: 'center', // Alineación del texto en las celdas
    };

    // Estilo de las celdas de datos (puedes personalizarlo según tus preferencias)
    docDefinition.styles.tableCell = {
        fillColor: '#F5F5F5', // Color de fondo de las celdas
        fontSize: 10, // Tamaño de fuente de las celdas de datos
        color: 'black', // Color del texto en las celdas de datos
    };

    pdfMake.createPdf(docDefinition).open();
    }


    </script>
        
</body>

</html>
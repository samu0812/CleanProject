<!-- Navbar Start -->
<?php
    include("../bd/conexion.php");
    $nombrePersona = isset($_SESSION['nombrePersona']) ? $_SESSION['nombrePersona'] : '';
?>
<script>
    function verificarStock() {
        // Lógica de verificación de stock en PHP
        <?php
            $limiteStock = 30; // Ajusta el límite de stock según tus necesidades

            // Verificación de stock
            $sql = "SELECT COUNT(*) AS count
                    FROM Productos P
                    JOIN StockSucursales SS ON P.idProductos = SS.idProductos
                    WHERE SS.Cantidad < ?";
        
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $limiteStock);
            $stmt->execute();
            $stmt->bind_result($count);
            $stmt->fetch();
            $stmt->close();
        ?>

        // Lógica de verificación de stock en JavaScript
        if (<?php echo $count; ?> > 0) {
            // No hay registros con stock bajo, muestra la campana con fondo naranja
            document.getElementById('campana').style.backgroundColor = '#e77a34';
            document.getElementById('campana').style.color = '#FFFFFF';
        } else {
            // Hay registros con stock bajo, muestra la campana con fondo blanco
            document.getElementById('campana').style.backgroundColor = '#FFFFFF';
            document.getElementById('campana').style.color = '#e77a34';
        }
    }

    // Verificar inicialmente al cargar la página
    verificarStock();

    // Verificar cada 5 segundos
    setInterval(verificarStock, 2000);
</script>

<nav class="navbar navbar-expand sticky-top py-0"> 
    <a href="#" class="sidebar-toggler flex-shrink-0" style="margin-left: 25px; color: #e77a34">
        <i class="fa fa-bars" style="color: #e77a34"></i>
    </a>
    <a id="campana" href="productos.php" class="campana-link" style="margin-left: 10px;width: 40px;height: 40px;display: inline-flex;align-items: 
        center;justify-content: center;background: #e77a34;border-radius: 40px;color: #FFFFFF;">
        <i class="fas fa-bell"></i>
    </a>

    <script>
        function verificarStock() {
            var iconoCampana = document.querySelector('.fas.fa-bell');
            fetch("../controladores/verificar_stock.php")
                .then(response => response.json())
                .then(count => {
                    console.log(count);
                    const campana = document.getElementById("campana");
                    if (parseInt(count) > 0) {
                        campana.style.backgroundColor = "#e77a34";
                        campana.style.color = "#FFFFFF";
                        iconoCampana.style.color = "#FFFFFF";
                    } else {
                        campana.style.backgroundColor = "#FFFFFF";
                        campana.style.color = "#e77a34";
                        iconoCampana.style.color = "#e77a34";
                    }
                })
                .catch(error => {
                    console.error('Error al verificar stock: ', error);
                });
        }

        // Mostrar u ocultar el navbar al desplazarse
        var prevScrollPos = window.pageYOffset;
        window.onscroll = function() {
            var currentScrollPos = window.pageYOffset;

            if (prevScrollPos > currentScrollPos) {
                // Muestra el navbar si el usuario está desplazándose hacia arriba
                document.getElementById("navbar").classList.remove("hidden");
            } else {
                // Oculta el navbar si el usuario está desplazándose hacia abajo
                document.getElementById("navbar").classList.add("hidden");
            }

            prevScrollPos = currentScrollPos;
        };

        // Verificar inicialmente al cargar la página
        verificarStock();

        // Verificar cada 5 segundos
        setInterval(verificarStock, 5000);
    </script>

    <div class="navbar-nav align-items-center ms-auto">
        <div class="nav-item dropdown rounded">
            <a href="#" class="nav-link dropdown-toggle" style="margin-right: 10px" data-bs-toggle="dropdown">
                <img class="rounded" src="../img/grupo.png" alt="" style="color: #e77a34; width: 45px; height: 45px; margin-right: 5px">
                <span style="font-size: 16px; color: #e77a34" class="badge d-lg-inline-flex p-0"><?php echo $nombrePersona?></span>
            </a>
            
            <div class="dropdown-menu dropdown-menu-end bg-light border-1 rounded-0 rounded-bottom m-0">
                <a href="ajustes.php" class="dropdown-item">Ajustes</a>
                <a href="logout.php" class="dropdown-item">Cerrar Sesión</a>
            </div>
        </div>
    </div>
</nav>


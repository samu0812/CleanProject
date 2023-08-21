<?php
    session_start(); // Iniciar la sesión
    include ("bd/conexion.php");
    // login.php



    // Verificar si ya se ha iniciado sesión
    if (isset($_SESSION['usuario'])) {
        // El usuario ya está autenticado, redirigir a la página principal o a otro destino deseado
        header("Location: index.php");
        exit();
    }

    // Verificar si se envió el formulario de inicio de sesión
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obtener los valores ingresados en el formulario
        $correo = $_POST['correo'];
        $clave = $_POST['clave'];

        // Realizar la consulta a la base de datos para verificar las credenciales
        $consulta = "SELECT persona.idPersona, persona.email, empleado.clave 
        FROM persona INNER JOIN empleado ON persona.idPersona = empleado.idPersona WHERE persona.email = '$correo' and empleado.clave= '$clave'";
        $resultado = mysqli_query($conn, $consulta);

        if ($resultado && mysqli_num_rows($resultado) === 1) {
            // El usuario existe en la base de datos, verificar la contraseña
            $fila = mysqli_fetch_assoc($resultado);
            $hash = $fila['clave'];
            

            if ($clave === $hash) {
                // La contraseña es correcta, iniciar la sesión
                
                $_SESSION['usuario'] = $fila['idPersona'];
                $_SESSION['nombre_usuario'] = $fila['Nombre'];

                header("Location: vistas\home.php");

                // Redirigir a la página principal o a otro destino deseado
            } else {
                // Contraseña incorrecta
                echo "Contraseña incorrecta";
            }
        } else {
            // Usuario no encontrado 
            ?>              
                <link rel="stylesheet" type="text/css" href="css\error.css">
                        <div class="error">
                            <div class="error__icon">
                                <svg fill="none" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="m13 13h-2v-6h2zm0 4h-2v-2h2zm-1-15c-1.3132 0-2.61358.25866-3.82683.7612-1.21326.50255-2.31565 1.23915-3.24424 2.16773-1.87536 1.87537-2.92893 4.41891-2.92893 7.07107 0 2.6522 1.05357 5.1957 2.92893 7.0711.92859.9286 2.03098 1.6651 3.24424 2.1677 1.21325.5025 2.51363.7612 3.82683.7612 2.6522 0 5.1957-1.0536 7.0711-2.9289 1.8753-1.8754 2.9289-4.4189 2.9289-7.0711 0-1.3132-.2587-2.61358-.7612-3.82683-.5026-1.21326-1.2391-2.31565-2.1677-3.24424-.9286-.92858-2.031-1.66518-3.2443-2.16773-1.2132-.50254-2.5136-.7612-3.8268-.7612z" fill="#393a37"></path></svg>
                             </div>
                         <div class="error__title">Correo o Contraseña incorrectas</div>
                    </div>
            <?php
        }
    }

    ?>



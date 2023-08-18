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
        $contraseña = $_POST['contraseña'];

        // Realizar la consulta a la base de datos para verificar las credenciales
        $consulta = "SELECT persona.idPersona, persona.email, empleado.clave FROM persona INNER JOIN empleado ON persona.idPersona = empleado.idPersona WHERE persona.email = '$correo' and empleado.clave= '$contraseña'";
        $resultado = mysqli_query($con, $consulta);

        if ($resultado && mysqli_num_rows($resultado) === 1) {
            // El usuario existe en la base de datos, verificar la contraseña
            $fila = mysqli_fetch_assoc($resultado);
            $hash = $fila['contraseña'];

            if ($contraseña === $hash) {
                // La contraseña es correcta, iniciar la sesión
                $_SESSION['usuario'] = $fila['idPersona'];
                header("Location: home.php");

                // Redirigir a la página principal o a otro destino deseado
            } else {
                // Contraseña incorrecta
                echo "Contraseña incorrecta";
            }
        } else {
            // Usuario no encontrado 
            ?>
            <div class=" alert alert-danger d-flex align-items-center" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </svg>
                        <div>
                            ¡Correo o contraseña incorrecta!
                        </div>
                    </div>
            <?php
        }
    }

    ?>



<?php
    session_start(); // Iniciar la sesión
    include ("bd\conexion.php");
    // login.php

    // Verificar si ya se ha iniciado sesión
    if (isset($_SESSION['usuario'])) {
        // El usuario ya está autenticado, redirigir a la página principal o a otro destino deseado
        header("Location: index.php");
    }

    // Verificar si se envió el formulario de inicio de sesión
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obtener los valores ingresados en el formulario
        $Email = $_POST['Email'];
        $Clave = $_POST['Clave'];

        // Realizar la consulta a la base de datos para verificar las credenciales

        $consulta = "SELECT Persona.idPersona, Persona.Email, Empleado.Clave 
        FROM Persona INNER JOIN Empleado ON persona.idPersona = Empleado.idPersona WHERE Persona.email = '$Email'";
        $resultado = mysqli_query($conn, $consulta);
        
        function obtenerNombrePersona($idPersona, $conn) { 
            $consultaNombre = "SELECT Nombre FROM Persona WHERE idPersona = $idPersona";
            $resultadoNombre = mysqli_query($conn, $consultaNombre);
        
            if ($resultadoNombre && mysqli_num_rows($resultadoNombre) === 1) {
                $filaNombre = mysqli_fetch_assoc($resultadoNombre);
                return $filaNombre['Nombre'];
            } else {
                return "Nombre no encontrado";
            }
        }

        function obtenerRolDescripcion($idPersona, $conn) {
            $sql = "SELECT e.IdRol, r.Descripcion
                    FROM Empleado e
                    INNER JOIN Rol r ON e.IdRol = r.idRol
                    WHERE e.idPersona = $idPersona";
            
            // Ejecutar la consulta
            $resultado = mysqli_query($conn, $sql);
            $fila = mysqli_fetch_assoc($resultado);
            mysqli_free_result($resultado);
            return $fila;
        }    

        function obtenerSucursalDescripcion($idPersona, $conn) {
            $sql = "SELECT e.IdSucursales, r.Descripcion
                    FROM Empleado e
                    INNER JOIN Sucursales r ON e.IdSucursales = r.IdSucursales
                    WHERE e.idPersona = $idPersona";
            
            // Ejecutar la consulta
            $resultado = mysqli_query($conn, $sql);
            $fila = mysqli_fetch_assoc($resultado);
            mysqli_free_result($resultado);
            return $fila;
        }    


        function obtnerIdEmpleado($idPersona, $conn){
            $consultaId = "SELECT idEmpleado from Empleado WHERE idEmpleado = $idPersona";
            $resultadoId = mysqli_query($conn, $consultaId);
        
            if ($resultadoId && mysqli_num_rows($resultadoId) === 1) {
                $filaId = mysqli_fetch_assoc($resultadoId);
                return $filaId['idEmpleado'];
            } else {
                return "Rol no encontrado";
            }
        }

        


        if ($resultado && mysqli_num_rows($resultado) === 1) {
            // El usuario existe en la base de datos, verificar la contraseña
            $fila = mysqli_fetch_assoc($resultado);
            $hash = $fila['Clave']; 
            
            

            $password = password_verify($Clave, $hash);
            if ($password === TRUE){
                // La contraseña es correcta, iniciar la sesión
                
                $_SESSION['usuario'] = $fila['idPersona'];
                header("Location: home.php");

                
                $idPersona = $fila['idPersona'];
                $_SESSION['usuario'] = $idPersona;

                $nombrePersona = obtenerNombrePersona($idPersona, $conn);
                $_SESSION['nombrePersona'] = $nombrePersona;

                $rol = obtenerRolDescripcion($idPersona, $conn);
                $_SESSION['rol'] = $rol['Descripcion'];

                $idRol = obtenerRolDescripcion($idPersona, $conn);
                $_SESSION['idRol'] = $idRol['IdRol'];

                $sucursal = obtenerSucursalDescripcion($idPersona, $conn);
                $_SESSION['sucursal'] = $sucursal['Descripcion'];

                $idSucursales = obtenerSucursalDescripcion($idPersona, $conn);
                $_SESSION['idSucursales'] = $idSucursales['IdSucursales'];
                
                $idEmpleado = obtnerIdEmpleado($idPersona, $conn);
                $_SESSION['idEmpleado'] = $idEmpleado;

                header("Location: vistas\home.php");


                // Redirigir a la página principal o a otro destino deseado
            } else {
                // Contraseña incorrecta
                echo "Contraseña incorrecta";
            }
        } else {
            // Usuario no encontrado 
            ?>
            <link href="css\error.css" rel="stylesheet">
                        <div class="error">
                            <div class="error__icon">
                                <svg fill="none" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="m13 13h-2v-6h2zm0 4h-2v-2h2zm-1-15c-1.3132 0-2.61358.25866-3.82683.7612-1.21326.50255-2.31565 1.23915-3.24424 2.16773-1.87536 1.87537-2.92893 4.41891-2.92893 7.07107 0 2.6522 1.05357 5.1957 2.92893 7.0711.92859.9286 2.03098 1.6651 3.24424 2.1677 1.21325.5025 2.51363.7612 3.82683.7612 2.6522 0 5.1957-1.0536 7.0711-2.9289 1.8753-1.8754 2.9289-4.4189 2.9289-7.0711 0-1.3132-.2587-2.61358-.7612-3.82683-.5026-1.21326-1.2391-2.31565-2.1677-3.24424-.9286-.92858-2.031-1.66518-3.2443-2.16773-1.2132-.50254-2.5136-.7612-3.8268-.7612z" fill="#393a37"></path></svg>
                             </div>
                        <div class="error__title">Correo o Contraseña incorrectas</div>
                    
                        </div>
                        </div>
                    </div>
            <?php
        }
    }

    ?>
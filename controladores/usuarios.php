<?php 
include("../bd/conexion.php");



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $Nombre = mysqli_real_escape_string($conn,$_POST['Nombre']);
    $Email = mysqli_real_escape_string($conn, $_POST['Email']);
    $Telefono = mysqli_real_escape_string($conn,$_POST['Telefono']);
    $Direccion = mysqli_real_escape_string($conn,$_POST['Direccion']);
    $FechaNacimiento = date('Y-m-d',strtotime(mysqli_real_escape_string($conn,$_POST['FechaNacimiento'])));
    $DescripcionRol = mysqli_real_escape_string($conn,$_POST['DescripcionRol']);
    $DescripcionSucursal = mysqli_real_escape_string($conn,$_POST['DescripcionSucursal']);
    $Clave = mysqli_real_escape_string($conn,$_POST['Clave']);

    }

    if (isset($_POST["crearUsuario"])) {
        $Email = $_POST["Email"];

    
        // Validar que correo y DNI no existan en la base de datos
        $validar = "SELECT * FROM Persona WHERE Email='$Email'";
        $result = mysqli_query($conn, $validar);
    
        if (mysqli_num_rows($result) > 0) {
            // El usuario ya existe agregar mensaje
            ?>
            <h3 class="na">¡El usuario ya existe en la base de datos!</h3>
            <?php
        } else {
            // Insertar nuevo usuario
            if (empty($Nombre) || empty($Email) || empty($Telefono) || empty($Direccion) || empty($FechaNacimiento) || empty($DescripcionRol) || empty($DescripcionSucursal) || empty($Clave)) {
                echo "Por favor, complete todos los campos.";
            }else{
                $Nombre = $_POST["Nombre"];
                $Telefono = $_POST['Telefono'];
                $Direccion = $_POST['Direccion'];
                $FechaNacimiento = $_POST['FechaNacimiento'];
                $DescripcionRol = $_POST['DescripcionRol'];
                $DescripcionSucursal = $_POST['DescripcionSucursal'];
                $Clave = $_POST['Clave'];
                // Generar hash de la contraseña
                $hashedClave = password_hash($Clave, PASSWORD_DEFAULT);
            
    
                $consulta1 = "INSERT INTO Persona (Nombre, Email, Telefono, Direccion, FechaNacimiento) VALUES ('$Nombre', '$Email', '$Telefono', '$Direccion', '$FechaNacimiento')";
                $resultado1 = mysqli_query($conn, $consulta1);
                $idPersona= mysqli_insert_id($conn);


                $consulta2= "INSERT INTO Empleado (idSucursales, idPersona, idRol, Clave) VALUES ('$DescripcionSucursal','$idPersona', '$DescripcionRol', '$hashedClave')";
                $resultado2 = mysqli_query($conn, $consulta2);
                
    
                if ($resultado1 && $resultado2) {
                    echo 'Usuario registrado correctamente'; //agregar mensaje
                    
                } else {
                // Error al registrar el usuario
                    ?>
                    <h3 class="bad">¡ha ocurrido un error!</h3>//agregar mensaje
                    <?php
            }
        }}
    }
    
    
?>
<?php
include '../bd/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Nombre = $_POST['Nombre'];
    $Email = $_POST['Email'];
    $Telefono = $_POST['Telefono'];
    $Direccion = $_POST['Direccion'];
    $FechaNacimiento = $_POST['FechaNacimiento'];
    $DescripcionRol = $_POST['DescripcionRol'];
    $DescripcionSucursal = $_POST['DescripcionSucursal'];
    $Clave = $_POST['Clave']; // Asegúrate de agregar esta línea
    $idPersona = $_POST['idPersona'];
    
    if (isset($_POST['UpdateUsuario'])) {
        $consulta1 = "SELECT idEmpleado, idRol, idSucursales FROM empleado WHERE idPersona = '$idPersona'";
        $result = $conn->query($consulta1);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $idEmpleado = $row["idEmpleado"];
                $idSucursal = $row["idSucursales"];
                $idRol = $row["idRol"];
                echo $idEmpleado, $idSucursal, $idRol;
                $hashedClave = password_hash($Clave, PASSWORD_DEFAULT);
                // Actualizar datos en la tabla Persona
                if (empty($Nombre) || empty($Email) || empty($Telefono) || empty($Direccion) || empty($FechaNacimiento) || empty($DescripcionRol) || empty($DescripcionSucursal) || empty($Clave) || empty($idPersona)) {
                    echo "Por favor, complete todos los campos.";
                    //AGREGAR MENSAJE
                } else {
            
                    $queryPersona = "UPDATE Persona SET Nombre=?, Email=?, Telefono=?, Direccion=?, FechaNacimiento=? WHERE idPersona=?";
                    $stmtPersona = $conn->prepare($queryPersona);
                    $stmtPersona->bind_param("sssssi", $Nombre, $Email, $Telefono, $Direccion, $FechaNacimiento, $idPersona);
            
                // Actualizar rol en la tabla Rol
                    $queryRol = "UPDATE Rol SET Descripcion=? WHERE idRol=?";
                    $stmtRol = $conn->prepare($queryRol);
                    $stmtRol->bind_param("si", $DescripcionRol, $idRol);
            
                // Actualizar sucursal en la tabla Sucursal
                    $querySucursal = "UPDATE Sucursales SET Descripcion=? WHERE idSucursales=?";
                    $stmtSucursal = $conn->prepare($querySucursal);
                    $stmtSucursal->bind_param("si", $DescripcionSucursal, $idSucursal);
            
                // Actualizar clave en la tabla Empleados
                    $queryEmpleado = "UPDATE Empleado SET Clave=? WHERE idEmpleado=?";
                    $stmtEmpleado = $conn->prepare($queryEmpleado);
                    $stmtEmpleado->bind_param("si", $hashedClave, $idEmpleado);
            
                // Ejecutar las actualizaciones en las tablas
                    if ($stmtPersona->execute() && $stmtRol->execute() && $stmtSucursal->execute() && $stmtEmpleado->execute()) {
                        echo "Actualización exitosa en todas las tablas";
                    } else {
                        echo "Error al actualizar: " . $conn->error;
                    }
                // Aquí puedes hacer lo que necesites con los datos

                    // Cerrar las declaraciones preparadas
                    $stmtPersona->close();
                    $stmtRol->close();
                    $stmtSucursal->close();
                    $stmtEmpleado->close();}
                    
            }
}
}}
// Cierra la conexión a la base de datos

?>

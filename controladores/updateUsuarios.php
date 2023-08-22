<?php
include '../bd/conexion.php';

if (isset($_POST['idPersona'])) {
    $idPersona = $_POST['idPersona'];
    $nombre = $_POST['editNombre'];
    $email = $_POST['editEmail'];
    $telefono = $_POST['editTelefono'];
    $direccion = $_POST['editDireccion'];
    $fechaNacimiento = $_POST['editFechaNacimiento'];
    $rol = $_POST['editRol'];
    $sucursal = $_POST['editSucursal'];

    $query = "UPDATE tablaUsuarios SET Nombre=?, Email=?, Telefono=?, Direccion=?, FechaNacimiento=?, Rol=?, Sucursal=? WHERE idPersona=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssssi", $nombre, $email, $telefono, $direccion, $fechaNacimiento, $rol, $sucursal, $idPersona);

    if ($stmt->execute()) {
        echo "Actualización exitosa";
    } else {
        echo "Error al actualizar: " . $stmt->error;
    }

    $stmt->close();
}else{
    echo "no anda"; }

// Cierra la conexión a la base de datos
$conn->close();
?>

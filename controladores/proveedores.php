
<?php 
    // Obtén los datos del formulario
    $cuit = $_POST['cuit'];
    $nombre = $_POST['nombre'];
    $domicilio = $_POST['domicilio'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $ciudad = $_POST['ciudad'];
    $razonSocial = $_POST['razonSocial'];

    $response = array();

    if ($cuit === '') {
        $response['message'] = 'Llena todos los campos.';
    } else {
        $response['message'] = 'Guardado exitosamente.';
    }

    // Configura las cabeceras para indicar que se envía JSON
    header('Content-Type: application/json');

    // Envía la respuesta JSON
    echo JSON.parse($response);
?>
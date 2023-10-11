<?php
include '../bd/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $opcion = $_POST['opcion'];

  switch ($opcion) {
    case 'rol':
      $query = "SELECT * FROM rol";
      break;
    case 'sucursal':
      $query = "SELECT * FROM sucursales";
      break;
    case 'tipoproducto':
      $query = "SELECT * FROM tipoproducto";
      break;
    case 'tipocategoria':
      $query = "SELECT * FROM tipocategoria";
      break;
    case 'tipotamaño':
      $query = "SELECT * FROM tipotamaño";
      break;
    case 'formadepago':
      $query = "SELECT * FROM formadepago";
      break;
    case 'tipodedocumento':
    $query = "SELECT * FROM tipoFactura";
    break;  
    default:
      $query = ''; // Maneja las otras opciones según tu lógica
      break;
  }

  if (!empty($query)) {
    $result = $conn->query($query);

    $data = array();
    while ($row = $result->fetch_assoc()) {
      $data[] = $row;
    }

    echo json_encode($data);
  } else {
    echo json_encode(array()); // Devuelve un array vacío si la opción no es válida
  }
}
?>

<?php
    include("../bd/conexion.php");

    $limiteStock = 30;

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

    echo $count;
    $conn->close();
?>

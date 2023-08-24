<?php
    include 'bd/conexion.php';
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Clean</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans:ital@1&family=Work+Sans:wght@300&display=swap" rel="stylesheet">
    <!-- Template Stylesheet -->
    <link href="css/styleLogin.css" rel="stylesheet">
    <link href="img/logoClean.css" rel="stylesheet">
</head>

<body>
    <section class="formulario">
        <div class="form-box">
            <img src="img/logoClean.png" class="avatar" alt="Avatar Image">
            <div class="form-value">
                <form action="" method="post">
                    <h2>Login</h2>
                    <div class="inputbox">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="email" name="Email" required>
                        <label for="">Correo</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" name="Clave" required>
                        <label for="">Contraseña</label>
                    </div>

                    <a class="nav-item nav-link active mb-2"><button  type="submit">Login</button></a>

                </form>
                <?php
                    include ('controladores/login.php')
                ?>
            </div>
        </div>
    </section>

    <section class="fondo">
        <div class="bubbles">
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class="bubble"></div>          
        </div>
    </section>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
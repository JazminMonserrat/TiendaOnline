<?php
require_once "../../conf/env.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URL_CSS?>style_login.css">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <title>Iniciar Sesión</title>
</head>

<body>
    <div class="main_login">
        <h1 class="sign">Iniciar Sesión</h1>
        <form action="<?php echo URL_CONTROLADORES?>loginController.php" method="post" class="form1">
            <input class="email" name="email" type="email" placeholder="@E-Mail" required>
            <input class="pass" name="password" type="password" placeholder="Password" required>
            <input class="login" type="submit" value="Login">
            <p class="forgot"><a href="registrarCliente.php">Registrarse</p>
            <p class="forgot"><a href="login_admin.php">Administrador</p>
        </form>
    </div>
</body>

</html>
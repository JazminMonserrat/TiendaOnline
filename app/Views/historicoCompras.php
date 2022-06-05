<?php
session_start();
require_once "../../conf/env.php";
require_once "../Models/producto.php";
require_once "../Models/compra.php";

$historico = [];
if (isset($_SESSION["id_cliente"])) {
    $historico = Compra::obtenerHistorico($_SESSION["id_cliente"]);
} else {
    header("Location:login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis compras</title>

    <!--Bootstrap CSS-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!--Inclusion de archivos css-->

    <meta name="page_type" content="np-template-header-footer-from-plugin">
    <title>Inicio</title>
    <link rel="stylesheet" href="../../public/css/nicepage.css" media="screen">
    <link rel="stylesheet" href="../../public/css/compras.css" media="screen">

    <link rel="stylesheet" type="text/css" href="../../public/css/bootstrap.css">
    <script class="u-script" type="text/javascript" src="../../public/js/nicepage.js" defer=""></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script type="text/javascript" src="../../public/js/jquery.1.11.1.js"></script>
    <script type="text/javascript" src="../../public/js/bootstrap.js"></script>

    <meta property="og:title" content="Inicio">
    <meta property="og:type" content="website">
    <meta name="theme-color" content="#478ac9">
    <link rel="canonical" href="index.html">
    <meta property="og:url" content="index.html">
    <style>
        <?php include '../../public/css/listaBonsais.css'; ?>
    </style>
</head>

<body data-home-page="Iniciar-Sesión.html" data-home-page-title="Iniciar Sesión" class="u-body">
    <!--Nav Bar-->
    <!--No sirve-->
    <?php
    if (isset($_SESSION["id_cliente"])) {
        require_once "menuCliente.php";
    } else {
        header("Location:login.php");
        exit();
    }
    ?>
    <!--Fin del NavBar-->

    <!--Mensaje para corroborar funcionamiento y boton de limpiar-->
    <br>
    <?php if ($mensaje != "") { ?>
        <div class="seccion-centrada alert alert-success">
            <p><?php print_r($mensaje); ?></p>
        </div>
    <?php } ?>

    <div class='contenedor'>
        <!--container-->

        <div class="contendor-compras">
            <?php foreach ($historico as $compra) { ?>
                <div class="tarjeta-compra">
                    <div class="fecha-compra"><span><?php echo $compra->fecha?></span></div>
                    <div class="productos-compra">
                        <?php foreach ($compra->productos as $producto) { ?>
                            <div class="item-producto">
                                <div class="imagen-item-producto">
                                    <img src="<?php echo $producto->imagenProducto?>" alt="imagen producto">
                                </div>
                                <div class="nombre-item-producto">
                                    <span><?php echo $producto->nombre?></span>
                                </div>
                                <div class="cantidad-item-producto">
                                    <span><?php echo $producto->cantidadVendida?></span>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <!--container-->
</body>

</html>
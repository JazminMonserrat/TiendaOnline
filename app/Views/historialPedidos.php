<?php
session_start();
require_once "../../conf/env.php";
require_once "../Models/usuario.php";
require_once "../Models/producto.php";
require_once "../Models/metodoPago.php";
require_once "../Models/compra.php";

if(isset($_GET["fechaInicio"]) && $_GET["fechaInicio"] !== "" && isset($_GET["fechaFin"]) && $_GET["fechaFin"] !== ""){
    $compras = Compra::obtenerVentasPorFechas($_GET["fechaInicio"], $_GET["fechaFin"]);
}else{
    $compras = Compra::obtenerVentasPorFechas(date("Y-m-d"), date("Y-m-d"));
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventas</title>

    <!--Bootstrap CSS-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!--Inclusion de archivos css-->

    <meta name="page_type" content="np-template-header-footer-from-plugin">
    <title>Inicio</title>
    <link rel="stylesheet" href="../../public/css/nicepage.css" media="screen">
    <link rel="stylesheet" href="../../public/css/listaProductos.css" media="screen">

    <link rel="stylesheet" type="text/css" href="../../public/css/bootstrap.css">
    <script class="u-script" type="text/javascript" src="../../public/js/nicepage.js" defer=""></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script type="text/javascript" src="../../public/js/jquery.1.11.1.js"></script>
    <script type="text/javascript" src="../../public/js/bootstrap.js"></script>
</head>

<body data-home-page="Iniciar-Sesión.html" data-home-page-title="Iniciar Sesión" class="u-body">
    <!--Nav Bar-->
    <?php
    if (isset($_SESSION["id_admin"])) {
        require_once "menuAdmin.php";
    } else {
        header("Location:login.php");
        exit();
    }
    ?>
    <!--Fin del NavBar-->

    <br>
    <div class="container">
        <form method="GET" action="historialPedidos.php">
            <div class="form-row align-items-center">
                <div class="col-auto">
                    <label class="mr-sm-2" for="fechaInicio">Fecha Inicio</label>
                    <input type="date" name="fechaInicio" class="form-control mb-2" id="fechaInicio">
                </div>
                <div class="col-auto">
                    <label class="mr-sm-2" for="fechaFin">Fecha Fin</label>
                    <input type="date" name="fechaFin" class="form-control mb-2" id="fechaFin">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mt-4">Buscar</button>
                </div>
            </div>
        </form>
    </div>
    <!--Comprobación del tamaño del carrito-->
    <div class="container">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Dirección</th>
                    <th scope="col" s>Resumen de productos</th>
                    <th scope="col">Importe total</th>
                    <th scope="col">Fecha</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($compras as $compra) { ?>
                    <?php $totalProductos = count($compra->productos) ?>
                    <tr>
                        <td><?php echo $compra->id_compra ?></td>
                        <td><?php echo $compra->cliente ?></td>
                        <td><?php echo $compra->direccion ?></td>
                        <td>
                            <table class="table">
                                <?php foreach ($compra->productos as $producto) { ?>
                                    <tr>
                                        <td><?php echo $producto->nombre ?></td>
                                        <td><?php echo $producto->cantidadVendida ?></td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </td>
                        <td><?php echo "$" . $compra->precioTotal ?></td>
                        <td><?php echo $compra->fecha ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>



</body>

</html>
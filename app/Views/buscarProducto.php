<?php
session_start();
require_once "../../conf/env.php";
require_once "../Models/producto.php";
require_once URL_CONTROLADORES . "carrito.php";

if(isset($_GET["busqueda"]) && is_string($_GET["busqueda"])){
    $productos = Producto::buscarProductoPorClave($_GET["busqueda"]);
}else{
    $productos = Producto::buscarProductosDefault();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>El Maletín de Merlin - Productos</title>

	<!--Bootstrap CSS-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
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
	if(isset($_SESSION["id_cliente"])){
		require_once "menuCliente.php";
  	}else{
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
        <div class="seccion-busqueda">
            <form class="seccion-busqueda" action="" method="GET">
                <div class="u-form-group u-form-name input-busqueda">
                    <input class="form-control mr-sm-2" placeholder="Buscar" type="search" name="busqueda" aria-label="Search">
                    <input type="submit" value="Buscar" class="btn btn btn-info my-2 my-sm-0">
                </div>
            </form>
        </div>

        <div class="contendor-productos">
            <?php foreach($productos as $producto){ ?>
            <div class="tarjeta-producto">
                <div>
                    <img src="<?php echo $producto->imagenProducto?>" alt="">
                </div>
                <div>
                    <strong><?php echo $producto->nombre?></strong>
                </div>
                <div>
                    <span><?php echo "$" . $producto->precio?></span>
                </div>
                <div>
                    <form action="" method='post'>
                        <input type="hidden" name="id" value="<?php echo $producto->id_producto ?>">
                        <input type="hidden" name="nombre" value="<?php echo $producto->nombre ?>">
                        <input type="hidden" name="precio" value="<?php echo $producto->precio ?>">
                        <input type="hidden" name="cantidad" value="1">
                        <button type="submit" name='btnAccion' value='Agregar' class="btn btn-primary" >Agregar al carrito</button>
                    </form>
                </div>
            </div>
            <?php } ?>
        </div>
	</div>
	<!--container-->
</body>

</html>
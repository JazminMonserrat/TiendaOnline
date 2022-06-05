<?php
session_start();
require_once "../../conf/env.php";
require_once "../Models/producto.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Carrito de compra</title>

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
	if(isset($_SESSION["id_cliente"])){
		require_once "menuCliente.php";
  	}else{
      	header("Location:login.php");
    	exit();
  }
  ?>
	<!--Fin del NavBar-->

	<br>
	
	<!--Comprobación del tamaño del carrito-->
	<?php if (!empty($_SESSION['Carrito'])) { ?>

		<div class="container">
            <div class="header-carrito">
				<h3>Productos del Carrito</h3> 
				<a href="<?php echo URL_CONTROLADORES?>limpiarCarritoController.php">
					<button class="btn-primary">Limpiar carrito</button>
				</a>
			</div>
			<table class="table table-bordered">
				<thead class="thead-dark">
					<tr>
						<th class="40% text-center">Descripción</th>
						<th class="15% text-center">Cantidad</th>
						<th class="20% text-center">Precio</th>
						<th class="20% text-center">Total</th>
						<th class="5%"></th>
					</tr>
				</thead>

				<tbody>
					<!--Iniciamos recorrido del carrito-->
					<?php $total = 0 ?>
					<?php foreach ($_SESSION['Carrito'] as $indice => $producto) { ?>
						<?php $total = $total + $producto['cantidad'] * $producto['precio'] ?>

						<tr>
							<th class="40%"><?php echo $producto['nombre'] ?></th>
							<th class="15% text-center"><?php echo $producto['cantidad'] ?></th>
							<th class="20% text-center"><?php echo $producto['precio'] ?></th>
							<th class="20% text-center"><?php echo number_format($producto['cantidad'] * $producto['precio'], 2) ?></th>
							<th class="5%  text-center">
								<form action="<?php echo URL_CONTROLADORES?>borrarProductoCarritoController.php" method="post">
									<input type="hidden" name="id" id="id" value="<?php echo $producto['id'] ?>">
									<button class="btn btn-danger" name="btnAccion" value="Eliminar" type="submit">Eliminar</button>
								</form>
							</th>
						</tr>

					<?php } ?>

					<tr>
						<td class="text-right" colspan="3">
							<h3>Total</h3>
						</td>
						<td class="text-right" colspan="2" style="color:green">
							<h3>$<?php echo number_format($total, 2) ?></h3>
						</td>
					</tr>
				</tbody>
			</table>
		</div>

		<div class="text-center">
			<a href="seleccionPago.php">
				<button class="btn btn-primary" type="submit">Comprar</button>
			</a>
		</div>
		<!--Fin de Comprobación del carrito-->
	<?php } else { ?>
		<div class="alert alert-success" role="alert">
			¡No Hay productos en el Carrito!
		</div>
	<?php } ?>
	</body>
</html>
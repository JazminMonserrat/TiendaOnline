<?php
function contarCarrito(){
	$contador = 0;
	foreach($_SESSION['Carrito'] as $producto){
		$contador += intval($producto["cantidad"]);
	}

	return $contador;
}

function calcularTotal(){
    $total = 0;
    foreach ($_SESSION['Carrito'] as $producto) {
        $total += $producto['cantidad'] * $producto['precio'];
    }

    return $total;
}
?>

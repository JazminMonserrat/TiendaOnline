<?php
session_start();
require_once "../../conf/env.php";
if(is_numeric($_POST['id'])){
    $ID = $_POST['id'];

    foreach($_SESSION['Carrito'] as $indice=>$producto){
        if($producto['id'] == $ID) {
            if($producto['cantidad'] == 1){
                unset($_SESSION['Carrito'][$indice]);
                array_values($_SESSION['Carrito']);
            } else {
                $producto['cantidad'] = $producto['cantidad'] - 1;
                $_SESSION['Carrito'][$indice] = $producto;
            }
        }
    }

}

header('Location: '. URL_VISTAS.'mostrarCarrito.php');
?>
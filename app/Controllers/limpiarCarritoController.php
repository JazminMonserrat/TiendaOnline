<?php
    require_once "../../conf/env.php";

    session_start();
    unset($_SESSION['Carrito']);

    header('Location: '.URL_VISTAS.'mostrarCarrito.php');
?>
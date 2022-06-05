<?php
session_start();
require_once "../../conf/env.php";
require_once "../Models/usuario.php";
require_once "../Models/producto.php";
require_once "../Models/metodoPago.php";
require_once "../Models/compra.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION['Carrito'])) {
        if (isset($_POST["pago"]) && isset($_POST["codigo"])) {
            if($_POST["pago"] === "tarjeta" && strlen($_POST["codigo"]) != 16){
                $jsondata = ["error" => "Error, el numero de tarjeta no es valido"];
                header('Content-type: application/json; charset=utf-8');
                echo json_encode($jsondata);
                exit();
            }
            $compra = new Compra();
            $total = floatval(substr($_POST["total"], 1, strlen($_POST["total"]) - 1));
            $compra->nombreCliente = $_POST["nombre"];
            $compra->precioTotal = $total;
            $compra->totalVendio = intval($_POST["cantidad"]);
            $compra->fecha = date("Y-m-d");
            $compra->id_usuario = $_SESSION["id_cliente"];
            $compra->direccion = $_POST["direccion"];

            foreach ($_SESSION['Carrito'] as $indice => $producto) {
                $productoDB = Producto::buscarProducto($producto["id"]);
                $productoDB->cantidadVendida = $producto["cantidad"];
                $compra->productos[] = $productoDB;
            }

            $metodoPago = new MetodoPago();
            $metodoPago->tipo = $_POST["pago"];
            $metodoPago->nombre = $_POST["nombre"];
            $metodoPago->total = $total;
            $metodoPago->referencia = $_POST["codigo"];
            $metodoPago->cantidadComprada = intval($_POST["cantidad"]);

            $compra->metodoPago = $metodoPago;
            $validacion = $compra->registrarVenta();
            if ($validacion) {
                unset($_SESSION['Carrito']);
                $jsondata = ["success" => "success"];
                header('Content-type: application/json; charset=utf-8');
                echo json_encode($jsondata);
                exit();
            } else {
                $jsondata = ["error" => "Error, no se pudo realizar la compra"];
                header('Content-type: application/json; charset=utf-8');
                echo json_encode($jsondata);
                exit();
            }
        } else {
            $jsondata = ["error" => "Error, seleccione metodo de pago y valide su referencia"];
            header('Content-type: application/json; charset=utf-8');
            echo json_encode($jsondata);
            exit();
        }
    } else {
        $jsondata = ["error" => "Error, no se tiene nada en el carrito de compra"];
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($jsondata);
        exit();
    }
}

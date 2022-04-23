<?php
require_once "../../conf/env.php";
require_once "../Models/producto.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["accion"]) && $_POST["accion"] == "delete" && isset($_POST["id_producto"])){
        $producto = Producto::buscarProducto($_POST["id_producto"]);
        $validacion = $producto->eliminarProducto();

        if ($validacion) {
            $jsondata = ["success" => "success"];
            header('Content-type: application/json; charset=utf-8');
            echo json_encode($jsondata);
            exit();
        } else {
            $jsondata = ["error" => "Error, no se pudo guardar la cita"];
            header('Content-type: application/json; charset=utf-8');
            echo json_encode($jsondata);
            exit();
        }
    }
}

?>
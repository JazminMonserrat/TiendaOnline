<?php
require_once "../../conf/env.php";
require_once "../Models/producto.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        isset($_POST["nombre"]) && isset($_POST["categoria"])
        && isset($_POST["descripcion"]) && isset($_POST["precio"])
        && isset($_POST["cantidad"])
    ) {
        $pathImage = URL_IMAGENE_PRODUCTO_DEFAULT;
        if (isset($_FILES["imagenProducto"]) && file_exists($_FILES['imagenProducto']['tmp_name'])) {
            $pathImage = PATH_IMAGENES_PRODUCTO . uniqid();
            if (move_uploaded_file($_FILES['imagenProducto']['tmp_name'], $pathImage)) {
                if (file_exists($_FILES['imagenProducto']['tmp_name'])) {
                    unlink($_FILES['imagenProducto']['tmp_name']);
                }
            }
        }
        $producto = new Producto();
        $producto->nombre = $_POST["nombre"];
        $producto->categoria = $_POST["categoria"];
        $producto->descripcion = $_POST["descripcion"];
        $producto->cantidad = $_POST["cantidad"];
        $producto->precio = $_POST["precio"];
        $producto->imagenProducto = $pathImage;
        $validacion = $producto->registrarProducto();
        // die(var_dump(($producto)));

        if ($validacion) {
            $jsondata = ["success" => "success"];
            header('Content-type: application/json; charset=utf-8');
            echo json_encode($jsondata);
            exit();
        } else {
            $jsondata = ["error" => "Error, no se pudo guardar el usuario"];
            header('Content-type: application/json; charset=utf-8');
            echo json_encode($jsondata);
            exit();
        }
    }else{
        $jsondata = ["error" => "Faltan campos"];
            header('Content-type: application/json; charset=utf-8');
            echo json_encode($jsondata);
            exit();
    }
}

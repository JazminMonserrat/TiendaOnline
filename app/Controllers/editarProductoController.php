<?php
require_once "../../conf/env.php";
require_once "../Models/producto.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["id_producto"]) && isset($_POST["nombre"]) && isset($_POST["categoria"])
    && isset($_POST["descripcion"]) && isset($_POST["precio"]) && isset($_POST["cantidad"])){
        $producto = Producto::buscarProducto($_POST["id_producto"]);
        if($producto){
            if (isset($_FILES["imagenProducto"]) && file_exists($_FILES['imagenProducto']['tmp_name'])){
                $pathImage = PATH_IMAGENES_PRODUCTO.uniqid();
                if (move_uploaded_file($_FILES['imagenProducto']['tmp_name'], $pathImage)) {
                    if (file_exists($_FILES['imagenProducto']['tmp_name'])){
                        unlink($_FILES['imagenProducto']['tmp_name']);
                        if (file_exists($producto->imagenProducto) && $producto->imagenProducto !== URL_IMAGENE_PRODUCTO_DEFAULT){
                            unlink($producto->imagenProducto);
                        }
                    }
                }
                $producto->imagenProducto = $pathImage;
            }
    
            $producto->nombre=$_POST["nombre"];
            $producto->descripcion=$_POST["descripcion"];
            $producto->categoria=$_POST["categoria"];
            $producto->cantidad=$_POST["cantidad"];
            $producto->precio=$_POST["precio"];
    
            $validacion = $producto->editarProducto();
    
            if ($validacion) {
                $jsondata = ["success" => "success"];
                header('Content-type: application/json; charset=utf-8');
                echo json_encode($jsondata);
                exit();
            } else {
                $jsondata = ["error" => "Error, no se pudo editar el producto"];
                header('Content-type: application/json; charset=utf-8');
                echo json_encode($jsondata);
                exit();
            }
        }else{
            $jsondata = ["error" => "Error, no existe producto"];
                header('Content-type: application/json; charset=utf-8');
                echo json_encode($jsondata);
                exit();
        }
        
    }
}
?>

<?php
require_once "../../conf/env.php";
require_once "../Models/usuario.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["correo"])) {
        $usuario = Usuario::buscarUsuarioPorCorreo($_POST["correo"]);
        if ($usuario === null) {
            if (
                isset($_POST["nombre"]) && isset($_POST["telefono"]) && isset($_POST["direccion"])
                && isset($_POST["contrasena"]) && isset($_POST["confirmarContrasena"]) && isset($_POST["correo"])
            ) {
                $usuario = new Usuario();
                $usuario->nombre = $_POST["nombre"];
                $usuario->telefono = $_POST["telefono"];
                $usuario->direccion = $_POST["direccion"];
                $usuario->contrasena = $_POST["contrasena"];
                $usuario->correo = $_POST["correo"];
                $validacion = $usuario->registrarUsuario();

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
            }
        } else {
            $jsondata = ["error" => "Error, el correo que intenta registrar ya se encuentra registrado"];
            header('Content-type: application/json; charset=utf-8');
            echo json_encode($jsondata);
            exit();
        }
    } 
}

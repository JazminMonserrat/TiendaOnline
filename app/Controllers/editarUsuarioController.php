<?php
require_once "../../conf/env.php";
require_once "../Models/usuario.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["id_correo"])) {
        $usuario = Usuario::buscarUsuarioPorCorreo($_POST["id_correo"]);
        if ($usuario) {
            $usuariosExistente = Usuario::buscarUsuarioPorCorreo($_POST["correo"]);
            if($usuariosExistente === null || $usuario->correo === $usuariosExistente->correo){
                if (
                    isset($_POST["nombre"]) && isset($_POST["telefono"]) && isset($_POST["direccion"])
                    && isset($_POST["contrasena"]) && isset($_POST["confirmarContrasena"]) && isset($_POST["correo"])
                ) {
                    $cambioContraseña = false;
                    if(isset($_POST["contrasena"]) && $_POST["contrasena"] !== "" && isset($_POST["confirmarContrasena"]) && $_POST["confirmarContrasena"] !== ""){
                        if ($_POST["contrasena"] === $_POST["confirmarContrasena"]){
                            $cambioContraseña = true;
                            $usuario->contrasena = $_POST["contrasena"];
                        }else{
                            $jsondata = ["error" => "Las contraseñas no son iguales"];
                            header('Content-type: application/json; charset=utf-8');
                            echo json_encode($jsondata);
                            exit();
                        }
                    }
                    $usuario->nombre = $_POST["nombre"];
                    $usuario->telefono = $_POST["telefono"];
                    $usuario->direccion = $_POST["direccion"];
                    $usuario->correo = $_POST["correo"];
                    $validacion = $usuario->editarUsuario($cambioContraseña);
    
                    if ($validacion) {
                        $jsondata = ["success" => "Usuario creado"];
                        header('Content-type: application/json; charset=utf-8');
                        echo json_encode($jsondata);
                        exit();
                    } else {
                        $jsondata = ["error" => "Error, no se pudo editar el usuario"];
                        header('Content-type: application/json; charset=utf-8');
                        echo json_encode($jsondata);
                        exit();
                    }
                }
            } else{
                $jsondata = ["error" => "Error, el correo que intenta ingresar ya esta registrado"];
                header('Content-type: application/json; charset=utf-8');
                echo json_encode($jsondata);
                exit();
            }
        } else {
            $jsondata = ["error" => "Error, el correo que intenta ingresar no esta registrado"];
            header('Content-type: application/json; charset=utf-8');
            echo json_encode($jsondata);
            exit();
        }
    } 
}

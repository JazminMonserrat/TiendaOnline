<?php
    session_start();
    require_once "../../conf/env.php";
    require '../../conf/database.php';
    
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $resultado = $conn->prepare('SELECT * FROM usuarios WHERE correo=:email');
        $resultado->bindParam(':email', $_POST['email']);
        $resultado->execute();

        $registros = $resultado->fetch(PDO::FETCH_ASSOC);

        $message = '';
        $location = '';
        
        if(!empty($registros) && count($registros) > 0){
            //password_verify(): Metodo para poder comparar contraseñas con encriptación hash.
            if(md5($_POST['password']) == $registros['contrasena']){
                $_SESSION['user_email'] = $registros['correo'];
                if($registros["tipo"] == "admin"){
                    $_SESSION['id_admin'] = $registros['id_usuario'];
                }else{
                    $_SESSION['id_cliente'] = $registros['id_usuario'];
                }
                header('Location: '. URL_VISTAS.'index.php');
            } else{
                $message = 'Error: contraseña incorrecta';
                $location = URL_VISTAS.'login.php';
                alerta($message, $location);
            }
        } else {
            $message = 'Cliente inexistente';
            $location = URL_VISTAS.'login.php';
            alerta($message, $location);
        }
    }else{
        $message = 'Los campos estan vacios';
        $location = URL_VISTAS.'login.php';
        alerta($message, $location);
    }

    function alerta($mensaje, $direccion){
        echo "<script type='text/javascript'>
        alert('".$mensaje."');
        window.location.href='".$direccion."';
        </script>";
    }
?>
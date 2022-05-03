<?php
$mensaje = "";
if(isset($_POST['btnAccion'])){
    switch ($_POST['btnAccion']) {
        case 'Agregar':
            #Verificar y desencriptar ID
            if(is_numeric($_POST['id'])){
                $ID = $_POST['id'];
                $mensaje.="OK<br>";
                $mensaje.="ID: ".$ID."<br>";
            } else {
                $mensaje = "Decrypt Error: ID Incorrecto";
                break;
            }
            
            #Verificar y desencriptar Nombre
            if(is_string($_POST['nombre'])){
                $Nombre = $_POST['nombre'];
                $mensaje.="Nombre: ".$Nombre."<br>";
            } else {
                $mensaje = "Decrypt Error: Nombre Incorrecto";
                break;
            }

            #Verificar y desencriptar Precio
            if(is_numeric($_POST['precio'])){
                $Precio = $_POST['precio'];
                $mensaje.="Precio: ".$Precio."<br>";
            } else {
                $mensaje = "Decrypt Error: Precio Incorrecto";
                break;
            }
            
            #Verificar y desencriptar Cantidad
            if(is_numeric($_POST['cantidad'])){
                $Cantidad = $_POST['cantidad'];
                $mensaje.="Cantidad: ".$Cantidad."<br>";
            } else {
                $mensaje = "Decrypt Error: Cantidad Incorrecto";
                break;
            }

            if(!isset($_SESSION['Carrito'])){
                $producto = array(
                    'id' => $ID,
                    'nombre' => $Nombre,
                    'precio' => $Precio,
                    'cantidad' => $Cantidad
                );
                $_SESSION['Carrito'][0] = $producto;
                $mensaje = "Producto Agregado Correctamente.";
            } else {
                $id_Productos = array_column($_SESSION['Carrito'], 'id');

                if(in_array($ID, $id_Productos)){
                    foreach($_SESSION['Carrito'] as $indice=>$producto){
                        if($producto['id'] == $ID) {
                            // $producto['cantidad'] = $producto['cantidad'] + 1;
                            $_SESSION['Carrito'][$indice] = $producto;
                        }
                    }
                    $mensaje = 'Unidad Ya Agregada al Carrito.';
                } else {
                    $sizeCarrito = count($_SESSION['Carrito']);
                    $producto = array(
                        'id' => $ID,
                        'nombre' => $Nombre,
                        'precio' => $Precio,
                        'cantidad' => $Cantidad
                    );
                    $_SESSION['Carrito'][$sizeCarrito] = $producto;
                    $mensaje = "Producto Agregado Correctamente.";
                }
            }
            //$mensaje = print_r($_SESSION['Carrito'], true);
        break;

        case 'Eliminar':
            #Verificar y desencriptar ID
            if(is_numeric($_POST['id'])){
                $ID = $_POST['id'];

                foreach($_SESSION['Carrito'] as $indice=>$producto){
                    if($producto['id'] == $ID) {
                        if($producto['cantidad'] == 1){
                            unset($_SESSION['Carrito'][$indice]);
                            array_values($_SESSION['Carrito']);
                            echo "<script type='text/javascript'>
                            alert('Producto Borrado');
                            window.location.href='".URL_VISTAS.'listaBonsaisCliente.php'."';
                            </script>";
                        } else {
                            $producto['cantidad'] = $producto['cantidad'] - 1;
                            $_SESSION['Carrito'][$indice] = $producto;
                        }
                    }
                }
            } else {
                $mensaje = "Decrypt Error: ID Incorrecto";
                break;
            }
        break;
        default:
            # code...
        break;
    }
}
?>
<?php
require_once "../../conf/env.php";
include URL_CONTROLADORES . "carrito.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Bonsais</title>

    <!--Bootstrap CSS-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!--Inclusion de archivos css-->

    <meta name="page_type" content="np-template-header-footer-from-plugin">
    <title>Inicio</title>
    <link rel="stylesheet" href="../../public/css/nicepage.css" media="screen">
    <link rel="stylesheet" type="text/css" href="<?php echo URL_CSS?>listaBonsais.css">

    <link rel="stylesheet" type="text/css" href="../../public/css/bootstrap.css">
    <script class="u-script" type="text/javascript" src="../../public/js/nicepage.js" defer=""></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <script type="text/javascript" src="../../public/js/jquery.1.11.1.js"></script>
    <script type="text/javascript" src="../../public/js/bootstrap.js"></script>
    <script type="text/javascript" src="<?php echo URL_JS?>producto.js"></script>

    <script language="JavaScript" type="text/javascript">
        function confirmationDelete(anchor) {
            var conf = confirm('Estas Seguro que quieres borrar este Bonsai?');
            if (conf)
                window.location = anchor.attr("href");
        }
    </script>

    <script language="JavaScript" type="text/javascript">
        function confirmationEdit(anchor) {
            var conf = confirm('Estas Seguro que quieres Editar este Bonsai?');
            if (conf)
                window.location = anchor.attr("href");
        }
    </script>




    <meta property="og:title" content="Inicio">
    <meta property="og:type" content="website">
    <meta name="theme-color" content="#478ac9">
    <link rel="canonical" href="index.html">
    <meta property="og:url" content="index.html">


</head>
<body class="u-body">
    <!--Nav Bar-->
    <!--No sirve-->
    <!--Fin del NavBar-->

    <!--Mensaje para corroborar funcionamiento y boton de limpiar-->
    <br>
    <?php if ($mensaje != "") { ?>
        <div class="alert alert-success">
            <?php print_r($mensaje); ?>
            <a href="<?php echo URL_CONTROLADORES ?>limpiar_carrito.php" class="badge badge-success">Limpiar Carrito</a>
        </div>
    <?php } ?>

    <div class='contenedor'>
        <div class="contenedor-margen alinear-derecha">
            <button type="button" class="boton-cita" id="registrarBonsai"><a href="<?php echo URL_VISTAS ?>registrarProducto.php">Registrar Producto</a></button>
        </div>
        <!--container-->
        <?php
        $mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
        $sql = "SELECT * FROM productos";
        if ($result = $mysqli->query($sql)) {
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_array()) {



                    //Agregar opciones para editar y eliminar

                    //Fuera del table                      
                    //Iconos para editar y borrar



                    echo "<div class='bonsaiInformation'>;";
                    echo "<div class='bonsaiSegment' >";
                    echo "<img src='" . $row['imagenProducto'] . "' alt='Not Found' onerror=this.src='../../public/bonsais/Error.png' width='200' height='120' class='imagenB'>";
                    echo "<label class='nameFont quantity' for=''>" . $row['nombre'] . "</label>";

                    echo "<label class='nameFont' for=''>" . $row['descripcion'] . "</label>";

                    echo "<div >";
                    echo "<label class='infoFont quantity' for=''>" . "Precio: " . $row['precio'] . ".00 $</label>";
                    echo "<label class='quantity infoFont''for=''>" . "Cantidad: " . $row['catidad'] . "</label>";

                    echo "<i class='fa fa-trash-o  icons' id='eliminar-producto' aria-hidden='true' data-id='" . $row['id_producto'] . "'></i>";
                    echo "<i class='fa fa-pencil icons' aria-hidden='true'  
          onclick='javascript:confirmationEdit($(this));return false;' href='../../app/Views/editarProducto.php?id=" . $row['id_producto'] . "'> </i>";
                    echo "</div>";
                    echo
                    "<form action='' method='post'>
            <input type='hidden' name='id' id='id' value='" . $row['id_producto'] . "'>
            <input type='hidden' name='nombre' id='nombre' value='" . $row['nombre'] . "'>
            <input type='hidden' name='precio' id='precio' value='" . $row['precio'] . "'>
            <input type='hidden' name='cantidad' id='cantidad' value='1'>
            <button class='btn btn-primary' name='btnAccion' value='Agregar' type='submit'>Agregar al Carrito</button>
           </form>";


                    echo "</div>";
                    echo "</div>";
                }
                echo "</tbody>";
                echo "</table>";
                // Free result set
                $result->free();
            } else {
                echo "<p class='lead'><em>No Hay elementos en la base de datos.</p>";
            }
        } else {
            echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
        }

        // Close connection
        $mysqli->close();

        ?>


    </div>
    <!--container-->
</body>

</html>
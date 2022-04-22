<?php
require_once "../../conf/env.php";

//Variables de los inputs
$nombre = "";
$descripcion = "";
$categoria = "";
$precio = "";
$cantidad = "";
//Variables para verificar errores
$imgERR = "";
$nomERR = "";
$descERR = "";
$catERR = "";
$prcERR = "";
$cantErr = "";

//pide el metodo post
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Validar el nombre de usuario
  if (empty(trim($_POST["nombre"]))) {
    $namCiERR = "Por favor, ingrese el nombre del producto";
  } else {
    // Busca el nombre del producto en la base de datos
    $sql = "SELECT * FROM producto WHERE nombre = ?";

    if ($stmt = $mysqli->prepare($sql)) {
      $stmt->bind_param("s", $param_name);
      $param_name = trim($_POST["nombre"]);
      if ($stmt->execute()) {
        $stmt->store_result();
        if ($stmt->num_rows == 1) {
          $namCiERR = "Ya existe este producto.";
        } else {
          $nombreCi = trim($_POST["nombre"]);
        }
      } else {
        echo "Oops! Something went wrong. Please try again later.";
      }

      // Close statement
      $stmt->close();
    }
  }

  $descripcion = $_POST["descripcion"];
  $categoria = $_POST["categoria"];
  $precio = $_POST["precio"];
  $cantidad = $_POST['cantidad'];

  // Validacion de los campos
  if (empty($nomERR)) {

    // If upload button is clicked ...
    if (isset($_POST['upload'])) {

      $filename = $_FILES["uploadfile"]["name"];
      $tempname = $_FILES["uploadfile"]["tmp_name"];
      $folder = "../../public/bonsais/" . $filename;

      //Preparamos el statement para el SQL
      $sql = "INSERT INTO producto (id_producto,imagenProducto,nombre,descipcion,categoria
,precio,cantidad) values (Null,?,?,?,?,?,?,?)";
      // Modificar 
      if ($stmt = $mysqli->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param(
          "siissii",
          $param_id_producto,
          $param_imgURL,
          $param_nombre,
          $param_descripcion,
          $param_categoria,
          $param_precio,
          $param_cantidad
        );

        // Set parameters
        $param_imgURL = $folder;
        $param_id_producto = $producto;
        $param_nombre = $nombre;
        $param_descripcion = $descripcion;
        $param_categoria = $categoria;
        $param_precio = $precio;
        $param_cantidad = $cantidad;

        // Ejecuta el statement
        if ($stmt->execute()) {

          // Redirigir a la lista de bonsais
          header("location: ../../app/Views/listaProductos.php");
        } else {
          echo "Algo malo paso, por favor intente de nuevo!!.";
        }

        // Close statement
        $stmt->close();
        move_uploaded_file($tempname, $folder);
      }
    }
  } //Fin de validacion empty

}
?>

<!---------------------------------------- Seccion de HTML------------------------------------------------>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <meta name="keywords" content="Blooms, For Every Occasion">
  <meta name="description" content="">
  <meta name="page_type" content="np-template-header-footer-from-plugin">
  <title>Inicio</title>
  <link rel="stylesheet" href="../../public/css/nicepage.css" media="screen">
  <link rel="stylesheet" href="../../public/css/Iniciar-Sesión.css" media="screen">
  <link rel="stylesheet" type="text/css" href="../../public/css/style.css">
  <link rel="stylesheet" type="text/css" href="../../public/css/bootstrap.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
  <!--Bootstrap CSS-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script class="u-script" type="text/javascript" src="../../public/js/nicepage.js" defer=""></script>

  <style>
    <?php include '../../public/css/registrarProductos.css'; ?>
  </style>

  <meta name="generator" content="Nicepage 3.11.0, nicepage.com">

  <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i">
  <link id="u-page-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i">
  <script type="text/javascript" src="../../public/js/jquery.1.11.1.js"></script>
  <script type="text/javascript" src="../../public/js/bootstrap.js"></script>
  <script type="text/javascript" src="../../public/js/jquery.isotope.js"></script>
  <script type="text/javascript" src="../../public/js/jqBootstrapValidation.js"></script>

  <script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "Organization",
      "name": "",
      "url": "index.html",
      "logo": "../../publico/imagenes/bonsai_karla.png"
    }
  </script>

  <meta property="og:title" content="Inicio">
  <meta property="og:type" content="website">
  <meta name="theme-color" content="#478ac9">
  <link rel="canonical" href="index.html">
  <meta property="og:url" content="index.html">
</head>

<body class="u-body">

  <!--NavBar-->
  <?php
    include "../../app/Views/menuAdmin.php";
  ?>
  <!--Fin deNavBar-->

  <!--Registro-->
  <div class="registro">
    <form style="position:relative" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <!-- Div de imagen-->
      <div class="image-upload">
        <p style="text-align:Center;">
          <label for="file-input">
            <img src="../../public/imagenes/upload.gif" width='200' height='200' class="inputImage" />
          </label>

          <input type="file" name="uploadfile" oninput='validity.valid' id="file-input" single accept="image/png, .jpeg, .jpg , .gif,.bmp">
          <!--Si la imagen esta puesta manda el siguiente mensaje-->
          <!--Arreglar esta onda-->
          <?php
          if (empty($_FILES)) {
            echo "<span class='help-block inputFont'>Seleccione una imagen</span>";
          }

          ?>
          <!--Error de imagen-->
          <span class='help-block inputFont'><?php echo $imgERR; ?></span>
        </p>
      </div>
      <!-- Fin de div de imagen-->

      <p style="text-align:Center;">


        <br>
        <label class="inputFont" for="nombre">Nombre del producto</label>
        <br>
        <input name="nombre" type="text">
        <!--Error de nombre -->
        <span class='help-block inputFont'><?php echo $nomERR; ?></span>
        <br>
        <label class="inputFont" for="descripcion">Descripcion</label>
        <br>
        <input type="string" name="descripcion" id="campoDescripcion"  required="required">
        <span class='help-block inputFont'><?php echo $descErr; ?></span>
        <br>
        <label class="inputFont" for="categoria">Categoría</label>
        <br>
        <select name="categoria">
          <option value="1">Ropa</option>
          <option value="2">Accesorio</option>
          <option value="3">Smartwatch </option>
          <option value="4">Auriculares</option>
          <option value="5">Maquillaje</option>
        </select>
        <br>

        <label class="inputFont" for="precio">Precio</label>
        <br>
        <input type="number" name="precio" id="campoPrecio" min="0" max="999999" oninput="validity.valid||(value='');" required="required">
        <span class='help-block inputFont'><?php echo $prcERR; ?></span>
        <br>

        <label class="inputFont" for="cantidad">Cantidad</label>
        <br>
        <input type="number" name="cantidad" id="campoCantidad" required="required">
        <span class='help-block inputFont'><?php echo $cantErr; ?></span>
        <br>
        <button class="registrar" type="submit" name="upload">Registrar</button>
        <button class="limpiar" type="reset">Limpiar </button>
      </p>

  </div>

  <br>
  <!--Fin Registro-->
</body>

</html>
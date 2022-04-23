<?php
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    require_once "../../conf/env.php";
    require_once "../Models/producto.php";
    $producto = Producto::buscarProducto($_GET['id']);
} else {
    header("location: ../../index.php");
    exit();
}

session_start();
?>

<!DOCTYPE html>
<html style="font-size: 16px;">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="Blooms, For Every Occasion">
    <meta name="description" content="">
    <meta name="page_type" content="np-template-header-footer-from-plugin">
    <title>Editar producto</title>
    <link rel="stylesheet" href="<?php echo URL_CSS?>registrarCliente.css" media="screen">
    <link rel="stylesheet" href="<?php echo URL_CSS?>nicepage.css" media="screen">
    <link rel="stylesheet" href="<?php echo URL_CSS?>Iniciar-Sesión.css" media="screen">
    <link rel="stylesheet" type="text/css" href="<?php echo URL_CSS?>style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URL_CSS?>bootstrap.css">
    <script class="u-script" type="text/javascript" src="<?php echo URL_JS?>nicepage.js" defer=""></script>

    <meta name="generator" content="Nicepage 3.11.0, nicepage.com">
    <link id="u-theme-google-font" rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i">
    <link id="u-page-google-font" rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i">
    <script type="text/javascript" src="<?php echo URL_JS?>jquery.1.11.1.js"></script>
    <script type="text/javascript" src="<?php echo URL_JS?>bootstrap.js"></script>
    <script type="text/javascript" src="<?php echo URL_JS?>jquery.isotope.js"></script>
    <script type="text/javascript" src="<?php echo URL_JS?>jqBootstrapValidation.js"></script>
    <script type="text/javascript" src="<?php echo URL_JS?>cliente.js"></script>

    <script type="application/ld+json">{
		"@context": "http://schema.org",
		"@type": "Organization",
		"name": "",
		"url": "index.html",
		"logo": "../../public/imagenes/bonsai_karla.png"
}</script>
    <meta property="og:title" content="Inicio">
    <meta property="og:type" content="website">
    <meta name="theme-color" content="#478ac9">
    <link rel="canonical" href="index.html">
    <meta property="og:url" content="index.html">
</head>

<body data-home-page="Iniciar-Sesión.html" data-home-page-title="Iniciar Sesión" class="u-body">

    <div>
        <section class="u-clearfix u-section-1" id="sec-0b39">
            <div class="u-clearfix u-sheet u-sheet-1">
                <h1 class="u-text u-text-default u-text-1">Editar producto</h1>
                <div class="u-form u-form-1">
                    <form enctype="multipart/form-data" action="<?php echo URL_CONTROLADORES?>editarProductoController.php" method="post" class="u-clearfix u-form-spacing-10 u-form-vertical u-inner-form"
                        style="padding: 10px" source="custom" name="form">
                        <input class="form-file form-hidden" type="file" name="imagenProducto" id="imagenProducto">
                        <input type="hidden" name="id_producto" value="<?php echo $producto->id_producto?>">
                        <div class="u-form-group u-form-name">
                            <label for="name-dc48" class="u-form-control-hidden u-label">Nombre</label>
                            <input value="<?php echo $producto->nombre?>" type="text" placeholder="Nombre" id="nombre" name="nombre"
                                class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white" required="">
                        </div>
                        <div class="u-form-group u-form-name u-form-group-2">
                            <label for="name-8ced" class="u-form-control-hidden u-label">Descripción</label>
                            <input value="<?php echo $producto->descripcion?>" type="text" placeholder="Descripción" id="descripcion" name="descripcion"
                                class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white" required="">
                        </div>
                        <div class="u-form-group u-form-name u-form-group-3">
                            <label for="name-998d" class="u-form-control-hidden u-label">Categoria</label>
                            <select name="categoria" id="categoria">
                                <option <?php echo ($producto->categoria === "ropa") ? "selected": "";?> value="ropa">Ropa</option>
                                <option <?php echo ($producto->categoria === "accesorio") ? "selected": "";?> value="accesorio">Accesorio</option>
                                <option <?php echo ($producto->categoria === "smartwatch") ? "selected": "";?> value="smartwatch">Smartwatch</option>
                                <option <?php echo ($producto->categoria === "auriculares") ? "selected": "";?> value="auriculares">Auriculares</option>
                                <option <?php echo ($producto->categoria === "maquillaje") ? "selected": "";?> value="maquillaje">Maquillaje</option>
                            </select>
                        </div>
                        <div class="u-form-group u-form-group-7">
                            <label for="text-2386" class="u-form-control-hidden u-label">Cantidad</label>
                            <input value="<?php echo $producto->cantidad?>" type="number" placeholder="Cantidad" id="cantidad" name="cantidad"
                                class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white" required="">
                        </div>
                        <div class="u-form-email u-form-group">
                            <label for="email-dc48" class="u-form-control-hidden u-label">Precio</label>
                            <input value="<?php echo $producto->precio?>" type="number" placeholder="Precio" id="precio" name="precio"
                                class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white" required="">
                        </div>
                        <div class="u-align-right u-form-group u-form-submit">
                            <a href="#" class="boton-verde u-btn u-btn-submit u-button-style u-btn-1">ACTUALIZAR DATOS<br>
                            </a>
                            <input type="submit" value="submit" class="u-form-control-hidden">
                        </div>
                        <div class="u-form-send-message u-form-send-success"> Tus datos han sido actualizados. </div>
                        <div class="u-form-send-error u-form-send-message"> Ha ocurrido un error al guardarlo. </div>
                        <input type="hidden" value="" name="recaptchaResponse">
                    </form>
                </div>
                <div alt="" class="u-image-registrar u-image-perfil u-image u-image-circle" style="background-image: url('/<?php echo $producto->imagenProducto?>');" data-image-width="1280" data-image-height="854">
                </div>

                <a class="select-bottom u-text u-text-registrar">CAMBIAR IMAGEN</a>
            </div>
        </section>
    </div>

    <footer class="u-align-center u-clearfix u-footer u-grey-80 u-footer" id="sec-712f">
        <div class="u-clearfix u-sheet u-sheet-1">
            <p class="u-small-text u-text u-text-variant u-text-1">Universidad Veracruzana&nbsp;<br>Desarrollo de
                Software
            </p>
        </div>
    </footer>

</body>

</html>